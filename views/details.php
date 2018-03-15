<?php
session_start();
require '../assets/php/connect.php';
include '../assets/php/buyer_dashboardphp.php';
require '../assets/php/email-script.php';
echo $_SESSION['userID'];
?>


<?php
$message = '';

// get productID
$productID = mysqli_escape_string($con, $_GET['id']);
echo "product ID:";
echo $_GET['id'];


//get current product's seller userID
$sql = "SELECT userID FROM product WHERE productID=$productID;";
$r_query = mysqli_query($con, $sql);
$productUserID = '';
if ($r_query != null) {
while ($row = mysqli_fetch_array($r_query)) {
  $productUserID = $row['userID'];
}
}

// calculate the number of views of the current product.
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
	$sql3 = "SELECT bid.userID, ROUND(AVG(purchase.ratingSeller),2) AS rateSeller FROM purchase, bid WHERE purchase.bidID = bid.bidID AND bid.userID=$productUserID;";


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

        <div>

        </div>

      <script>
      function goForward() {
          window.history.forward();
      }
      </script>
      <script>
        function goBack() {
            window.history.back()
        }
        </script>
      <body>

        <a button onclick="goBack()">&laquo; Previous</a>
        <a button onclick="goForward()">Next &raquo;</a>

      </body>

      </div>
      <h1 class="loginTitle"> Esway </h1>
      </div>

      <div class="top-container">
      <div class="header" id="header">
      <a class="active" href="search_product.php">Home</a>
      <a class="active" href="buyer_dashboard.php">Dashboard</a>
      <a class="active" href="logout.php">Logout</a>
      </div>
      </div>
    </div>
  </header>


</head>


<body>
	<div id="site">
		<div id="content">
			<div id="breadcrumbs" class="reset menu">
            <ul>
                <li><a class="active" href="search_product.php">Home</a></li>
                <li><?php
				echo "Bid Page";
				?></li>
            </ul>
            </div>

