<?php
//Starting a new database session 
session_start();
include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
	<!--Including Bootstrap CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
	<!--Including the stylesheet-->
   <link rel="stylesheet" href="app new2.css">
</head>

<body>

<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <a class="navbar-brand" id="logo" href="loginnew.php">Med-Anytime</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02" >
     <form class="form-inline my-2 my-lg-0" style="margin-left: auto; display: block margin-right: 20px;" >
    <a class= "btn btn-info my-2 my-sm-0 align-right" id="registration" href="registration.php">Register</a>
    </form>
  </div>
</nav>
<div class="wrapper">
<!--On successfully entering the details this section will redirect to login.php for checking the credentials-->
<form class="form" method= "POST"  action="login.php" id="formstyle">
 <h2> Login</h2>
  
    <div class="form-group">
    <label for="InputEmail1">Email address</label>
    <input type="email" class="form-control" name ="username" aria-describedby="emailHelp" placeholder="Enter email">
    
  </div>
     <div class="form-group">
    <label for="InputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
  </div>

  <div class="form-row">
    <div class="form-group col">
    <button type="submit" class="btn">Login</button>
    </div>
    
    </div>
</form>
<?php
//Display Error message received from login.php in case of incorrect credentials
if (isset($_SESSION['msg'])) {
    echo '<strong><span style ="color:#FF0000;">"' . $_SESSION['msg'] . '"</span></strong>';
    unset($_SESSION['msg']);
}
?>
</div>
	
	<!-- Scripts needed for proper functionality-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    
</body>

</html>