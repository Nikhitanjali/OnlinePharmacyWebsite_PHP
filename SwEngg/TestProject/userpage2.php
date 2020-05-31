
<?php
    session_start();
	//Checking if the user is logged in
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
	<script src="https://use.fontawesome.com/c6ae9d48ae.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="app new2.css">

    <title>User Page</title>
  </head>
  
  <body>

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
 <div class="image">
</div>
    <!--Footer of the page -->
	<section class="bg-light">
			<div class="container">
				<div class="row justify-content-center ">
          <div class="col-md-12 text-center heading-section">
          	<span class="subheading"> Contact Us at (956)5364567 or at MedAnyTime2019@gmail.com</span>
            <h2 class="mb-4"> Buying Medicines is easy now !!</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4  align-self-stretch text-center">
           
                <h3 class="heading">Add to Cart</h3>
                <p>Directly buy OTC Medicines</p> 
				<p>Upload a prescription for Non-OTC Medicines</p>
              </div>
         
          <div class="col-md-4 align-self-stretch text-center">
            
                <h3 class="heading">Confirmation</h3>
                <p> Recieve an Email about order confirmation </p>
				<p> Track your order </p>
              </div>
          
     
          <div class="col-md-4 align-self-stretch text-center">
        
                <h3 class="heading">Delivery</h3>
                <p>Delivery at your door step within 24-28 HRS</p>
				<p> 100 % Accurate and Verified Products </p>
              </div>
                 
          </div>
        </div>
			
		</section>
	
<div class="container">
  <h1 align="center"> Featured Products </h1>
  <div class="row">
               <?php
			            // Fetching the featured products from the database
                        $query = "SELECT * FROM products WHERE Featured_Flag = 'Y'";
                        $result = mysqli_query($dbConnection,$query);
                        while($res = mysqli_fetch_assoc($result)) {  
                            $ID=$res['ID'];
                    ?>  
					<?php if($res['ID'] != ""): ?>
							<div class="col-sm-4">			
							<div class="card-columns">
							<div class="card" style = "width: 22rem; " >
							<!--Displaying all the featured products in a loop -->
                                <img  class="card-img-top" src="/SwEngg/upload/<?php echo $res['productImage']; ?>" width="300px" height="200px">
                                <?php else: ?>
                                <img  src="/uploads/default.png" width="300px" height="200px">
                                <?php endif; ?>
							<div class="card-body">
                              <h5 class="card-title"><b><?php echo $res['ProductName'];?></b></h5>
                              <h6><a class="card-text btn btn-success btn-round" title="Click for more details!" href="userProductDetails.php?ID=<?php echo $res['ID'];?>"><i class="now-ui-icons gestures_tap-01"></i>View</a>
							  <strong class="card-text"><span style="float:right;">Price: <?php echo $res['Price']; ?></span></strong></h6>
                            </div>
							</div>
							</div>
							</div>
						
                    <?php }?> 
                </div>
				               </div>   

        
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
    
  </body>
</html>