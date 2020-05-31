<!--This page allows the admin to edit the admin account details for a successful login. Allows for editing Firstname, Lastname, Date of birth, password

//php session start-->
<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:loginnew.php');
    exit();
}

//class created for updated the profile information of admin
class profile_update{
	function profUpdate(){
		
		// including the database connection file
		include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
		if (isset($_POST['update'])) {
			//$id           = mysqli_real_escape_string($dbConnection, $_POST['ID']);
			$AdminId  = mysqli_real_escape_string($dbConnection, $_POST['AdminId']);
			$FirstName  = mysqli_real_escape_string($dbConnection, $_POST['FirstName']);
			$LastName      = mysqli_real_escape_string($dbConnection, $_POST['LastName']);
			$Age      = mysqli_real_escape_string($dbConnection, $_POST['Age']);
			$Password   = mysqli_real_escape_string($dbConnection, $_POST['Password']);
			//Encrypting password using md5
            $pass = md5($Password);
            $salt = "a1Bz20ydqelm8m1wql";
            $pass = $salt.$pass;
			
			// checking empty fields
			if (empty($AdminId) || empty($FirstName) || empty($LastName) || empty($DOB) || empty($Password)) {
				
				if (empty($AdminId)) {
					echo "<font color='red'>User name field is empty!</font><br/>";
				}
				
				if (empty($FirstName)) {
					echo "<font color='red'>First Name field is empty!</font><br/>";
				}
				
				if (empty($LastName)) {
					echo "<font color='red'>Last Name field is empty!</font><br/>";
				}
				
				if (empty($Age)) {
					echo "<font color='red'>Age field is empty!</font><br/>";
				}
				
				if (empty($Password)) {
					echo "<font color='red'>Password field is empty!</font><br/>";
				}
				return 1;
				
			} else {
				//updating the table
				$query  = "UPDATE admindetails SET FirstName='$FirstName',LastName='$LastName',Gender='$Gender',Age='$Age', Password='$pass' WHERE AdminId=$id";
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
$ID= $_GET['AdminId'];
//selecting data associated with this particular id
$result = mysqli_query($dbConnection, "SELECT * FROM admindetails WHERE AdminId= '$ID'");
while($res = mysqli_fetch_array($result))
{
    
    $UserID  = $res['AdminId'];
    $FirstName = $res['FirstName'];
    $LastName = $res['LastName'];
    $Age = $res['Age'];
    $Password = $res['Password'];
}
?>
<!--html code for the User Interface of Admin_profile_update.php page-->
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
   
    <!-- Custom CSS -->
    <link rel="stylesheet" href="app new2.css">

    <title>Med-Anytime</title>

</head>

<body class="index-page sidebar-collapse">
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
<div class="wrapper" id="formstyle">
<br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
				<br><br>
                      <h2 align="center">	User Profile</h2>
                      <br>
                      &nbsp&nbsp&nbsp<a href='AdminPage.php' class='btn btn-success btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">

    <div class="panel panel-success panel-size-custom">
  <div class="panel-heading"><h3>Update Profile</h3></div>
  <div class="panel-body">

<!--getting the admin profile details using post method-->
    <form method="post" id="formstyle">
        <div class="form group">
            <input type="hidden" class="form-control" id="ID" name="ID" value=<?php echo $_GET['AdminId'];?>>
            <label>First Name:</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $FirstName;?>">
            <label>Last Name:</label>
            <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $LastName;?>">
            <label>User ID:</label>
            <input type="text" class="form-control" id="AdminId" name="AdminId" value="<?php echo $UserID;?>">
            <label>Password :</label>
            <input type="password" class="form-control" id="Password" name="Password" >
			<label>Age:</label>
            <input type="number" class="form-control" id="Age" name="Age" value="<?php echo $Age;?>">
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