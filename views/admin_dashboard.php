<?php
session_start();
include '../assets/php/buyer_dashboardphp.php';
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
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/admin_dashboard.css">

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




  <?php
  if (isset($_POST['disable-user'])) {
  $id = $_POST['id'];
  echo $id;
  $sql = "SELECT active FROM users WHERE id=$id";
  $result = mysqli_query($con, $sql) or die ($mysqli->error());
  $row = $result -> fetch_assoc();
  if ($row['active'] == TRUE) {
    $sql = "UPDATE users SET active=FALSE WHERE id=$id";
      if ($con->query($sql) === TRUE) {
        echo '<script></script>';
      } else {
        echo "Error deleting record: " . $con->error;
      }
  } else {
    $sql = "UPDATE users SET active=TRUE WHERE id=$id";
      if ($con->query($sql) === TRUE) {
        echo '<script></script>';
      } else {
        echo "Error deleting record: " . $con->error;
      }
  }
  }
  $id = '';
  ?>


</head>
<body>

  <?php $totalproducts = findTotalActiveProducts($con);?>


  <div class="admin-dashboard">

    <a class="btn btn-lg btn-primary btn-block" href="sign_up.php">Add New User</a>

  <table class="table table-striped">
      <thead>
        <tr>
          <th>Number of Users</th>
          <th>Number of active Products</th>
          <th>Number of completed Products</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo findTotalUsers($con)?></td>
          <td><?php echo $totalproducts['totalProductsCurrent']; ?></td>
          <td><?php echo $totalproducts['totalProductsFinished']; ?></td>
        </tr>
      </tbody>
    </table>

<div class="table-all-users">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>id</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $button = "";
          $r_query = viewAllUsers($con);
          while ($row = mysqli_fetch_array($r_query)) {
            if ($row['active'] == FALSE) {
              $button = "Re-activate User";
            } else {
              $button = "Disable User";
            }
            ?>
          <tr>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['role']?></td>
            <td><?php echo $row['id']?></td>
            <form method="post">
              <input id="productID" type="hidden" name="id" value="<?php echo $row['id'];?>">
            <td><button type="submit" name="disable-user" value="disable-user" class="btn btn-primary"><rb><?php echo $button ?></rb>
            </form>
          </tr>

        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

  <footer>

  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
