<!-- The orderdetails contains  productid, price, name, quantity, total price, the userid , orderdate . After the product is successfully added it is redirected to the userproductdetails which contains the details of the product such as the name of the product, productID given by the admin, the brand name of the product, the price of the product, the description for which it is used, the image of the product, the expiry date, if it is in over counter or not and the quantity in stock.-->
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
                                 $query=mysqli_query($dbConnection,"SELECT * FROM `userdetails` WHERE UserId='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_assoc($query);
                                 echo ''.$row['FirstName'].'';
                            ?>
                        </a>
		<div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Order_details_User.php">View Orders</a>
          <a class="dropdown-item" href="#">View Profile Information</a>
         <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      
       </li>
     
	   
    </ul>
    
  </div>
  </nav>    
    <!-- End Navbar -->

	<br><br><br>
	<h1 align="Center"> Product Details</h1>
 
    <?php
		//Fetching all the products to be displayed
		include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
		$ID=$_GET['ID'];
		$query = "SELECT * FROM products WHERE ID='$ID'";
		$result = mysqli_query($dbConnection,$query);
		while($res = mysqli_fetch_array($result)) {  
	?>  
	
<form class = "form" method ="POST" action="addToCart.php">	
   
  <div class="row"> 
	<div class="col-sm-4">
	<?php echo "<input type =\"hidden\" name = \"ProductId\" value =".$res['ID'].">"; ?>
	</div>
	
		<div class="col-sm-4">			
			<div class="card-columns">
                <div class="card" style = "width: 25rem;" >
                                 <?php if($res['productImage'] != ""): ?>
                            <img class="card-img-top" src="/SwEngg/upload/<?php echo $res['productImage']; ?>" alt="prodImage"  Style = "width:80%">
                            <?php else: ?>
                            <img class="card-img-top" src="/SwEngg/upload/default.jpg" alt="prodImage" class="center" Style = "width:100%">
                            <?php endif; ?>
                          <div class="card-body">
							<!--Displaying product details in a card format -->
							<label><strong>Product Name:</strong></label>
							<output type ="text" name="ProductName"><?php echo $res['ProductName'];?></output>
							<br>
							<label><strong>ID:</strong></label>
							<output  type ="text" name="ProductID"><?php echo $res['ID'];?></output>
							<br>
							<label><strong>Product Brand:</strong></label>
							<output type ="text" name="compName"><?php echo $res['CompanyName'];?></output>
                            <br>
							<label><strong>Price:</strong></label>
							<output type ="text" name="price"><?php echo $res['Price'];?></output>
							<br>
							<label><strong>Cure For:</strong></label>
							<output type ="text" name="cureFor"><?php echo $res['CureFor'];?></output>
							<br>
							<label><strong>Over the Counter or Not:</strong></label>
							<output type ="text" name="OtcFlag"><?php echo $res['OtcFlag'];?></output>
							<br>
							<label><strong>Featured Image (Y/N):</strong></label>
							<output type ="text" name="FeaturedFlag"><?php echo $res['Featured_Flag'];?></output>
							<br>
							<label><strong>Quantity IN Stock:</strong></label>
							<output type ="text" name="prodQty"><?php echo $res['NumberInStock'];?></output>
							<?php $cartQty = $res['NumberInStock']; ?>
							<br>
							<label><strong>Expiry Date:</strong></label>
							<output type ="date" name="ExpiryDate"><?php echo $res['ExpiryDate'];?></output>	
						<?php } ?></ul>
                        </div>
					</div>
				</div>
				<label><strong>Quantity:</strong></label>
				<select size='1' width = '10' name="cartQty" id="cartQty" class='btn btn-success btn-round dropdown-toggle'/>
				<?php 
				$i=1;			
				while ($i <= $cartQty ){
                                echo "<option value=".$i.">".$i."</option>";
                                $i++;
                            }
							?>
				</select>
				<br>
            <button class="btn btn-success btn-round pull-right" name = "submit" type = "submit">
                <i class="now-ui-icons shopping_cart-simple" ></i>Add To Cart
			</button>
			<br><br>
        </div>	
        </div>  
		<?php
		//Display Error message received from CartDetails.php when we try adding item to cart
		if (isset($_SESSION['msg'])) {
			echo '<center><strong><span style ="color:#FF0000;">"' . $_SESSION['msg'] . '"</span></strong></center>';
			unset($_SESSION['msg']);
		}
		?>
		</form>
</body>
</html>