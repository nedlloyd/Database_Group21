<?php
require '../assets/php/connect.php';

function findProdcuts($tablename, $userID, $con) {
$sql = "SELECT * FROM $tablename WHERE userID = $userID";
$r_query = mysqli_query($con, $sql);
$productIDs = array();
while ($row = mysqli_fetch_array($r_query)) {
   array_push($productIDs, $row['productID']);
}

$sql = "SELECT * FROM product";
$r_query = mysqli_query($con, $sql);
$products = array();
while ($row = mysqli_fetch_array($r_query)) {
   if (in_array($row['productID'], $productIDs)){
      array_push($products, $row);
   }
}
return $products;
}

function highestBid($productID, $con) {
  $sql = "SELECT * from bid WHERE productID=$productID ORDER BY amount DESC LIMIT 1";

  $r_query = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($r_query)) {
      $products=array('productID'=>$row['productID'],'amount'=>$row['amount'], 'bidID'=>$row['bidID'], 'userID'=>$row['userID']);
  }

  return $products;
}

function yourHighestBid($userID, $productID, $con) {
  $sql = "SELECT * from bid WHERE userID=$userID AND productID=$productID";

$products = [];
  $r_query = mysqli_query($con, $sql);
  $biggest = 0;
  while ($row = mysqli_fetch_array($r_query)) {
      $products=array('productID'=>$row['productID'],'amount'=>$row['amount'], 'bidID'=>$row['bidID'], 'userID'=>$row['userID']);
      if ($biggest < $row['amount']) {
        $products=array('productID'=>$row['productID'],'amount'=>$row['amount'], 'bidID'=>$row['bidID'], 'userID'=>$row['userID']);
        $biggest = $row['amount'];
      }
  }

  return $products;
}

function yourfeebackAverage($userID, $con) {
  $sql = "SELECT AVG(ratingBuyer) from purchase WHERE userID=$userID";
  $r_query = mysqli_query($con, $sql);
  if ($r_query != null) {
  $av = '';
  while ($row = mysqli_fetch_array($r_query)) {
  $av = $row['AVG(ratingBuyer)'];
  }
  } else {
    $av = "empty";
  }


  return $av;
}

function allFeedback($userID, $con) {
  $sql = "SELECT commentsBuyer, ratingBuyer from purchase WHERE userID=$userID";
  $r_query = mysqli_query($con, $sql);

    $products = "";

  if ($r_query != null) {

  while ($row = mysqli_fetch_array($r_query)) {
  $products=array('commentsBuyer'=>$row['commentsBuyer'],'ratingBuyer'=>$row['ratingBuyer']);
  print_r($products);
  echo "got here";
  }


} else {
    $products = "empty";
}
return $products;
}

?>
