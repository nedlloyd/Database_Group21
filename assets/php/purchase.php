<?php
require 'connect.php';


// query finds the last time the databaase was checked for expired products
$sql = "SELECT * FROM lastChecked";
$r_query = mysqli_query($con, $sql);

$lastChecked = '';
while ($row = mysqli_fetch_array($r_query)) {
  $lastChecked = $row['lastChecked'];
 }



//  See report for explanation of query
 $sql = "SELECT a.bidID, a.amount, p.endDateTime, p.reservePrice
 FROM bid a
 INNER JOIN (
   SELECT productID, MAX(amount) amount
   FROM bid
   GROUP BY productID) b
   ON a.productID = b.productID
   AND a.amount = b.amount
   INNER JOIN product p
   ON a.productID=p.productID
   WHERE p.endDateTime < CURRENT_TIMESTAMP;";
 $r_query = mysqli_query($con, $sql);
 $sql = "";

$_SESSION['reservePrice'] = '';
$i = 0;
echo $row['reservePrice'];
 while ($row = mysqli_fetch_array($r_query)) {

   // if the expired product expired after the last time the database was checked
    if (strtotime($lastChecked) < strtotime($row['endDateTime'])) {
      echo $row['reservePrice'];
      // if the reserve price was less than the highest bid the bidID is not entered into the purchase table
       if ($row['reservePrice'] <= $row['amount']) {
        if ($i == 0) {
          $sql = "INSERT INTO purchase (bidID) VALUES";
          $i++;
        } else if ($i != 0) {
          $sql = $sql . ',';
        }
        $sql = $sql . ' (' . $row['bidID'] . ')';
      } else {
        $_SESSION['reservePrice'] = "Highest bid is less than reserve Price";
      }
    }

    }
    $sql = $sql . ';';



    if ($con->query($sql) === TRUE) {
        echo "Table last checked created successfully";
    } else {
        echo "Error updating table: " . $con->error;

    }

// the last time the database was checked is deleted from the table
 $sql = "DELETE FROM lastChecked;";

 if ($con->query($sql) === TRUE) {
 } else {
     echo "Error deleting row: " . $con->error;
 }

// the most recent time the database was checked is added to the table 
    $sql = "INSERT INTO lastChecked (lastChecked) VALUES (CURRENT_TIMESTAMP);";

    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error adding new row: " . $con->error;
    }

 ?>


 <!-- SELECT a.bidID, a.amount, p.endDateTime, p.reservePrice FROM bid a INNER JOIN (SELECT productID, MAX(amount) amount FROM bid GROUP BY productID) b ON a.productID = b.productID AND a.amount = b.amount INNER JOIN product p ON a.productID=p.productID WHERE p.endDateTime < CURRENT_TIMESTAMP;

 SELECT a.productID, a.userID, a.amount FROM bid a INNER JOIN (SELECT productID, MAX(amount) amount FROM bid GROUP BY productID) b ON a.productID = b.productID AND a.amount = b.amount INNER JOIN product p ON a.productID=p.productID INNER JOIN users u ON u.id=a.userID WHERE p.endDateTime < CURRENT_TIMESTAMP; -->
