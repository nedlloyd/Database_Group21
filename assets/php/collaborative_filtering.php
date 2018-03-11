<?php
session_start();

$connectstr_dbhost = "group21-mysql-server.mysql.database.azure.com";
$connectstr_dbusername = "group21@group21-mysql-server";
$connectstr_dbname = 'online_auction_db';
$connectstr_dbpassword = 'COMPGC06@@';

$con=mysqli_init();
// mysqli_ssl_set($con, NULL, NULL, {ca-cert filename}, NULL, NULL);
mysqli_real_connect($con, $connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword, $connectstr_dbname, 3306);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$userID = $_SESSION['userID'];


$sql = "SELECT * FROM bid";
$r_query = mysqli_query($con, $sql);

$userProducts = [];

while ($row = mysqli_fetch_array($r_query)) {
  if ($row['userID'] == $userID && (!in_array($row['productID'], $userProducts))) {
      array_push($userProducts, $row['productID']);
  }
}


$otherBuyers = [];

$sql = "SELECT * FROM bid";
$r_query = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($r_query)) {
  if (in_array($row['productID'], $userProducts) && $row['userID'] != $userID) {
      $buyer = $row['userID'];
      array_push($otherBuyers, $buyer);

  }

}

$values = array_count_values($otherBuyers);
arsort($values);
$popular = array_slice(array_keys($values), 0, 2, true);


$id1 = $popular[0];
$id2 = $popular[1];

$sql = "SELECT * FROM bid";
$r_query = mysqli_query($con, $sql);

$filteredProducts = [];

while ($row = mysqli_fetch_array($r_query)) {
  if (($row['userID'] != $_SESSION['userID']) && (($row['userID'] == $id1) || ($row['userID'] == $id2))) {
    if ((!in_array($row['productID'], $userProducts))) {

      array_push($filteredProducts, $row['productID']);
    }
  }
}

$valuesProducts = array_count_values($filteredProducts);
arsort($valuesProducts);
$popularProducts = array_slice(array_keys($valuesProducts), 0, 4, true);

$_SESSION['popularProducts'] = $popularProducts;


$con->close();
?>
