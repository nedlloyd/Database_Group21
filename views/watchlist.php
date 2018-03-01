<?php
session_start();
require '../assets/php/connect.php';
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
$sql = "SELECT * FROM watchlist WHERE userID = $userID";
$r_query = mysqli_query($con, $sql);
$productIDs = array();
while ($row = mysqli_fetch_array($r_query)) {
   array_push($productIDs, $row['productID']);
}

$sql = "SELECT * FROM product";
$r_query = mysqli_query($con, $sql);
$products = array();
while ($row = mysqli_fetch_array($r_query)) {
   if (in_array($row['productID'], $productIDs)){
      array_push($products, $row);
   }
}
?>

  <div class="container">
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
          <th>Current Bid</th>
          <th>Remove From Watchlist</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($products != null) {
          $i = 0;
          $endDateArray = [];
        while ($i < count($products)) { ?>
        <tr>
          <td><?php echo $products[$i]['productName'];?></td>
          <td><?php echo $products[$i]['description'];?></td>
          <td><?php echo $products[$i]['category'];?></td>
          <td><?php echo $products[$i]['startPrice'];?></td>
          <td><?php echo substr($products[$i]['endDateTime'], 0, 10);?></td>
          <td></td>
          <td><form method="post">
            <input id="productID" type="hidden" name="productID" value="<?php echo $products[$i]['productID'];?>">
          <td><button type="submit" name="remove-watchlist" value="remove-watchlist" class="btn btn-primary"><rb>Remove</rb>
          </form>
        </tr>
<?php
$i += 1;
}
// print_r($endDateArray);
}
?>
      </tbody>
    </table>
  </div>



</body>


<?php $con->close(); ?>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
