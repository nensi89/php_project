<?PHP 
session_start();
if(!isset($_SESSION['admin_email'])){
    header("location: admin_login.php");
}

?>
<!-- PHP Code Start -->
<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $brand_name = $_POST['brand_name'];
    $brand_description = $_POST['brand_description'];

    $sql = "INSERT INTO `book_brand`
            (`brand_name`, `brand_description`)
            VALUES
            ('$brand_name','$brand_description')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Brand Added Successfully');
        window.location.href='view_brand_detail.php';
        </script>";
    } else {
        echo "<script>alert('Data Not Inserted');</script>";
    }
}
?>
<!-- PHP Code End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Brand Detail</title>
<style>
    .brand{
                    background: #ae7be6;
                    color:white

    }
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
</style>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

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
                                <div class="brand   text-center py-4 rounded-top-4">

                                    <h2 class="fw-bold mb-0">
                                        <i class="bi bi-tags-fill"></i>
                                        Add Brand Detail
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
                                                    placeholder="Enter Brand Name"
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
                                                    placeholder="Enter Brand Description"
                                                    required></textarea>

                                            </div>

                                        </div>

                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-center gap-3 mt-4">

                                            <button type="submit"
                                                name="submit"
                                                class="add  ">

                                                 
                                                Add Brand

                                            </button>

                                            <a href="view_brand_detail.php"
                                                class="view  ">

                                                 
                                                View Brand

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