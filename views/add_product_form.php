<?php
session_start();
require '../assets/php/connect.php';

$sql = "SELECT userID FROM product WHERE productID=49;";
$r_query = mysqli_query($con, $sql);
$productUserID = '';
if ($r_query != null) {
while ($row = mysqli_fetch_array($r_query)) {
  $productUserID = $row['userID'];
}
}

if ($_SESSION['userID'] != $productUserID){
$sql = "UPDATE product SET views= views + 1 WHERE productID=48";
$con->query($sql);
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
    <div class="wrapperforstickyfooter">
  <div class="content-wrap">
    <div class="container">
    <form class="form-horizontal" method="post">
      <fieldset>
        <legend>Add New Product</legend>

        <div class="form-group">
          <label for="productName" class="col-sm-4 control-label">Product Title</label>
          <div class="col-sm-4">
            <input name="productName" type="text" class="form-control" columns="7" id="productName" placeholder="Title">
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-sm-4 control-label">Description</label>
          <div class="col-sm-4">
            <input name="description" type="text" class="form-control" id="description" placeholder="description">
          </div>
        </div>

        <div class="form-group">
          <label for="startPrice" class="col-sm-4 control-label">Start Price</label>
          <div class="col-sm-4">
            <input name="startPrice" type="text-area" class="form-control" columns="7" id="startPrice" placeholder="Reserve Price">
          </div>
        </div>

        <div class="form-group">
          <label for="reservePrice" class="col-sm-4 control-label">Reserve Price</label>
          <div class="col-sm-4">
            <input name="reservePrice" type="text-area" class="form-control" columns="7" id="reservePrice" placeholder="Reserve Price">
          </div>
        </div>

        <div class="form-group">
          <label for="endDateTime" class="col-sm-4 control-label">End Date and Time</label>
          <div class="col-sm-4">
            <input class="form-control" name="endDateTime" id="endDateTime" type="datetime-local" name="bdaytime">
          </div>
        </div>

        <div class="form-group">
          <label for="category" class="col-sm-4 control-label">category</label>
          <div class="col-sm-4">
            <input list="category" name="category" class="form-control">
  <datalist id="category" name="category">
    <?php
    $sql = "SELECT category FROM product;";
    $r_query = mysqli_query($con, $sql);
    $category_array = array();
    while ($row = mysqli_fetch_array($r_query)){
      $category = $row['category'];
      if (!(in_array($category, $category_array))) {
        array_push($category_array, $category);
      echo "<option value='$category'>";
    }
    }
     ?>
  </datalist>
          </div>
        </div>

        <div class="form-group submit-sign-up">
          <div class="col-sm-8 col-sm-offset-4">
            <button type="submit" name="submit-product" value="submit-product" class="btn btn-primary">Submit</button>
          </div>
        </div>

      </fieldset>
    </form>

<?php
if (isset($_POST['submit-product'])) {
  $description = mysqli_escape_string($con, $_POST['description']);
  $startPrice = mysqli_escape_string($con, $_POST['startPrice']);
  $reservePrice = mysqli_escape_string($con, $_POST['reservePrice']);
  $productName = mysqli_escape_string($con, $_POST['productName']);
  $endDateTime = mysqli_escape_string($con, $_POST['endDateTime']);
  $category = mysqli_escape_string($con, $_POST['category']);

  $stmt = $con->prepare("INSERT INTO product (description, startPrice, reservePrice, productName, endDateTime, category, userID)
  VALUES (?,?,?,?,?,?,?)");
  $stmt->bind_param("sssssss", $description, $startPrice, $reservePrice, $productName, $endDateTime, $category, $_SESSION['userID']);
  $stmt->execute();

  echo "New records created successfully";

}
$con->close();
?>



    </div>
  </div>
</div>
</body>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
