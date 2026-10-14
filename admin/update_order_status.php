
<?php

include 'database.php';

$order_id = $_GET['order_id'];
$status   = $_GET['status'];

$order_sql = "SELECT *
              FROM orders
              WHERE order_id='$order_id'";

$order_result = mysqli_query($conn,$order_sql);

$order = mysqli_fetch_assoc($order_result);

/* STOCK REDUCE ONLY ON CONFIRM */

if(
$status == "Confirmed"
&&
$order['order_status'] != "Confirmed"
)
{

$product_id = $order['book_product_id'];

$order_qty = $order['quantity'];

$stock_sql = "SELECT *
              FROM stock
              WHERE book_product_id='$product_id'";

$stock_result = mysqli_query($conn,$stock_sql);

if(mysqli_num_rows($stock_result)>0)
{

$stock = mysqli_fetch_assoc($stock_result);

$new_stock = $stock['stock_qty'] - $order_qty;

mysqli_query($conn,

"UPDATE stock
SET stock_qty='$new_stock'
WHERE book_product_id='$product_id'"

);

}

}

/* UPDATE STATUS */

$update = "UPDATE orders
SET order_status='$status'
WHERE order_id='$order_id'";

mysqli_query($conn,$update);

echo "<script>

alert('Order Status Updated');

window.location.href='view_order_detail.php?order_id=$order_id';

</script>";

?>
