<?php
session_start();
require '../assets/php/connect.php';

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
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/application.css">

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

  <?php
  if (isset($_GET['search'])) {
  $term_cat = mysqli_real_escape_string($con, $_GET['searchcategory']);
  $term_name = mysqli_real_escape_string($con, $_GET['searchname']);

  $sql = "SELECT * FROM product WHERE category LIKE '%".$term."%' AND productName LIKE '%".$term."%'";
  $r_query = mysqli_query($con, $sql);
  }
  ?>

  <form method="get">
  <p>
    <p>
      <label for="searchterm"> Find: </label>
      <input type="search" name="searchname" id="searchname">
    </p>

    <label for="searchterm"> Find Category: </label>
      <div class="form-group">
      <label for="category" class="col-sm-4 control-label">category</label>
      <div class="col-sm-4">
        <input list="category" name="searchcategory" id="search" class="form-control">
    <datalist id="category" name="category">
    <?php
    $sql = "SELECT category FROM product;";
    $r_query_cat = mysqli_query($con, $sql);
    $category_array = array();
    while ($row_cat = mysqli_fetch_array($r_query_cat)){
    $category = $row_cat['category'];
    if (!(in_array($category, $category_array))) {
    array_push($category_array, $category);
    echo "<option value='$category'>";
    }
    }
    ?>
    </datalist>
      </div>
    </div>
    <input type="submit" name="search" id="search" value="search">
  </p>
  </form>

  <div class="container">
      <p><?php echo $_SESSION['userID'];?><p>
    <h2>What we've got</h2>
    <a class="btn btn-lg btn-primary btn-block" href="add_product_form.php">Add a new item</a>
    <a class="btn btn-lg btn-primary btn-block" href="watchlist.php">View Watchlist</a>
    <table class="table table-striped" id="myTable2">
      <thead>
        <tr>
          <th onclick="sortTable(0)">Product Name</th>
          <th onclick="sortTable(1)">Description</th>
          <th onclick="sortTable(2)">Category</th>
          <th onclick="sortTable(3)">Start Price</th>
          <th onclick="sortTable(4)">Reserve Price</th>
          <th onclick="sortTable(5)">ProductID</th>
          <th onclick="sortTable(6)"> Watchlist</th>
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
          <td><?php echo $row['productID'];?></td>
          <form method="post">
          <input type="hidden" name="productID" value="<?php echo $row['productID']; ?>">
          <input id="productName" type="hidden" name="productName" value="<?php echo $row['productName']; ?>">
          <td><button type="submit" name="add-watchlist" value="add-watchlist" class="btn btn-primary">Add To Watchlist</button></td>
          </form>
        </tr>
      <?php }
    } ?>
      </tbody>
    </table>
  </div>

</body>

<?php $con->close(); ?>

  <footer>

  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
