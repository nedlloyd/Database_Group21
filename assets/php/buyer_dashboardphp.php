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

  $products=array('amount'=>'');

  $r_query = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($r_query)) {
    if ($row['amount'] != NULL) {
      $products['amount']= $row['amount'];
    }
  }

  return $products;
}

function reservedprice($productID, $con) {
  $sql = "SELECT * from product WHERE productID=$productID";
  $products=array('reservePrice'=>'');

  $r_query = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($r_query)) {
    if ($row['reservePrice'] != NULL) {
      $products['reservePrice']= $row['reservePrice'];
    }
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

function yourfeedbackAverage($userID, $con) {
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
  $sql = "SELECT * from purchase WHERE userID=$userID";
  $r_query = mysqli_query($con, $sql);

  $products = array();

  if ($r_query != null) {

  while ($row = mysqli_fetch_array($r_query)) {
    array_push($products, $row);
  }

} else {
    $products = "empty";
}
return $products;
}

function findSellerEmail($productID, $con) {
  $sql = "SELECT userID, email FROM product AS p JOIN users AS u ON p.userID=u.ID WHERE productID=$productID";
  $r_query = mysqli_query($con, $sql);

  $products = "";

  while ($row = mysqli_fetch_array($r_query)) {
  $products=$row['email'];
  }


return $products;
}

function findTotalUsers($con) {
  $sql = "SELECT COUNT(id) FROM users";
  $r_query = mysqli_query($con, $sql);

  $totalUsers = 0;

  while ($row = mysqli_fetch_array($r_query)) {
  $totalUsers=$row['COUNT(id)'];
  }


  return $totalUsers;

}

function findTotalActiveProducts($con) {
  $sql = "SELECT endDateTime, productID FROM product";
  $r_query = mysqli_query($con, $sql);

  $totalProductsCurrent = 0;
  $totalProductsFinished = 0;

  while ($row = mysqli_fetch_array($r_query)) {
    if ((time() <= strtotime($row['endDateTime']))) {
      $totalProductsCurrent++;
    } else {
      $totalProductsFinished++;
    }
  }

  $totalProducts = array("totalProductsCurrent"=>$totalProductsCurrent, "totalProductsFinished"=>$totalProductsFinished);


  return $totalProducts;

}

function viewAllUsers($con) {
  $sql = "SELECT * FROM users";
  $r_query = mysqli_query($con, $sql);


  return $r_query;
}

function findOtherBidders($userID, $productID, $con) {
  $sql = "SELECT DISTINCT u.email, u.id FROM bid b INNER JOIN users u ON u.id=b.userID WHERE b.productID=$productID;";
  $r_query = mysqli_query($con, $sql);

  $otherBidders = [];

  while ($row = mysqli_fetch_array($r_query)) {

    if ($row['id'] != $userID) {
    array_push($otherBidders, $row['email']);
    echo $row['email'];
    }
  }

  array_unique($otherBidders);

  return $otherBidders;
}

function findFromWatchlist($userID, $productID, $con) {
  $sql = "SELECT  u.email, u.id FROM watchlist w INNER JOIN users u ON u.id=w.userID WHERE w.productID=$productID;";
  $r_query = mysqli_query($con, $sql);

  $otherBidders = [];

  while ($row = mysqli_fetch_array($r_query)) {

    if ($row['id'] != $userID) {
    array_push($otherBidders, $row['email']);
    echo $row['email'];
    }
  }

  array_unique($otherBidders);

  return $otherBidders;
}

?>
