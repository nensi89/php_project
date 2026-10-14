<?php include "db.php";

session_start();
if(!isset($_SESSION['admin'])){
    header("Location:admin_login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <table >
        <tr>
            <th><button><a href="./add_product.php">ADD Product</a></button></th>
            <th><button><a href="./view_product.php">VIEW Product</a></button></th>

        </tr>
        <tr>
            <td colspan="2" align="center"><button><a href="logout.php">Logout</a></button></td>
        </tr>
    </table>
</body>

</html>