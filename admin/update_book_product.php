<?php
include 'database.php';

$book_product_id = $_GET['book_product_id'];

/* Fetch Old Product Data */
$select = "SELECT * FROM `book_product`
           WHERE book_product_id='$book_product_id'";

$result = mysqli_query($conn, $select);

$row = mysqli_fetch_assoc($result);

/* Fetch Brand Data */
$brand_sql = "SELECT * FROM book_brand";
$brand_result = mysqli_query($conn, $brand_sql);

/* Fetch Categories Data */
$categories_sql = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_sql);

/* Update Product */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $book_product_name         = $_POST['book_product_name'];
    $brand_id                  = $_POST['brand_id'];
    $categories_id             = $_POST['categories_id'];
  
    $book_product_description  = $_POST['book_product_description'];

    /* Old Image */
    $old_image = $row['book_product_image'];

    /* Check New Image */
    if ($_FILES['book_product_image']['name'] != "") {

        $image_name = time() . "_" . $_FILES['book_product_image']['name'];

        $temp_name = $_FILES['book_product_image']['tmp_name'];

        $folder = '../Image/' . $image_name;

        move_uploaded_file($temp_name, $folder);

    } else {

        $image_name = $old_image;
    }

    /* Update Query */
    $update = "UPDATE `book_product`
               SET
               book_product_name='$book_product_name',
               brand_id='$brand_id',
               categories_id='$categories_id',
               book_product_image='$image_name',
             
               book_product_description='$book_product_description'

               WHERE book_product_id='$book_product_id'";

    $update_result = mysqli_query($conn, $update);

    if ($update_result) {

        echo "<script>
                alert('Product Updated Successfully');
                window.location.href='view_book_product.php';
              </script>";

    } else {

        echo "<script>
                alert('Data Not Updated');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Book Product</title>

    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

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

        .product-card {
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

        .old-image {
            width: 120px;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            border: 3px solid #dee2e6;
        }
        
        .add {
             background-color: #3d035f;
            color: white;
            border: 1px solid #3d035f;
            text-decoration: none;
        }

        .view {
 
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

    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="card shadow-lg product-card">

                    <!-- Header -->
                    <div class="card-header-custom text-center">

                        <h2>
                            <i class="bi bi-pencil-square"></i>
                            Update Book Product
                        </h2>

                    </div>

                    <!-- Body -->
                    <div class="card-body p-5">

                        <form action=""
                            method="POST"
                            enctype="multipart/form-data">

                            <div class="row">

                                <!-- Product Name -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">
                                        Product Name
                                    </label>

                                    <input type="text"
                                        name="book_product_name"
                                        class="form-control form-control-lg"
                                        value="<?= $row['book_product_name']; ?>"
                                        required>

                                </div>

                                <!-- Brand -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">
                                        Select Brand
                                    </label>

                                    <select name="brand_id"
                                        class="form-select form-select-lg"
                                        required>

                                        <?php while($brand = mysqli_fetch_assoc($brand_result)) { ?>

                                            <option value="<?= $brand['brand_id']; ?>"

                                                <?php
                                                if($brand['brand_id'] == $row['brand_id']) {
                                                    echo "selected";
                                                }
                                                ?>

                                            >

                                                <?= $brand['brand_name']; ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <!-- Categories -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">
                                        Select Categories
                                    </label>

                                    <select name="categories_id"
                                        class="form-select form-select-lg"
                                        required>

                                        <?php while($categories = mysqli_fetch_assoc($categories_result)) { ?>

                                            <option value="<?= $categories['categories_id']; ?>"

                                                <?php
                                                if($categories['categories_id'] == $row['categories_id']) {
                                                    echo "selected";
                                                }
                                                ?>

                                            >

                                                <?= $categories['categories_name']; ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>
 
                                

                                <!-- Product Image -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">
                                        Change Product Image
                                    </label>

                                    <input type="file"
                                        name="book_product_image"
                                        class="form-control form-control-lg">

                                </div>

                                <!-- Old Image -->
                                <div class="col-12 mb-4 text-center">

                                    <label class="form-label fw-semibold d-block">
                                        Current Product Image
                                    </label>

                                    <img src="../Image/<?= $row['book_product_image']; ?>"
                                        class="old-image">

                                </div>

                                <!-- Description -->
                                <div class="col-12 mb-4">

                                    <label class="form-label fw-semibold">
                                        Product Description
                                    </label>

                                    <textarea name="book_product_description"
                                        rows="5"
                                        class="form-control form-control-lg"
                                        required><?= $row['book_product_description']; ?></textarea>

                                </div>

                                <!-- Buttons -->
                                <div class="col-12 text-center mt-3">

                                    <button type="submit"
                                        class="add btn-lg btn-custom me-2">

                                         
                                        Update Product

                                    </button>

                                    <a href="view_book_product.php"
                                        class="view btn-lg btn-custom">

                                         
                                        Back

                                    </a>

                                </div>

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