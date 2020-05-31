<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

<!--Admin Home Page-->
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="app new2.css">

    <title>Med-Anytime</title>
  </head>
  
  <body>
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
	    <!--Redirect to the inventory page -->
        <a class="nav-link" href="inventory.php">Inventory</a>
      </li>
	   <li class="nav-item">
        <a class="nav-link" href="Order_details_admin.php">Orders</a>
      </li>  
       <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="now-ui-icons users_circle-08"></i>
                            <?php
                                include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
								$query=mysqli_query($dbConnection,"SELECT * FROM `admindetails` WHERE AdminId='".$_SESSION['id']."'");
								$row=mysqli_fetch_assoc($query);
                                echo ''.$row['FirstName'].'';
                            ?>
                        </a>
						<div class="dropdown-menu"  aria-labelledby="navbarDropdown">
         
          <a class="dropdown-item" href="AdminViewProfile.php">View Profile Information</a>
           <a class="dropdown-item" href="logout.php">Logout</a>
      
        </div>
      
       </li>
      
	   

    </ul>
    
  </div>
      
    </nav>
 <div class="image">
</div>
      
    <!--Footer-->
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
    

 

        
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!--<script>
      $(function() {
        $(document).scroll(function() {
          var $nav = $("#mainNavbar");
          $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
        })
      })
    </script>-->
    
  </body>
</html>