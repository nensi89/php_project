<?php
include 'database.php';

/* Fetch Product Data */
$product_sql = "SELECT * FROM book_product";
$product_result = mysqli_query($conn, $product_sql);

/* Insert Purchase */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $purchase_date   = $_POST['purchase_date'];
    $book_product_id = $_POST['book_product_id'];
    $purchase_qty    = $_POST['purchase_qty'];
    $purchase_price  = $_POST['purchase_price'];

    /* Total */
    $purchase_total = $purchase_qty * $purchase_price;

    /* Insert Purchase */
    $insert = "INSERT INTO purchase
               (
                    purchase_date,
                    book_product_id,
                    purchase_qty,
                    purchase_price,
                    purchase_total
               )

               VALUES
               (
                    '$purchase_date',
                    '$book_product_id',
                    '$purchase_qty',
                    '$purchase_price',
                    '$purchase_total'
               )";

    $result = mysqli_query($conn, $insert);

    /* =========================
       AUTO STOCK UPDATE
    ========================== */

    /* Check Product Already Exists in Stock */
    $check_stock = "SELECT * FROM stock
                    WHERE book_product_id='$book_product_id'";

    $stock_result = mysqli_query($conn, $check_stock);

    /* Product Already Exists */
    if(mysqli_num_rows($stock_result) > 0) {

        $stock_row = mysqli_fetch_assoc($stock_result);

        /* Old Stock Qty */
        $old_stock_qty = $stock_row['stock_qty'];

        /* New Stock Qty */
        $new_stock_qty = $old_stock_qty + $purchase_qty;

        /* Update Stock */
        $update_stock = "UPDATE stock
                         SET stock_qty='$new_stock_qty'
                         WHERE book_product_id='$book_product_id'";

        mysqli_query($conn, $update_stock);

    } else {

        /* Insert New Stock */
        $insert_stock = "INSERT INTO stock
                        (
                            book_product_id,
                            stock_qty
                        )

                        VALUES
                        (
                            '$book_product_id',
                            '$purchase_qty'
                        )";

        mysqli_query($conn, $insert_stock);
    }

    /* Success Message */
    if($result) {

        echo "<script>
                alert('Purchase Added & Stock Updated Successfully');
                window.location.href='view_purchase.php';
              </script>";

    } else {

        echo "<script>
                alert('Data Not Inserted');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Add Purchase</title>

    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css"
        rel="stylesheet">

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
        .form-select {
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
            width: 20%;
            background-color: #3d035f;
            color: white;
            border: 1px solid #3d035f;
            text-decoration: none;
            color: white;
        }

        .view {
            width: 20%;

            border: 1px solid #3d035f;
            text-decoration: none;
            color: #000;
            background-color: #ae7be6;
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
                            <i class="bi bi-cart-plus-fill"></i>
                            Add Purchase
                        </h2>

                    </div>

                    <!-- Body -->
                    <div class="card-body p-5">

                        <form action=""
                            method="POST">

                            <!-- Purchase Date -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Purchase Date
                                </label>

                                <input type="date"
                                    name="purchase_date"
                                    class="form-control form-control-lg"
                                    required>

                            </div>

                            <!-- Product -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Product Name
                                </label>

                                <select name="book_product_id"
                                    class="form-select form-select-lg"
                                    required>

                                    <option value="">
                                        Select Product
                                    </option>

                                    <?php while($product = mysqli_fetch_assoc($product_result)) { ?>

                                        <option value="<?= $product['book_product_id']; ?>">

                                            <?= $product['book_product_name']; ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <!-- Quantity -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Quantity
                                </label>

                                <input type="number"
                                    name="purchase_qty"
                                    class="form-control form-control-lg"
                                    placeholder="Enter Quantity"
                                    required>

                            </div>

                            <!-- Price -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Price
                                </label>

                                <input type="number"
                                    step="0.01"
                                    name="purchase_price"
                                    class="form-control form-control-lg"
                                    placeholder="Enter Price"
                                    required>

                            </div>

                            <!-- Buttons -->
                            <div class="text-center">

                                <button type="submit"
                                    class="add btn-lg btn-custom">

                                    <i class="bi bi-save-fill"></i>
                                    Add Purchase

                                </button>

                                <a href="view_purchase.php"
                                    class="view btn-lg btn-custom">

                                    <i class="bi bi-eye-fill"></i>
                                    View Purchase

                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>