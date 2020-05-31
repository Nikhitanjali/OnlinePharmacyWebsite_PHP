<?php
    session_start();
    include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');

    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

<?php

$user_id = $_SESSION['id'];
$orderID=$_GET['orderID'];

$result = mysqli_query($dbConnection, "DELETE FROM `order details` WHERE OrderID=$orderID");

header('location: CartDetails.php');
?>

