<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_email'])) {
    header("location:dashboard.php");
    exit;
}

$user_email = $_SESSION['user_email'];

$sql = "SELECT cart.*, 
               book_product.book_product_name,
               book_product.book_product_image,
               purchase.purchase_price

        FROM cart

        LEFT JOIN book_product
        ON cart.book_product_id = book_product.book_product_id

        LEFT JOIN purchase
        ON purchase.book_product_id = book_product.book_product_id

        WHERE cart.user_email='$user_email'";

$result = mysqli_query($conn, $sql);

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>View Cart</title>

 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="../css/bootstrap.min.css">

    <style>
        .navbar {
            background: #6f42c1;
        }
.bg {
            background: #6f42c1;
            color: white;
            padding-top: 30px;
            margin-top: 20px;
            padding-bottom: 30px;
        }

        .footer-box ul li a {
            text-decoration: none;
            color: white;
            font-weight: 100;
        }

        .footer-box ul li {
            list-style-type: none;

        }
        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .hero {
            /* background: #6f42c1; */

            /* padding: 60px; */
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
        }

        .hero h1 {
            font-size: 30px;
            

        }

        .card{
            height: 100vh;
        }
        .hero p {
            background-color: #6f42c1;
            color: white;

            font-size: 30px;
            margin-top: 20px;
        }

        .category-title {
            color: #000;
            background-color: #e9d5ff;
            padding: 12px;
            text-align: center;
            border-radius: 5px;
            margin-top: 40px;
        }

        .book-card {
            transition: 0.3s;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-image {
            height: 250px;
            object-fit: cover;
        }

        .footer {
            background: #212529;
            color: white;
            padding: 20px 0;
            margin-top: 50px;
        }
        .light-purple:hover{
            background-color: #000;
        }
        .light-purple{
            background-color: #6f42c1;
            color: #e9d5ff;
        }
           .add {
             background-color: #3d035f;
            color: white;
            border: 1px solid #3d035f;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 10px;
         }

        .view {
 
            border: 1px solid #3d035f;
            text-decoration: none;
            color: #000;
            background-color: #ae7be6;
             padding: 10px 15px;
            border-radius: 10px;
        }
        .mt-20{
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a class="navbar-brand fw-bold"
                >
                Mahi Women Shop
            </a>

            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse"
                id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active"
                            href="dashboard.php">
                            Home
                        </a>
                    </li>

                    <!-- Categories -->




                    <li class="nav-item">
                        <a class="nav-link"
                            href="view_cart.php">
                            Cart
                        </a>
                    </li>

                     <li class="nav-item">
                        <a class="nav-link"
                            href="order.php">
                            My order
                        </a>
                    </li>

                     <li class="nav-item">
                        <a class="nav-link"
                            href="contact.php">
                            Contact
                        </a>
                    </li>

                    <?php
                    if (isset($_SESSION['user_email'])) {
                    ?>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="user_logout.php">
                                Logout
                            </a>
                        </li>

                    <?php
                    } else {
                    ?>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="user_login.php">
                                Login
                            </a>
                        </li>

                    <?php
                    }
                    ?>

                </ul>

            </div>

        </div>

    </nav>




    <!-- Cart -->
    <div class="container mt-20">

        <div class="card shadow p-4">

            <h2 class="text-center mb-4">
                My Cart
            </h2>

            <table class="table table-bordered align-middle">

                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result)) {

                    $sub_total = $row['purchase_price'] * $row['quantity'];

                    $total += $sub_total;
                ?>

                    <tr>

                        <td width="120">

                            <img src="../Image/<?php echo $row['book_product_image']; ?>"
                                width="100">

                        </td>

                        <td>
                            <?php echo $row['book_product_name']; ?>
                        </td>

                        <td>
                            ₹ <?php echo $row['purchase_price']; ?>
                        </td>

                        <td>
                            <?php echo $row['quantity']; ?>
                        </td>

                        <td>
                            ₹ <?php echo $sub_total; ?>
                        </td>

                        <td>

                            <a href="remove_cart.php?id=<?php echo $row['cart_id']; ?>"
                                class="btn btn-danger btn-sm">

                                Remove

                            </a>

                        </td>

                    </tr>

                <?php } ?>

                <tr>

                    <th colspan="4"
                        class="text-end">

                        Grand Total

                    </th>

                    <th colspan="2"
                        class="text-success">

                        ₹ <?php echo $total; ?>

                    </th>

                </tr>

            </table>

            <div class="d-flex justify-content-center gap-2">

                <a href="dashboard.php"
                    class="add">

                    Continue Shopping

                </a>

                <a href="place_order.php"
                    class="view">

                    Confirm Order

                </a>

            </div>

        </div>

    </div>



    <!-- Footer -->
     <footer class="bg">

        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="footer-box">
                        <h2 class="mb-3">Mahi Women Shop</h2>
                        <p>Your one-stop fashion destination for women</p>
                        <h6>Email:  <span style="font-weight: 100;">mahiwomnenshop@gmail.com</span></h6>
                        <h6>phone:  <span style="font-weight: 100;">+91 9874225632</span></h6>
                        <h6>Adress:  <span style="font-weight: 100;">Surat,Gujarat</span></h6>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="footer-box">
                        <h3 class="mb-3">Quick Links</h3>
                        <ul>
                            <li><a href="dashboard.php">Home</a></li>
                            <li><a href="view_cart.php">Cart</a></li>
                            <li><a href="order.php">My order</a></li>
                            <li><a href="contact.php">Contact us</a></li>
                            <li><a href="logout.php">Logout</a></li>


                        </ul>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="footer-box">
                        <h3 class="mb-3">Customer Care</h3>
                        <ul>
                            <li><a href="user_login.php">Login</a></li>
                            <li><a href="user_registration.php">Register</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-2">

                    <div class="footer-box">
                        <h3 class="mb-3">Follow us</h3>
                        <ul>
                            <li><a href="">Instragram</a></li>
                                                        <li><a href="">Twitter</a></li>
                            <li><a href="">Facebook</a></li>
                            <li><a href="">Youtube</a></li>

                        </ul>
                    </div>
                </div>
            </div>


        </div>

    </footer>

    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>