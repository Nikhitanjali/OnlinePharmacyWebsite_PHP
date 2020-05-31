<?php
    session_start();
    include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');

    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

<?php

$user_id = $_GET['UID'];
$TNum=$_GET['TNum'];

$result = mysqli_query($dbConnection, "UPDATE `order details` SET OrderStatus = 'Deleted' , TotalPrice = 0.00 WHERE UserID='$user_id' AND TrackingNumber='$TNum'");

header('location: Order_details_admin.php');
?>
