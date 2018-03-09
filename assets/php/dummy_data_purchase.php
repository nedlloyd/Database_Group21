<?php
$connectstr_dbhost = "group21-mysql-server.mysql.database.azure.com";
$connectstr_dbusername = "group21@group21-mysql-server";
$connectstr_dbname = 'online_auction_db';
$connectstr_dbpassword = 'COMPGC06@@';

$con=mysqli_init();

mysqli_real_connect($con, $connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword, $connectstr_dbname, 3306);


$stmt = $con->prepare("INSERT INTO purchase (userID, productID, ratingSeller, commentsSeller, ratingSeller, commentsSeller)
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", );
$stmt->execute();

$stmt = $con->prepare("INSERT INTO purchase (userID, productID, ratingSeller, commentsSeller, ratingSeller, commentsSeller)
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", );
$stmt->execute();

$stmt = $con->prepare("INSERT INTO purchase (userID, productID, ratingSeller, commentsSeller, ratingSeller, commentsSeller)
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", );
$stmt->execute();

$stmt = $con->prepare("INSERT INTO purchase (userID, productID, ratingSeller, commentsSeller, ratingSeller, commentsSeller)
VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", );
$stmt->execute();

?>
