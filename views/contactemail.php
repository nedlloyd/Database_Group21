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

<form action="mailto:esway@mail.com" method="post" enctype="text/plain">

Name:<br>
<input type="text" name="name"><br>
Your e-mail address:<br>
<input type="text" name="email" size="30"><br><br>
Subject:<br>
<input type="text" name="subject" size="30"><br><br>
Comment:<br>
<input type="text" name="comment" size="200"><br><br>

<input type="submit" value="Send">
</form>

</body>
</html>
