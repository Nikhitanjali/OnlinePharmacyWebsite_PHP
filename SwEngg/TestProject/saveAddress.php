<!-- This is a php code to take shipping address from the user if they wish to check out with an order from their cart--> 
<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
	
	class saveAddress{
		
		public function saveAddr(){
				//here we are establishing connection with a database to save the address
				include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
				echo "check 4";
				if (isset($_POST['submit'])) { 
				//Fetching all the values to be saved in the database
				$streetAddress = $_POST['streetAddress'];
				$county = $_POST['county'];
				$shipCity = $_POST['shipCity'];
				$shipState = $_POST['shipState'];
				$zipCode = $_POST['zipCode'];
				$UserId = $_SESSION['id'];
				
				$chkquery   = mysqli_query($dbConnection, "SELECT * FROM `order details` WHERE UserID='$UserId' AND OrderStatus='Cart'"); //sql query to insert data in DB
				$res        = mysqli_fetch_assoc($chkquery);
				echo "check 2";
				// checking empty fields
				if (empty($streetAddress) || empty($county) || empty($shipCity) || empty($shipState) || empty($zipCode) || empty($UserId)) {
					echo "check 1";
					if (empty($streetAddress)) {
						$_SESSION['msg'] = "Street address field is empty! Please check out again to correct the address.";
					}
					
					if (empty($county)) {
						$_SESSION['msg'] = "County field is empty! Please check out again to correct the address";
					}
					
					if (empty($shipCity)) {
						$_SESSION['msg'] = "City field is empty! Please check out again to correct the address";
					}
					
					if (empty($shipState)) {
						$_SESSION['msg'] = "State field is empty! Please check out again to correct the address";
					}
					
					if (empty($zipCode)) {
						$_SESSION['msg'] = "Zipcode field is empty! Please check out again to correct the address";
					}
					//For testing purpose
					//return 1;
				} 
				
				else if (!(mysqli_num_rows($chkquery) <= 0)) {
					echo "check 3--$streetAddress--$county--$shipCity--$shipState--$zipCode--$UserId";
					$query = "UPDATE `order details` SET `Street Address` = '$streetAddress', County='$county', City='$shipCity' , State='$shipState' , ZipCode='$zipCode' WHERE UserID = '$UserId' and OrderStatus = 'Cart'";
					$result = mysqli_query($dbConnection, $query);
					if ($result) {
						$_SESSION['msg'] = "Address saved!";
						header("Location: checkForOtc.php", true, 301);
						exit();
					}
				}
				}
			}
			
		}
		
		$obj = new saveAddress;
		$obj->saveAddr();
		
		
	
	
?>
<!-- This is end of the code-->
