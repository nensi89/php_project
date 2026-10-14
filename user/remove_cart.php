<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_email'])) {
    header("location:dashboard.php");
    exit;
}

$cart_id = $_GET['id'];

$delete_sql = "DELETE FROM cart WHERE cart_id='$cart_id'";

mysqli_query($conn, $delete_sql);

header("location:view_cart.php");
?>