<!-- PHP Code Start -->
<?php
include 'database.php';

/* Fetch Brand Data */
$brand_sql = "SELECT * FROM book_brand";
$brand_result = mysqli_query($conn, $brand_sql);

/* Fetch Categories Data */
$categories_sql = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_sql);

/* Insert Product Data */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $book_product_name        = $_POST['book_product_name'];
    $brand_id                 = $_POST['brand_id'];
    $categories_id                 = $_POST['categories_id'];

    $book_product_description = $_POST['book_product_description'];

    /* Image Upload */
    $image_name = $_FILES['book_product_image']['name'];
    $temp_name  = $_FILES['book_product_image']['tmp_name'];

    $folder = '../Image/' . $image_name;

    move_uploaded_file($temp_name, $folder);

    /* Insert Query */
    $sql = "INSERT INTO `book_product`
            (
                `book_product_name`,
                `brand_id`,
                `categories_id`,
                `book_product_image`,
              
                `book_product_description`
            )

            VALUES
            (
                '$book_product_name',
                '$brand_id',
                '$categories_id',
                '$folder',
                 
                '$book_product_description'
            )";

    $result = mysqli_query($conn, $sql);

    if ($result) {

        echo "<script>
                alert('Book Product Added Successfully');
                window.location.href='view_book_product.php';
              </script>";
    } else {

        echo "<script>
                alert('Data Not Inserted');
              </script>";
    }
}
?>
<!-- PHP Code End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book Product</title>

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f1f5f9;
        }

        .page-wrapper {
            margin-left: 260px;
            padding: 30px;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .card-header-custom {
            background: #ae7be6;
            color: white;
            padding: 25px;
        }

        .card-header-custom h2 {
            margin: 0;
            font-weight: 700;
        }

        .form-control,
        .form-select,
        textarea {
            border-radius: 12px;
        }

        .btn-custom {
            border-radius: 12px;
            padding: 10px 25px;
        }
        .add{
            background-color: #3d035f;
            color: white;
            border: 1px solid #3d035f;
        }
        .view{
            border: 1px solid #3d035f;
            text-decoration: none;
            color: #000;
            background-color: #ae7be6;
        }

        @media(max-width:768px) {

            .page-wrapper {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include 'sidebar_menu.php'; ?>

    <div class="page-wrapper">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="card shadow-lg card-custom">

                        <!-- Header -->
                        <div class="card-header-custom text-center">

                            <h2>
                                <i class="bi bi-book-half"></i>
                                Add Product
                            </h2>

                        </div>

                        <!-- Body -->
                        <div class="card-body p-5">

                            <form action="" method="POST" enctype="multipart/form-data">

                                <!-- Product Name -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Product Name
                                    </label>

                                    <input type="text"
                                        name="book_product_name"
                                        class="form-control form-control-lg"
                                        placeholder="Enter Product Name"
                                        required>

                                </div>

                                <!-- Brand -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Select Brand
                                    </label>

                                    <select name="brand_id"
                                        class="form-select form-select-lg"
                                        required>

                                        <option value="">
                                            Select Brand
                                        </option>

                                        <?php while ($brand = mysqli_fetch_assoc($brand_result)) { ?>

                                            <option value="<?= $brand['brand_id']; ?>">
                                                <?= $brand['brand_name']; ?>
                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <!-- Categories -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Select Categories
                                    </label>

                                    <select name="categories_id"
                                        class="form-select form-select-lg"
                                        required>

                                        <option value="">
                                            Select Categories
                                        </option>

                                        <?php while ($categories = mysqli_fetch_assoc($categories_result)) { ?>

                                            <option value="<?= $categories['categories_id']; ?>">
                                                <?= $categories['categories_name']; ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <!-- Product Image -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Product Image
                                    </label>

                                    <input type="file"
                                        name="book_product_image"
                                        class="form-control form-control-lg"
                                        required>

                                </div>



                                <!-- Description -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Product Description
                                    </label>

                                    <textarea name="book_product_description"
                                        rows="5"
                                        class="form-control form-control-lg"
                                        placeholder="Enter Product Description"
                                        required></textarea>

                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-center gap-3 mt-4">

                                    <button type="submit"
                                        class="add btn-lg btn-custom">

                                         
                                        Add Product

                                    </button>

                                    <a href="view_book_product.php"
                                        class="view btn-lg btn-custom">

                                        
                                        View Product

                                    </a>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>