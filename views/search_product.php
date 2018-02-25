<?php
session_start();
require '../assets/php/connect.php';

$r_query = null;
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
<h1 class="find_stuff">Find Stuff</h1>

<form method="get">
<p>
  <label for="searchterm"> Find Stuff: </label>
  <input type="search" name="searchterm" id="searchterm">
  <input type="submit" name="search" id="search" value="search">
</p>
</form>

<?php if (isset($_GET['searchterm'])) { ?>
  <p>You searched for <?php echo $_GET['searchterm'];?>.<p>

<?php
$term = mysqli_real_escape_string($con, $_GET['searchterm']);
echo $term;

$sql = "SELECT * FROM product WHERE productName LIKE '%".$term."%'";
$r_query = mysqli_query($con, $sql);
}
?>
<div class="container">
    <p><?php echo $_SESSION['userID'];?><p>
  <h2>What we've got</h2>
  <a class="btn btn-lg btn-primary btn-block" href="add_product_form.php">Add a new item</a>
  <a class="btn btn-lg btn-primary btn-block" href="watchlist.php">View Watchlist</a>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Descritpion</th>
        <th>Category</th>
        <th>Start Price</th>
        <th>Reserve Price</th>
        <th>ProductID</th>
        <th>Watchlist</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($r_query != null) {
      while ($row = mysqli_fetch_array($r_query)) { ?>
      <tr>
        <td><?php echo $row['productName'];?></td>
        <td><?php echo $row['description'];?></td>
        <td><?php echo $row['category'];?></td>
        <td><?php echo $row['startPrice'];?></td>
        <td><?php echo $row['reservePrice'];?></td>
        <td><?php echo $row['productID'];?></td>
        <form method="post">
        <input type="hidden" name="productID" value="<?php echo $row['productID']; ?>">
        <input type="hidden" name="productName" value="<?php echo $row['productName']; ?>">
        <td><button type="submit" name="add-watchlist" value="add-watchlist" class="btn btn-primary">Add To Watchlist</button></td>
        </form>
      </tr>
    <?php }
  } ?>
    </tbody>
  </table>
</div>

</body>

<?php
if (isset($_POST['add-watchlist'])) {
  $productID = mysqli_escape_string($con, $_POST['productID']);
  $sql = "SELECT * FROM watchlist WHERE productID=$productID";
  $result = mysqli_query($con, $sql) or die ($mysqli->error());
  if ($result->num_rows == 0) {
$stmt = $con->prepare("INSERT INTO watchlist (userID, productID)
VALUES (?,?)");
$stmt->bind_param("ss", $_SESSION['userID'], $_POST['productID']);
$stmt->execute();
echo "done";
$con->close();
} else {
  echo "you already have this item to your watchlist";
}
}
?>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
