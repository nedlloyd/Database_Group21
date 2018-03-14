<?php

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

// slecting all bids from the bid table
$sql = "SELECT * FROM bid";
$r_query = mysqli_query($con, $sql);

$userProducts = [];


while ($row = mysqli_fetch_array($r_query)) {
    // for each bid if the userID(buyerID) equals the current logged in user and it is not already in the array $userProducts
  if ($row['userID'] == $userID && (!in_array($row['productID'], $userProducts))) {
    // product is added to the array $userProducts
      array_push($userProducts, $row['productID']);
  }
}


$otherBuyers = [];

//selecting all bids from bid table
$sql = "SELECT * FROM bid";
$r_query = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($r_query)) {
  // if the bid is in the array $userProducts and the userID(buyerID) does not equal the current logged in user
  // i.e. the userID for each user who has bid on a similar item to the logged in user is added to the array $otherbuyers
  if (in_array($row['productID'], $userProducts) && $row['userID'] != $userID) {
      $buyer = $row['userID'];
      // the user ID is added to the array $otherbuyers
      array_push($otherBuyers, $buyer);

  }

}

// values is an array counting up each distinct userID in the array $otherBuyers
// to each distint userID a number is assigned corresponing to the number of times that element appears in $otherBuyers
$values = array_count_values($otherBuyers);
// the values are sorted from highest (number of instances of a certain userID)to lowest (number of instances of a certain userID)
arsort($values);
// the top 2 userIDs from the array are taken and assigned to the array $popular
$popular = array_slice(array_keys($values), 0, 2, true);


// as long as the array popular is not null (i.e. there are no other users who have bought the same items the the user logged in)
if ($popular != NULL) {

// the first $id variable is set as the first userID from the array $popular
$id1 = $popular[0];
$id2 = $popular[1];

// all userIDs(buyerIDs) and productIDs for items that have not yet ended
$sql = "SELECT b.userID, p.productID FROM bid b INNER JOIN product p ON p.productID=b.productID WHERE p.endDateTime > CURRENT_TIMESTAMP";
$r_query = mysqli_query($con, $sql);

$filteredProducts = [];

while ($row = mysqli_fetch_array($r_query)) {
  // all products that have been bid on by the two usersIDs contained in the $popular array
  // but have not been bid on by the current logged in user
  // are added to the the $userProducts array
  if (($row['userID'] != $_SESSION['userID']) && (($row['userID'] == $id1) || ($row['userID'] == $id2))) {
    // only products that have not been bid on by the current user
    if ((!in_array($row['productID'], $userProducts))) {

      array_push($filteredProducts, $row['productID']);
    }
  }
}

// number of instances of each product form the array $filteredProducts is counted and placed in the array $valuesProducts
$valuesProducts = array_count_values($filteredProducts);

// the array is sorted so the highest number is at the front
arsort($valuesProducts);
// the 4 most common items from the $valuesProducts are taken
$popularProducts = array_slice(array_keys($valuesProducts), 0, 4, true);

// these four most popular products are a set as a session
$_SESSION['popularProducts'] = $popularProducts;


$con->close();
}
?>
