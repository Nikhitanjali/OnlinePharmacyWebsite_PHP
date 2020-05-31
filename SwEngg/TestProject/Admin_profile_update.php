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
<div class="wrapper">
<br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      <h2 align="center">	User Profile</h2>
                      <br>
                      &nbsp&nbsp&nbsp<a href='AdminPage.php' class='btn btn-success btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">

    <div class="panel panel-success panel-size-custom">
  <div class="panel-heading"><h3>Update Profile</h3></div>
  <div class="panel-body">

<!--getting the admin profile details using post method-->
    <form method="post">
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
<footer class="footer" data-background-color="black">
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
        </footer>
    </div>
</body>

</html>