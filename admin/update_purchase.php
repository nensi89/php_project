<?php
include 'database.php';

$purchase_id = $_GET['purchase_id'];

/* Fetch Old Purchase Data */
$select = "SELECT * FROM purchase
           WHERE purchase_id='$purchase_id'";

$result = mysqli_query($conn, $select);

$row = mysqli_fetch_assoc($result);

/* Fetch Product Data */
$product_sql = "SELECT * FROM book_product";
$product_result = mysqli_query($conn, $product_sql);

/* Update Purchase */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $purchase_date   = $_POST['purchase_date'];
    $book_product_id = $_POST['book_product_id'];
    $purchase_qty    = $_POST['purchase_qty'];
    $purchase_price  = $_POST['purchase_price'];

    /* New Total */
    $purchase_total = $purchase_qty * $purchase_price;

    /* ==========================
       OLD PURCHASE DATA
    ========================== */

    $old_product_id = $row['book_product_id'];
    $old_qty        = $row['purchase_qty'];

    /* ==========================
       REMOVE OLD STOCK
    ========================== */

    $old_stock_sql = "SELECT * FROM stock
                      WHERE book_product_id='$old_product_id'";

    $old_stock_result = mysqli_query($conn, $old_stock_sql);

    if(mysqli_num_rows($old_stock_result) > 0) {

        $old_stock_row = mysqli_fetch_assoc($old_stock_result);

        $updated_old_stock =
        $old_stock_row['stock_qty'] - $old_qty;

        mysqli_query($conn,

            "UPDATE stock
             SET stock_qty='$updated_old_stock'
             WHERE book_product_id='$old_product_id'"

        );
    }

    /* ==========================
       ADD NEW STOCK
    ========================== */

    $new_stock_sql = "SELECT * FROM stock
                      WHERE book_product_id='$book_product_id'";

    $new_stock_result = mysqli_query($conn, $new_stock_sql);

    if(mysqli_num_rows($new_stock_result) > 0) {

        $new_stock_row = mysqli_fetch_assoc($new_stock_result);

        $new_stock_qty =
        $new_stock_row['stock_qty'] + $purchase_qty;

        mysqli_query($conn,

            "UPDATE stock
             SET stock_qty='$new_stock_qty'
             WHERE book_product_id='$book_product_id'"

        );

    } else {

        mysqli_query($conn,

            "INSERT INTO stock
            (
                book_product_id,
                stock_qty
            )

            VALUES
            (
                '$book_product_id',
                '$purchase_qty'
            )"

        );
    }

    /* ==========================
       UPDATE PURCHASE
    ========================== */

    $update = "UPDATE purchase
               SET
               purchase_date='$purchase_date',
               book_product_id='$book_product_id',
               purchase_qty='$purchase_qty',
               purchase_price='$purchase_price',
               purchase_total='$purchase_total'

               WHERE purchase_id='$purchase_id'";

    $update_result = mysqli_query($conn, $update);

    if($update_result) {

        echo "<script>
                alert('Purchase Updated & Stock Updated Successfully');
                window.location.href='view_purchase.php';
              </script>";

    } else {

        echo "<script>
                alert('Purchase Not Updated');
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

    <title>Update Purchase</title>

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
             background-color: #3d035f;
            color: white;
            border: 1px solid #3d035f;
            text-decoration: none;
            color: white;
        }

        .view {
 
            border: 1px solid #3d035f;
            text-decoration: none;
            color: #000;
            background-color: #ae7be6;
        }
    </style>

</head>

<body>

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
                            Update Purchase
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
                                    value="<?= $row['purchase_date']; ?>"
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

                                    <?php while($product = mysqli_fetch_assoc($product_result)) { ?>

                                        <option value="<?= $product['book_product_id']; ?>"

                                        <?php
                                        if($product['book_product_id'] == $row['book_product_id']) {
                                            echo "selected";
                                        }
                                        ?>

                                        >

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
                                    value="<?= $row['purchase_qty']; ?>"
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
                                    value="<?= $row['purchase_price']; ?>"
                                    required>

                            </div>

                            <!-- Buttons -->
                            <div class="text-center">

                                <button type="submit"
                                    class="add btn-lg btn-custom">

                                    
                                    Update Purchase

                                </button>

                                <a href="view_purchase.php"
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

<script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>