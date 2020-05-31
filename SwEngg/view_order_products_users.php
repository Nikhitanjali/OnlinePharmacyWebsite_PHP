<?php
    session_start();
	//Checking if the user is logged in
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

<?php

  include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
  $ID=$_GET['ID'];
  $query = "SELECT * FROM products WHERE ID='$ID'";
  $result = mysqli_query($dbConnection,$query);
  while($res = mysqli_fetch_array($result)){

              $ID=$res['ID'];
			  $prodName=$res['ProductName'];
              $price=$res['Price'];
              $userId = $_SESSION['id'];


              if (isset($_POST['submit'])){

                  $ProductID=$ID;
                  $price=$price;
				  $prodName=$prodName;
                  $prodQty = $_POST['prodQty'];                                       
                  $total = $price * $prodQty;
                  $userId = $userId;

                  $date=date("Y-m-d");


                  if(empty($prodQty)){    

                      if(empty($prodQty)) {
                      echo "<br><center><h4><font color='red'><b>Error!</b> Enter Product Quantity.</font></h4></center>";
                  }

                  } else {

                  mysqli_query($dbconn,"INSERT INTO orders (ProductID,ProductQuantity,ProductName,TotalPrice,UserId,OrderDate) 
                          VALUES ('$ProductID','$prodQty','$prodName','$total','$userId','$date')") or die(mysql_error());
                      ?>
                   
                      <script type="text/javascript">
                          alert("Product Added To Cart!");
                          window.location = "userProductDetails.php";
                      </script>

                      <?php 
                  }
                  }
                      } ?>


<!--Page to display all the products to the user-->
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
	<script src="https://kit.fontawesome.com/763504b100.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="app new2.css">
    <title>Med-Anytime</title>
</head>

<body class="index-page sidebar-collapse">
<nav  class="navbar navbar-dark navbar-expand-md pt-0 pb-0 fixed-top">
   <a href="userpage2.php" class="navbar-brand"> Med-AnyTime   </a>
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
        <a class="nav-link" href="CartDetails.php">Cart <i class="fas fa-shopping-cart fa-md"></i></a>
      </li>
	  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    
                            <?php
								 //Checking for user details to diplay on the nav bar
                                 include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
                                 $query=mysqli_query($dbConnection,"SELECT * FROM `userdetails` WHERE UserId='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_assoc($query);
                                 echo ''.$row['FirstName'].'';
                            ?>
							       <i class="fas fa-user"></i>
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
     <br><br><br>
<a class="btn btn-primary btn-round" href="Order_details_User.php" id="formstyle" ><i class="now-ui-icons shopping_basket"></i> &nbsp Back to Orders</a>
                      <hr color="blue"> 
	<br>
	<h1 align="Center"> Product Details</h1>
 
    <?php
		//Fetching all the products to be displayed
		include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
		$ID=$_GET['ID'];
		$trackingNumber = $_GET['tNum'];
		$query = "SELECT * FROM `order details` WHERE ProductID='$ID' AND UserID='".$_SESSION['id']."' AND TrackingNumber = '$trackingNumber'";
		$result = mysqli_query($dbConnection,$query);
		$query1 = "SELECT * FROM products WHERE ID='$ID'";
		$result1 = mysqli_query($dbConnection,$query1);
		while($res = mysqli_fetch_array($result)) {  
			$res1 = mysqli_fetch_assoc($result1);
	?>  
	
<form class = "form" method ="POST" action="addToCart.php">	
   
  <div class="row"> 
	<div class="col-sm-4">
	<?php echo "<input type =\"hidden\" name = \"ProductId\" value =".$res1['ID'].">"; ?>
	</div>
	
		<div class="col-sm-4">			
			<div class="card-columns">
                <div class="card" style = "width: 25rem;" >
                                 <?php if($res1['productImage'] != ""): ?>
                            <img class="card-img-top" src="/SwEngg/upload/<?php echo $res1['productImage']; ?>" alt="prodImage"  Style = "width:80%">
                            <?php else: ?>
                            <img class="card-img-top" src="/SwEngg/upload/default.jpg" alt="prodImage" class="center" Style = "width:100%">
                            <?php endif; ?>
                          <div class="card-body">
							<!--Displaying product details in a card format -->
							<label><strong>Product Name:</strong></label>
							<output type ="text" name="ProductName"><?php echo $res1['ProductName'];?></output>
							<br>
							<label><strong>ID:</strong></label>
							<output  type ="text" name="ProductID"><?php echo $res1['ID'];?></output>
                            <br>
							<label><strong>Price: $</strong></label>
							<output type ="text" name="price"><?php echo $res['TotalPrice'];?></output>
							<br>
							<label><strong>Cure For:</strong></label>
							<output type ="text" name="cureFor"><?php echo $res1['CureFor'];?></output>
							<br>
							<label><strong>Over the Counter or Not:</strong></label>
							<output type ="text" name="OtcFlag"><?php echo $res['OtcFlag'];?></output>
							<br>
							<label><strong>Quantity:</strong></label>
							<output type ="text" name="prodQty"><?php echo $res['ProductQuantity'];?></output>
							<br>
							<label><strong>Expiry Date:</strong></label>
							<output type ="date" name="ExpiryDate"><?php echo $res1['ExpiryDate'];?></output>	
							<?php 
								
								if($res['OtcFlag'] == 'N'){?>
								<strong class="card-title">Doctor NPI number: </strong><?php echo $res['docNPInum'];?><br>
								<strong class="card-title">Doctor Email ID: </strong><?php echo $res['docEmailId'];?><br>
								<strong class="card-title">Doctor Prescription: </strong><br>
								<center><img class="card-img-top" src="/SwEngg/Prescriptions/<?php echo $res['docPrescription']; ?>" alt="Prescription"  Style = "width:50%"></center>
						<?php } ?></ul>

						<br>
							<?php	
								} ?>
                        </div>
					</div>
				</div>
				
			<br><br>
        </div>	
        </div>  
		
		</form>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
    
  </body>
</html>