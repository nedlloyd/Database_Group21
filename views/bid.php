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
    </div>

  </header>

</form>


<!DOCTYPE html>
<html>
<head>
<h1> Bid page </h1>
</head>
<body>
 <div class="wrapperforstickyfooter">
  <div class="content-wrap">
    <div class="container">
    <form class="form-horizontal" method="post" action="bid.php">
      <fieldset>
        <legend>Add New Bid</legend>

          <div class="form-group">
            <label for="userID" class="col-sm-4 control-label">userID</label>
            <div class="col-sm-4">
              <input name="userID" type="text" class="form-control" columns="7" id="userID" placeholder="userID">
            </div>
          </div>

          <div class="form-group">
            <label for="productID" class="col-sm-4 control-label">productID</label>
            <div class="col-sm-4">
              <input name="productID" type="text" class="form-control" columns="7" id="productID" placeholder="productID">
            </div>
          </div>

            <div class="form-group">
              <label for="amount" class="col-sm-4 control-label">bid amount</label>
              <div class="col-sm-4">
              <input name="amount" type="text" class="form-control" id="amount" placeholder="bid amount">
              <span class="error"><?php echo $amounterr?></span>
            </div>
          </div>

          <div class="form-group submit-sign-up">
            <div class="col-sm-8 col-sm-offset-4">
              <button type="submit" name="submit-user" value="submit-user" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </body>

<?php
if (isset($_POST['submit-bid'])) {
$stmt = $con->prepare("INSERT INTO bid (amount)
VALUES (?)");
$stmt->bind_param("s", $_POST['amount']);
$stmt->execute();
echo "New bid submitted.";
$con->close();
}
?>
