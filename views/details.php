<?php
session_start();
require '../assets/php/connect.php';
include '../assets/php/buyer_dashboardphp.php';
?>


<?php
$message = '';

$productID = mysqli_escape_string($con, $_GET['id']);
echo "product ID:";
echo $_GET['id'];

$sql = "SELECT userID FROM product WHERE productID=$productID;";
$r_query = mysqli_query($con, $sql);
$productUserID = '';
if ($r_query != null) {
while ($row = mysqli_fetch_array($r_query)) {
  $productUserID = $row['userID'];
}
}
echo $_SESSION['userID'];
if ($_SESSION['userID'] != $productUserID){
$sql = "UPDATE product SET views = views + 1 WHERE productID=$productID";
$con->query($sql);
}

if ($con->connect_error) {
	$message = $con->connect_error;
} else {
	$sql = "SELECT * FROM product WHERE productID=" . $con->real_escape_string($_GET['id']);
	$sql2 = "SELECT * FROM users, product WHERE users.id = product.userID AND product.productID=" . $con->real_escape_string($_GET['id']);
	$sql3 = "SELECT product.userID, ROUND(AVG(purchase.ratingSeller),2)AS rateSeller FROM purchase, product
			WHERE purchase.productID = product.productID AND product.userID=$productUserID;";


	$result = $con -> query($sql);
	$result2 = $con -> query($sql2);
	$result3 = $con -> query($sql3);

	if ($con -> error) {
		$message = $con -> error;
	} else {
		$row = $result -> fetch_assoc();
		$row2 = $result2 -> fetch_assoc();
		$row3 = $result3 -> fetch_assoc();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- Viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- IE Edge Meta Tag// edge means the browser should use the best and newest machine -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="../assets/stylesheets/application.css">
  <link rel="stylesheet" href="../assets/stylesheets/details.css">

  <!-- Optional IE8 Support -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Minified CSS -->

  <header role="banner" class="header-reports">
    <div class="content-wrap">
      <img class="logo" src="../images/Logo-Logo.svg.png" alt="AMRC Logo">
      <div class='btn-toolbar pull-right'>
        <div class='btn-group'>
          <button type="button" class="btn btn-default templateBtnToolbar contactLogin">
            <span class="glyphicon glyphicon-envelope"></span> Contact Us
          </button>
        </div>
      </div>

      <h1 class="loginTitle"> Esway </h1>

    </div>
  </header>


</head>


<body>
	<div id="site">
		<div id="content">





<div class="container product-details">
  <h1 class="header-details"><?php echo $row['productName']; ?></h1>

<a class="btn btn-lg btn-primary btn-block" href="search_product.php">Back to Search Products</a>

  <table class="table table-striped">
  <thead>
    <tr>
      <th>Starting Price</th>
      <th>Current Bid</th>
      <th>Description</th>
      <th>Category</th>
      <th>End Date</th>
      <th>End Time</th>
      <th>Seller Name</th>
      <th>Seller Rating</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $row['startPrice']; ?></td>
      <td><?php
      $productID = $row['productID'];
      $highestBid = highestBid($productID, $con)['amount'];
      if ($highestBid == NULL){
        $highestBid = 'No Bids Yet';
      }
      echo $highestBid;?></td>
      <td><?php echo $row['description']; ?></td>
      <td><?php echo $row['category']; ?></td>
      <td><?php echo substr($row['endDateTime'], 0, 10);?></td>
      <td><?php echo substr($row['endDateTime'], 11, 16);?></td>
      <td><?php echo $row2['name']; ?></td>
      <td><?php echo $row3['rateSeller']; ?></td>
    </tr>
  </tbody>
</table>
</div>





			<div id="col_1" role="main">

				<!-- <?php if ($message) {
				echo "<h2>$message</h2>";
				} else { ?>

				<?php if ($_SESSION['userID'] == null) { ?>
					<h2 class="inline_block">Sorry, you must login first.</h2>
				<?php echo "<a href='login.php'>Back to the login page </a>" ?>
				<?php } else { ?>

				<form action="basket.php" method="post" id="bab_form" class="basket_add clearfix">
				<h1 class="inline_block"><?php echo $row['productName']; ?></h1>
            	<p class="figure"><img src="../images/images/<?php echo $row['image']; ?>" alt="<?php echo $row['category']; ?>" width="200" height="200">Price from $</p>

              <?php echo $row['startPrice']; ?>
              <?php echo $row['description']; ?>


				<div class="qty">
                       <label for="qty">Quantity</label>
                       <input value="0" name="qty_<?php echo $row['productID'] ?>" id="qty" class="text" type="number" min="0">
                </div>

				<input type="hidden" name="price_<?php echo $row['productID'] ?>" value="<?php echo $row['startPrice'] ?>">

				<input type="hidden" name="image_<?php echo $row['productID'] ?>" value="<?php echo $row['image'] ?>">


				<div id="addtobask">

					<input class="btn checkout" value="Add to Basket" type="submit" name="addtobasket">
				</div>


				</form>
				<?php
				if (isset($_POST['addtobasket'])){
					print_r($_POST);
				}
				?>



				<?php }   //end of if
					  }  // end of page ?> -->
			</div>
		</div>
	</div>
  <form method="post">
  <div class="form-group">
      <label for="amount" class="col-sm-4 control-label"></label>
      <div class="col-sm-4">
      <input name="amount" type="text" class="form-control" id="amount" placeholder="bid amount">
    </div>
  </div>

  <div class="form-group submit-sign-up">
    <div class="col-sm-8 col-sm-offset-4">
      <button type="submit" name="submit-bid" value="submit-bid" id="btnsubmit" class="btn btn-primary">Submit Bid</button>
      <button onclick="myFunction()" class="btn btn-primary">Refresh</button>
    </div>
    <script>
    function myFunction() {
        location.reload();
    }
    </script>
    <input name="userID" type="hidden" value="<?php echo $_SESSION['userID']; ?>"/>
    <input name="productID" type="hidden" value="<?php echo $_GET['productID']; ?>"/>
  </div>
  </form>

  <?php

  if (isset($_POST['submit-bid'])) {
    $userID = $_SESSION['userID'];
    $productID = mysqli_escape_string($con, $_GET['id']);
    /*echo $_POST['amount'];
    echo $_GET['id'];*/
  $stmt = $con->prepare("INSERT INTO bid (userID, productID, amount)
  VALUES (?,?,?)");
  $stmt->bind_param("sss", $userID, $productID, $_POST['amount']);
  $stmt->execute();
  echo "New bid submitted.";
  $con->close();
  }
  ?>

  <?php
  $productID = mysqli_escape_string($con, $_GET['id']);
  echo $productID;
  $sql = "SELECT endDateTime FROM product WHERE productID=$productID";
  /*echo $productID;*/
  $r_query_DT = mysqli_query($con, $sql);
  $time = '';
  if ($r_query_DT != null) {
  while ($row = mysqli_fetch_array($r_query_DT)) {
    $time = $row['endDateTime'];
    /*echo $time;*/
    }
  }
   ?>

   <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  p {
    text-align: center;
    font-size: 60px;
    margin-top:0px;
  }
  </style>
  </head>

 <p id="timer"></p>
 <p id="timer"></p>
 <script>
 var countdownDate = new Date("<?php echo $time ?>").getTime();
 var x = setInterval(function() {
     var now = new Date().getTime();
     var distance = countdownDate - now;
     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
     document.getElementById("timer").innerHTML = days + "d " + hours + "h "
     + minutes + "m " + seconds + "s ";
     if (distance < 0) {
         clearInterval(x);
         document.getElementById("timer").innerHTML = "EXPIRED";
     }
 }, 1000);
 </script>

</body>

  <footer>

  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</html>
