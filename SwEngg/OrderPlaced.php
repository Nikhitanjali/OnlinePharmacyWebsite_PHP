<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
      <a href="userpage2.php" class="navbar-brand">Med-AnyTime<span> <i class="fas fa-clinic-medical"></i> </span></a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navmenu" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
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
								 //Checking for user details to diplay on the nav bar
                                 include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
                                 $query=mysqli_query($dbConnection,"SELECT * FROM `userdetails` WHERE UserId='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_assoc($query);
                                 echo ''.$row['FirstName'].'';
                            ?>
                        </a>
						<div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Order_details_User.php">View Orders</a>
          <?php echo "<a class=\"dropdown-item\" href=\"ViewProfile.php?ID=".$row['ID']."\">View Profile</a>"; ?>
		  
         <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      
       </li>
     
	   
    </ul>
    
  </div>
  </nav>      
  <!-- End Navbar -->
  
  <?php
    
	class OrderPlaced{
		
		function generateTrackingNumber(){
			include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
			$query=mysqli_query($dbConnection,"SELECT * FROM `userdetails` WHERE user_id='".$_SESSION['id']."'");
			$row=mysqli_fetch_array($query);
			$firstname=$row['FirstName'];
			$lastname=$row['LastName'];
			$user_id= $_SESSION['id'];
    
                        
			$query = mysqli_query($dbConnection,"SELECT * FROM `order details` WHERE UserID='$user_id' AND OrderStatus='Cart'");
			while($row3 = mysqli_fetch_array($query)) {
				$ProductID=$row3['ProductID'];
				$UserID=$row3['UserID'];
				$ProductQuantity= $row3['ProductQuantity'];
				$ProductName=$row3['ProductName'];
				$query2=mysqli_query($dbConnection,"SELECT * FROM products WHERE ID='$ProductID'");
				$row2=mysqli_fetch_array($query2);
				$ProdQuantity=$row2['NumberInStock'];
				mysqli_query($dbConnection,"UPDATE products SET NumberInStock = $ProdQuantity - $ProductQuantity WHERE ID ='$ProductID' AND NumberInStock='$ProdQuantity'");
			}

			$cart_table = mysqli_query($dbConnection,"SELECT sum(TotalPrice),`Street Address`,`County`,`City`,`State`,`ZipCode` FROM `order details` WHERE UserID='$user_id' AND OrderStatus='Cart'");
				   $cart_count = mysqli_num_rows($cart_table);
       
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
		   echo "<br><br><br>";
		   echo '<center><strong><span style ="color:#FF0000;">********* Your tracking number: '.$track_num.' | </span></strong></center>';
           echo '<center><strong><span style ="color:#FF0000;">Total: $'.$total.' | </span></strong></center>';
           echo '<center><strong><span style ="color:#FF0000;">Shipping Address: '.$ship_add.' *********</span></strong></center>';
		   //For Test Cases
		   //return 1;
           mysqli_query ($dbConnection,"UPDATE `order details` SET OrderStatus = 'Cart',`OrderDate` = '$date',`TrackingNumber` = '$track_num' WHERE UserID ='$user_id' AND OrderStatus='Cart' ");  
		   header("Location: payment.php");
		}
			
			
				
		}
		
		
	}
	
	$order = new OrderPlaced;
	$order->generateTrackingNumber();
	
	
	

?>

<button type="button" class="btn btn-warning btn-round" style = "float: center;" onclick = "window.print()"><span class="now-ui-icons ui-1_check"></span> Print</button> 
     <a href="userpage2.php"><button type="button" class="btn btn-success btn-round" style = "float: center;"><span class="now-ui-icons ui-1_check"></span> Back to Homepage</button></a>   
   
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
    
  </body>
</html>