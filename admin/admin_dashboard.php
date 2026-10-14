<?php
session_start();
include 'database.php';

if(!isset($_SESSION['admin_email']))
{
    header("Location:admin_login.php");
    exit();
}

// Total Books
$book = mysqli_query($conn,"SELECT COUNT(*) as total FROM book_product");
$book_row = mysqli_fetch_assoc($book);

// Total Categories
$category = mysqli_query($conn,"SELECT COUNT(*) as total FROM categories");
$category_row = mysqli_fetch_assoc($category);

// Total Orders
$order = mysqli_query($conn,"SELECT COUNT(*) as total FROM orders");
$order_row = mysqli_fetch_assoc($order);

// Total Brands
$brand = mysqli_query($conn,"SELECT COUNT(*) as total FROM book_brand");
$brand_row = mysqli_fetch_assoc($brand);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            background:#f4f6f9;
        }

        .main-wrapper{
            margin-left:260px;
        }

        .dashboard-card{
            border:none;
            border-radius:15px;
            transition:0.3s;
        }

        .dashboard-card:hover{
            transform:translateY(-5px);
        }

        .card-icon{
            width:60px;
            height:60px;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
        }
        .bg-light{
            background-color: #9c34b6;
        }

        @media(max-width:768px)
        {
            .main-wrapper{
                margin-left:0;
            }
        }
        .grey{
            background-color: #ae7be6;
            border-radius: 20px;
        }
         .grey2{
            background-color: #7b9de6;
            border-radius: 20px;
        } .grey3{
            background-color: #7b9de6;
            border-radius: 20px;
        } .grey4{
            background-color: #ae7be6;
            border-radius: 20px;
        }
    </style>

</head>

<body>

<!-- Sidebar -->
<?php include('sidebar_menu.php'); ?>

<!-- Main Content -->
<div class="main-wrapper">

    <!-- Navbar -->
    <nav class=" bg-white shadow-sm p-3">
        <div class="container-fluid text-center">

           

            <div>
                 <h2 class="fw-bold">
                    Welcome Admin
                </h2>
                <span class="fw-bold">
                    admin :
                    <?php echo $_SESSION['admin_email']; ?>
                </span>
            </div>

        </div>
    </nav>

    <div class="container-fluid p-4">

        <!-- Welcome -->
        

        <!-- Dashboard Cards -->
        <div class="row g-4 p-4 ">

            <!-- Books -->
            <div class="col-md-6">
                <div class=" grey shadow p-2  ">
                    <div class="text-center mt-3 mb-3 text-white">

                        <div >
                            <h6>Total Product</h6>
                            <h2 class="fw-bold ">
                                <?php echo $book_row['total']; ?>
                            </h2>
                        </div>

                      

                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-md-6">
                <div class="grey2   shadow p-2   ">
                    <div class="text-center mt-3 mb-3 text-white">

                        <div>
                            <h6>Categories</h6>
                            <h2 class="fw-bold">
                                <?php echo $category_row['total']; ?>
                            </h2>
                        </div>

                       

                    </div>
                </div>
            </div>

            <!-- Orders -->
            <div class="col-md-6">
                <div class="  shadow p-2  grey3">
                    <div class="text-center mt-3 mb-3 text-white">

                        <div>
                            <h6>Total Orders</h6>
                            <h2 class="fw-bold">
                                <?php echo $order_row['total']; ?>
                            </h2>
                        </div>

                         

                    </div>
                </div>
            </div>

           
            <div class="col-md-6">
                <div class="grey4 shadow p-2  ">
                    <div class="text-center mt-3 mb-3 text-white">

                        <div>
                            <h6>Brand</h6>
                            <h2 class="fw-bold">
                                <?php echo $brand_row['total']; ?>
                            </h2>
                        </div>

                         

                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Orders -->
        <div class="card shadow border-0 mt-5 ">

            <div class="card-header text-center ">
                <h5 class=" ">
                    Recent Orders
                </h5>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Mobile</th>
                            <th>Total Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        $recent_order = mysqli_query($conn,
                        "SELECT * FROM orders ORDER BY order_id DESC LIMIT 5");

                        while($row = mysqli_fetch_assoc($recent_order))
                        {
                        ?>

                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['mobile_number']; ?></td>
                            <td>₹ <?php echo $row['total_price']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                        </tr>

                        <?php
                        }
                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="./js/bootstrap.bundle.min.js"></script>

</body>
</html>