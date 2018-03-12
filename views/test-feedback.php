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
        <legend>Feedback</legend>
              <p></p>

<body>
      <div class="form-group">
        <label for="role" class="col-sm-4 control-label">account type</label>
        <div class="col-sm-4">
          <select name="role" class="form-control" id="role">
             <option value="1">seller</option>
             <option value="2">buyer</option>
          <span class="error"></span>
        </div>
      </div>
        
      <div class="form-group">
        <label for="userID" class="col-sm-4 control-label">userID</label>
        <div class="col-sm-4">
          <input name="userID" type="text" class="form-control" columns="7" id="userID" placeholder="userID">
        <span class="error"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="email" class="col-sm-4 control-label">email</label>
        <div class="col-sm-4">
          <input name="email" type="text" class="form-control" id="email" placeholder="Email">
        <span class="error"></span>
        </div>
      </div>
        
      <div class="form-group">
        <label for="purchaseID" class="col-sm-4 control-label">purchaseID</label>
        <div class="col-sm-4">
          <input name="purchaseID" type="text" class="form-control" columns="7" id="purchaseID" placeholder="purchaseID">
        <span class="error"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="role" class="col-sm-4 control-label">rating score</label>
        <div class="col-sm-4">
          1 <input type="radio" name="role" value="1"> 
          2 <input type="radio" name="role" value="2"> 
          3 <input type="radio" name="role" value="3"> 
          4 <input type="radio" name="role" value="4">
          5 <input type="radio" name="role" value="5" checked>
          <!-- <select name="role" class="form-control" id="role">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option> -->
          
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
          <label for="comment" class="col-sm-4 control-label">comment</label>
          <div class="col-sm-4">
            <input type="comment" name="comment" class="form-control" id="comment" placeholder="comment">
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
