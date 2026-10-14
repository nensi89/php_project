<!-- book_details.php -->

<?php
// session_start();
include 'database.php';

if (!isset($_GET['id'])) {
    header("location:dashboard.php");
}

$book_id = $_GET['id'];

$sql = "SELECT book_product.*, purchase.purchase_price

        FROM book_product

        LEFT JOIN purchase
        ON purchase.book_product_id = book_product.book_product_id

        WHERE book_product.book_product_id='$book_id'";

$result = mysqli_query($conn, $sql);

$book = mysqli_fetch_assoc($result);

if (!$book) {
    echo "Book Not Found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $book['book_product_name']; ?>
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="./css/bootstrap.min.css">
    <title>Online Women Shop</title>

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

        .card {
            height: 450px;
             
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
            margin-top: 80px;
        }

        .light-purple:hover {
            background-color: #000;
        }

        .light-purple {
            background-color: #6f42c1;
            color: #e9d5ff;
        }
        .main{
            width: 57%;
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

        .view {
  padding: 10px 15px;
            border-radius: 10px;
            border: 1px solid #3d035f;
            text-decoration: none;
            color: #000;
            background-color: #ae7be6;
        }
        .mb-10{
            margin-bottom: 120px;
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a class="navbar-brand fw-bold"
                href="dashboard.php">
                Online Women Shop
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




    <!-- Book Details -->
    <div class="container mt-5 mb-10">

        <div class="w-50 mx-auto shadow align-item-center py-5 px-0   rounded">

            <!-- Image -->

            <div class="main">
                <div class="">

                    <img src="../Image/<?php echo $book['book_product_image']; ?>"
                        class="book-image">

                </div>


                <!-- Details -->


                <div class="book-box ">

                    <h2>
                        <?php echo $book['book_product_name']; ?>
                    </h2>



                    <h6>

                        Price :

                        <span class="text-success fw-bold">

                            ₹ <?php echo $book['purchase_price']; ?>

                        </span>

                    </h6>

                    


                    

                    <h6>Description :

                    
                        <?php echo $book['book_product_description']; ?>
                    </h6>

                    <br>

                    <a href="add_to_cart.php?id=<?php echo $book['book_product_id']; ?>"
                        class="add">

                        Add To Cart

                    </a>

                    <a href="dashboard.php"
                        class="view">

                        Back

                    </a>

                </div>


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



    <!-- Bootstrap JS -->
    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>