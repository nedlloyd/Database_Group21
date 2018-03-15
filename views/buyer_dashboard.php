<?php
session_start();
require '../assets/php/collaborative_filtering.php';
include '../assets/php/buyer_dashboardphp.php';
include '../assets/php/seller_dashboardphp.php';
require '../assets/php/connect.php';
require '../assets/php/purchase.php';
echo $_SESSION['userID'];
echo $_SESSION['reservePrice'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/application.css">
  <link rel="stylesheet" href="../assets/stylesheets/buyer_dashboard.css">


  <header role="banner" class="header-reports">
    <div class="content-wrap">
      <img class="logo" src="../images/Logo-Logo.svg.png" alt="AMRC Logo">
      <div class='btn-toolbar pull-right'>
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
        <div class='btn-group'>
          <a button onclick="goBack()">&laquo; Previous</a>
          <a button onclick="goForward()">Next &raquo;</a>
        </div>


        <h1 class="loginTitle"> Esway </h1>

        <div class="top-container">
        <div class="header" id="header">
        <a class="active" href="search_product.php">Home</a>
        <a class="active" href="logout.php">Logout</a>
        </div>
      </div>
    </div>

  </header>

</head>
<body>


<a class='btn btn-lg btn-primary btn-block btn-search-product' href='search_product.php'>Product Search</a>

<div class="tabs-dashboard col-sm-offset-1">
  <ul class="nav nav-pills" role="tablist">

    <?php
	  #If user's role is seller, shows the seller dashboard.
   if ($_SESSION['role'] === 'seller') {
     echo "<li class='active col-sm-5'><a href=''#seller' role='tab' data-toggle='tab'>Seller Dashboard</a></li>";
	  #If user's role is buyer, shows the buyer dashboard. 
   } else if ($_SESSION['role'] === 'buyer') {
     echo "<li class='active col-sm-5'><a href='#buyer' role='tab' data-toggle='tab'>Buyer Dashboard</a></li>";
  } else {
	  #If user's role is both, show both dashboards.
    echo "<li class='active col-sm-5'><a href='#buyer' role='tab' data-toggle='tab'>Buyer Dashboard</a></li>";
    echo "<li class='col-sm-5'><a href='#seller' role='tab' data-toggle='tab'>Seller Dashboard</a></li>";
  }
     ?>

     <!-- <li class='active col-sm-5'><a href='#buyer' role='tab' data-toggle='tab'>Buyer Dashboard</a></li>
     <li class='col-sm-5'><a href='#seller' role='tab' data-toggle='tab'>Seller Dashboard</a></li> -->
</ul>
</div>

<!-- Tab panes -->
<div class="tab-content">

    <?php
    // if user role is seller the buyer dashboard tab is not displayed
    if ($_SESSION['role'] == 'seller') {
      echo "<div>";
    } else {
      echo "<div class='tab-pane active' id='buyer'>";
     ?>
    <?php
	// if user click remove-watchlist button, the product in the watchlist table will be deleted.	
    if (isset($_POST['remove-watchlist'])) {
    $id = $_POST['productID'];
    echo $id;
    $sql = "DELETE FROM watchlist WHERE productID='$id'";
      if ($con->query($sql) === TRUE) {
      } else {
        echo "Error deleting record: " . $con->error;
      }
    }
    $id = '';
    ?>

  <?php
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);

  // called from buyer_dashboardphp
  // setting variable $productsWatch as an array of current user's (userID) all products in the watchlist
  // setting variable $productsBid as an array of current user's (userID) all bidded products in the bid table
  // setting variable $allFeedback as an array of current user's (userID) all purchase info in the purchase table
  $productsWatch = findProdcuts('watchlist', $userID, $con);
  $productsBid = findProdcuts('bid', $userID, $con);
  $allFeedback = allFeedback($userID, $con);

  


  ?>

    <div class="container">

      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
              Watchlist</a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
              <p><?php echo $_SESSION['userID'];?><p>
            <h2>Your Watchlist</h2>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Descritpion</th>
                  <th>Category</th>
                  <th>Start Price</th>
                  <th>End Time and Date</th>
                  <th>Current Highest Bid</th>
                  <th>Your Highest Bid</th>
                  <th>Remove From Watchlist</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($productsWatch != null) {
                  $i = 0;
                  $endDateArray = [];
	  			// goes over each product in current user's watchlist.
                while ($i < count($productsWatch)) {
                  // if porduct has finished in 5 days, it will still be showed in the user's watchlist
                   if(((time() - (60*60*120)) <= strtotime($productsWatch[$i]['endDateTime']))) {
                     $productID = $row['productID'];
					 // setting variable $highestBid as the highest bid for current product in the watchlist
                     $highestBid = highestBid($productsWatch[$i]['productID'], $con)['amount'];
                    ?>
                <tr>
                  <td><a href="details.php?id=<?php echo $productsWatch[$i]['productID']?>"><?php echo $productsWatch[$i]['productName'];?></a></td>
                  <td><?php echo $productsWatch[$i]['description'];?></td>
                  <td><?php echo $productsWatch[$i]['category'];?></td>
                  <td><?php echo $productsWatch[$i]['startPrice'];?></td>	
                  <td><?php 
				  // check if the current time is after bid end date time or not
				  // if the current time is earlier than the bid end date time, show the bid end date time
				  // else, show bid ended.	
				  if ((time() - strtotime($productsWatch[$i]['endDateTime']) <= 0)) {	  
                  echo substr($productsWatch[$i]['endDateTime'], 0, 10);
                } else {  
                  echo "Bid Ended";
                }?></td>
                 <td><?php
                 if ($highestBid == NULL){
                   $highestBid = 'No Bids Yet';
                 }
                 echo $highestBid;?></td>

                <td><?php 
				// setting variable $yhb as the user's highest bid of the product in the watchlist
			    // if the yhb is not null, it will show the highest bid of current user on the product in the watchlist
				// else it means the user have yet to bid on the product
				$yhb = YourHighestBid($_SESSION['userID'], $productsWatch[$i]['productID'], $con);
                if ($yhb != NULL) {
                echo YourHighestBid($_SESSION['userID'], $productsWatch[$i]['productID'], $con)['amount'];
              } else {
                echo "You've yet to bid";
              }
                ?></td>
                  <form method="post">
                    <input id="productID" type="hidden" name="productID" value="<?php echo $productsWatch[$i]['productID'];?>">
                  <td><button type="submit" name="remove-watchlist" value="remove-watchlist" class="btn btn-primary"><rb>Remove</rb>
                  </form>
                </tr>
        <?php
         }
        $i += 1;
        }
        }
        ?>
              </tbody>
            </table>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
              Current Items</a>
            </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
              <p><?php echo $_SESSION['userID'];?><p>
            <h2>Current Items</h2>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Start Price</th>
                  <th>End Time and Date</th>
                  <th>Current Highest Bid</th>
                  <th>Your Highest Bid</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				// if the array of user's bided product is not null, it will go through every product in the array
		        // if the bid end date time is later than the current time, it will show every detail info of the product
		        // such as product name, description, category, start price, end time and date, current highest bid, your highest bid.
				// if the bid end date time is earlier than the current time, it will show nothing.
		        // if the array of user's bid product is null, it will show You have yet to bid.
				if ($productsBid != null) {
                  $i = 0;
                  $endDateArray = [];
                while ($i < count($productsBid)) {
                   if((time() <= strtotime($productsBid[$i]['endDateTime']))) {
                    ?>
                <tr>
                  <td><a href="details.php?id=<?php echo $productsBid[$i]['productID']?>"><?php echo $productsBid[$i]['productName'];?></a></td>
                  <td><?php echo $productsBid[$i]['description'];?></td>
                  <td><?php echo $productsBid[$i]['category'];?></td>
                  <td><?php echo $productsBid[$i]['startPrice'];?></td>
                  <td><?php if ((time() - strtotime($productsBid[$i]['endDateTime']) <= 0)) {
                  echo substr($productsBid[$i]['endDateTime'], 0, 10);
                } else {
                  echo "Bid Ended";
                }?></td>
                <td><?php echo highestBid($productsBid[$i]['productID'], $con)['amount'] ?></td>
                <td><?php $yhb = YourHighestBid($_SESSION['userID'], $productsBid[$i]['productID'], $con);
                if ($yhb != NULL) {
                echo YourHighestBid($_SESSION['userID'], $productsBid[$i]['productID'], $con)['amount'];
              } else {
                echo "You've yet to bid";
              }
                ?></td>
                </tr>
        <?php
         }
        $i += 1;
        }
        }
        ?>
              </tbody>
            </table>
            </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
              Finished Items</a>
            </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">
              <p><?php echo $_SESSION['userID'];?><p>
            <h2>Finished Items</h2>
            <p> click on products you've won to add feedback </p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Descritpion</th>
                  <th>Category</th>
                  <th>Start Price</th>
                  <th>End Time and Date</th>
                  <th>Winning Bid</th>
                  <th>Your Highest Bid</th>
                  <th>Result</th>
                </tr>
              </thead>
              <tbody>
                <?php 
		
				  // Similar to the current items section.
		          // the only different is that if the bid end date time is earlier than the current time, it will show every detail info of the product
		          // if the bid end date time is later than the current time, it will show nothing.
				  
				  if ($productsBid != null) {
                  $i = 0;
                  $endDateArray = [];
                while ($i < count($productsBid)) {
                   if((time() >= strtotime($productsBid[$i]['endDateTime']))) {

                     $currentProductID = $productsBid[$i]['productID'];
                     $yourHighestBid = yourHighestBid($_SESSION['userID'], $currentProductID, $con)['amount'];
					 
					 // setting variable $totalHighestBid as the current product's highest bid from all bid of this product
					 // setting variable $reservedprice as the current product's reserved price.
					   
                     $totalHighestBid = highestBid($currentProductID, $con)['amount'];
					 $reservedprice = reservedprice($currentProductID, $con)['reservePrice'];

                    ?>
                <tr>
                  <td><a href="details.php?id=<?php echo $productsBid[$i]['productID']?>"><?php echo $productsBid[$i]['productName'];?></a></td>
                  <td><?php echo $productsBid[$i]['description'];?></td>
                  <td><?php echo $productsBid[$i]['category'];?></td>
                  <td><?php echo $productsBid[$i]['startPrice'];?></td>
                  <td><?php if ((time() - strtotime($productsBid[$i]['endDateTime']) <= 0)) {
                  echo substr($productsBid[$i]['endDateTime'], 0, 10);
                } else {
                  echo "Bid Ended";
                }?></td>
                <td><?php echo $totalHighestBid ?></td>
                <td><?php if ($yourHighestBid != NULL) {
                echo $yourHighestBid;
              } else {
                echo "You've yet to bid";
              }
                ?></td>
                <td><?php 
				
				// if the total highest bid is higher than your highest bid, it will show lost
				// if the reserved price is higher than your highest bid, it will show lower than reserved price
				// else, it will show won
					   
				if ($yourHighestBid < $totalHighestBid) {
                echo "Lost";
              } elseif ($yourHighestBid < $reservedprice) {
                echo "Lower than reserved Price";
              } else {
				echo "Won";
			  }
                ?></td>


                </tr>
        <?php
         }
        $i += 1;
        }
        }
        ?>
              </tbody>
            </table>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
              Feedback</a>
            </h4>
          </div>
          <div id="collapse4" class="panel-collapse collapse">
            <div class="panel-body">
            <h2>Average Feedback: <?php 
			// yourfeedbackaverage function will calculate the average value of the rating for the current user.
			echo yourfeedbackAverage($_SESSION['userID'], $con);?></h2>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Comments</th>
                  <th>Rating</th>
                  <th>Feedback From</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				
				// if the purchase record is not null, it will go through every record on the purchase table of the current user.
				// if the rating for buyer is not null, 
				//it will show the 'Comments for buyer' for the current user and the 'rating for buyer' for the current user 
				// and it will show the seller's email, which is from who gave the rating and comments.
				
				if ($allFeedback != null) {
                  $i = 0;
                while ($i < count($allFeedback)) {
                    if (($allFeedback[$i]['ratingBuyer'] != NULL)) {
                  ?>
                <tr>
                  <td><?php echo $allFeedback[$i]['commentsBuyer']?></td>
                  <td><?php echo $allFeedback[$i]['ratingBuyer']?></td>
                  <td><?php echo findSellerEmail($allFeedback[$i]['productID'], $con)?></td>
                </tr>
        <?php
         }
              $i += 1;
         }
        }
        ?>
              </tbody>
            </table>
            </div>
          </div>
        </div>

      </div>

    </div>

    <?php
	// the session 'popularproducts' comes from collaborative_filtering.php
    if ($_SESSION['popularProducts'] == NULL)  {


      echo "<h2 class='colab-filtering-head'>Place Some Bids to get recommendations</h2>";
  } else {

    $cfPorducts = $_SESSION['popularProducts'];
    $recomendation1 = '';
    $recomendation2 = '';
    $recomendation3 = '';
    $sql = "";
    $items = sizeof($cfPorducts);
	
	// if there is one item in the session 'popularproducts', it will run the first sql, if there is 2 items, it will run the second sql, etc.
	
    $recomendation1 = $cfPorducts[0];
    $sql = "SELECT * FROM product WHERE productID=$recomendation1";
    if ($items > 1) {
    $recomendation2 = $cfPorducts[1];
    $sql = "SELECT * FROM product WHERE productID=$recomendation1 OR productID=$recomendation2";
    }
    if ($items > 2) {
    $recomendation3 = $cfPorducts[2];
    $sql = "SELECT * FROM product WHERE productID=$recomendation1 OR productID=$recomendation2 OR productID=$recomendation3";
    }
    $r_query = mysqli_query($con, $sql);

    ?>

    <div class="colab-filtering col-sm-12">
    <h2 class="colab-filtering-head">You may also like (based on poeple who bid on similar things to you)</h2>

        <table class="table table-striped colab-filtering-table">
      <tr>
        <th>Item</th>
        <th>End Date</th>
      </tr>
      <?php while ($row = mysqli_fetch_array($r_query)) { ?>
      <tr>
        <td><a href="details.php?id=<?php echo $row['productID'] ?>"><?php echo $row['productName'];?></a></td>
        <td><?php echo substr($row['endDateTime'], 0, 10) ?></td>
      </tr>
      <?php
    }
      ?>
      </table>
    </div>

  <?php } ?>

  </div>

</div>
  <?php } ?>



    <?php
    $role = $_SESSION['role'];
	
	// if user role is buyer, the seller dashboard tab is not displayed
    if ($role == 'buyer') {
        echo "<div>";
      }else {
        echo " <div class='tab-pane' id='seller'>";
     ?>

    <?php
    $userID = mysqli_real_escape_string($con, $_SESSION['userID']);

    // called from buyer_dashboardphp
    $sellinghist = sellinghist($userID,$con);
		
	// called from seller_dashboardphp
	// setting variable $productsAuction as the current user's product.
    $productsAuction = yourCurrentItemAuctioned($userID, $con);
    $allFeedback2 = allFeedbackSeller($userID, $con);


    ?>

      <div class="container">

        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                Current Items</a>
              </h4>
            </div>
            <div id="collapse5" class="panel-collapse collapse">
              <div class="panel-body">
                <p><?php echo $_SESSION['userID'];?><p>
              <h2>Current Items</h2>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Descritpion</th>
                    <th>Category</th>
                    <th>Start Price</th>
                    <th>End Time and Date</th>
                    <th>Current Highest Bid</th>
                    <th>Viewing History</th>
    				<th>Numbers of Bids</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
					//similar to the buyer dashboard
					if ($productsAuction != null) {
                    $i = 0;
                    $endDateArray = [];
                  while ($i < count($productsAuction)) {
                     if((time() <= strtotime($productsAuction[$i]['endDateTime']))) {
                      ?>
                  <tr>
                    <td><a href="details.php?id=<?php echo $productsAuction[$i]['productID']?>"><?php echo $productsAuction[$i]['productName'];?></a></td>
                    <td><?php echo $productsAuction[$i]['description'];?></td>
                    <td><?php echo $productsAuction[$i]['category'];?></td>
                    <td><?php echo $productsAuction[$i]['startPrice'];?></td>
                    <td><?php if ((time() - strtotime($productsAuction[$i]['endDateTime']) <= 0)) {
                    echo substr($productsAuction[$i]['endDateTime'], 0, 10);
                  } else {
                    echo "Bid Ended";
                  }?></td>
                  <td><?php echo highestBid($productsAuction[$i]['productID'], $con)['amount'] ?></td>
                  <td><?php $view = viewtraffic($productsAuction[$i]['productID'], $con);
                  if ($view != NULL) {
                  echo $view['view'];
                  } else {
                  echo "No one has view this product yet";
                  }
                  ?></td>
    			  <td><?php $numbid = numberofbid($productsAuction[$i]['productID'], $con);
    			  if ($numbid != NULL) {
                  echo $numbid['numbid'];
                  } else {
                  echo "No one has bid on this product yet";
                  }
    			  ?></td>
                  </tr>
          <?php
           }
          $i += 1;
          }
          }
          ?>
                </tbody>
              </table>
              </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                Finished Items</a>
              </h4>
            </div>
            <div id="collapse6" class="panel-collapse collapse">
              <div class="panel-body">
                <p><?php echo $_SESSION['userID'];?><p>
              <h2>Finished Items</h2>
              <p> click on finished items to add feedback </p>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Descritpion</th>
                    <th>Category</th>
                    <th>Start Price</th>
                    <th>End Time and Date</th>
                    <th>Winning Bid</th>
                    <th>Result</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
					//similar to the buyer dashboard
					if ($sellinghist != null) {
                    $i = 0;
                    $endDateArray = [];
                  while ($i < count($sellinghist)) {
                     if((time() >= strtotime($sellinghist[$i]['endDateTime']))) {
                       $currentProductID = $sellinghist[$i]['productID'];
                       
                       $totalHighestBid = highestBid($currentProductID, $con)['amount'];
                       $reservedprice = reservedprice($currentProductID, $con)['reservePrice'];
                       
                      ?>
                  <tr>
                    <td><a href="details.php?id=<?php echo $sellinghist[$i]['productID']?>"><?php echo $sellinghist[$i]['productName'];?></a></td>
                    <td><?php echo $sellinghist[$i]['description'];?></td>
                    <td><?php echo $sellinghist[$i]['category'];?></td>
                    <td><?php echo $sellinghist[$i]['startPrice'];?></td>
                    <td><?php if ((time() - strtotime($sellinghist[$i]['endDateTime']) <= 0)) {
                    echo substr($sellinghist[$i]['endDateTime'], 0, 10);
                  } else {
                    echo "Bid Ended";
                  }?></td>
                  <td><?php echo $totalHighestBid ?></td>
                  <td><?php
                  if ($totalHighestBid == "") {
                  echo "No Bids";
                } else if ($reservedprice > $totalHighestBid) {
                  echo "Lower than reserve Price";
                } else {
  				        echo "Won";
  			        }
                  ?></td>
                  </tr>
          <?php
           }
          $i += 1;
          }
          }
          ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                Feedback</a>
              </h4>
            </div>
            <div id="collapse7" class="panel-collapse collapse">
              <div class="panel-body">
              <h2>Average Feedback: <?php echo yourfeedbackAverageSeller($_SESSION['userID'], $con);?></h2>
              <table class="table table-striped">
                <thead>
                  <tr>
    				<th>Product Name</th>
                    <th>Rating</th>
                    <th>Comments</th>
					<th>Feedback From</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($allFeedback2 != null) {
                    $i = 0;
                  while ($i < count($allFeedback2)) {
					  if (($allFeedback2[$i]['ratingSeller'] != NULL)) {
                    ?>
                  <tr>
    				<td><?php echo $allFeedback2[$i]['productName']?></td>
                    <td><?php echo $allFeedback2[$i]['ratingSeller']?></td>
                    <td><?php echo $allFeedback2[$i]['commentsSeller']?></td>
					<td><?php echo findbuyeremail($allFeedback2[$i]['productID'], $con)?></td>
                  </tr>
          <?php
					  }
                $i += 1;

           	}
          }
          ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>

        </div>

      </div>



  </div>
</div>
    <?php } ?>
</div>



</body>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
