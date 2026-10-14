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

    $categories_name = $_POST['categories_name'];
    $categories_description = $_POST['categories_description'];

    $sql = "INSERT INTO `categories`
            (`categories_name`, `categories_description`)
            VALUES
            ('$categories_name','$categories_description')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Category Added Successfully');
        window.location.href='view_categories.php';
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
    <title>Add Categories Detail</title>
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
                                <div class="brand text-white 
                                text-center py-4 rounded-top-4">

                                    <h2 class="fw-bold mb-0">
                                        <i class="bi bi-grid-fill"></i>
                                        Add Categories Detail
                                    </h2>

                                </div>

                                <!-- Body -->
                                <div class="card-body p-5">

                                    <form action="" method="POST">

                                        <!-- Categories Name -->
                                        <div class="mb-4">

                                            <label class="form-label fw-semibold">
                                                Categories Name
                                            </label>

                                            <div class="input-group">

                                                 

                                                <input type="text"
                                                    name="categories_name"
                                                    class="form-control form-control-lg"
                                                    placeholder="Enter Categories Name"
                                                    required>

                                            </div>

                                        </div>

                                        <!-- Categories Description -->
                                        <div class="mb-4">

                                            <label class="form-label fw-semibold">
                                                Categories Description
                                            </label>

                                            <div class="input-group">

                                                 

                                                <textarea name="categories_description"
                                                    rows="5"
                                                    class="form-control form-control-lg"
                                                    placeholder="Enter Categories Description"
                                                    required></textarea>

                                            </div>

                                        </div>

                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-center gap-3 mt-4">

                                            <button type="submit"
                                                name="submit"
                                                class="add btn-lg px-4">

                                               
                                                Add Categories

                                            </button>

                                            <a href="view_categories.php"
                                                class="view btn-lg px-4">

                                                
                                                View Categories

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