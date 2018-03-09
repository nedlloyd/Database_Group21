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
            <span class="glyphicon glyphicon-envelope"></span> Contact Us
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
        <a class="active" href="product.php">Home</a>
        <a class="active" href="logout.php">Logout</a>
        </div>
      </div>
    </div>

  </header>


</head>
<meta charset="utf-8">
<title>Feedback</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">       <!-- form delect action="do.php", add method-->

        <div class="form-group">
          <label for="userID" class="col-sm-3 control-label"></label>
        <div class="col-sm-3">
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label"></label>
        <div class="col-sm-3">
        <div class="form-group">
          <label for="purchaseID" class="col-sm-3 control-label"></label>
        <div class="col-sm-3">
        <div class="form-group">
          <label for="rating score" class="col-sm-3 control-label"></label>
        <div class="col-sm-3">
        <div class="form-group">
          <label for="feedback comment" class="col-sm-3 control-label"></label>
        <div class="col-sm-3">

        <p>*userID: <input name="userID" type="text" value="" size="30"  required /><br /><p>
        *email: <input name="email" type="email" value="" size="30"  required /><br />
        *purchaseID: <input name="purchaseID" type="text" value="" size="30" required /><br />
        *rating score:
            1 <input type="radio" name="rating" value="1">
            2 <input type="radio" name="rating" value="2">
            3 <input type="radio" name="rating" value="3">
            4 <input type="radio" name="rating" value="4">
            5 <input type="radio" name="rating" value="5" checked> <br>
        feedback comment:<br>
        <input name="comments" rows="7" cols="30"><br>

        <input name="userID" type="hidden" value="$_SESSION['userID']"/>
        <input name="doing" type="hidden" value="feedback"/>
        <input type="submit" value="submit" name="submit-feedback"/>
    </form>
</body>
</html>

<?php
if (isset($_POST['submit-feedback'])) {
$stmt = $con->prepare("INSERT INTO feedback (rating, comments)
VALUES (?,?)");
$stmt->bind_param("ss", $_POST['rating'], $_POST['comments']);
$stmt->execute();
echo "done";
$con->close();
}
?>


  <footer>
  </footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
