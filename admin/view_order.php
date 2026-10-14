<?php
include 'database.php';

$sql = "SELECT
        orders.*,
        book_product.book_product_name,
        book_product.book_product_image

        FROM orders

        INNER JOIN book_product
        ON orders.book_product_id = book_product.book_product_id

        ORDER BY orders.order_id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Orders</title>

    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f1f5f9;
        }

        .page-wrapper {
            margin-left: 260px;
            padding: 30px;
        }

        .product-img {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        @media(max-width:768px) {

            .page-wrapper {
                margin-left: 0;
                padding: 15px;
            }

        }

        .brand {
            background: #ae7be6;
            color: white;
            padding: 7px 15px;

        }

        .add {
            background-color: #3d035f;
            color: white;
            border: 1px solid #3d035f;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 10px;
        }

        .view {

            border: 1px solid #3d035f;
            text-decoration: none;
            color: #000;
            background-color: #ae7be6;
            padding: 10px 25px;
            border-radius: 10px;
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

        <div class="card shadow">

            <div class=" brand text-white">

                <h3 class="">
                    <i class="bi bi-cart-fill"></i>
                    Order Details
                </h3>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">

                            <!-- <tr>

                                <th>ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Customer</th>
                                <th>Mobile</th>
                                <th>City</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr> -->

                        </thead>

                        <tbody>
                            <div class="row pro">
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <div class="col-md-4 mb-4">
                                            <div class="card dashboard-card shadow p-2 h-100 ">
                                                <div class=" mt-3 mb-3 pl-2">
                                                    #<?= $row['order_id']; ?>


                                                    <img src="../Image/<?= $row['book_product_image']; ?>"
                                                        class="product-img">
                                                    <br>
                                                    <h4><span class="fs">Product Name:</span>
                                                        <span class="fw"><?= $row['book_product_name']; ?></span>
                                                    </h4>


                                                    <h4><span class="fs">Customer:</span>
                                                        <span class="fw"><span class="fw"><?= $row['full_name']; ?></span>
                                                    </h4>

                                                    <h4><span class="fs">Mobile:</span>
                                                        <span class="fw"><?= $row['mobile_number']; ?></span>
                                                    </h4>
                                                    <h4><span class="fs">City:</span>
                                                        <span class="fw"><?= $row['city']; ?></span></h4>

                                                    <h4><span class="fs">Qty:</span>
                                                        <span class="fw"><?= $row['quantity']; ?></span>
                                                    </h4>

                                                    <h4><span class="fs">Total:</span>
                                                        ₹<span class="fw"><?= $row['total_price']; ?></span>
                                                    </h4>

                                                    <h4><span class="fs">Status:</span>
                                                        <?php

                                                        if ($row['order_status'] == "Pending") {
                                                            echo "<span class='badge bg-warning'>Pending</span>";
                                                        } elseif ($row['order_status'] == "Confirmed") {
                                                            echo "<span class='badge bg-primary'>Confirmed</span>";
                                                        } elseif ($row['order_status'] == "Delivered") {
                                                            echo "<span class='badge bg-success'>Delivered</span>";
                                                        } elseif ($row['order_status'] == "Cancelled") {
                                                            echo "<span class='badge bg-danger'>Cancelled</span>";
                                                        }

                                                        ?>
                                                    </h4>

                                                    <h4><span class="fs">Action:</span>
                                                        <a href="view_order_detail.php?order_id=<?= $row['order_id']; ?>"
                                                            class="btn btn-info btn-sm">

                                                            View

                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                } else {
                                    ?>




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