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
<title>Feedback</title>
</head>
<body>
  <div class="wrapperforstickyfooter">
  <div class="content-wrap">

  <fieldset>
        <legend>Feedback</legend>
  </fieldset>

    <form method="POST"  class="form-horizontal">       <!-- form delect action="do.php", add method-->
    <div class="container">
      

      
      
      <!-- <div class="form-group">
          <label for="feedbackFor" class="col-sm-4 control-label">identify</label>
          <div class="col-sm-4">
            <select name="feedbackFor" class="form-control" id="feedbackFor">
              <option value="1">seller</option>
              <option value="2">buyer</option>
            </select>
            <span class="error"></span>

          </div>
      </div> -->

        <!-- <div class="form-group">
          <label for="email" class="col-sm-4 control-label">email</label>
          <div class="col-sm-4">
            <input name="email" type="text" class="form-control" id="email" placeholder="Email">
            <span class="error"></span>
          </div>
        </div> -->

        <div class="form-group">
          <label for="rating score" class="col-sm-4 control-label">rating score</label>
          <div class="col-sm-4">
            <select name="rating" class="form-control" id="rating">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <span class="error"></span>
          </div>
        </div>

        <div class="form-group">
          <label for="comments" class="col-sm-4 control-label">comments</label>
          <div class="col-sm-4">
            <input name="comments" type="text" class="form-control" id="comments" placeholder="comments">
            <span class="error"></span>
          </div>
        </div>

        <div class="form-group submit-sign-up">
          <div class="col-sm-8 col-sm-offset-4">
            <button type="submit" name="submit-feedback" value="submit-feedback" class="btn btn-primary">Submit</button>
          </div>
        </div>
        <input name="userID" type="hidden" value="<?php echo $_SESSION['userID']; ?>"/>
        <input name="purchaseID" type="hidden" value="<?php echo $_GET['purchaseID']; ?>"/>
        <input name="feedbackFor" type="hidden" value="<?php echo $_GET['feedbackFor']; ?>"/>
    </div>   
  </form>

  </div>
  </div>
  <?php


// $result = $link -> prepare("INSERT INTO feedback (rating,comments, purchaseID, reg_date, feedbackFor ) VALUES (:rating,:comments, :purchaseID, ".date("Y-M-d H:i:s").", :feedbackFor)");
// $result -> execute(array("rating"=>$_POST['rating'],"comments"=>$_POST['comments'],"comments"=>$_POST['comments']));
			

if (isset($_POST['submit-feedback'])) {
$stmt = $con->prepare("INSERT INTO feedback (rating, comments, reg_date, purchaseID, feedbackFor) VALUES (?,?,?,?,?)");
@$stmt->bind_param("ssssd", $_POST['rating'], $_POST['comments'], date("Y-m-d H:s:i"), $_POST['purchaseID'], $_POST['feedbackFor']);
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

</body>
</html>
