<!--This code allows the admin to search for a product using some of the words in the product name or they can also search the product using specific disease name associated with the medicines (like search for fever gives us the result of Ibuprofen).

//php session start-->
<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

<!--html page code that will be viewed when we search for a product.-->
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
//navbar
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
        <a class="nav-link" href="Order_details_Admin.php">Orders</a>
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
          <a class="dropdown-item" href="#">View Orders</a>
          <a class="dropdown-item" href="AdminViewProfile.php">View Profile Information</a>
           <a class="dropdown-item" href="logout.php">Logout</a>
      
        </div>
      
       </li>
      
	   

    </ul>
    
  </div>
      
    </nav>    
  <!-- End Navbar -->
  <div class="image">
</div>
    <div class="wrapper">
        
        <br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                    <br>
					 <h5><strong>Search Results for <?php echo $_POST['search'];?></strong></h5>
                    <br><hr color="orange">
					<div class ="col-md-12"></div>
                    <div class="tab-pane  active" id="">
                        <ul class="thumbnails">
                         <!--POST Method for 'search'-->
                            <?php
                            if (isset($_POST['search'])){
                                                            
                            $search=$_POST['search'];
                                 //retrieving the products based on 'search'                               
                            $query="SELECT * FROM products WHERE ProductName LIKE '%$search%' OR CompanyName LIKE '%$search%' OR CureFor LIKE '%$search%'";
                            $result = mysqli_query($dbConnection,$query);
                            while($res=mysqli_fetch_array($result)){
                                $productID=$res['ID'];
                            ?> 
                             <!--displaying the products which are retrieved-->

                            <div class="row-sm-4">
                                <div class="thumbnail">
                                    <img src="/SwEngg/upload/<?php echo $res['productImage']; ?>" width="300px" height="200px">
                                <div class="caption">
                                  <h5><b><?php echo $res['ProductName'];?></b></h5>
                                  <h6><a class="btn btn-success btn-round" title="Click for more details!" href="View_Product_Details.php?ID=<?php echo $res['ID'];?>"><i class="now-ui-icons gestures_tap-01"></i>View</a><span style = "float: right;"><?php echo $res['Price']; ?></h6>
                                </div>

                                </div>
								<hr color="orange">
                              </div>
                                     
                                <?php }?> 
                            <?php }?> 

                        </ul>
                    </div>
					




        </div>
    </div>     
</div>
</div>
</body>
</html>