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

<?php
if (isset($_POST['add-watchlist'])) {
  $productName = mysqli_escape_string($con, $_POST['productName']);
  $productID = mysqli_escape_string($con, $_POST['productID']);
  $sql = "SELECT * FROM watchlist WHERE productID=$productID";
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
