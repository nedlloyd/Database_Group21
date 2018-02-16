<?php
require '../database/connect.php';
$r_query = null;
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
  <link rel="stylesheet" href="../assets/stylesheets/application.css">

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
<h1 class="find_stuff">Find Stuff</h1>

<form method="get">
<p>
  <label for="searchterm"> Find Stuff: </label>
  <input type="search" name="searchterm" id="searchterm">
  <input type="submit" name="search" id="search" value="search">
</p>
</form>

<?php if (isset($_GET['searchterm'])) { ?>
  <p>You searched for <?php echo $_GET['searchterm'];?>.<p>

<?php
$term = mysqli_real_escape_string($con, $_GET['searchterm']);
echo $term;

$sql = "SELECT * FROM product WHERE productName LIKE '%".$term."%'";
$r_query = mysqli_query($con, $sql);
}
?>
<div class="container">
  <h2>What we've got</h2>
  <a class="btn btn-lg btn-primary btn-block" href="add_product_form.php">Add a new item</a>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Descritpion</th>
        <th>Category</th>
        <th>Start Price</th>
        <th>Reserve Price</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($r_query != null) {
      while ($row = mysqli_fetch_array($r_query)) { ?>
      <tr>
        <td><?php echo $row['productName'];?></td>
        <td><?php echo $row['description'];?></td>
        <td><?php echo $row['category'];?></td>
        <td><?php echo $row['startPrice'];?></td>
        <td><?php echo $row['reservePrice'];?></td>
        <td><?php echo $row['reservePrice'];?></td>
      </tr>
    <?php }
  } ?>
    </tbody>
  </table>
</div>

</body>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
