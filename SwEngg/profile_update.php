<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:loginnew.php');
    exit();
}

class profile_update{
	function profUpdate(){
		
		// including the database connection file
		include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
		if (isset($_POST['update'])) {
			$id           = mysqli_real_escape_string($dbConnection, $_POST['ID']);
			$UserID  = mysqli_real_escape_string($dbConnection, $_POST['UserID']);
			$FirstName  = mysqli_real_escape_string($dbConnection, $_POST['FirstName']);
			$LastName      = mysqli_real_escape_string($dbConnection, $_POST['LastName']);
			$Gender        = mysqli_real_escape_string($dbConnection, $_POST['Gender']);
			$DOB      = mysqli_real_escape_string($dbConnection, $_POST['DOB']);
			$Password   = mysqli_real_escape_string($dbConnection, $_POST['Password']);
			//Encrypting password using md5
            $pass = md5($Password);
            $salt = "a1Bz20ydqelm8m1wql";
            $pass = $salt.$pass;
			
			// checking empty fields
			if (empty($id) || empty($UserID) || empty($FirstName) || empty($LastName) || empty($Gender) || empty($DOB) || empty($Password)) {
				
				if (empty($UserID)) {
					echo "<font color='red'>User name field is empty!</font><br/>";
				}
				
				if (empty($FirstName)) {
					echo "<font color='red'>First Name field is empty!</font><br/>";
				}
				
				if (empty($LastName)) {
					echo "<font color='red'>Last Name field is empty!</font><br/>";
				}
				
				if (empty($Gender)) {
					echo "<font color='red'>Gender field is empty!</font><br/>";
				}
				
				if (empty($DOB)) {
					echo "<font color='red'>Date of Birth field is empty!</font><br/>";
				}
				
				if (empty($Password)) {
					echo "<font color='red'>Password field is empty!</font><br/>";
				}
				return 1;
				
			} else {
				//updating the table
				$query  = "UPDATE userdetails SET FirstName='$FirstName',LastName='$LastName',Gender='$Gender',DateofBirth='$DOB',UserID='$UserID', Password='$pass' WHERE ID=$id";
				$result = mysqli_query($dbConnection, $query);
				//return 2;
				if ($result) {
					//redirecting to the display page.
					header("Location: ViewProfile.php?ID=$id");
				}
				
			}
}
}
	
}
$prof = new profile_update;
$prof->profUpdate();

?>

<?php
include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
//getting id from url
$ID= $_GET['ID'];
//selecting data associated with this particular id
$result = mysqli_query($dbConnection, "SELECT * FROM userdetails WHERE ID=$ID");
while($res = mysqli_fetch_array($result))
{
    $id = $res['ID'];
    $UserID  = $res['UserID'];
    $FirstName = $res['FirstName'];
    $LastName = $res['LastName'];
    $Gender =  $res['Gender'];
    $DOB = $res['DateOfBirth'];
    $Password = $res['Password'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
<div class="wrapper" >
<br>
        <div class="main" id="formstyle">
            <div class="section section-basic">
                <div class="container">
				<br><br>
                      <h2 align="center">	User Profile</h2>
                      <br>
                      &nbsp&nbsp&nbsp<a href='userpage2.php' class='btn btn-success btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">

    <div class="panel panel-success panel-size-custom">
  <div class="panel-heading"><h3>Update Profile</h3></div>
  <div class="panel-body">
    <form method="post">
        <div class="form group">
            <input type="hidden" class="form-control" id="ID" name="ID" value=<?php echo $_GET['ID'];?>>
            <label>First Name:</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $FirstName;?>">
            <label>Last Name:</label>
            <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $LastName;?>">
            <label>User ID:</label>
            <input type="text" class="form-control" id="UserID" name="UserID" value="<?php echo $UserID;?>">
            <label>Password :</label>
            <input type="password" class="form-control" id="Password" name="Password" >
            <label>Gender:</label>
            <input type="text" class="form-control" id="Gender" name="Gender" value="<?php echo $Gender;?>">
			<label>Date of Birth:</label>
            <input type="date" class="form-control" id="DOB" name="DOB" value="<?php echo $DOB;?>">
			   </div>            
             </div>
            </div>
            <br>
            <div class="form group">
                <button type="submit" class="btn btn-success btn-round" id="submit" name="update">
                    <i class="now-ui-icons ui-1_check"></i> Update Info
                </button>
            </div>
    </form>
  </div>
</div>
</div>

    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
    
  </body>

</html>