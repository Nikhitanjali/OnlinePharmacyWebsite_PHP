<?php
session_start();
if (!isset($_SESSION['id'])) {
    //header('location:loginnew.php');
    //exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
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
                      <h2>New Products</h2>
                      <br>
                      <a href='AdminPage.php' class='btn btn-success btn-round'>Back to Index</a>
                      <br>
                <br>
                <div class="col-md-12">
              

		<?php
		class productAdd{
			
			function saveProductTest(){
				
				// including the database connection file
				include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
				error_reporting(E_ALL);
				ini_set('display_errors', '1');
				if (isset($_POST['submit'])) {
					
					$prod_name    = $_POST['prod_name'];
					$comp_name    = $_POST['comp_name'];
					$price        = $_POST['price'];
					$cureFor      = $_POST['cureFor'];
					$otcFlag      = $_POST['otcFlag'];
					$quantity     = $_POST['quantity'];
					$expDate      = $_POST['expDate'];
					$featuredFlag = $_POST['featuredFlag'];
					$prodImage    = $_POST['prodImage'];
					//Uploading image for the product in a server folder
					//move_uploaded_file($_FILES["prodImage"]["tmp_name"], "C:/xampp/htdocs/SwEngg/upload/" . $_FILES["prodImage"]["name"]);
					//$prodImage = $_FILES["prodImage"]["name"];
					
					//Checking if the product already exists
					$chkquery = mysqli_query($dbConnection, "SELECT * FROM `products` WHERE ProductName='$prod_name'");
					$res      = mysqli_fetch_assoc($chkquery);
					
					// checking empty fields
					if (empty($prod_name) || empty($comp_name) || empty($price) || empty($cureFor) || empty($otcFlag) || empty($quantity) || empty($expDate) || empty($prodImage)) {
						
						if (empty($prod_name)) {
							echo "<font color='red'>Product name field is empty!</font><br/>";
						}
						
						if (empty($comp_name)) {
							echo "<font color='red'>Brand name field is empty!</font><br/>";
						}
						
						if (empty($price)) {
							echo "<font color='red'>Price field is empty!</font><br/>";
						}
						
						if (empty($cureFor)) {
							echo "<font color='red'>Product cure for field is empty!</font><br/>";
						}
						
						if (empty($otcFlag)) {
							echo "<font color='red'>Over the counter flag is empty!</font><br/>";
						}
						
						if (empty($quantity)) {
							echo "<font color='red'>Quantity in stock field is empty!</font><br/>";
						}
						
						if (empty($expDate)) {
							echo "<font color='red'>Expiry Date field is empty!</font><br/>";
						}
						
						if (empty($prodImage)) {
							echo "<font color='red'>Product Image field is empty!</font><br/>";
						}
						if (empty($featuredFlag)) {
							echo "<font color='red'>Featured image or No field is empty!</font><br/>";
						}
						return 1;
						
					} else if (!(mysqli_num_rows($chkquery) <= 0)) {
						echo "The product already exists. Please update it.";
						return 2;
					}
					
					else {
						//Inserting new product into database
						$query = "INSERT INTO products (ProductName, CompanyName, CureFor, Price, OtcFlag, ExpiryDate, NumberInStock, productImage, Featured_Flag) 
						VALUES ('$prod_name','$comp_name','$cureFor','$price','$otcFlag','$expDate','$quantity','$prodImage','$featuredFlag')";
						
						$result = mysqli_query($dbConnection, $query);
						return 3;
						
					}
				}				
				
			}
		}
		$pr = new productAdd;
		$pr->saveProductTest();
		 
		?>



		<div class="panel panel-success panel-size-custom">
				  <div class="panel-heading"><h3>Add New Product</h3></div>
				  <!-- Fields to enter the new product details-->
				  <div class="panel-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form group">
							<label>Product Name:</label>
							<input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="Product Name"/>
							<label>Company Name:</label>
							<input type="text" class="form-control" id="comp_name" name="comp_name" placeholder="Product Brand"/>
							<label>Price</label>
							<input type="text" class="form-control" id="price" name="price" placeholder="Price"/>
							<label>Cure For</label>
							<input type="text" class="form-control" id="cureFor" name="cureFor" placeholder="Product Used For"/>
							<label>Over The Counter or Not (Y/N):</label>
							<input type="text" class="form-control" id="otcFlag" name="otcFlag" placeholder="Y/N"/>
							<label>Featured Image (Y/N):</label>
							<input type="text" class="form-control" id="featuredFlag" name="featuredFlag" placeholder="Y/N"/>
							<label>Number in Stock:</label>
							<input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity"/>
							<label>Expiry Date:</label>
							<input type="date" class="form-control" id="expDate" name="expDate" />
							<label>Product Image:</label>
							<div class="input-group">
								<input type="file" class="form-control" id="prodImage" name="prodImage">  
							</div>
						</div>
						<br>

						<div class="form group">
							<button type="submit" class="btn btn-success btn-round" id="submit" name="submit">
							<i class="now-ui-icons ui-1_check"> Add Product</i> 
							</button> 
						</div>
					</form>
				  </div>
				</div> 
				<br> 
			</div>
		</div>
		</div>
        </div>
</body>