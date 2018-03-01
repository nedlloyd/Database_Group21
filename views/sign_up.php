<?php
session_start();
require '../assets/php/connect.php';
?>

<?php
$_SESSION['message'] = "";
if (isset($_POST['submit-user'])) {
  $name = mysqli_escape_string($con, $_POST['first_name']);
  $address_line_1 = mysqli_escape_string($con, $_POST['address_line_1']);
  $address_line_2 = mysqli_escape_string($con, $_POST['address_line_2']);
  $address_line_3 = mysqli_escape_string($con, $_POST['address_line_3']);
  $role = mysqli_escape_string($con, $_POST['role']);
  $email = mysqli_escape_string($con, $_POST['email']);
  $password = mysqli_escape_string($con, (password_hash($_POST['password'], PASSWORD_BCRYPT)));
  $hash = mysqli_escape_string($con, ( md5( rand(0,1000))));
  echo $role;

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($con, $sql) or die ($mysqli->error());
  if ($result->num_rows == 0) {

    $_SESSION['message'] = "Your account has been created!";

    $stmt = $con->prepare("INSERT INTO users (name, address_line_1, address_line_2, address_line_3, email, password, hash, role)
    VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $name, $address_line_1, $address_line_2, $address_line_3, $email, $password, $hash, $role);
    $stmt->execute();

  } else {
    $_SESSION['message'] = "I'm afraid that email address has already been taken, please try another one";
  }

  $con->close();
}
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
        <legend>Sign Up</legend>
              <p><?php echo $_SESSION['message'] ?></p>

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

        <!-- <div class="form-group">
          <label for="admin_role" class="col-sm-4 control-label">Role</label>
          <div class="col-sm-1">
            <input class="radio-inline" type="checkbox" name="admin" value="">Yes<br>
            </div>
            <div class="col-sm-1">
            <input class="radio-inline" type="checkbox" name="admin" value=0>No<br>
          </div>
        </div> -->

        <div class="form-group">
      <label for="role" class="col-sm-4 control-label">Account Type</label>
      <div class="col-sm-4">
        <select name="role" class="form-control" id="role">
          <option value="both">Seller and Buyer</option>
          <option value="seller">Seller</option>
          <option value="buyer">Buyer</option>
        </select>
      </div>
    </div>


        <div class="form-group">
          <label for="password" class="col-sm-4 control-label">Password</label>
          <div class="col-sm-4">
            <input type="text" name="password" class="form-control" id="password" placeholder="password">
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

        <!-- <input id="admin" type="hidden" name="admin" value=0> -->

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
