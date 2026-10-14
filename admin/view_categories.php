<?PHP
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("location: admin_login.php");
}

?>
<?php
include 'database.php';

$sql = "SELECT * FROM categories ORDER BY categories_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories Detail</title>

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

        .categories-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .card-header-custom {
            background: #ae7be6;
            color: white;
            padding: 20px;
        }

        .card-header-custom h3 {
            margin: 0;
            font-weight: 700;
        }

        .table thead th {
            background-color: #212529;
            color: white;
            border: none;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: 0.3s;
        }

        .btn-action {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .categories-id {
            font-weight: bold;
            color: #198754;
        }

        @media(max-width:768px) {
            .page-wrapper {
                margin-left: 0;
                padding: 15px;
            }

            .card-header-custom {
                text-align: center;
            }

            .header-flex {
                flex-direction: column;
                gap: 15px;
            }
        }

        .add {
            width: 20%;
            background-color: #3d035f;
            color: white;
            border: 1px solid #3d035f;
            text-decoration: none;
        }

        .view {
            width: 20%;

            border: 1px solid #3d035f;
            text-decoration: none;
            color: #000;
            background-color: #ae7be6;
        }
         .fw{
            font-weight: 400;
            font-size: 20px;
            color: #6e6e6e;

        }
        .fs{
                       font-size: 20px;
 

        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include 'sidebar_menu.php'; ?>

    <div class="page-wrapper">

        <div class="card shadow-lg categories-card">

            <!-- Card Header -->
            <div class="card-header-custom">

                <div class="d-flex justify-content-between align-items-center header-flex">

                    <h3>
                        <i class="bi bi-grid-fill"></i>
                        Categories Details
                    </h3>

                    <a href="add_categories.php" class="btn btn-light fw-semibold">
                        <i class="bi bi-plus-circle-fill"></i>
                        Add New Categories
                    </a>

                </div>

            </div>

            <!-- Card Body -->
            <div class="card-body p-4">

                <div class="table-responsive">

                    <table class="table align-middle table-hover">

                      

                        <tbody>
                            <div class="row pro">
                                <?php if (mysqli_num_rows($result) > 0) { ?>

                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                                        <div class="col-md-4 mb-4">
                                            <div class="card dashboard-card shadow p-2 h-100 ">
                                                <div class="text-center mt-3 mb-3 ">

                                                    <span class="categories-id">
                                                        #<?= $row['categories_id']; ?>
                                                    </span>
                                                    <h4><span class="fs">Categories Name:</span>
                                                        <span class="fw"><?= $row['categories_name']; ?></span>
                                                    </h4>
                                                    <h4><span class="fs">Description:</span>
                                                        <span class="fw"><?= $row['categories_description']; ?></span>
                                                    </h4>
                                                    <br>
                                                    <div class="col-12">
                                                        <a href="update_categories.php?categories_id=<?= $row['categories_id']; ?>"
                                                            class=" add btn-action me-1">

                                                        Update
                                                        </a>

                                                        <a href="delete_categories.php?categories_id=<?= $row['categories_id']; ?>"
                                                            class="view btn-action"
                                                            onclick="return confirm('Delete this category?')">

                                                             
                                                        Delete
                                                        </a>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    <?php } ?>

                                <?php } else { ?>
                            </div>


                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>