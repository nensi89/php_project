<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_email'])) {
    header("location:dashboard.php");
    exit;
}

$user_email = $_SESSION['user_email'];

$cart_sql = "SELECT cart.*, 
                    book_product.book_product_name,
                    purchase.purchase_price

             FROM cart

             LEFT JOIN book_product
             ON cart.book_product_id = book_product.book_product_id

             LEFT JOIN purchase
             ON purchase.book_product_id = book_product.book_product_id

             WHERE cart.user_email='$user_email'";

$cart_result = mysqli_query($conn, $cart_sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $full_name = $_POST['full_name'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];

    $cart_data = mysqli_query($conn, $cart_sql);

    while ($row = mysqli_fetch_assoc($cart_data)) {

        $book_id = $row['book_product_id'];
        $quantity = $row['quantity'];
        $price = $row['purchase_price'];
        $total_price = $quantity * $price;

        $insert_order = "INSERT INTO orders
        (
            user_email,
            book_product_id,
            quantity,
            price,
            total_price,
            full_name,
            mobile_number,
            address,
            city,
            pincode
        )

        VALUES
        (
            '$user_email',
            '$book_id',
            '$quantity',
            '$price',
            '$total_price',
            '$full_name',
            '$mobile_number',
            '$address',
            '$city',
            '$pincode'
        )";

        mysqli_query($conn, $insert_order);
    }

    // Clear Cart
    mysqli_query($conn, "DELETE FROM cart WHERE user_email='$user_email'");

    echo "<script>
            alert('Order Placed Successfully');
            window.location='dashboard.php';
          </script>";
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
            height: 600px;
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

        .light-purple {
            background-color: #6f42c1;
            color: #e9d5ff;
        }
          .main{
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

        <div class="row">

            <!-- Order Items -->
            <!-- <div class="col-md-7">

                <div class="card shadow p-4">

                    <h3 class="mb-4">
                        Order Items
                    </h3>

                    <table class="table table-bordered">

                        <tr>
                            <th>Book</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>

                        <?php
                        $grand_total = 0;

                        while ($item = mysqli_fetch_assoc($cart_result)) {

                            $sub_total = $item['purchase_price'] * $item['quantity'];

                            $grand_total += $sub_total;
                        ?>

                            <tr>

                                <td>
                                    <?php echo $item['book_product_name']; ?>
                                </td>

                                <td>
                                    ₹ <?php echo $item['purchase_price']; ?>
                                </td>

                                <td>
                                    <?php echo $item['quantity']; ?>
                                </td>

                                <td>
                                    ₹ <?php echo $sub_total; ?>
                                </td>

                            </tr>

                        <?php } ?>

                        <tr>

                            <th colspan="3"
                                class="text-end">

                                Grand Total

                            </th>

                            <th class="text-success">

                                ₹ <?php echo $grand_total; ?>

                            </th>

                        </tr>

                    </table>

                </div>

            </div> -->


            <div class="main">
                <!-- Address Form -->
                <div class="col-md-12">

                    <div class="card shadow p-4">

                        <h3 class="mb-4 text-center">
                            Shipping Address
                        </h3>

                        <form method="POST" class="pb-5">

                            <div class="mb-3">

                                <label>
                                    Full Name
                                </label>

                                <input type="text"
                                    name="full_name"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label>
                                    Mobile Number
                                </label>

                                <input type="text"
                                    name="mobile_number"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label>
                                    Address
                                </label>

                                <textarea name="address"
                                    class="form-control"
                                    rows="3"
                                    required></textarea>

                            </div>

                            <div class="mb-3">

                                <label>
                                    City
                                </label>

                                <input type="text"
                                    name="city"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label>
                                    Pincode
                                </label>

                                <input type="text"
                                    name="pincode"
                                    class="form-control"
                                    required>

                            </div>

                            <button type="submit"
                                class="add w-100">

                                Place Order

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