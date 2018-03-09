<?php
session_start();
require '../assets/php/connect.php';
echo $_SESSION['userID'];
echo $_SESSION['productID']
?>

<?php
$_SESSION['message'] = "";
$amountErr = "";
if (isset($_POST['amount'])) {
  if (empty($_POST["amount"])) {
    $amountErr = "Bid amount is required";
  } else {
    $amount = mysqli_escape_string($con, $_POST['amount']);
  }
}
?>

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

    <div class="top-container">
      <div class="header" id="header">
        <a class="active" href="http://localhost/Database_Group21/views/product.php">Home</a>
        <a class="active" href="http://localhost/Database_Group21/views/logout.php">Logout</a>
        </div>
      </div>
    </div>

  </header>

</form>


<!DOCTYPE html>
<html>
<head>
<h1> Bid page </h1>
</head>

  <body>
    <form method="post" action="bid.php">

    <div class="wrapperforstickyfooter">
    <div class="content-wrap">
      <div class="container">
      <form class="form-horizontal" method="post">
        <fieldset>


          <div class="form-group">
            <label for="userID" class="col-sm-4 control-label">userID</label>
            <div class="col-sm-4">
              <input name="userID" type="text" class="form-control" columns="7" id="userID" placeholder="userID">
            </div>
          </div>
<p>

</p>
          <div class="form-group">
            <label for="productID" class="col-sm-4 control-label">productID</label>
            <div class="col-sm-4">
              <input name="productID" type="text" class="form-control" columns="7" id="productID" placeholder="productID">
            </div>
          </div>
<p>

</p>
            <div class="form-group">
              <label for="amount" class="col-sm-4 control-label">bid amount (£)</label>
              <div class="col-sm-4">
              <input name="amount" type="text" class="form-control" id="amount" placeholder="bid amount (£)">
              <span class="error"><?php echo $amounterr?></span>
            </div>
          </div>
<p>

</p>
          <div class="input-group">
              <input type="submit" value="Submit" name="submit-buyer">
          </div>
        </form>
      </body>

<?php
if (isset($_POST['submit-buyer'])) {
$stmt = $con->prepare("INSERT INTO bid (amount, productID, userID)
VALUES (?, ?, ?)");
$stmt->bind_param("sss", $_POST['amount'], $_SESSION['productID'], $_SESSION['userID']);
$stmt->execute();
echo "New bid submitted.";
$con->close();
}
?>
