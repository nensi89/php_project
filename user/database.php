<?php
$host="localhost";
$user="root";
$password="";
$database="womenstore";

$conn=mysqli_connect($host,$user,$password,$database);
if ($conn==true) {
    // echo "Database Connection Succes";
}else {
    echo "Database Not Connect";
}
?>