<?php
include 'database.php';

$order_id = $_GET['order_id'];

$sql = "SELECT
        orders.*,
        book_product.book_product_name,
        book_product.book_product_image

        FROM orders

        INNER JOIN book_product
        ON orders.book_product_id = book_product.book_product_id

        WHERE orders.order_id='$order_id'";

$result = mysqli_query($conn,$sql);

$order = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>

<title>Order Detail</title>

<link href="./css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f1f5f9;
}

.page-wrapper{
    margin-left:260px;
    padding:30px;
}

.product-img{
    width:150px;
    border-radius:10px;
}

@media(max-width:768px){

.page-wrapper{
margin-left:0;
padding:15px;
}

}
 .brand{
                    background: #ae7be6;
                    color:white;
                    padding: 7px 15px;

    }

</style>

</head>

<body>

<?php include 'sidebar_menu.php'; ?>

<div class="page-wrapper">

<div class="card shadow">

<div class="brand text-white">

<h3>
Order #<?= $order['order_id']; ?>
</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">

<img src="../Image/<?= $order['book_product_image']; ?>"
class="img-fluid product-img">

</div>

<div class="col-md-8">

<h4><?= $order['book_product_name']; ?></h4>

<p>
<b>Quantity :</b>
<?= $order['quantity']; ?>
</p>

<p>
<b>Price :</b>
₹<?= $order['price']; ?>
</p>

<p>
<b>Total :</b>
₹<?= $order['total_price']; ?>
</p>

</div>

</div>

<hr>

<h4>Customer Detail</h4>

<p><b>Name :</b> <?= $order['full_name']; ?></p>

<p><b>Email :</b> <?= $order['user_email']; ?></p>

<p><b>Mobile :</b> <?= $order['mobile_number']; ?></p>

<p><b>Address :</b> <?= $order['address']; ?></p>

<p><b>City :</b> <?= $order['city']; ?></p>

<p><b>Pincode :</b> <?= $order['pincode']; ?></p>

<hr>

<h4>

Status :

<?php

if($order['order_status']=="Pending")
{
echo "<span class='badge bg-warning'>Pending</span>";
}
elseif($order['order_status']=="Confirmed")
{
echo "<span class='badge bg-primary'>Confirmed</span>";
}
elseif($order['order_status']=="Delivered")
{
echo "<span class='badge bg-success'>Delivered</span>";
}
elseif($order['order_status']=="Cancelled")
{
echo "<span class='badge bg-danger'>Cancelled</span>";
}

?>

</h4>

<hr>

<a href="update_order_status.php?order_id=<?= $order_id; ?>&status=Confirmed"
class="btn btn-primary">

Confirm Order

</a>

<a href="update_order_status.php?order_id=<?= $order_id; ?>&status=Delivered"
class="btn btn-success">

Delivered

</a>

<a href="update_order_status.php?order_id=<?= $order_id; ?>&status=Cancelled"
class="btn btn-danger">

Cancel

</a>

<a href="view_order.php"
class="btn btn-secondary">

Back

</a>

</div>

</div>

</div>

</body>

</html>

