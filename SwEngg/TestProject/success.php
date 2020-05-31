<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        //header('location:loginnew.php');
        //exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="app new2.css">
    <title>Med-Anytime</title>
</head>


<body class="index-page sidebar-collapse">
    <nav  class="navbar navbar-dark navbar-expand-md pt-0 pb-0 fixed-top">
      <a href="userpage2.php" class="navbar-brand">Med-AnyTime</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navmenu" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	  <!-- navbar-->
	  <div class="collapse navbar-collapse" id="navmenu">
    <ul class="navbar-nav mr-auto">
     
      <li class="nav-item">
      <form method="POST" action="UserProductSearch.php" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-3" type="search" placeholder="Search" name="search" id="navBarSearchForm" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit" name = "SearchButton" id="SearchButton">Search</button>
      </form>
      </li>
	 
	   <li class="nav-item">
        <a class="nav-link" href="UserProducts.php">Products</a>
      </li>
	    <li class="nav-item">
        <a class="nav-link" href="CartDetails.php">Cart</a>
      </li>
	  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="now-ui-icons users_circle-08"></i>
                            <?php
							     //Fetching the user details to display on the navbar
                                 include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
                                 $query=mysqli_query($dbConnection,"SELECT * FROM `userdetails` WHERE UserID='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_assoc($query);
                                 echo ''.$row['FirstName'].'';
                            ?>
                        </a>
		<div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">View Orders</a>
          <a class="dropdown-item" href="#">View Profile Information</a>
         <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
       </li>
    </ul>
  </div>
  </nav>    
  <!-- End Navbar -->
<br><br><br><br>

<?php 

		class paymentSuccess{

			function testPaymentSuccess(){
				// Include configuration file 
				include_once 'paymentConfig.php'; 
				// Include database connection file 
				include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
					$trackingNum = '';
					$totalPrice = 0.00;
					//echo "Hi there";
				// If transaction data is available in the URL 
				if(!empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){ 
					// Get transaction information from URL 
					//$item_number = $_GET['item_number'];  
					//echo "entered the loop;";
					$txn_id = $_GET['tx']; 
					$payment_gross = $_GET['amt']; 
					$currency_code = $_GET['cc']; 
					$payment_status = $_GET['st']; 
					// Get product info from the database 
					$userId = $_SESSION['id'];
					$date = date("Y-m-d H:i:s");
					$query = mysqli_query($dbConnection, "SELECT * FROM `order details` WHERE UserID = '$userId' AND OrderStatus='Cart' AND TrackingNumber != ''"); 
					while($productRow = mysqli_fetch_array($query)) {
								$trackingNum = $productRow['TrackingNumber'];
								$totalPrice =  $totalPrice + $productRow['TotalPrice'];
							}
					// Check if transaction data exists with the same TXN ID. 
					$prevPaymentResult = $dbConnection->query("SELECT * FROM payments WHERE txn_id = '".$txn_id."'"); 
					if($prevPaymentResult->num_rows > 0){ 
						$paymentRow = $prevPaymentResult->fetch_assoc(); 
						$payment_id = $paymentRow['payment_id']; 
						$payment_gross = $paymentRow['payment_gross']; 
						$payment_status = $paymentRow['payment_status']; 
						echo "Record Exists";
					}else{ 
						// Insert tansaction data into the database
						mysqli_query ($dbConnection,"INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$trackingNum."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')"); 
						/*$insert = $dbConnection->query(""); 
						$payment_id = $dbConnection->insert; */
						$chkquery = mysqli_query($dbConnection, "SELECT * FROM payments WHERE txn_id = '".$txn_id."'");
						$paymentRow = mysqli_fetch_assoc($chkquery);
						$payment_id = $paymentRow['payment_id'];
					    if(!empty($payment_id)){
						echo "Your Payment is complete";
						mysqli_query ($dbConnection,"UPDATE `order details` SET `OrderDate` = '$date', OrderStatus='Placed' WHERE UserID ='$userId' AND OrderStatus='Cart' AND `TrackingNumber` ='$trackingNum'"); 
						return 1; 
						}
						else {
						echo "Your Payment has Failed";
						return 2;
						}
					}
				}
				
				
				
			}
			
			function testSendMail(){
				
				include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 			
				$ProductID = 0;
				$ProductName = '';
				$ProductQuantity = 0;
				$userId = $_SESSION['id'];
				$trackingNum = $_POST['tNum'];
				$flag =0;
				$query = mysqli_query($dbConnection,"SELECT * FROM `order details` WHERE UserID='$userId' AND OrderStatus='Placed' AND `TrackingNumber` ='$trackingNum'");
						while($row3 = mysqli_fetch_array($query)) {
							$ProductID=$row3['ProductID'];
							$UserID=$row3['UserID'];
							$ProductQuantity= $row3['ProductQuantity'];
							$ProductName=$row3['ProductName'];
							$flag =1;
						}
						if($flag == 0){
							echo "Tracking Number not found";
							return 2;
						}
				$cart_table = mysqli_query($dbConnection,"SELECT sum(TotalPrice),`Street Address`,`County`,`City`,`State`,`ZipCode` FROM `order details` WHERE UserID='$userId' AND OrderStatus='Placed' AND `TrackingNumber` ='$trackingNum'");
							   //$cart_count = mysqli_num_rows($cart_table);
					$total = 0;
					$ship_add = '';
					while ($cart_row = mysqli_fetch_array($cart_table)) {

					   $total = $cart_row['sum(TotalPrice)'];
					   $date = date("Y-m-d H:i:s");
					   $track_num= uniqid();
					   $StreetAddr=$cart_row['Street Address'];
					   $County=$cart_row['County'];
					   $City=$cart_row['City'];
					   $State=$cart_row['State'];
					   $ZipCode=$cart_row['ZipCode'];
					   $ship_add=$StreetAddr .' '. $County .' '.$City .' '. $State .' '. $ZipCode;    
					}

					$UserID = $userId;

					$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						$headers .= 'From: <medanytimeonline2019@gmail.com>' . "\r\n";
						
						$subject = "Order Details";
						
						$message = "<html> 
						<p>
						
						Hello, <br> You have ordered some products on our website Med-AnyTime.com, please find your order details, your order will be processed shortly. Thank you!</p>
						
							<table width='600' align='center'  border='2'>
						
								<tr align='center'><td colspan='6'><h2>Your Order Details from Med-AnyTime.com</h2></td></tr>
								
								<tr align='center'>
									<th><b>Product ID</b></th>
									<th><b>Product Name</b></th>
									<th><b>Product Quantity</b></th>
									<th><b>Total Amount</th></th>
									<th><b>Tracking Number</b></th>
									<th><b>Shipping Address</b></th>
								</tr>
								<tr align='center'>
									<td>$ProductID</td>
									<td>$ProductName</td>
									<td>$ProductQuantity</td>
									<td>$total</td>
									<td>$trackingNum</td>
									<td>$ship_add</td>
								</tr>
								
								
						
							</table>
							
							<h3>Please go to your account and see your order details!</h3>
							
							<h3> Thank you for your order @ - www.Med-AnyTime.com</h3>
							
						</html>
						
						";
						
						mail($UserID,$subject,$message,$headers);
						return 1;
				
			}
		}
		$pay = new paymentSuccess;
		$pay->testPaymentSuccess();
?>
<br><br><br><br>
<div class="container">
    <div class="status">
        <?php if(!empty($payment_id)){ ?>
            <h1 class="success">Your Payment has been Successful</h1>
			
            <h4>Payment Information</h4>
            <p><strong>Reference Number:</strong> <?php echo $payment_id; ?></p>
            <p><strong>Transaction ID:</strong> <?php echo $txn_id; ?></p>
            <p><strong>Paid Amount:</strong> <?php echo $payment_gross; ?></p>
            <p><strong>Payment Status:</strong> <?php echo $payment_status; ?></p>
			
            <h4>Product Information</h4>
            <p><strong>Tracking Number:</strong> <?php echo $trackingNum; ?></p>
            <p><b>Price:</b> <?php echo $payment_gross; ?></p>
        <?php }else{ ?>
            <h1 class="error">Your Payment has Failed</h1>
        <?php } ?>
    </div>
    <a href="userpage2.php" class="btn-link">Back to Products</a>
</div>
</body>