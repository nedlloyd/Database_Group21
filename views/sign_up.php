<?php
session_start();
require '../assets/php/connect.php';
echo $_SESSION['userID'];
echo $_SESSION['role'];
?>

<?php
$_SESSION['message'] = "";
$nameErr = $emailErr = $address_line_1Err = $address_line_2Err = $address_line_3Err = $roleErr = $passwordErr = "";
if (isset($_POST['submit-user'])) {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = mysqli_escape_string($con, $_POST['name']);
  }
  if (empty($_POST["address_line_1"])) {
    $address_line_1Err = "First Line of address is required";
  } else {
    $address_line_1 = mysqli_escape_string($con, $_POST['address_line_1']);
  }
  if (empty($_POST["address_line_2"])) {
    $address_line_2Err = "Second Line of address is required";
  } else {
    $address_line_2 = mysqli_escape_string($con, $_POST['address_line_2']);
  }
  if (empty($_POST["address_line_3"])) {
    $address_line_3Err = "Third Line of address is required";
  } else {
    $address_line_3 = mysqli_escape_string($con, $_POST['address_line_3']);
  }
  if (empty($_POST["role"])) {
    $roleErr = "Role is required";
  } else {
    $role = mysqli_escape_string($con, $_POST['role']);
  }
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = mysqli_escape_string($con, $_POST['email']);
  }
  if (empty($_POST["password"])) {
    $passwordErr = "Role is required";
  } else {
    $password = mysqli_escape_string($con, (password_hash($_POST['password'], PASSWORD_BCRYPT)));
    $hash = mysqli_escape_string($con, ( md5( rand(0,1000))));
  }



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

if ($_SESSION['role'] != 'admin') {
    $_SESSION['role'] = $role;
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
        <a class="active" href="login.php">Login</a>
      </div>
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
            <input name="name" type="text" class="form-control" columns="7" id="name" placeholder="Name">
            <span class="error"><?php echo $nameErr;?></span>
          </div>
        </div>



        <div class="form-group">
          <label for="email" class="col-sm-4 control-label">Email</label>
          <div class="col-sm-4">
            <input name="email" type="text" class="form-control" id="email" placeholder="Email">
            <span class="error"><?php echo $emailErr;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="address_line_1" class="col-sm-4 control-label">Address Line 1</label>
          <div class="col-sm-4">
            <input name="address_line_1" type="text-area" class="form-control" columns="7" id="address_line_1" placeholder="Line 1">
            <span class="error"><?php echo $address_line_1Err;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="address_line_2" class="col-sm-4 control-label">Address Line 2</label>
          <div class="col-sm-4">
            <input name="address_line_2" type="text-area" class="form-control" columns="7" id="address_line_2" placeholder="Line 2">
            <span class="error"><?php echo $address_line_2Err;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="address_line_3" class="col-sm-4 control-label">Address Line 3</label>
          <div class="col-sm-4">
            <input name="address_line_3" type="text-area" class="form-control" columns="7" id="address_line_3" placeholder="Line 3">
            <span class="error"><?php echo $address_line_3Err;?></span>
          </div>
        </div>

        <div class="form-group">
      <label for="role" class="col-sm-4 control-label">Account Type</label>
      <div class="col-sm-4">
        <select name="role" class="form-control" id="role">
          <option value="both">Seller and Buyer</option>
          <option value="seller">Seller</option>
          <option value="buyer">Buyer</option>
          <?php if ($_SESSION['role'] === 'admin') {
            ?>
          <option value="admin">Admin</option>
          <?php
        }
          ?>
        </select>
        <span class="error"><?php echo $roleErr;?></span>
      </div>
    </div>


        <div class="form-group">
          <label for="password" class="col-sm-4 control-label">Password</label>
          <div class="col-sm-4">
            <input type="password" name="password" class="form-control" id="password" placeholder="password">
            <span class="error"><?php echo $passwordErr;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="confirm_password" class="col-sm-4 control-label">Confirm Password</label>
          <div class="col-sm-4">
            <input type="password" class="form-control" id="password" placeholder="password">
          </div>
        </div>

        <div class="form-group submit-sign-up">
          <div class="col-sm-8 col-sm-offset-4">
            <button type="submit" name="submit-user" value="submit-user" class="btn btn-primary">Submit</button>
          </div>
        </div>

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
