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

// sql to create table
$sql = "CREATE TABLE Users
(
 id INTEGER AUTO_INCREMENT PRIMARY KEY,
 first_name VARCHAR(40) NOT NULL,
 address_line_1 VARCHAR(60) NOT NULL,
 address_line_2 VARCHAR(60) NOT NULL,
 address_line_3 VARCHAR(60) NOT NULL,
 admin boolean NOT NULL,
 reg_date TIMESTAMP
)
ENGINE = InnoDB;";

if ($con->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

$con->close();
?>
