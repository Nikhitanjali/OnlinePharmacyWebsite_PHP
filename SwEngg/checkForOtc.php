<!-- To check whether the medicines were over the counter or not? In the userproduct details we have the field if the medicine is over the counter or not. It means that these medicines require more information such as the Doctor name, prescription, NPI number and the emailid of the doctor. The delivery address requires complete information.  -->
<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

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
  <!-- End Navbar -->
    
    <div tabindex="1">
                
			    <?php
				//Display Error message received from CartDetails.php when we try adding item to cart
				if (isset($_SESSION['msg'])) {
					echo "<br><br><br>";
					echo '<center><strong><span style ="color:#FF0000;">"' . $_SESSION['msg'] . '"</span></strong></center>';
					include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
						$ID1 = $_SESSION['id'];	
						$query3=mysqli_query($dbConnection,"SELECT * FROM `order details` WHERE UserID='$ID1' AND OrderStatus='Cart' AND OtcFlag='N' and `docEmailId` = '' and `docNPInum` = '0'");
						$count1=mysqli_num_rows($query3);
						if($count1 <= 0 && $_SESSION['msg']== "Address saved!"){
							header("Location: OrderPlaced.php");
						}
					unset($_SESSION['msg']);
				}
				else{
					$ID1 = $_SESSION['id'];	
						$query4=mysqli_query($dbConnection,"SELECT * FROM `order details` WHERE UserID='$ID1' AND `OrderStatus`='Cart' AND `Street Address`='' and `County` = '' and `City` = '' AND State='' AND ZipCode=''");
						$count1=mysqli_num_rows($query4);
						if($count1 <= 0){
							echo "<br><br>";
							echo '<center><strong><span style ="color:#FF0000;">"You have already entered the address and Doctors details"</span></strong></center>';
							echo "<center><a href = \"OrderPlaced.php\"><button type=\"submit\" name=\"submit\" class=\"btn btn-success btn-round\"><i class=\"now-ui-icons shopping_delivery-fast\"></i> Save Address and Continue</button></a></center>";
						}
						else{
				?>
               
			    <form method="POST" action="saveAddress.php" id="formstyle">
                  <div >
				  <br><br><br>
                    <center><strong><h4>SHIPPING ADDRESS</h4></strong></center>
                  </div>
                  <div class="modal-body">

                      <div class="form-group">
					  <label>Street Address :</label>
                      <input type="text" class="form-control" name="streetAddress" placeholder="Complete Address For Delivery Purpose." required>
					  <br>
					  <label>County:</label>
                      <select class="btn btn-primary btn-round dropdown-toggle" size="1" name="county">
                      <option value="Dallas">Dallas</option>
                      <option value="Fort Worth">Fort worth</option>
                      <option value="Arlington">Arlington</option>
                      <option value="Plano">Plano</option>
                      <option value="Garland">Garland</option>
                      <option value="Irving">Irving</option>
                      <option value="Grand Prairie">Grand Prairie</option>
                      <option value="McKinney">McKinney</option>
                      <option value="Frisco">Frisco</option>
                      <option value="Allen">Allen</option>
                      <option value="Lewisville">Lewisville</option>
                      <option value="Flower Mound">Flower Mound</option>
                      <option value="Richardson">Richardson</option>
                      <option value="Denton">Denton</option>
                      <option value="Grapevine">Grapevine</option>
                      <option value="Little Elm">Little Elm</option>
                      </select>  
					  <br>
					  <label>City:</label>
					  <input type="text" class="form-control" name="shipCity" value = "Dallas" readonly>
					  <label>State:</label>
					  <input type="text" class="form-control" name="shipState" value = "Texas" readonly>
					  <label>Zipcode:</label>
					  <input type="text" class="form-control" name="zipCode" placeholder="Zipcode" pattern="[0-9]*" required>
                      </div>
					  <a href="CartDetails.php" ><button class="btn btn-primary btn-round" type="button">Close</button></a>
                    <a><button type="submit" name="submit" class="btn btn-success btn-round"><i class="now-ui-icons shopping_delivery-fast"></i> Save Address and Continue</button></a>
				</form>
				  <?php   
				}}?>
					
					<?php
					
						include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
						$ID = $_SESSION['id'];	
						$query=mysqli_query($dbConnection,"SELECT * FROM `order details` WHERE UserID='$ID' AND OrderStatus='Cart' AND OtcFlag='N' and `docEmailId` = '' and `docNPInum` = '0'");
						$count=mysqli_num_rows($query);
						if($count >= 1){		?>
						
						    <form method="POST" action="checkDocDetails.php" enctype="multipart/form-data" id="formstyle">
							<br>
							<strong><h4 style ="color:#FF0000;">Please enter additional details as you have medicines which cannot be sold over the counter!!</h4></strong>
							<label>Doctor's Name:</label>
							<input type="text" class="form-control" name="dName" required>
							<label>Doctor's NPI Number:</label>
							<input type="text" class="form-control" name="dNPINum" required>
							<label>Doctor's Email ID:</label>
							<input type="text" class="form-control" name="dEmailId" required>
							<label>Upload Prescription</label>
							<div class="input-group">
								<input type="file" class="form-control" id="prescription" name="prescription" Placeholder="Please upload a valid .jpg or .png file" required>  
							</div>
							<br>
							<button  type="submit" id="submit" name="submit" class="btn btn-success btn-round pull-right"><i class="now-ui-icons shopping_bag-16"></i> Continue</button> 
							</form>
							
							
						<?php}?>
					<?php }
					
						if (isset($_SESSION['msg1'])) {
							echo "<br><br>";
							echo '<center><strong><span style ="color:#FF0000;">"' . $_SESSION['msg1'] . '"</span></strong></center>';
							unset($_SESSION['msg1']);
						}
						
					?>
					
					
                  </div>
                  
              
            
            </div>
	
	
	
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
    
  </body>
</html>