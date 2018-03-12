<?php
session_start();
include '../assets/php/seller_dashboardphp.php';
require '../assets/php/connect.php';
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
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/buyer_dashboard.css">


  <header role="banner" class="header-reports">
    <div class="content-wrap">
      <img class="logo" src="../images/Logo-Logo.svg.png" alt="AMRC Logo">
      <div class='btn-toolbar pull-right'>
        <div class='btn-group'>
          <button type="button" class="btn btn-default templateBtnToolbar contactLogin">
            <a class="active" href="contactemail.php"></span> Contact Us</a>
          </button>
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
        <a class="active" href="logout.php">Logout</a>
      </div>
    </div>

  </header>

</head>
<body>


<?php
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);

// called from buyer_dashboardphp
$sellinghist = sellinghist($userID,$con);
$productsAuction = yourCurrentItemAuctioned($userID, $con);
$allFeedback = allFeedback($userID, $con);
print_r($allFeedback);
echo $allFeedback[0]['commentsSeller'];
echo $allFeedback[0]['ratingSeller'];
//$highestbid = highestBid(62, $con);


?>

  <div class="container">

    <div class="panel-group" id="accordion">
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
              <td><?php $allb = allBid($productsAuction[$i]['productID'], $con);
              if ($allb != NULL) {
              echo allBid($productsAuction[$i]['productID'], $con)['amount'];
            } else {
              echo "No one bid on this product";
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
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
            Feeback</a>
          </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse">
          <div class="panel-body">
          <h2>Average Feedback: <?php echo yourfeebackAverage($_SESSION['userID'], $con);?></h2>
          <table class="table table-striped">
            <thead>
              <tr>
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
                <td><?php echo $allFeedback[$i]['commentsSeller']?></td>
                <td><?php echo $allFeedback[$i]['ratingSeller']?></td>
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


</body>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
