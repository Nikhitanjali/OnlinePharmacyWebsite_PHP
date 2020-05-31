<!--This page facilitates to add the product by the user to the user page

//php session start-->
<?php
    session_start();
	//Checking if the user is logged in
    if (!isset($_SESSION['id'])) {
       header('location:loginnew.php');
       exit();
    }

//class for add to cart

	class AddToCart{
		
//this function add the product to cart based on "ID"
		function itemsToCart(){
			include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
			  $ID= $_POST['ProductId'];
			  $query = "SELECT * FROM products WHERE ID='$ID'";
			  $result = mysqli_query($dbConnection,$query);
			  while($res = mysqli_fetch_array($result)){

              $ProductID=$res['ID'];
			  $prodName=$res['ProductName'];
              $price=$res['Price'];
              $userId = $_SESSION['id'];
			  $prodQty = $res['NumberInStock'];  
			  $cartQty = $_POST['cartQty'];
			  $OtcFlag = $res['OtcFlag'];
			  
              if (isset($_POST['submit'])){
				  $query1 = "SELECT * FROM `order details` WHERE ProductID='$ProductID' and UserID='$userId' and OrderStatus='Cart'";
				  $result1 = mysqli_query($dbConnection,$query1);
				  while($res1 = mysqli_fetch_array($result1)){
					  $_SESSION['msg'] = "Product already in cart.Please change the quantity in the cart.";
					  header("Location: userProductDetails.php?ID=$ProductID");
					  exit();
				  }


                  if($cartQty == 0){    
					  $_SESSION['msg'] = "Please select quantity!!!";
					  header("Location: userProductDetails.php?ID=$ProductID");
                  }
				  else if($prodQty == 0){
					  $_SESSION['msg'] = "Product is out of stock. Please return later!!!";
					  header("Location: userProductDetails.php?ID=$ProductID");
				  }
				  else {

                   //total is  calculated 
				  $total = $price * $cartQty;
                  $date=date("Y-m-d");
                  $result = mysqli_query($dbConnection,"INSERT INTO `order details` (ProductID,ProductQuantity,ProductName,TotalPrice,UserID,OrderDate,OrderStatus,OtcFlag) 
                          VALUES ('$ProductID','$cartQty','$prodName','$total','$userId','$date','Cart','$OtcFlag')");
				  
				  $_SESSION['msg'] = "Product added to cart.";
				  header("Location: userProductDetails.php?ID=$ProductID");
                  }
                  }
				  else
					  echo "";
                      }	
			
		}
		
			  	
		
	}
	
	$atc = new AddToCart;
	$atc->itemsToCart();
	
   ?>