<?php
include 'database.php';

$book_product_id = $_GET['book_product_id'];

/* Fetch Image */
$select = "SELECT * FROM `book_product`
           WHERE book_product_id='$book_product_id'";

$result = mysqli_query($conn, $select);

$row = mysqli_fetch_assoc($result);

/* Delete Image File */
$image_path = "Image/" . $row['book_product_image'];

if(file_exists($image_path)) {

    unlink($image_path);
}

/* Delete Product */
$delete = "DELETE FROM `book_product`
           WHERE book_product_id='$book_product_id'";

$delete_result = mysqli_query($conn, $delete);

if ($delete_result) {

    echo "<script>
            alert('Product Deleted Successfully');
            window.location.href='view_book_product.php';
          </script>";

} else {

    echo "<script>
            alert('Product Not Deleted');
            window.location.href='view_book_product.php';
          </script>";
}
?>