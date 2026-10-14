<?PHP 
session_start();
if(!isset($_SESSION['admin_email'])){
    header("location: admin_login.php");
}

?>
<?php
include 'database.php';

$brand_id = $_GET['brand_id'];

// Fetch Old Data
$select = "SELECT * FROM `book_brand` WHERE brand_id='$brand_id'";
$result = mysqli_query($conn, $select);

$row = mysqli_fetch_assoc($result);

// Update Data
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $brand_name = $_POST['brand_name'];
    $brand_description = $_POST['brand_description'];

    $update = "UPDATE `book_brand`
               SET
               brand_name='$brand_name',
               brand_description='$brand_description'
               WHERE brand_id='$brand_id'";

    $update_result = mysqli_query($conn, $update);

    if ($update_result) {

        echo "<script>
                alert('Brand Updated Successfully');
                window.location.href='view_brand_detail.php';
              </script>";

    } else {

        echo "<script>alert('Data Not Updated');</script>";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Brand</title>
    <style>
         .add {
             background-color: #3d035f;
            color: white;
            border: 1px solid #3d035f;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 10px;
        }

        .view {
 
            border: 1px solid #3d035f;
            text-decoration: none;
            color: #000;
            background-color: #ae7be6;
              padding: 10px 25px;
            border-radius: 10px;
        }
         .brand{
                    background: #ae7be6;
                    color:white

    }
    </style>
    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <!-- Sidebar -->
    <?php include 'sidebar_menu.php'; ?>

    <!-- Main Content -->
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-9 col-md-8 ms-auto">

                <div class="container py-5">

                    <div class="row justify-content-center">

                        <div class="col-lg-8">

                            <div class="card shadow border-0 rounded-4">

                                <!-- Header -->
                                <div class="brand text-center py-4 rounded-top-4">

                                    <h2 class="fw-bold mb-0">
                                        <i class="bi bi-pencil-square"></i>
                                        Update Brand Detail
                                    </h2>

                                </div>

                                <!-- Body -->
                                <div class="card-body p-5">

                                    <form action="" method="POST">

                                        <!-- Brand Name -->
                                        <div class="mb-4">

                                            <label class="form-label fw-semibold">
                                                Brand Name
                                            </label>

                                            <div class="input-group">

                                                
                                                <input type="text"
                                                    name="brand_name"
                                                    class="form-control form-control-lg"
                                                    value="<?= $row['brand_name']; ?>"
                                                    required>

                                            </div>

                                        </div>

                                        <!-- Brand Description -->
                                        <div class="mb-4">

                                            <label class="form-label fw-semibold">
                                                Brand Description
                                            </label>

                                            <div class="input-group">

                                               

                                                <textarea name="brand_description"
                                                    rows="5"
                                                    class="form-control form-control-lg"
                                                    required><?= $row['brand_description']; ?></textarea>

                                            </div>

                                        </div>

                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-center gap-3 mt-4">

                                            <button type="submit"
                                                class="add px-4">

                                                <i class="bi bi-check-circle-fill"></i>
                                                Update Brand

                                            </button>

                                            <a href="view_brand_detail.php"
                                                class="view px-4">

                                                <i class="bi bi-arrow-left-circle-fill"></i>
                                                Back

                                            </a>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>