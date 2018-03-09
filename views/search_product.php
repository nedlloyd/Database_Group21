<?php
session_start();
require '../assets/php/connect.php';

$r_query = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/application.css">
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/search_product.css">



  <header role="banner" class="header-reports">
    <div class="content-wrap">
      <img class="logo" src="../images/Logo-Logo.svg.png" alt="AMRC Logo">
      <div class='btn-toolbar pull-right'>
        <div class='btn-group'>
          <button type="button" class="btn btn-default templateBtnToolbar contactLogin">
            <span class="glyphicon glyphicon-envelope"></span> Contact Us
          </button>
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
        <a class="active" href="http://localhost/Database_Group21/views/product.php">Home</a>
        <a class="active" href="http://localhost/Database_Group21/views/logout.php">Logout</a>
        </div>
      </div>
    </div>

  </header>


</head>
<body>
<h1 class="find_stuff">Find Stuff</h1>

<form class="form-horizontal" method="get">

  <div class="form-group">
    <label for="searchterm" class="col-sm-4 control-label"> Find: </label>
      <div class="col-sm-4">
    <input class="form-control" type="search" name="searchname" id="searchname">
    </div>
  </div>

  <div class="panel-group col-sm-10 col-sm-offset-1">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse1">Advanced Search</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">

        <div class="form-group">
        <label for="description" class="col-sm-4 control-label"> Search also in Description</label>
        <div class="col-sm-1">
        <input class="form-control" type="radio" name="description" value='1'> Yes
        </div>
          <div class="col-sm-1">
        <input class="form-control" type="radio" name="description" value='0' checked> No
        </div>
        </div>

        <div class="form-group">
        <label for="category" class="col-sm-4 control-label">category</label>
        <div class="col-sm-4">
          <input class="form-control" list="category" name="searchcategory" id="search">
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

        <div class="form-group">
          <label for="endDateTime" class="col-sm-4 control-label">End Date and Time</label>
          <div class="col-sm-4">
            <input class="form-control" name="endDateTime" id="endDateTime" type="date">
          </div>
        </div>

        <div class="form-group">
        <label for="lowprice" class="col-sm-4 control-label">Starting Price: more than</label>
        <div class="col-sm-1">
        <input class="form-control" type="number" id="lowprice" name="lowprice">
        </div>
        </div>

        <div class="form-group">
        <label for="highprice" class="col-sm-4 control-label">Starting Price: less than</label>
        <div class="col-sm-1">
        <input class="form-control" type="number" id="highprice" name="highprice">
        </div>

      </div>
    </div>
  </div>
</div>
</div>

<div class="form-group col-sm-12">
<div class="">
      <input type="submit" name="search" id="search" value="Search" class="btn btn-primary search-product">
</div>
</div>

</form>

<?php
if (isset($_GET['search'])) {
$term_name = mysqli_real_escape_string($con, $_GET['searchname']);
$term_cat = mysqli_real_escape_string($con, $_GET['searchcategory']);
$term_endDate = mysqli_real_escape_string($con, $_GET['endDateTime']);
$low_price = mysqli_real_escape_string($con, $_GET['lowprice']);
$high_price = mysqli_real_escape_string($con, $_GET['highprice']);
$highlow = '';
if ($low_price != '' && $high_price != '') {
  $highlow = " AND startPrice > $low_price AND startPrice < $high_price";
} else if ($low_price != '') {
  $highlow = " AND startPrice > $low_price";
} else if ($high_price != '') {
  $highlow = " AND startPrice < $high_price";
}


$searchwhat = '';
$description = mysqli_real_escape_string($con, $_GET['description']);
if ($description == '0') {
  $searchwhat = " AND productName LIKE '%".$term_name."%' ";
} else {
  $searchwhat = "AND (productName LIKE '%".$term_name."%' OR description LIKE '%".$term_name."%')";
}

$sql = "SELECT * FROM product WHERE category LIKE '%".$term_cat."%' $searchwhat AND endDateTime LIKE '%".$term_endDate."%' $highlow";
$r_query = mysqli_query($con, $sql);
}
?>
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
        <th onclick="sortTable(5)">End Date</th>
        <th onclick="sortTable(5)">End Time</th>
        <th> Watchlist</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($r_query != null) {
      while ($row = mysqli_fetch_array($r_query)) {
          if((time() - strtotime($row['endDateTime']) <= 0)) {
        ?>
      <tr>
        <td><a href="details.php?id=<?php echo $row['productID'] ?>"><?php echo $row['productName'];?></a></td>
        <td><?php echo $row['description'];?></td>
        <td><?php echo $row['category'];?></td>
        <td><?php echo $row['startPrice'];?></td>
        <td><?php echo $row['reservePrice'];?></td>
        <td><?php echo substr($row['endDateTime'], 0, 10);?></td>
        <td><?php echo substr($row['endDateTime'], 11, 16);?></td>
        <form method="post">
        <input type="hidden" name="productID" value="<?php echo $row['productID']; ?>">
        <input id="productName" type="hidden" name="productName" value="<?php echo $row['productName']; ?>">
        <td><button type="submit" name="add-watchlist" value="add-watchlist" class="btn btn-primary">Add To Watchlist</button></td>
        </form>
      </tr>
    <?php
  }
  }
  } ?>
    </tbody>
  </table>
</div>

</body>

<?php
if (isset($_POST['add-watchlist'])) {
  $userID = $_SESSION['userID'];
  $productName = mysqli_escape_string($con, $_POST['productName']);
  $productID = mysqli_escape_string($con, $_POST['productID']);
  $sql = "SELECT * FROM watchlist WHERE productID=$productID AND userID=$userID";
  $result = mysqli_query($con, $sql) or die ($mysqli->error());
  if ($result->num_rows == 0) {
$stmt = $con->prepare("INSERT INTO watchlist (userID, productID)
VALUES (?,?)");
$stmt->bind_param("ss", $_SESSION['userID'], $_POST['productID']);
$stmt->execute();
echo "done";
$con->close();
} else { ?>

    <div class="alert alert-warning">
  <p><strong>Warning!</strong> you already have added <?php $productName ?> to your watchlist;</p>
</div>

<?php
}
}
?>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
