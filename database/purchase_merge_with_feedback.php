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


// add_column
$sql = "ALTER TABLE purchase ADD COLUMN ratingSeller VARCHAR(120);";

if ($con->query($sql) === TRUE) {
    echo "column added";
} else {
    echo "column added" . $con->error;
}

// add_column
$sql = "ALTER TABLE purchase ADD COLUMN commentsSeller VARCHAR(300);";

if ($con->query($sql) === TRUE) {
    echo "column added";
} else {
    echo "column added" . $con->error;
}

// add_column
$sql = "ALTER TABLE purchase ADD COLUMN ratingBuyer VARCHAR(120);";

if ($con->query($sql) === TRUE) {
    echo "column added";
} else {
    echo "column added" . $con->error;
}

// add_column
$sql = "ALTER TABLE purchase ADD COLUMN commentsBuyer VARCHAR(300);";

if ($con->query($sql) === TRUE) {
    echo "column added";
} else {
    echo "column added" . $con->error;
}

$con->close();
?>