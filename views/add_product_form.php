<?php
session_start();
require '../database/connect.php';
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
  <link rel="stylesheet" href="../assets/stylesheets/sign_up.css">


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
            <input name="startPrice" type="text-area" class="form-control" columns="7" id="startPrice" placeholder="start price">
          </div>
        </div>

        <div class="form-group">
          <label for="reservePrice" class="col-sm-4 control-label">Reserve Price</label>
          <div class="col-sm-4">
            <input name="reservePrice" type="text-area" class="form-control" columns="7" id="reservePrice" placeholder="Reserve Price">
          </div>
        </div>

        <div class="form-group">
          <label for="startTime" class="col-sm-4 control-label">startTime</label>
          <div class="col-sm-4">
            <input name="startTime" type="text-area" class="form-control" columns="7" id="startTime" placeholder="startTime">
          </div>
        </div>

        <div class="form-group">
          <label for="startDate" class="col-sm-4 control-label">startDate</label>
          <div class="col-sm-4">
            <input name="startDate" type="text-area" class="form-control" columns="7" id="startDate" placeholder="startDate">
          </div>
        </div>


        <div class="form-group">
          <label for="endTime" class="col-sm-4 control-label">endTime</label>
          <div class="col-sm-4">
            <input name="endTime" type="text-area" class="form-control" columns="7" id="endTime" placeholder="endTime">
          </div>
        </div>

        <div class="form-group">
          <label for="endDate" class="col-sm-4 control-label">endDate</label>
          <div class="col-sm-4">
            <input name="endDate" type="text-area" class="form-control" columns="7" id="endDate" placeholder="endDate">
          </div>
        </div>

        <div class="form-group">
          <label for="category" class="col-sm-4 control-label">category</label>
          <div class="col-sm-4">
            <input name="category" type="text-area" class="form-control" columns="7" id="category" placeholder="category">
          </div>
        </div>

        <div class="form-group submit-sign-up">
          <div class="col-sm-8 col-sm-offset-4">
            <button type="submit" name="submit-user" value="submit-user" class="btn btn-primary">Submit</button>
          </div>
        </div>

      </fieldset>
    </form>
<pre>
  <?php
  if (isset($_POST['submit-user'])) {
    print_r($_POST);
    print($_POST['first_name']);
    print($_POST['address_line_1']);
    print($_POST['address_line_2']);
    print($_POST['address_line_3']);
    // print($_POST['admin']);
    print($_POST['email']);
  }
  ?>
</pre>

<?php
$admin = true;
$stmt = $con->prepare("INSERT INTO product (description, startPrice, reservePrice, productName, startTime, startDate, endTime, endDate, category)
VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssss", $_POST['description'], $_POST['startPrice'], $_POST['reservePrice'], $_POST['productName'], $_POST['startTime'], $_POST['startDate'], $_POST['endTime'], $_POST['endDate'], $_POST['category']);
$stmt->execute();

echo "New records created successfully";

$con->close();
?>



    </div>


  </div>
</div>
</body>

  <footer>
    <div class="content-wrap">
      <p>AMRC is a registered charity in England and Wales (296772). Registered as a company limited by guarantee (2107400) in England and Wales. Registered office at Charles Darwin House 2, 107 Gray's Inn Rd, London WC1X 8TZ. Visit the AMRC website for more information:<a href="https://www.amrc.org.uk/" class="link-footer-tem" title="www.amrc.org.uk" target="_blank">www.amrc.org.uk</a></p>
    </div>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
