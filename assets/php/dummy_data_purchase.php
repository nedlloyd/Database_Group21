<?php
$connectstr_dbhost = "group21-mysql-server.mysql.database.azure.com";
$connectstr_dbusername = "group21@group21-mysql-server";
$connectstr_dbname = 'online_auction_db';
$connectstr_dbpassword = 'COMPGC06@@';

$con=mysqli_init();

mysqli_real_connect($con, $connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword, $connectstr_dbname, 3306);


$a = 59;







$stmt = $con->prepare("INSERT INTO purchase (userID, productID, ratingSeller, commentsSeller, ratingBuyer, commentsBuyer)
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", 59, 49, 2, "bad product", 3, "too many homeworks");
$stmt->execute();

$stmt = $con->prepare("INSERT INTO purchase (userID, productID, ratingSeller, commentsSeller, ratingBuyer, commentsBuyer)
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", 56, 50, 3, "awesome, but I dont want to give a high rate", 1, "I dont care");
$stmt->execute();

$stmt = $con->prepare("INSERT INTO purchase (userID, productID, ratingSeller, commentsSeller, ratingBuyer, commentsBuyer)
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", 58, 58, 2, "poor quality", 3, "good person");
$stmt->execute();

$stmt = $con->prepare("INSERT INTO purchase (userID, productID, ratingSeller, commentsSeller, ratingBuyer, commentsBuyer)
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", 59, 59, 5, "best ever", 5, "nice person");
$stmt->execute();

?>
