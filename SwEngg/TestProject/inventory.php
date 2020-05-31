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
    <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="app new2.css">

    <title>Inventory Page</title>

</head>
<body>
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
          <a class="dropdown-item" href="#">View Orders</a>
          <a class="dropdown-item" href="AdminViewProfile.php">View Profile Information</a>
           <a class="dropdown-item" href="logout.php">Logout</a>
      
        </div>
      
       </li>
      
	   

    </ul>
    
  </div>
      
    </nav>
    <div class="wrapper"><br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                   <br><br>
                      <h2 align="center">All Products List</h2>
                     
                <div class="col-md-12">
                
            
                <div class="panel panel-success panel-size-custom">
                        <div class="panel-body">

                            <?php
								    //Fetching all product details to be displayed in the inventory
                                      include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php'); 
                                      $action = isset($_GET['action']) ? $_GET['action'] : "";
                                      $query = "SELECT * FROM products ORDER BY NumberInStock ASC";
                                      $result = mysqli_query($dbConnection,$query);
									  $result1=mysqli_fetch_assoc($result);
                                      ?>  
                                 
                                <br>
                                <br>
                                <table id="prodTable" class="table table-condensed table-striped">
                                    <tr>
                                      
                                      <th>Product Name</th>
                                      <th>Company Name</th>
                                      <th>Cure For</th>
                                      <th>Price</th>
                                      <th>Featured Product</th>
                                      <th>Expiry Date</th>
				      <th>Quantity</th>
                                    </tr>
                                        <?php
                                          if($result1){
                                            while($res = mysqli_fetch_array($result)) {  
												echo "<tr>";
                                                //Display details in the form of a table
                                                echo "<td>".$res['ProductName']."</td>";
                                                echo "<td>".$res['CompanyName']."</td>";  
                                                echo "<td>".$res['CureFor']."</td>";
												echo "<td>".$res['Price']."</td>";
												echo "<td contenteditable="."true".">".$res['Featured_Flag']."</td>";
												echo "<td>".$res['ExpiryDate']."</td>";
												//echo "<td>".$res['NumberInStock']."</td>";
                                                
                                                $quantity=$res['NumberInStock'];
                                                
                                                if ($quantity<=10){
                                                ?>
                                                 <td><span style="color:red;"><?php echo $res['NumberInStock'];?> : Reorder!</span></td>  
                                                 <?php
                                                }else{
                                               ?>
                                               <td><?php echo $res['NumberInStock'];?></td>
                                               </ul>
											   
                                               <?php }
											   echo "<td><a href=\"View_Product_Details.php?ID=$res[ID]\">View</a></td>";
                                              echo "</tr>"; 
                                            }
                                          }?>
                                </table><br><br>
								<a class="btn btn-success btn-round" href="product_add.php"><i class="now-ui-icons ui-1_simple-add"></i> Add new Product</a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
<br><br><br><br>

    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
    
  </body>

</html>