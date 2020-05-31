<?php
session_start();
class login
{
    
    function loginNew()
    {
        
		//Include the Database connectivity File
        include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
        
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_unsafe = $_POST['username'];
            $pass_unsafe = $_POST['password'];
            
			//Formatting the userame and password for using them in the MySQL query
            $user  = mysqli_real_escape_string($dbConnection, $user_unsafe);
            $pass1 = mysqli_real_escape_string($dbConnection, $pass_unsafe);
            
			//Encrypting password using md5
            $pass = md5($pass1);
            $salt = "a1Bz20ydqelm8m1wql";
            $pass = $salt.$pass;
            
            
            //Checking if the credentials belong to admin or user
            $query  = mysqli_query($dbConnection, "SELECT * FROM `admindetails` WHERE AdminId='$user'");
            $res    = mysqli_fetch_assoc($query);
            $id     = $res['AdminId'];
            $query1 = mysqli_query($dbConnection, "SELECT * FROM `userdetails` WHERE UserId='$user'");
            $res1   = mysqli_fetch_assoc($query1);
            $id1    = $res1['UserId'];
			
			//Validations for incorrect details
            if (!(mysqli_num_rows($query) <= 0)) {
                $pass2 = $res['Password'];
				//Wrong password by Admin
                if (!($pass2 == $pass)) {
                    $_SESSION['msg'] = "Please enter the correct password for '$user'";
                    header("Location: loginnew.php");
                    exit();
                }
                $_SESSION['id'] = $res['AdminId'];
                header("Location: AdminPage.php", true, 301);
                exit();
            } else if (mysqli_num_rows($query) < 1 && mysqli_num_rows($query1) == 1) {
                $pass2 = $res1['Password'];
				//Wrong password by User
                if (!($pass2 == $pass)) {
                    $_SESSION['msg'] = "Please enter the correct password for '$user'";
                    header("Location: loginnew.php");
                    exit();
                }
                $_SESSION['id'] = $user;
                header("Location: userpage2.php");
                exit();
                
            } else 
				//Incorrect User/Admin ID
                $_SESSION['msg'] = "Login Failed, user not found! '$user'";
                header("Location: loginnew.php");
            }
            
        }
		
		function loginNewTest()
		{
			
			//Include the Database connectivity File
			include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
			
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$user_unsafe = $_POST['username'];
				$pass_unsafe = $_POST['password'];
				
				//Formatting the userame and password for using them in the MySQL query
				$user  = mysqli_real_escape_string($dbConnection, $user_unsafe);
				$pass1 = mysqli_real_escape_string($dbConnection, $pass_unsafe);
				
				//Encrypting password using md5
				$pass = md5($pass1);
				$salt = "a1Bz20ydqelm8m1wql";
				$pass = $salt . $pass;
				
				
				//Checking if the credentials belong to admin or user
				$query  = mysqli_query($dbConnection, "SELECT * FROM `admindetails` WHERE AdminId='$user' and Password = '$pass'");
				$res    = mysqli_fetch_assoc($query);
				$id     = $res['AdminId'];
				$query1 = mysqli_query($dbConnection, "SELECT * FROM `userdetails` WHERE UserId='$user' and Password = '$pass'");
				$res1   = mysqli_fetch_assoc($query1);
				$id1    = $res1['UserId'];
				
				if (mysqli_num_rows($query) == 1 || mysqli_num_rows($query1) == 1){
					return true;
				}
				else
					return false;
				
			}
		}
        
        
    }

$log = new login;

//Calling the login function using a class object
$log->loginNew();




?>