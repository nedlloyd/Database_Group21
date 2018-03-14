<?php
session_start();
require '../assets/php/collaborative_filtering.php';
include '../assets/php/buyer_dashboardphp.php';
include '../assets/php/seller_dashboardphp.php';
require '../assets/php/connect.php';
//require '../assets/php/purchase.php';
echo $_SESSION['userID'];
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
  <!-- <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/buyer_dashboard.css"> -->


  <header role="banner" class="header-reports">
    <div class="content-wrap">
      <img class="logo" src="../images/Logo-Logo.svg.png" alt="AMRC Logo">
      <div class='btn-toolbar pull-right'>
        <div class='btn-group'>
          <button type="button" class="btn btn-default templateBtnToolbar contactLogin">
            <a class="active" href="contactemail.php"></span> Contact Us</a>
          </button>
        </div>
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

<div class="tabs-dashboard col-sm-offset-1">
  <ul class="nav nav-pills" role="tablist">

    <?php
   if ($_SESSION['role'] === 'seller') {
     echo "<li class='active col-sm-5'><a href=''#seller' role='tab' data-toggle='tab'>Seller Dashboard</a></li>";
   } else if ($_SESSION['role'] === 'buyer') {
     echo "<li class='active col-sm-5'><a href='#buyer' role='tab' data-toggle='tab'>Buyer Dashboard</a></li>";
  } else {
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
    if ($_SESSION['role'] == 'seller') {
      echo "<div>";
    } else {
      echo "<div class='tab-pane active' id='buyer'>";
     ?>
    <?php
    if (isset($_POST['remove-watchlist'])) {
    $id = $_POST['productID'];
    echo $id;
    $sql = "DELETE FROM watchlist WHERE productID='$id'";
      if ($con->query($sql) === TRUE) {
        echo '<script></script>';
      } else {
        echo "Error deleting record: " . $con->error;
      }
    }
    $id = '';
    ?>

  <?php
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);

  // called from buyer_dashboardphp
  $productsWatch = findProdcuts('watchlist', $userID, $con);
  $productsBid = findProdcuts('bid', $userID, $con);
  $allFeedback = allFeedback($userID, $con);

  //$highestbid = highestBid(62, $con);


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
                while ($i < count($productsWatch)) {
                   if(((time() - (60*60*120)) <= strtotime($productsWatch[$i]['endDateTime']))) {
                    ?>
                <tr>
                  <td><a href="details.php?id=<?php echo $productsWatch[$i]['productID']?>"><?php echo $productsWatch[$i]['productName'];?></a></td>
                  <td><?php echo $productsWatch[$i]['description'];?></td>
                  <td><?php echo $productsWatch[$i]['category'];?></td>
                  <td><?php echo $productsWatch[$i]['startPrice'];?></td>
                  <td><?php if ((time() - strtotime($productsWatch[$i]['endDateTime']) <= 0)) {
                  echo substr($productsWatch[$i]['endDateTime'], 0, 10);
                } else {
                  echo "Bid Ended";
                }?></td>
                 <td><?php
                 $productID = $row['productID'];
                 $highestBid = highestBid($productsWatch[$i]['productID'], $con)['amount'];
                 if ($highestBid == NULL){
                   $highestBid = 'No Bids Yet';
                 }
                 echo $highestBid;?></td>

                <td><?php $yhb = YourHighestBid($_SESSION['userID'], $productsWatch[$i]['productID'], $con);
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
                  <th>Descritpion</th>
                  <th>Category</th>
                  <th>Start Price</th>
                  <th>End Time and Date</th>
                  <th>Current Highest Bid</th>
                  <th>Your Highest Bid</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($productsBid != null) {
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
                </tr>
              </thead>
              <tbody>
                <?php if ($productsBid != null) {
                  $i = 0;
                  $endDateArray = [];
                while ($i < count($productsBid)) {
                   if((time() >= strtotime($productsBid[$i]['endDateTime']))) {
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
            <h2>Average Feedback: <?php echo yourfeedbackAverage($_SESSION['userID'], $con);?></h2>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Rating</th>
                  <th>Comments</th>
                  <th>Feedback From</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($allFeedback != null) {
                  $i = 0;
                while ($i < count($allFeedback)) {
                    if (($allFeedback[$i]['commentsBuyer'] != NULL) && ($allFeedback[$i]['ratingBuyer'] != NULL)) {
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
    $cfPorducts = $_SESSION['popularProducts'];

    $recomendation1 = '';
    $recomendation2 = '';
    $recomendation3 = '';
    $sql = "";
    $items = sizeof($cfPorducts);

    if ($items < 1) {
      echo "<h2 class='colab-filtering-head'>Place Some Bids to get recommendations</h2>";
  } else {
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
  }
      ?>
      </table>
    </div>

  </div>

</div>
  <?php } ?>



    <?php
    $role = $_SESSION['role'];

    if ($role == 'buyer') {
        echo "<div>";
      }else {
        echo " <div class='tab-pane' id='seller'>";
     ?>

    <?php
    $userID = mysqli_real_escape_string($con, $_SESSION['userID']);

    // called from buyer_dashboardphp
    $sellinghist = sellinghist($userID,$con);
    $productsAuction = yourCurrentItemAuctioned($userID, $con);
    $allFeedback = allFeedbackSeller($userID, $con);
    //print_r($allFeedback);
    //echo $allFeedback[0]['commentsSeller'];
    //echo $allFeedback[0]['ratingSeller'];
    //$highestbid = highestBid(62, $con);


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
                  <?php if ($productsAuction != null) {
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
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Descritpion</th>
                    <th>Category</th>
                    <th>Start Price</th>
                    <th>End Time and Date</th>
                    <th>Winning Bid</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($sellinghist != null) {
                    $i = 0;
                    $endDateArray = [];
                  while ($i < count($sellinghist)) {
                     if((time() >= strtotime($sellinghist[$i]['endDateTime']))) {
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
                  <td><?php echo highestBid($sellinghist[$i]['productID'], $con)['amount'] ?></td>
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

                  </tr>
                </thead>
                <tbody>
                  <?php if ($allFeedback != null) {
                    $i = 0;
                  while ($i < count($allFeedback)) {
                    ?>
                  <tr>
    				<td><?php echo $allFeedback[$i]['productName']?></td>
                    <td><?php echo $allFeedback[$i]['ratingSeller']?></td>
                    <td><?php echo $allFeedback[$i]['commentsSeller']?></td>
                  </tr>
          <?php
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
