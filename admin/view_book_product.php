<?php
include 'database.php';

/* Fetch Product with Brand and Categories */
$sql = "SELECT book_product.*, book_brand.brand_name, categories.categories_name FROM book_product INNER JOIN book_brand ON book_product.brand_id = book_brand.brand_id INNER JOIN categories ON book_product.categories_id = categories.categories_id ORDER BY book_product.book_product_id DESC;";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book Product</title>

    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
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
            padding: 20px;
        }

        .card-header-custom h3 {
            margin: 0;
            font-weight: 700;
        }

        .table thead th {
            background-color: #212529;
            color: white;
            border: none;
            padding: 15px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: 0.3s;
        }

        .btn-action {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .product-id {
            font-weight: bold;
            color: #198754;
        }

        .product-img {
            width: 70px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #dee2e6;
        }

        .add {
            width: 20%;
            background-color: #3d035f;
            color: white;
            border: 1px solid #3d035f;
            text-decoration: none;
        }

        .view {
            width: 20%;

            border: 1px solid #3d035f;
            text-decoration: none;
            color: #000;
            background-color: #ae7be6;
        }
        .pro{
            overflow: hidden;
        }

        @media(max-width:768px) {

            .page-wrapper {
                margin-left: 0;
                padding: 15px;
            }

            .card-header-custom {
                text-align: center;
            }

            .header-flex {
                flex-direction: column;
                gap: 15px;
            }
        }
        .fw{
            font-weight: 400;
            font-size: 20px;
            color: #6e6e6e;

        }
        .fs{
                       font-size: 20px;
 

        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include 'sidebar_menu.php'; ?>

    <div class="page-wrapper">

        <div class="card shadow-lg product-card">

            <!-- Card Header -->
            <div class="card-header-custom">

                <div class="d-flex justify-content-between align-items-center header-flex">

                    <h3>
                        <i class="bi bi-book-half"></i>
                        Women Product Details
                    </h3>

                    <a href="add_book_product.php"
                        class="btn btn-light fw-semibold">

                        <i class="bi bi-plus-circle-fill"></i>
                        Add New Product

                    </a>

                </div>

            </div>

            <!-- Card Body -->
            <div class="card-body p-4">

                <div class="table-responsive">

                    
                       
                            <div class="row pro">
                                <?php if (mysqli_num_rows($result) > 0) {

                                    while ($row = mysqli_fetch_assoc($result)) { ?>


                                        <div class="col-md-4 mb-4">
                                            <div class="card dashboard-card shadow p-2 h-100 ">
                                                <div class="text-center mt-3 mb-3 ">


                                                    <span class="product-id">
                                                        <?= $row['book_product_id']; ?>
                                                    </span>
                                                    <img src="../Image/<?= $row['book_product_image']; ?>  " class="product-img">

                                                    <br>
                                                    <h4><span class="fs">product name :</span>
                                                        <span class="fw"><?= $row['book_product_name']; ?></span>
                                                    </h4>
                                                    <h4> <span class="fs">product brand : </span>
                                                        <span class="fw"><?= $row['brand_name']; ?></span>
                                                    </h4>
                                                     
                                                    <h4><span class="fs">Category name :</span>
                                                       <span class="fw"> <?= $row['categories_name']; ?></span>
                                                    </h4>
                                                    <h4><span class="fs">Product description :</span>
                                                        <span class="fw"><?= $row['book_product_description']; ?></span>
                                                    </h4>
                                                    <br>
                                                    <div class="col-12">
                                                        <a href="update_book_product.php?book_product_id=<?= $row['book_product_id']; ?>"
                                                            class="btn-primary btn-action add ">
                                                            update

                                                        </a>
                                                        <a href="delete_book_product.php?book_product_id=<?= $row['book_product_id']; ?>"
                                                            class="view btn-danger btn-action"
                                                            onclick="return confirm('Delete this product?')">

                                                            Delete

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                <?php } else  ?>

                            </div>
                </div>


                <!-- Bootstrap JS -->
                <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>