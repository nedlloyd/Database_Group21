<?php
session_start();
require '../assets/php/connect.php';
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


</head>
<meta charset="utf-8">
<title>Purchase</title>
</head>
<body>
  <div class="wrapperforstickyfooter">
  <div class="content-wrap">

  <fieldset>
        <legend>Dashboard</legend>
  </fieldset>

        <div class="container">
            <div class="col-sm-6">
                <h3>Product Order</h3>
                <ul>
                    <li><a href="details.php?id=<?php echo $row['productID'] ?>">AAAA</a> / loss the bid / --</li>
                    <li><a href="details.php?id=<?php echo $row['productID'] ?>">BBBB</a> / win the bid / payment / <a href="feedback.php?purchaseID=22&feedbackFor=1">Feedback</a></li>
                </ul>       
            </div>

            <div class="col-sm-6">
                <h3>Product List</h3>
                <ul>
                    <li><a href="details.php?id=<?php echo $row['productID'] ?>">CCCC</a> / bidding /</li>
                    <li><a href="details.php?id=<?php echo $row['productID'] ?>">DDDD</a> / auction closed / details / <a href="feedback.php?purchaseID=33&feedbackFor=2">Feedback</a></li>
                </ul>
            </div>
        </div>

  <footer>
  </footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
