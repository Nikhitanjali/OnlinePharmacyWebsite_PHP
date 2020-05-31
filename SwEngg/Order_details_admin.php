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
          <a class="dropdown-item" href="Order_details_admin.php">View Orders</a>
          <a class="dropdown-item" href="AdminViewProfile.php">View Profile Information</a>
           <a class="dropdown-item" href="logout.php">Logout</a>
      
        </div>
      
       </li>
      
	   

    </ul>
    
  </div>
      
    </nav>   
  <!-- End Navbar -->
    <div class="wrapper"><br><br><br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                     
                
                <div class="col-md-12">
                <br>
            
                <div class="panel panel-success panel-size-custom">
                        <div class="panel-body">



      <?php 
        $user_id = $_SESSION['id'];
        $query=mysqli_query($dbConnection,"SELECT * FROM `order details` WHERE OrderStatus='Placed'");
        $count=mysqli_num_rows($query);
		$res = mysqli_fetch_array($query);
		
              if($count==0 ){
				   echo '<center><strong><span style ="color:#FF0000;">"No recent orders"</span></strong></center>';
				   echo $user_id;	
              }else{
                
      ?>

  <form method="POST" >
    <h5>[<small><?php echo $count;?></small>] Recent Orders</h5>  

      <table class="table table-condensed table-bordered">
              <thead>
                <tr>
                  
				  <th width="100">Tracking Number</th>
				  <th width= "100">User ID</th>
				  <th width= "100">Order Date</th>
				  <th width="100"> Total Price</th>
				  <th width="100">View Order</th>
				  <th width="100">Cancel Order</th>
                </tr>
              </thead>

              <tbody>

          <?php 
            $query1=mysqli_query($dbConnection,"SELECT TrackingNumber, UserID, `OrderDate`, Sum(TotalPrice) FROM `order details` WHERE OrderStatus='Placed' GROUP BY `TrackingNumber`");
            while($row=mysqli_fetch_array($query1)){
            $count1=mysqli_num_rows($query1);
            //$ProductID=$row['ProductID'];
            //$query2=mysqli_query($dbConnection,"SELECT * FROM products WHERE ID='$ProductID'");
            //$row2=mysqli_fetch_array($query2);
          ?>

              <tr>
                  <td><br><?php echo $row['TrackingNumber'];?></td>
				  <td><br><?php echo $row['UserID'];?></td>
				  <td><br><?php echo $row['OrderDate'];?></td>
				  <td><br><?php echo number_format($row['Sum(TotalPrice)'], 2, '.', ' ');?></td>
                  <td>
                  <a href="view_Order_products_admins.php?TNum=<?php echo $row['TrackingNumber'];?>&UID=<?php echo $row['UserID'];?>"><button class="btn btn-success btn-round" type="button"> View this Order </button></a>				  
				  <td>
				  <a href="cancel_order_details_admin.php?TNum=<?php echo $row['TrackingNumber'];?>&UID=<?php echo $row['UserID'];?>" ><button class="btn btn-danger btn-round" onclick="return confirm('Are you sure you want to cancel?')" type="button">Cancel this Order</button></a>
				  </td>
				  
                  <?php
			  } }?>
				 
				 

              </tr>
        
            

              </tbody>
          </table>
    </form>
	<?php}
	?>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
<br><br><br><br>
    </div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</body>
</html>