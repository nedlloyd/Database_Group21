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
echo $userID;

$sql = "SELECT * FROM bid";
$r_query = mysqli_query($con, $sql);

$userProducts = [];

while ($row = mysqli_fetch_array($r_query)) {
  if ($row['userID'] == $userID && (!in_array($row['productID'], $userProducts))) {
      array_push($userProducts, $row['productID']);
  }
}

// sql to create table
// $sql = "CREATE TABLE filtering
// (
//  userID VARCHAR(50) NOT NULL,
//  similarItems int(3) NOT NULL,
// )
// ENGINE = InnoDB;";
//
// if ($con->query($sql) === TRUE) {
//     echo "Table filtering created successfully";
// } else {
//     echo "Error creating table: " . $con->error;
// }

$otherBuyers = [];

$sql = "SELECT * FROM bid";
$r_query = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($r_query)) {
  if (in_array($row['productID'], $userProducts) && $row['userID'] != $userID) {
      //$buyer = (object) ['userID' => $row['userID'], 'productID' => $row['productID']];
      $buyer = $row['userID'];
      array_push($otherBuyers, $buyer);

      // $stmt = $con->prepare("INSERT INTO filtering (description, startPrice, reservePrice, productName, endDateTime, category, userID)
      // VALUES (?,?,?,?,?,?,?)");
      // $stmt->bind_param("sssssss", $description, $startPrice, $reservePrice, $productName, $endDateTime, $category, $_SESSION['userID']);
      // $stmt->execute();
  }

}

$values = array_count_values($otherBuyers);
arsort($values);
$popular = array_slice(array_keys($values), 0, 2, true);

// $userID
//
// while ($i = 0; $i < sizeof($otherBuyers); $i++) {
//     if (in_array($otherBuyers[i]['productID']) {
//
//     }
// }

print_r($userProducts);
echo "<br>";
echo "<br>";
print_r($otherBuyers);
echo "<br>";
echo "<br>";
print_r($values);
echo "<br>";
echo "<br>";
print_r($popular);
echo "<br>";
echo "<br>";

$id1 = $popular[0];
$id2 = $popular[1];
echo $id1;
echo $id2;
echo "<br>";
echo "<br>";

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

print_r($filteredProducts);
echo "<br>";
echo "<br>";

$valuesProducts = array_count_values($filteredProducts);
arsort($valuesProducts);
$popularProducts = array_slice(array_keys($valuesProducts), 0, 4, true);

print_r($popularProducts);

$_SESSION('popularProducts') = $popularProducts;


$con->close();
?>
