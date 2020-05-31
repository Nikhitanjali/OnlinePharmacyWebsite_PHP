<!-- This is a php code to let user view their own details if they click on their first name in their home page. -->
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

    <title>View Profile</title>

</head>

<body>
 <!--Navbar-->
 <nav  class="navbar navbar-dark navbar-expand-md pt-0 pb-0 fixed-top">
      <a href="userpage2.php" class="navbar-brand">Med-AnyTime</a>
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
    
<div class="container">
<br><br><br>
<h1 align="Center"> User Profile</h1>
 
 
                      &nbsp &nbsp  <center><a href='userpage2.php' class='btn btn-success btn-round'>Back to Index</a></center>
                <br>
   <?php
    include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
    $ID=$_GET['ID'];
	//Fetching User details to be viewed
    $query = "SELECT * FROM userdetails WHERE ID='$ID'";
    $result = mysqli_query($dbConnection,$query);
    while($res = mysqli_fetch_array($result)) {  
    
?>   
  <div class="row"> 
  
  <div class="col-sm-4"></div>
 <div class="col-sm-4">			
  <div class="card-columns">
				
                <div class="card" style = "width: 25rem;  display:inline block" >
                          <div class="card-body">
							<!--Display all the details-->
							  <ul><strong class="card-text">User ID:</strong><?php echo $res['UserID']; ?></ul>
                              <ul><strong class="card-title">First Name: </strong><?php echo $res['FirstName'];?></ul>
		                       <ul> <strong class="card-text">Last Name:</strong> <?php echo $res['LastName']; ?> </ul>
					          <ul><strong class="card-title">Gender:</strong> <?php echo $res['Gender']; ?></ul>
                              <ul><strong class="card-title">Date of Birth:</strong> <?php echo $res['DateOfBirth']; ?></ul>
							  <ul><strong class="card-title">Password:</strong><input type="password" value="<?php echo $res['Password'];?>" readonly> </ul>
							  <ul><button type="submit" class="btn btn-success btn-round" id="submit" name="update"><?php echo "<a href=\"profile_update.php?ID=$res[ID]\">Edit Profile</a>"; }?></button></ul>
                            </div>
							</div>
							</div>
							</div>
						
                 </div>
				</div> 
	
	

</body>


</html>