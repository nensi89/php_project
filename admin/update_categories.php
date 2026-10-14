<?PHP 
session_start();
if(!isset($_SESSION['admin_email'])){
    header("location: admin_login.php");
}

?>
<?php
include 'database.php';

$categories_id = $_GET['categories_id'];

/* Fetch Old Data */
$select = "SELECT * FROM `categories`
           WHERE categories_id='$categories_id'";

$result = mysqli_query($conn, $select);

$row = mysqli_fetch_assoc($result);

/* Update Data */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $categories_name = $_POST['categories_name'];
    $categories_description = $_POST['categories_description'];

    $update = "UPDATE `categories`
               SET
               categories_name='$categories_name',
               categories_description='$categories_description'
               WHERE categories_id='$categories_id'";

    $update_result = mysqli_query($conn, $update);

    if ($update_result) {

        echo "<script>
                alert('Category Updated Successfully');
                window.location.href='view_categories.php';
              </script>";

    } else {

        echo "<script>
                alert('Data Not Updated');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Categories Detail</title>

    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f1f5f9;
        }

        .page-wrapper {
            margin-left: 260px;
            padding: 30px;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .card-header-custom {
                    background: #ae7be6;
            color: white;
            padding: 25px;
        }

        .card-header-custom h2 {
            margin: 0;
            font-weight: 700;
        }

        .form-control,
        textarea {
            border-radius: 12px;
        }

        .btn-custom {
            border-radius: 12px;
            padding: 10px 25px;
        }

        @media(max-width:768px) {

            .page-wrapper {
                margin-left: 0;
                padding: 15px;
            }
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
         .brand{
                    background: #ae7be6;
                    color:white

    } 
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include 'sidebar_menu.php'; ?>

    <div class="page-wrapper">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <div class="card shadow-lg card-custom">

                        <!-- Header -->
                        <div class="card-header-custom text-center">

                            <h2>
                                <i class="bi bi-pencil-square"></i>
                                Update Categories Detail
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
                                            value="<?= $row['categories_name']; ?>"
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
                                            required><?= $row['categories_description']; ?></textarea>

                                    </div>

                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-center gap-3 mt-4">

                                    <button type="submit"
                                        class="add btn-lg btn-custom">

                                        
                                        Update Category

                                    </button>

                                    <a href="view_categories.php"
                                        class="view btn-lg btn-custom">

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

    <!-- Bootstrap JS -->
    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>