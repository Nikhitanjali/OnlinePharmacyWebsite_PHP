<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:loginnew.php');
    exit();
}



class product_update{
	function prodUpdate(){
		
		// including the database connection file
		include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
		if (isset($_POST['update'])) {
			$id           = mysqli_real_escape_string($dbConnection, $_POST['ID']);
			$ProductName  = mysqli_real_escape_string($dbConnection, $_POST['ProductName']);
			$CompanyName  = mysqli_real_escape_string($dbConnection, $_POST['CompanyName']);
			$CureFor      = mysqli_real_escape_string($dbConnection, $_POST['CureFor']);
			$Price        = mysqli_real_escape_string($dbConnection, $_POST['Price']);
			$OtcFlag      = mysqli_real_escape_string($dbConnection, $_POST['OtcFlag']);
			$ExpiryDate   = mysqli_real_escape_string($dbConnection, $_POST['ExpiryDate']);
			$quantity     = mysqli_real_escape_string($dbConnection, $_POST['quantity']);
			$FeaturedFlag = mysqli_real_escape_string($dbConnection, $_POST['FeaturedFlag']);
			
			
			// checking empty fields
			if (empty($ProductName) || empty($CompanyName) || empty($CureFor) || empty($Price) || empty($OtcFlag) || empty($ExpiryDate) || empty($quantity) || empty($FeaturedFlag)) {
				
				if (empty($ProductName)) {
					echo "<font color='red'>Product name field is empty!</font><br/>";
				}
				
				if (empty($CompanyName)) {
					echo "<font color='red'>Company Name field is empty!</font><br/>";
				}
				
				if (empty($CureFor)) {
					echo "<font color='red'>Cure for field is empty!</font><br/>";
				}
				
				if (empty($Price)) {
					echo "<font color='red'>Product price field is empty!</font><br/>";
				}
				
				if (empty($OtcFlag)) {
					echo "<font color='red'>Over the counter is empty!</font><br/>";
				}
				
				if (empty($ExpiryDate)) {
					echo "<font color='red'>Expiry date field is empty!</font><br/>";
				}
				
				if (empty($quantity)) {
					echo "<font color='red'>Quantity in stock field is empty!</font><br/>";
				}
				
				if (empty($FeaturedFlag)) {
					echo "<font color='red'>Product featured flag field is empty!</font><br/>";
				}
				//return 1;
				
			} else {
				//updating the table
				$query  = "UPDATE products SET ProductName='$ProductName',CompanyName='$CompanyName',CureFor='$CureFor',Price='$Price',OtcFlag='$OtcFlag',
						ExpiryDate='$ExpiryDate',NumberInStock='$quantity',Featured_Flag='$FeaturedFlag' WHERE ID=$id";
				$result = mysqli_query($dbConnection, $query);
				//return 2;
				if ($result) {
					//redirecting to the display page.
					header("Location: inventory.php");
				}
				
			}
}
}
	
}
$prod = new product_update;
$prod->prodUpdate();

?>

<?php
include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
//getting id from url
$ID= $_GET['ID'];
//selecting data associated with this particular id
$result = mysqli_query($dbConnection, "SELECT * FROM products WHERE ID=$ID");
while($res = mysqli_fetch_array($result))
{
    $CompanyName = $res['CompanyName'];
    $ProductName = $res['ProductName'];
    $CureFor = $res['CureFor'];
    $Price = $res['Price'];
    $OtcFlag = $res['OtcFlag'];
    $ExpiryDate = $res['ExpiryDate'];
    $quantity = $res['NumberInStock'];
    $FeaturedFlag = $res['Featured_Flag'];
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
<div class="wrapper">
<br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
				 <br>
				 <br>
                      <h2>Product Information</h2>
                      <br>
                      &nbsp&nbsp&nbsp<a href='inventory.php' class='btn btn-success btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">

    <div class="panel panel-success panel-size-custom">
  <div class="panel-heading"><h3>Update Product</h3></div>
  <div class="panel-body">
    <form action="product_update.php" method="post" id="formstyle">
        <div class="form group">
            <input type="hidden" class="form-control" id="ID" name="ID" value=<?php echo $_GET['ID'];?>>
            <label>Company Name:</label>
            <input type="text" class="form-control" id="CompanyName" name="CompanyName" value="<?php echo $CompanyName;?>">
            <label>Product Name:</label>
            <input type="text" class="form-control" id="ProductName" name="ProductName" value="<?php echo $ProductName;?>">
            <label>Cure For:</label>
            <input type="text" class="form-control" id="CureFor" name="CureFor" value="<?php echo $CureFor;?>">
            <label>Price :</label>
            <input type="text" class="form-control" id="Price" name="Price" value="<?php echo $Price;?>">
            <label>Over the Counter or Not:</label>
            <input type="text" class="form-control" id="OtcFlag" name="OtcFlag" value="<?php echo $OtcFlag;?>">
  <label>Featured Product or Not:</label>
            <input type="text" class="form-control" id="FeaturedFlag" name="FeaturedFlag" value="<?php echo $FeaturedFlag;?>">
  <label>Expiry Date:</label>
            <input type="text" class="form-control" id="ExpiryDate" name="ExpiryDate" value="<?php echo $ExpiryDate;?>">
  <label>Quantity in stock:</label>
            <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity;?>">
                </div>            
             </div>
            </div>
            <br>
            <div class="form group">
                <button type="submit" class="btn btn-success btn-round" id="submit" name="update">
                    <i class="now-ui-icons ui-1_check"></i> Update Product
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