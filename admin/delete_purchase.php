<?php
include 'database.php';

$purchase_id = $_GET['purchase_id'];

/* ==========================
   FETCH PURCHASE DATA
========================== */

$select = "SELECT * FROM purchase
           WHERE purchase_id='$purchase_id'";

$result = mysqli_query($conn, $select);

$row = mysqli_fetch_assoc($result);

/* Purchase Product & Qty */
$book_product_id = $row['book_product_id'];

$purchase_qty = $row['purchase_qty'];

/* ==========================
   UPDATE STOCK
========================== */

$stock_sql = "SELECT * FROM stock
              WHERE book_product_id='$book_product_id'";

$stock_result = mysqli_query($conn, $stock_sql);

if(mysqli_num_rows($stock_result) > 0) {

    $stock_row = mysqli_fetch_assoc($stock_result);

    /* Minus Deleted Purchase Qty */
    $new_stock_qty =
    $stock_row['stock_qty'] - $purchase_qty;

    /* If Stock 0 Then Delete */
    if($new_stock_qty <= 0) {

        mysqli_query($conn,

            "DELETE FROM stock
             WHERE book_product_id='$book_product_id'"

        );

    } else {

        /* Update Stock */
        mysqli_query($conn,

            "UPDATE stock
             SET stock_qty='$new_stock_qty'
             WHERE book_product_id='$book_product_id'"

        );
    }
}

/* ==========================
   DELETE PURCHASE
========================== */

$delete = "DELETE FROM purchase
           WHERE purchase_id='$purchase_id'";

$delete_result = mysqli_query($conn, $delete);

/* ==========================
   MESSAGE
========================== */

if($delete_result) {

    echo "<script>
            alert('Purchase Deleted & Stock Updated Successfully');
            window.location.href='view_purchase.php';
          </script>";

} else {

    echo "<script>
            alert('Purchase Not Deleted');
            window.location.href='view_purchase.php';
          </script>";
}
?>