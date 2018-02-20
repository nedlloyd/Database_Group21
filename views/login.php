<?php session_start();?>
<?php
require '../database/connect.php';
require '../assets/php/login_function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- Viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- IE Edge Meta Tag// edge means the browser should use the best and newest machine -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/login.css">
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/application.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <title>Esway </title>
</head>
<body>
  <div class="wrapperforstickyfooter">
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


    <div class="content-wrap"><section class="description">
      <div class="container col-sm-12">
        <p class="loginDescription">Welcome to Esway, the orginal online auction company.  If you need more information send a message to this link: <a class="loginContact" href="j.leblanc@amrc.org.uk">j.leblanc@amrc.org.uk!</a></p>
        </div>
      </section>
      <div class="container">
        <div class="login-btns-input col-sm-12">
          <p><?php echo $_SESSION['message']?></p>

          <div class="container login-fields-all">

            <form class="form-signin" method="post">
              <h2 class="form-signin-heading">Please sign in</h2>
              <label for="inputEmail" class="sr-only login-field">Email address</label>
              <input type="email" name="email" id="inputEmail" class="form-control login-field" placeholder="Email address" required autofocus>
              <label for="inputPassword" class="sr-only login-field">Password</label>
              <input type="password" name="password" id="inputPassword" class="form-control login-field" placeholder="Password" required>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me"> Remember me
                </label>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit-login">Sign in</button>
              <a class="btn btn-lg btn-primary btn-block sign_up-link" href="sign_up.php">Sign Up</a>
            </form>

          </div>



        </div>
      </div>
    </div>



    <div class="push"></div> <!-- include this line for stickyfooter -->
  </div> <!-- close wrapperforstickyfooter -->
  <footer>
    <div class="content-wrap login-footer">
      <p>Esway is a registered charity in England and Wales (296772). Registered as a company limited by guarantee (2107400) in England and Wales. Registered office at Charles Darwin House 2, 107 Gray's Inn Rd, London WC1X 8TZ. Visit the Esway website for more information:<a href="https://www.amrc.org.uk/" class="link-footer-tem" title="www.amrc.org.uk" target="_blank">www.esway.org.uk</a></p>
    </div>
  </footer>
  <!-- </div> closing for "container-fluid" -->
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!-- Link to JavaScript -->
  <!-- <script stc="js/script.js"></script> -->
</body>
</html>
