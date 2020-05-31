<?php
    session_start();
    include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');

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
    <div class="wrapper"><br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      
                      <a class="btn btn-primary btn-round" href="userpage2.php"><i class="now-ui-icons shopping_basket"></i> &nbsp Shop more items</a>
                      <hr color="orange"> 
                
                <div class="col-md-12">
                <br>
                <div class="panel panel-success panel-size-custom">
                        <div class="panel-body">
<?php
                                    if (isset($_POST['submit'])) {
                                        $OrderID=$_GET['OrderID'];
                                        $cartQty = $_POST['cartQty'];
                                        $total = $_POST['cartQty']*$_POST['total'];
                                        $date = date("Y-m-d H:i:s");      

										$result = mysqli_query($dbConnection,"UPDATE `order details` SET ProductQuantity = '$cartQty', TotalPrice='$total' WHERE OrderID='$OrderID'  AND OrderStatus='cart'");
										header("location: CartDetails.php");
                                    }
                                    ?>

<form method="post">

  

  <button type="submit" name="submit" class="btn btn-success btn-round">Update</button> 

  
  <table class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
				  <th width="100">Old Quantity</th>
                  <th width="100">New Quantity</th>
                  <th width="100">Price</th>
                  <th width="100">Total Price</th>
        </tr>
              </thead>
              <tbody>
                <?php 
                    $user_id = $_SESSION['id'];
                    $OrderID=$_GET['OrderID'];
					$query=mysqli_query($dbConnection,"SELECT * FROM `order details` WHERE UserID='$user_id' AND OrderStatus='cart' AND OrderID='$OrderID'");
					$row=mysqli_fetch_array($query);	
					//$count=mysqli_num_rows($query);
					$ProductID=$row['ProductID'];
					$query1=mysqli_query($dbConnection,"SELECT * FROM products WHERE ID='$ProductID'");
					$row1=mysqli_fetch_array($query1);
					$cartQty = $row['ProductQuantity'];
					$prodQty = $row1['NumberInStock'];
                ?>
        <tr>


                  <td> <img width="150" height="100" src="/SwEngg/upload/<?php echo $row1['productImage']; ?>" alt=""/></td>
                  <td><b><?php echo $row1['ProductName'];?></b><br><br>
                    <?php echo $row1['CompanyName'];
                    ?>
                  </td>
				  <td><br><?php  echo $row['ProductQuantity']; ?></td>
                  <td>  
					<select size='1' width = '10' name="cartQty" id="cartQty" class='btn btn-success btn-round dropdown-toggle'/>
					<?php 
					$i=1;			
					echo "<option value = 0>Select</option>";
					while ($i <= $prodQty ){
						echo "<option value=".$i.">".$i."</option>";
						$i++;
					}
								?>
					</select>
				  </td>
                  <td><br><?php  echo $row1['Price']; ?></td>
                  <td><br><?php echo $row['TotalPrice'];?></td>
              <input type="hidden" name="total" value="<?php echo $row1['Price'];?>">
                </tr>
        
 
        </tbody>
            </table>
    
  <a href="CartDetails.php" ><button class="btn btn-warning btn-round"  type="button" style="float: right;">Cancel</button></a>

</form>







                        </div>
                    </div> 
                </div>
            </div>
        </div>
<br><br><br><br>

    </div>
</body>


</html>