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
$sql = "ALTER TABLE product DROP COLUMN startDateTime;";
if ($con->query($sql) === TRUE) {
    echo "column removed startDateTime";
} else {
    echo "removing column: startDateTime" . $con->error;
}


// add_column
$sql = "ALTER TABLE product ADD COLUMN startTime TIME;";

if ($con->query($sql) === TRUE) {
    echo "column added startTime";
} else {
    echo "column added startTime" . $con->error;
}

// add_column
$sql = "ALTER TABLE product ADD COLUMN startDate DATE;";

if ($con->query($sql) === TRUE) {
    echo "column added startDate";
} else {
    echo "column added startDate" . $con->error;
}

//remove column
$sql = "ALTER TABLE product DROP COLUMN endDateTime;";
if ($con->query($sql) === TRUE) {
    echo "column removed endDateTime";
} else {
    echo "removing column: endDateTime" . $con->error;
}


// add_column
$sql = "ALTER TABLE product ADD COLUMN endTime TIME;";

if ($con->query($sql) === TRUE) {
    echo "column added endTime";
} else {
    echo "column added endTime" . $con->error;
}

// add_column
$sql = "ALTER TABLE product ADD COLUMN endDate DATE;";

if ($con->query($sql) === TRUE) {
    echo "column added endDate";
} else {
    echo "column added endDate" . $con->error;
}

$con->close();
?>
