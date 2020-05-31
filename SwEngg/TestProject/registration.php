<?php
session_start();
include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>Registration Page</title>
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	  <!--Includig Bootstrap and font CDN-->
      <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="app new2.css">
   </head>
   <body>
      <!--Navbar-->
      <nav class="navbar navbar-expand-lg navbar-light ">
         <a class="navbar-brand" id="logo" href="loginnew.php">Med-Anytime</a>
      </nav>
      <form method= "post"  action="" id="formstyle" enctype="multipart/form-data">
         <h4> Buy Medicines Online !!</h4>
         <h5> Fill out these details to register </h5>
         <div class="form-row">
            <div class="form-group col">
               <label for="InputFirstname">Firstname</label>
               <input type="text" class="form-control" placeholder="Firstname" name = "firstname" id="InputFirstname">
            </div>
            <div class="form-group col">
               <label for="InputLastname">Lastname</label>
               <input type="text" class="form-control" placeholder="Lastname" name = "lastname" id="InputLastname">
            </div>
         </div>
         <div class="row">
            <div class= "form-group col">
               <label for="exampleFormControlSelect1">Gender</label>
            </div>
            <div class= "form-group col">
               <select class="form-control" name = "gender" id="exampleFormControlSelect1" >
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
               </select>
            </div>
         </div>
         <div class="form-group">
            <label for="InputDOB">DateOfBirth</label>
            <input type="date" value="1990-06-01" class="form-control" id="InputDOB" name = "DOB" placeholder="Enter Date of Birth">
         </div>
         <div class="form-group">
            <label for="InputEmail1">Email address</label>
            <input type="email" class="form-control" id="InputEmail1" name = "username" aria-describedby="emailHelp" placeholder="Enter email">
         </div>
         <div class="form-group">
            <label for="InputPassword1">Password</label>
            <input type="password" class="form-control" id="InputPassword1" name = "password" placeholder="Password">
         </div>
         <div class="form-group">
          
          <label for="exampleFormControlFile1">ID Proof</label>
          <input type="file" class="form-control-file" name = "govtID" id="IdProoffile">
          
          </div>
          <div class="form-group">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name ="chkBox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
            I agree that information provided by me is valid
            </label>
            </div>
          </div>
          <button type="submit" name="submit" class="btn">Submit</button>
      </form>
      <?php
		class registration{
			
			//To calculate the age of users
			public function dateDifference($date_1, $date_2, $differenceFormat = '%y Year')
			{
				$datetime1 = date_create($date_1);
				$datetime2 = date_create($date_2);
				$interval = date_diff($datetime1, $datetime2);
				$interval = $interval->format($differenceFormat);
				
			}
			
			public function save(){
				
				include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
				if (isset($_POST['submit'])) { 
				//Fetching all the values to be saved in the database
				$firstname  = $_POST['firstname'];
				$lastname   = $_POST['lastname'];
				$username   = $_POST['username'];
				//To check if it is an existing user
				$chkquery   = mysqli_query($dbConnection, "SELECT * FROM `userdetails` WHERE UserId='$username'");
				$res        = mysqli_fetch_assoc($chkquery);
				$gender     = $_POST['gender'];
				$DOB        = $_POST['DOB'];
				//To calculate the age of the user
				$date_2 = date("Y-m-d");
				$differenceFormat = '%y Year';
				$datetime1 = date_create($DOB);
				$datetime2 = date_create($date_2);
				$interval = date_diff($datetime1, $datetime2);
				$interval = $interval->format($differenceFormat);
				$DOB        = $_POST['DOB'];
				$password   = $_POST['password'];
				$terms      = $_POST['chkBox'];
				//encrypting the password
				$pass1 = md5($password);
				$salt  = "a1Bz20ydqelm8m1wql";
				$pass1 = $salt . $pass1;
				$filename = $_POST["govtID"];
				//upload stateID
				
				//Uploading stateID for the user in a server folder
				//move_uploaded_file($_FILES["govtID"]["tmp_name"], "C:/xampp/htdocs/SwEngg/stateID/" . $_FILES["govtID"]["name"]);
				//$filename = $_FILES["govtID"]["name"];
				
				// checking empty fields
				if (empty($firstname) || empty($lastname) || empty($username) || empty($gender) || empty($password) || empty($filename) || empty($terms) || empty($DOB)) {
					//echo "'".$pass1."'";
					if (empty($firstname)) {
						echo "<font color='red'>Firstname field is empty!</font><br/>";
					}
					
					if (empty($lastname)) {
						echo "<font color='red'>Lastname field is empty!</font><br/>";
					}
					
					if (empty($gender)) {
						echo "<font color='red'>Gender field is empty!</font><br/>";
					}
					
					if (empty($DOB)) {
						echo "<font color='red'>Date of Birth is empty!</font><br/>";
					}
					
					if (empty($username)) {
						echo "<font color='red'>Email field is empty!</font><br/>";
					}
					
					if (empty($password)) {
						echo "<font color='red'>Password field is empty!</font><br/>";
					}
					
					if (empty($filename)) {
						echo "<font color='red'>It is mandatory to upload any one valid government ID!</font><br/>";
					}
					
					if (empty($terms)) {
						echo "<font color='red'>Please check the box stating all the information you provided is valid.</font><br/>";
					}
					//For testing purpose
					return 1;
				} 
				//Checking if the user already exists
				else if (!(mysqli_num_rows($chkquery) <= 0)) {
					echo "<font color='red'>That emailID is already in use.</font><br/>";
					//For testing purpose
					return 2;
				}
				//Checking if the age is less than 18
				else if ($interval < 18) {
					echo "<font color='red'>Age should be atleast 18 years.</font><br/>";
					//For testing purpose
					return 3;
				}
				
				else {
					//Inserting new user details
					$query = "INSERT INTO userdetails (ID, UserID, FirstName, LastName, Password,Gender, GovtID,DateOfBirth) 
											VALUES ('','$username','$firstname','$lastname','$pass1','$gender','$filename',$DOB)";
					
					$result = mysqli_query($dbConnection, $query);
					//For testing sake
					return 5;
					if ($result) {
						//header("Location: loginnew.php", true, 301);
						//exit();
					}
					
				}
				
			}
			
		}
		
}

$reg = new registration;
$reg->save();
//Clering the POST request variable
unset($_POST['submit']);
?>
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
         crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
         crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
         crossorigin="anonymous"></script>
   </body>