<?php
include 'database.php';

// Check ID
if (isset($_GET['brand_id'])) {

    $brand_id = $_GET['brand_id'];

    // Delete Query
    $delete = "DELETE FROM `book_brand`
               WHERE brand_id='$brand_id'";

    $result = mysqli_query($conn, $delete);

    // Success Message
    if ($result) {

        echo "<script>
                alert('Brand Deleted Successfully');
                window.location.href='view_brand_detail.php';
              </script>";

    } else {

        echo "<script>
                alert('Brand Not Deleted');
                window.location.href='view_brand_detail.php';
              </script>";

    }

} else {

    echo "<script>
            alert('Invalid Request');
            window.location.href='view_brand_detail.php';
          </script>";

}
?>