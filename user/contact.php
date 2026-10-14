<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_email'])) {
    header("location:dashboard.php");
    exit;
}

$user_email = $_SESSION['user_email'];  


if(isset($_POST['submit'])){
$name=$_POST['contact_name'];
$mobile=$_POST['contact_mobile'];
$email=$_POST['contact_email'];
$message=$_POST['contact_message'];

$sql="INSERT INTO `contact`(`contact_name`, `contact_mobile`, `contact_email`, `contact_message`) VALUES ('$name','$mobile','$email','$message')";
if(mysqli_query($conn,$sql)){
    echo"<script>alert('Message sent successfully');window.location='contact.php;</script>";
}
else{
    echo "error";
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Place Order</title>

    <link rel="stylesheet"
        href="./css/bootstrap.min.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="../css/bootstrap.min.css">

    <style>
        .navbar {
            background: #6f42c1;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }
.bg {
            background: #6f42c1;
            color: white;
            padding-top: 30px;
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

        .card {
            height: 530px;
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

        .light-purple:hover {
            background-color: #000;
        }

        .light {
             background-color: #e9d5ff;
        }

        .main {
            width: 40%;
            margin: auto;
        }

        .add {
            padding: 10px 15px;
            border-radius: 10px;
            background-color: #3d035f;
            color: white;
            margin-right: 10px;
            border: 1px solid #3d035f;
            text-decoration: none;
        }
    </style>
</head>




<body style="background:#f5f5f5;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a class="navbar-brand fw-bold"
                href="dashboard.php">
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



    <div class="container mt-5 mb-5">
        <h2 class="text-center mb-5">Contact US</h2>
      
        <div class="contact-info  mb-5">
              <div class="row gap-3">
            <div class="col-md-2 shadow light text-center pt-3 rounded">
                <h4>Address</h4>
                <p>surat,Gujarat,India</p>
            </div>
            <div class="col-md-3 shadow light text-center pt-3 rounded">
                <h4>Phone</h4>
                <p>+91 9874225632</p>
            </div>
            <div class="col-md-3 shadow light text-center pt-3 rounded">
                <h4>Email</h4>
                <p>mahiwomnenshop@gmail.com</p>
            </div>
            <div class="col-md-3 shadow light text-center pt-3 rounded">
                <h4>Working Hours:</h4>
                <p>Monday-Saturday <br> 10:00 AM - 7:00 PM</p>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="main">
                <!-- Address Form -->
                <div class="col-md-12">


                    <div class="card shadow p-4">

                        <h3 class="mb-4 text-center">
                            Contact Form
                        </h3>

                        <form method="POST" class="pb-5">

                            <div class="mb-3">

                                <label>
                                    Full Name
                                </label>

                                <input type="text"
                                    name="contact_name"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label>
                                    Mobile Number
                                </label>

                                <input type="text"
                                    name="contact_mobile"
                                    class="form-control"
                                    required>

                            </div>
                             <div class="mb-3">

                                <label>
                                    Email Address
                                </label>

                                <input type="text"
                                    name="contact_email"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label>
                                    Address
                                </label>

                                <textarea name="contact_message"
                                    class="form-control"
                                    rows="3"
                                    required></textarea>

                            </div>

                            

                            <button type="submit"
                                class="add w-100" name="submit">

                                Submit

                            </button>

                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>



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
</body>

</html>