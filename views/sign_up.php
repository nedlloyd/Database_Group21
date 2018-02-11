<?php
$connectstr_dbhost = "group21-mysql-server.mysql.database.azure.com";
$connectstr_dbusername = "group21@group21-mysql-server";
$connectstr_dbname = 'online_auction_db';
$connectstr_dbpassword = 'COMPGC06@@';

$con=mysqli_init();

mysqli_real_connect($con, $connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword, $connectstr_dbname, 3306);
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

    <form class="form-horizontal" method="post">
      <fieldset>
        <legend>Sign Up</legend>

        <div class="form-group">
          <label for="name" class="col-sm-4 control-label">Name</label>
          <div class="col-sm-4">
            <input name="first_name" type="text" class="form-control" columns="7" id="name" placeholder="Name">
          </div>
        </div>



        <div class="form-group">
          <label for="email" class="col-sm-4 control-label">Email</label>
          <div class="col-sm-4">
            <input name="email" type="text" class="form-control" id="email" placeholder="Email">
          </div>
        </div>

        <div class="form-group">
          <label for="address_line_1" class="col-sm-4 control-label">Address Line 1</label>
          <div class="col-sm-4">
            <input name="address_line_1" type="text-area" class="form-control" columns="7" id="address_line_1" placeholder="Line 1">
          </div>
        </div>

        <div class="form-group">
          <label for="address_line_2" class="col-sm-4 control-label">Address Line 2</label>
          <div class="col-sm-4">
            <input name="address_line_2" type="text-area" class="form-control" columns="7" id="address_line_2" placeholder="Line 2">
          </div>
        </div>

        <div class="form-group">
          <label for="address_line_3" class="col-sm-4 control-label">Address Line 3</label>
          <div class="col-sm-4">
            <input name="address_line_3" type="text-area" class="form-control" columns="7" id="address_line_3" placeholder="Line 3">
          </div>
        </div>

        <div class="form-group">
          <label for="admin_role" class="col-sm-4 control-label">Admin Role</label>
          <div class="col-sm-1">
            <input class="radio-inline" type="checkbox" name="admin" value=1>Yes<br>
            </div>
            <div class="col-sm-1">
            <input class="radio-inline" type="checkbox" name="admin" value=0>No<br>
          </div>
        </div>


        <div class="form-group">
          <label for="password" class="col-sm-4 control-label">Password</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="password" placeholder="password">
          </div>
        </div>

        <div class="form-group">
          <label for="confirm_password" class="col-sm-4 control-label">Confirm Password</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="password" placeholder="password">
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
$stmt = $con->prepare("INSERT INTO users (first_name, address_line_1, address_line_2, address_line_3, admin, email)
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", $_POST['first_name'], $_POST['address_line_1'], $_POST['address_line_2'], $_POST['address_line_3'], $_POST['admin'], $_POST['email']);
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
