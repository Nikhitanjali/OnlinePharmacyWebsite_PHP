<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

<!--Page for the admin to view details-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="app new2.css">

    <title>View Product Details</title>

</head>

<body>
 <!--Navbar-->
 <nav  class="navbar navbar-dark navbar-expand-md pt-0 pb-0 fixed-top">
      <a href="AdminPage.php" class="navbar-brand">Med-AnyTime</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navmenu" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	  <div class="collapse navbar-collapse" id="navmenu">
    <ul class="navbar-nav mr-auto">
     
      <li class="nav-item">
      <form method="POST" action="AdminProductSearch.php" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-3" type="search" placeholder="Search" name="search" id="navBarSearchForm" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit" name = "SearchButton" id="SearchButton">Search</button>
      </form>
      </li>
	  
	 <li class="nav-item">
        <a class="nav-link" href="inventory.php">Inventory</a>
      </li>
	   <li class="nav-item">
        <a class="nav-link" href="Order_details_admin.php">Orders</a>
      </li>  
       <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="now-ui-icons users_circle-08"></i>
                            <?php
							    //Fetching user details
                                include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
								$query=mysqli_query($dbConnection,"SELECT * FROM `admindetails` WHERE AdminId='".$_SESSION['id']."'");
								$row=mysqli_fetch_assoc($query);
                                echo ''.$row['FirstName'].'';
                            ?>
                        </a>
						<div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">View Orders</a>
          <a class="dropdown-item" href="AdminViewProfile.php">View Profile Information</a>
           <a class="dropdown-item" href="logout.php">Logout</a>
      
        </div>
      
       </li>
      
	   

    </ul>
    
  </div>
      
    </nav>
    
<div class="container">
<br><br><br>
<h1 align="Center"> Product Details</h1>
 
               <?php
    include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
    $ID=$_GET['ID'];
	//Fetching product details to be viewed
    $query = "SELECT * FROM products WHERE ID='$ID'";
    $result = mysqli_query($dbConnection,$query);
    while($res = mysqli_fetch_array($result)) {  
    
?>   
  <div class="row"> 
 <div class="col-sm-4">			
  <div class="card-columns">
                <div class="card" style = "width: 30rem; margin:0 auto; " >
                                 <?php if($res['productImage'] != ""): ?>
                            <img class="card-img-top" src="/SwEngg/upload/<?php echo $res['productImage']; ?>" alt="prodImage"  Style = "width:100%">
                            <?php else: ?>
                            <img class="card-img-top" src="/SwEngg/upload/default.jpg" alt="prodImage" class="center" Style = "width:100%">
                            <?php endif; ?>
                          <div class="card-body">
							<!--Display all the details-->
                              <ul><strong class="card-title">Product Name: </strong><?php echo $res['ProductName'];?></ul>
                             <ul><strong class="card-text">ID:</strong><?php echo $res['ID']; ?></ul>
		                       <ul> <strong class="card-text">Product Brand:</strong> <?php echo $res['CompanyName']; ?> </ul>
					          <ul><strong class="card-title">Price:</strong> <?php echo $res['Price']; ?></ul>
                              <ul><strong class="card-title">Cure For:</strong> <?php echo $res['CureFor']; ?></ul>
							  <ul><strong class="card-title">Over The Counter or Not:</strong><?php echo $res['OtcFlag']; ?> </ul>
							  <ul><strong class="card-title">Featured Image (Y/N):</strong><?php echo $res['Featured_Flag']; ?></ul>
							  <ul><strong class="card-title">Quantity In stock:</strong> <?php echo $res['NumberInStock']; ?></ul>
							  <ul><strong class="card-title">Expiry Date:</strong> <?php echo $res['ExpiryDate']; ?></ul>
							  <ul><?php echo "<a href=\"product_update.php?ID=$res[ID]\">Edit Product Details</a>"; }?></ul>
                            </div>
							</div>
							</div>
							</div>
						
                 </div>
				</div> 
	
	

</body>


</html>