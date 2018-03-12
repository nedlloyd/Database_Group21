<?php
require '../assets/php/connect.php';

function sellinghist($userID, $con) {
	$sql = "SELECT * FROM product WHERE userID = $userID";
	$r_query = mysqli_query($con, $sql);
	$products = array();
	while ($row = mysqli_fetch_array($r_query)) {
	   array_push($products, $row);
	}

	return $products;
}


function yourCurrentItemAuctioned($userID, $con) {
	$sql = "SELECT bid.productID from bid, product WHERE bid.productID=product.productID AND product.userID=$userID";

	$r_query = mysqli_query($con, $sql);
	$products = array();
	while ($row = mysqli_fetch_array($r_query)) {
		array_push($products, $row);
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


function allBid($productID, $con) {
  $sql = "SELECT * from bid WHERE productID=$productID ORDER BY amount DESC";

  $r_query = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($r_query)) {
      $products=array('productID'=>$row['productID'],'amount'=>$row['amount'], 'bidID'=>$row['bidID'], 'userID'=>$row['userID']);
  }

  return $products;
}


function yourfeebackAverage($userID, $con) {
  $sql = "SELECT ROUND(AVG(purchase.ratingSeller),2)AS rateSeller FROM purchase, product
			WHERE purchase.productID = product.productID AND product.userID=$userID";
  $r_query = mysqli_query($con, $sql);
  if ($r_query != null) {
  $av = '';
  while ($row = mysqli_fetch_array($r_query)) {
  $av = $row['rateSeller'];
  }
  } else {
    $av = "empty";
  }

  return $av;
}

function allFeedback($userID, $con) {
  $sql = "SELECT purchase.commentsSeller AS commentsSeller, purchase.ratingSeller AS ratingSeller, purchase.productID AS productID FROM purchase, product
			WHERE purchase.productID = product.productID AND product.userID=$userID";
  $r_query = mysqli_query($con, $sql);

    $products = "";

  if ($r_query != null) {

  while ($row = mysqli_fetch_array($r_query)) {
    $products=array($row);
  }


} else {
    $products = "empty";
}
return $products;
}

?>
