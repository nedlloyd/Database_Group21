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
        </div>

        <div>

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

<html>
<head>
</head>
<body>
 <div class="wrapperforstickyfooter">
  <div class="content-wrap">
    <div class="container">
    <form class="form-horizontal" enctype="text/plain" method="post" action="mailto:esway@mail.com">

      <fieldset>
        <legend>Contact us</legend>

          <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-4">
              <input name="name" type="text" class="form-control" columns="7" id="name" placeholder="Name">
            </div>
          </div>

          <div class="form-group">
            <label for="emailaddress" class="col-sm-4 control-label">Email address</label>
            <div class="col-sm-4">
              <input name="emailaddress" type="text" class="form-control" columns="7" id="productID" placeholder="Email address">
            </div>
          </div>

            <div class="form-group">
              <label for="subject" class="col-sm-4 control-label">Subject</label>
              <div class="col-sm-4">
              <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject">
            </div>
          </div>

          <div class="form-group">
            <label for="comments" class="col-sm-4 control-label">Comments</label>
            <div class="col-sm-4">
            <input name="comments" type="text" class="form-control" id="comments" placeholder="Comments">
          </div>
        </div>

          <div class="form-group send-email">
            <div class="col-sm-8 col-sm-offset-4">
              <button type="submit" class="btn btn-primary">Send</button>
            </div>
          </div>
        </form>
      </body>