<div class="container product-details">
  <h1 class="header-details"><?php $nameOfProduct = $row['productName'];
  echo $nameOfProduct?></h1>

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
      <td><?php
	  //show values of starting price, current bid, description of product, category of product, bid end date, bid end time
	  //seller's name, and seller's rating.
	  // if the highest bid exist, show the highest bid, otherwise, show No bid yet.
	  $startPrice = $row['startPrice'];
      echo $startPrice;?></td>
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


		</div>
	</div>
  <form method="post">
  <div class="form-group">
      <label for="amount" class="col-sm-4 control-label"></label>
      <div class="col-sm-4">
      <input name="amount" type="number" min="0" class="form-control" id="amount" placeholder="bid amount">
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
 // get seller's userID from product table
 $sql = "SELECT userID AS sellerID FROM product WHERE product.productID=$productID";
 $result = $con -> query($sql);
 $seller = '';
 while ($row = mysqli_fetch_array($result)) {
   $seller = $row['sellerID'];

 }

 // get user's role from users table, and assign the value to the variable $role
 $userID = $_SESSION['userID'];
 $productID = mysqli_escape_string($con, $_GET['id']);
 $sql4 = "SELECT role from users Where id=$userID";
 $result4 = $con -> query($sql4);
 $role = '';
 while ($row = mysqli_fetch_array($result4)) {
   $role = $row['role'];

 }

  if (isset($_POST['submit-bid'])) {
    $currentbid = mysqli_escape_string($con, $_POST['amount']);

		  if($userID != $seller && $role != "seller"){
			  if($currentbid > $highestBid || ($highestBid == 'No Bids Yet' && $currentbid > $startPrice)) {

			      $amount = mysqli_escape_string($con, $_POST['amount']);
				  $stmt = $con->prepare("INSERT INTO bid (userID, productID, amount)
				  VALUES (?,?,?)");
				  $stmt->bind_param("sss", $userID, $productID, $amount);
				  $stmt->execute();
				  echo "New bid submitted.";
				  $otherbidders = findOtherBidders($userID, $productID, $con);
				  foreach($otherbidders as $item) {
				  sendmail($item, "You've been outbid!!", "You've been outbid on the $nameOfProduct");
				  }
          $otherbidders = findFromWatchlist($userID, $productID, $con);
				  foreach($otherbidders as $item) {
				  sendmail($item, "Watchlist Update", "Someone has bid on $nameOfProduct");
				  }
			  	  }  else {
					 if ($highestBid == "No Bids Yet") {
					   echo "Sorry, your bid must be higher than the Starting Price";
				  } else {
				       echo "Sorry, your bid must be higher than the current bid, which is $highestBid";
				  }

			      }

	  			} elseif ($userID == $seller && $role != "seller") {
			  		echo "Sorry, you cannot bid on your own product.";

		        } else {
			  		echo "Sorry, you cannot bid on any product since you are a seller.";
		  		}


	  }


  ?>

  <?php
  $productID = mysqli_escape_string($con, $_GET['id']);
  $sql = "SELECT endDateTime FROM product WHERE productID=$productID";
  $r_query_DT = mysqli_query($con, $sql);
  $time = '';
  if ($r_query_DT != null) {
  while ($row = mysqli_fetch_array($r_query_DT)) {
    $time = $row['endDateTime'];
    }
  }
   ?>

   <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  p {
    text-align: center;
    font-size: 60px;
    margin-top:30px;
  }
  </style>
  </head>

 <p id="timer"></p>
 <p id="timer"></p>



 <?php

 $sql = "SELECT pr.userID AS sellerID, b.userID AS buyerID FROM product pr INNER JOIN bid b ON pr.productID = b.productID INNER JOIN purchase pu ON  b.bidID=pu.bidID WHERE b.productID=$productID";
 $result = $con -> query($sql);
 $buyer = '';
 $seller = '';
 $startingPrice = '';
 while ($row = mysqli_fetch_array($result)) {
   $buyer = $row['buyerID'];
   $seller = $row['sellerID'];
 }


 // if the bid is not end, the purchase table will not have the record of buyer, and the variable buyer and seller will be empty
 // Thus the following feedback will not be shown for the users.

 if ($buyer == $_SESSION['userID'] || $seller == $_SESSION['userID']) {

    ?>

   <form method="POST"  class="form-horizontal">
   <div class="container">

	   <?php
	     if($_SESSION['userID'] == $buyer){ ?>
            <h2> <?php echo "Feedback for your seller";?> </h2>
	   <?php }else{ ?>
		    <h2> <?php echo "Feedback for your buyer";?> </h2>
	   <?php }

	   ?>

         <div class="form-group">
           <label for="rating" class="col-sm-4 control-label">rating score<br>(10=very satisfied; 1=very poor)</label>
           <div class="col-sm-4">
             <select name="rating" class="form-control" id="rating">
               <option value="10">10</option>
               <option value="9">9</option>
               <option value="8">8</option>
               <option value="7">7</option>
               <option value="6">6</option>
               <option value="5">5</option>
               <option value="4">4</option>
               <option value="3">3</option>
               <option value="2">2</option>
               <option value="1">1</option>
             </select>
             <span class="error"></span>
           </div>
         </div>

         <div class="form-group">
           <label for="comments" class="col-sm-4 control-label">comments</label>
           <div class="col-sm-4">
             <input name="comments" type="text" class="form-control" id="comments" placeholder="comments">
             <span class="error"></span>
           </div>
         </div>

         <div class="form-group submit-sign-up">
           <div class="col-sm-8 col-sm-offset-4">
             <button type="submit" name="submit-purchase" value="submit-purchase" class="btn btn-primary">Submit</button>
           </div>
         </div>


         <input name="userID" type="hidden" value="<?php echo $row['userID']; ?>"/>
         <input name="productID" type="hidden" value="<?php echo $row['productID']; ?>"/>
         <input name="purchaseID" type="hidden" value="<?php echo $row['purchaseID']; ?>"/>
     </div>
   </form>

<?php
}

if (isset($_POST['submit-purchase'])) {

  //get comments and rating of the feedback form
  $comment = mysqli_escape_string($con, $_POST['comments']);
  $rating = mysqli_escape_string($con, $_POST['rating']);



 //if the user ID equals to the buyer's userID, the form of feedback is for seller,
 //if the user ID equals to the seller's userID, the form of feedback if for buyer.
 //Then update information into the feedback table

 if($_SESSION['userID'] == $buyer){
   $sqlCode = "commentsSeller='".$comment."', ratingSeller='".$rating."'";
 }else{
  $sqlCode = "commentsBuyer='".$comment."', ratingBuyer='".$rating."'";
 }

 $feedbackproductID = mysqli_escape_string($con, $_GET['id']);

 $sql = "SELECT bidID FROM bid WHERE productID=$feedbackproductID";
 $result = $con -> query($sql);
 $bidID = '';
 while ($row = mysqli_fetch_array($result)) {
   $bidID = $row['bidID'];
 }

 $stmt = $con->query("UPDATE purchase SET ".$sqlCode." WHERE bidID='".$bidID."'");

 echo "done";
 $con->close();
}
?>





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
         document.getElementById("timer").innerHTML = "Bidding ended";
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
