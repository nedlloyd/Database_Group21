<?php
require 'connect.php';


$sql = "SELECT * FROM lastChecked";
$r_query = mysqli_query($con, $sql);

$lastChecked = '';
while ($row = mysqli_fetch_array($r_query)) {
  $lastChecked = $row['lastChecked'];
 }




 $sql = "SELECT a.productID, a.userID, a.amount, p.endDateTime
 FROM bid a
 INNER JOIN (
   SELECT productID, MAX(amount) amount
   FROM bid
   GROUP BY productID) b
   ON a.productID = b.productID
   AND a.amount = b.amount
   INNER JOIN product p
   ON a.productID=p.productID
   INNER JOIN users u
   ON u.id=a.userID
   WHERE p.endDateTime < CURRENT_TIMESTAMP;";
 $r_query = mysqli_query($con, $sql);
 $sql = "";

$i = 0;
 while ($row = mysqli_fetch_array($r_query)) {

    if (strtotime($lastChecked) < strtotime($row['endDateTime'])) {
     if ($i == 0) {
       $sql = "INSERT INTO purchase (productID, userID) VALUES";
      $i++;
     } else if ($i != 0) {
       $sql = $sql . ',';
     }
     $sql = $sql . ' (' . $row['productID'] . ', ' . $row['userID'] . ')';
  }

    }
    $sql = $sql . ';';



    if ($con->query($sql) === TRUE) {
        echo "Table last checked created successfully";
    } else {
        echo "Error updating table: " . $con->error;

    }

 $sql = "DELETE FROM lastChecked; ;";

 if ($con->query($sql) === TRUE) {
 } else {
     echo "Error deleting row: " . $con->error;
 }

    $sql = "INSERT INTO lastChecked (lastChecked) VALUES (CURRENT_TIMESTAMP);";

    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error adding new row: " . $con->error;
    }

 ?>


 <!-- SELECT a.productID, a.userID, a.amount, p.endDateTime FROM bid a INNER JOIN (SELECT productID, MAX(amount) amount FROM bid GROUP BY productID) b ON a.productID = b.productID AND a.amount = b.amount INNER JOIN product p ON a.productID=p.productID INNER JOIN users u ON u.id=a.userID WHERE p.endDateTime < CURRENT_TIMESTAMP;

 SELECT a.productID, a.userID, a.amount FROM bid a INNER JOIN (SELECT productID, MAX(amount) amount FROM bid GROUP BY productID) b ON a.productID = b.productID AND a.amount = b.amount INNER JOIN product p ON a.productID=p.productID INNER JOIN users u ON u.id=a.userID WHERE p.endDateTime < CURRENT_TIMESTAMP; -->
