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

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <medanytimeonline2019@gmail.com>' . "\r\n";
			
			$subject = "Order Cancellation Details";
			
			$message = "<html> 
			<p>
			
			Hello, <br> <br>
            We are sorry to inform you that your recent order that has been placed at our website Med-AnyTime.com is cancelled because it has few Non OTC medicines with invalid prescription. So, for security purposes we have to cancel the total order that has been placed you.
			
			<h3>Please login in to your account and find the status of your order with TrackingNumber '$TNum' <h3>
				
			 <h3> Thank you! <h3>
				
			</html>
			
			";
			
			mail($user_id,$subject,$message,$headers);
			
?>
