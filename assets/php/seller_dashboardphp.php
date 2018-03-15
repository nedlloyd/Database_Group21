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

function viewtraffic($productID, $con) {
  $sql = "SELECT * FROM product WHERE productID=$productID";

  $r_query = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($r_query)) {
      $products=array('productID'=>$row['productID'],'view'=>$row['views']);
  }

  return $products;
}


function numberofbid($productID, $con) {
  $sql = "SELECT productID, COUNT(productID) as numbid FROM bid WHERE productID=$productID";

  $r_query = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($r_query)) {
      $products=array('productID'=>$row['productID'],'numbid'=>$row['numbid']);
  }

  return $products;
}


function yourCurrentItemAuctioned($userID, $con) {
	// $sql = "SELECT DISTINCT product.productID from bid, product WHERE bid.productID=product.productID AND product.userID=$userID";
	$sql = "SELECT productID from product WHERE userID=$userID";
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




function allBid($productID, $con) {
  $sql = "SELECT * from bid WHERE productID=$productID ORDER BY amount DESC";
  $r_query = mysqli_query($con, $sql);
  $products = array();
  while ($row = mysqli_fetch_array($r_query)) {
      array_push($products, $row);
  }

  return $products;
}


function yourfeedbackAverageSeller($userID, $con) {
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

function allFeedbackSeller($userID, $con) {
  $sql = "SELECT * FROM purchase, product
			WHERE purchase.productID = product.productID AND product.userID=$userID";
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

function findbuyeremail ($productID, $con){
 $sql = "SELECT userID, email FROM purchase AS p JOIN users AS u ON p.userID=u.ID WHERE productID=$productID";
  $r_query = mysqli_query($con, $sql);

  $products = "";

  while ($row = mysqli_fetch_array($r_query)) {
  $products=$row['email'];
  }


return $products;
}
	
	
	







?>
