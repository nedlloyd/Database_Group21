<?php

$connectstr_dbhost = "group21-mysql-server.mysql.database.azure.com";
$connectstr_dbusername = "group21@group21-mysql-server";
$connectstr_dbname = 'online_auction_db';
$connectstr_dbpassword = 'COMPGC06@@';

$con=mysqli_init();
// mysqli_ssl_set($con, NULL, NULL, {ca-cert filename}, NULL, NULL);
mysqli_real_connect($con, $connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword, $connectstr_dbname, 3306);

// $connectstr_dbname = 'online_acution_db';
// $connectstr_dbhost = 'database-group21.database.windows.net';
// $connectstr_dbusername = 'group21';
// $connectstr_dbpassword = 'COMPGC06!@';
//
//
// // $connectstr_dbname = 'ebay_database';
// // $connectstr_dbhost = 'localhost';
// // $connectstr_dbusername = 'root';
// // $connectstr_dbpassword = '';
//
// echo $connectstr_dbname;
// echo $connectstr_dbhost;
// echo $connectstr_dbusername;
// echo $connectstr_dbpassword;
//
// foreach ($_SERVER as $key => $value) {
//     if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
//         continue;
//     }
//
//     $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
//     $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
//     $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
// }
//
// $link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);
//
//
// if (!$link) {
//     echo "Error: Unable to connect to MySQL." . PHP_EOL;
//     echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
//     echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
//     exit;
// }
//
// echo "<p>Success: A proper connection to MySQL was made!</p>";
// echo "<p>The database is $connectstr_dbname</p>";
// echo "<p>connectstr_dbhost = $connectstr_dbhost</p>";
// echo "<p>Host information: " . mysqli_get_host_info($link) . "</p>";
// echo "<p>connectstr_dbusername: $connectstr_dbusername</p>";
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

  <!-- Optional IE8 Support -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Minified CSS -->

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

    <form class="form-horizontal">
      <fieldset>
        <legend>Sign Up</legend>

        <div class="form-group">
          <label for="name" class="col-sm-4 control-label">Name</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" columns="7" id="name" placeholder="Name">
          </div>
        </div>

        <div class="form-group">
          <label for="email" class="col-sm-4 control-label">Email</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="email" placeholder="Email">
          </div>
        </div>

        <div class="form-group">
          <label for="address" class="col-sm-4 control-label">Address</label>
          <div class="col-sm-4">
            <input type="text-area" class="form-control" columns="7" id="Address" placeholder="Address">
          </div>
        </div>

        <div class="form-group">
          <label for="Grant_name" class="col-sm-4 control-label"></label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Grant_name" placeholder="Email">
          </div>
        </div>

        <div class="form-group">
          <label for="Grant_email" class="col-sm-4 control-label">Grant Contact Email</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="Grant_email" placeholder="Email">
          </div>
        </div>

        <div class="form-group">
          <label for="username" class="col-sm-4 control-label">Username</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="username" placeholder="username">
          </div>
        </div>

        <div class="form-group">
          <label for="password" class="col-sm-4 control-label">Password</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="password" placeholder="password">
          </div>
        </div>

        <div class="form-group">
          <label for="select_charity" class="col-sm-4 control-label">Charity Category</label>
          <div class="col-sm-4">
            <select class="form-control" id="select_category">
              <option>A</option>
              <option>B</option>
              <option>C</option>
              <option>D</option>
              <option>E</option>
            </select>
          </div>
        </div>

        <div class="form-group submit-sign-up">
          <div class="col-sm-8 col-sm-offset-4">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>

      </fieldset>
    </form>

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
