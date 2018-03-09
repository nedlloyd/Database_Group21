<?php
session_start();
require '../assets/php/connect.php';
echo $_SESSION['userID'];
echo $_SESSION['role'];
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
        <a class="active" href="http://localhost/Database_Group21/views/product.php">Home</a>
        <a class="active" href="http://localhost/Database_Group21/views/logout.php">Logout</a>
        </div>
      </div>
    </div>

  </header>


</head>
<body>
    <div class="wrapperforstickyfooter">
  <div class="content-wrap">
    <div class="container">

    <form class="form-horizontal" method="post" action="do.php">
      <fieldset>
        <legend>Purchase</legend>
              <p></p>

        <div class="form-group">
          <label for="orderID" class="col-sm-4 control-label">orderID</label>
          <div class="col-sm-4">
            <input name="productID" type="text" class="form-control" columns="7" id="productID" placeholder="productID">
            <span class="error"></span>
          </div>
        </div>

        <div class="form-group">
      <label for="role" class="col-sm-4 control-label">purchase comfirmation</label>
      <div class="col-sm-4">
        <select name="role" class="form-control" id="role">
          <option value="1">Yes</option>
          <option value="2">No</option>

          <?php if ($_SESSION['role'] === 'admin') {
            ?>
          <option value="admin">Admin</option>


          <?php
        }
          ?>
        </select>
        <span class="error"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="role" class="col-sm-4 control-label">payment</label>
      <div class="col-sm-4">
        <select name="role" class="form-control" id="role">
           <option value="1">credit card</option>
           <option value="2">paypal</option>
           <option value="2">other</option>


          <?php if ($_SESSION['role'] === 'admin') {
            ?>
          <option value="admin">Admin</option>


          <?php
        }
          ?>
        </select>
        <span class="error"></span>
      </div>
    </div>


        <div class="form-group submit-sign-up">
          <div class="col-sm-8 col-sm-offset-4">
            <button type="submit" name="submit-user" value="submit-user" class="btn btn-primary">Submit</button>
            <input type="hidden" name="doing" value="feedback">
          </div>
        </div>

      </fieldset>
    </form>


    </div>


  </div>
</div>
</body>

  <footer>
  </footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
