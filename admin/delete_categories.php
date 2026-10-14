<?php
include 'database.php';

$categories_id = $_GET['categories_id'];

/* Delete Query */
$delete = "DELETE FROM `categories`
           WHERE categories_id='$categories_id'";

$result = mysqli_query($conn, $delete);

/* Check Result */
if ($result) {

    echo "<script>
            alert('Category Deleted Successfully');
            window.location.href='view_categories.php';
          </script>";

} else {

    echo "<script>
            alert('Category Not Deleted');
            window.location.href='view_categories.php';
          </script>";
}
?>