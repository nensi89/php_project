<?php
include 'database.php';

/* Fetch Stock Data */
$sql = "SELECT
        stock.*,
        book_product.book_product_name,
        book_product.book_product_image

        FROM stock

        INNER JOIN book_product
        ON stock.book_product_id = book_product.book_product_id

        ORDER BY stock.stock_id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Stock</title>

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

        .stock-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .card-header-custom {
            background: #ae7be6;
            color: white;
            padding: 20px;
        }

        .table thead th {
            background-color: #212529;
            color: white;
            padding: 15px;
            border: none;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .stock-id {
            color: #198754;
            font-weight: bold;
        }

        .product-img {
            width: 70px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #dee2e6;
        }

        @media(max-width:768px) {

            .page-wrapper {
                margin-left: 0;
                padding: 15px;
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

    <?php include 'sidebar_menu.php'; ?>

    <div class="page-wrapper">

        <div class="card shadow-lg stock-card">

            <!-- Header -->
            <div class="card-header-custom">

                <div class="d-flex justify-content-between align-items-center header-flex">

                    <h3>
                        <i class="bi bi-box-seam-fill"></i>
                        Stock Details
                    </h3>

                    <a href="add_purchase.php"
                        class="btn btn-light fw-semibold">

                        <i class="bi bi-plus-circle-fill"></i>
                        Add Purchase

                    </a>

                </div>

            </div>

            <!-- Body -->
            <div class="card-body p-4">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                       

                        <tbody>
                            <div class="row pro">
                                <?php if (mysqli_num_rows($result) > 0) { ?>

                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <div class="col-md-4 mb-4">
                                            <div class="card dashboard-card shadow p-2 h-100 ">
                                                <div class="text-center mt-3 mb-3 ">
                                                    <span class="stock-id">
                                                        #<?= $row['stock_id']; ?>
                                                    </span>
                                                   
                                                        <img src="../Image/<?= $row['book_product_image']; ?>" class="product-img">
                                                    

                                                    <h4><span class="fs">Product Name:</span>
                                                        <span class="fw"><?= $row['book_product_name']; ?></span>
                                                    </h4>
                                                      <h4><span class="fs">Stock Qty:</span>
                                                     <span class="fw"><?= $row['stock_qty']; ?></span>
                                                      </h4>
                                                </div>
                                            </div>
                                        </div>






                                    <?php } ?>

                                <?php } else { ?>

                            </div>

                        <?php } ?>


                        




                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>