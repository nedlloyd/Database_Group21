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

//remove column
$sql = "ALTER TABLE users CHANGE first_name name varchar(100);";
if ($con->query($sql) === TRUE) {
    echo "column name changed";
} else {
    echo "error changing column name: " . $con->error;
}

$con->close();
?>
