<?php
session_start();
include 'database.php';

// User Login Check
if (!isset($_SESSION['user_email'])) {
    header("location:dashboard.php");
    exit;
}

$user_email = $_SESSION['user_email'];

if (!isset($_GET['id'])) {
    header("location:dashboard.php");
    exit;
}

$book_id = $_GET['id'];

// Check Book Already In Cart
$check_sql = "SELECT * FROM cart 
              WHERE user_email='$user_email' 
              AND book_product_id='$book_id'";

$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {

    // Update Quantity
    $update_sql = "UPDATE cart 
                   SET quantity = quantity + 1 
                   WHERE user_email='$user_email' 
                   AND book_product_id='$book_id'";

    mysqli_query($conn, $update_sql);

} else {

    // Insert New Item
    $insert_sql = "INSERT INTO cart(user_email, book_product_id, quantity)
                   VALUES('$user_email','$book_id','1')";

    mysqli_query($conn, $insert_sql);
}

// Redirect Back
header("location:view_cart.php");
?>