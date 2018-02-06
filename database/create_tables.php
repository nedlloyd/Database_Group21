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
$sql = "CREATE TABLE Feedback
(
 feedbackID INTEGER AUTO_INCREMENT PRIMARY KEY,
 rating int(3) NOT NULL,
 comments VARCHAR(500) NOT NULL,
 reg_date TIMESTAMP
)
ENGINE = InnoDB;";

if ($con->query($sql) === TRUE) {
    echo "Table Feedback created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

$sql = "CREATE TABLE Purchase
(
 purchaseID INTEGER AUTO_INCREMENT PRIMARY KEY,
 userID int(10) NOT NULL,
 productID int(10) NOT NULL,
 payementComplete boolean NOT NULL,
 dateAndTimeCompletion DateTime,
 reg_date TIMESTAMP
)
ENGINE = InnoDB;";

if ($con->query($sql) === TRUE) {
    echo "Table purchase created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

$sql = "CREATE TABLE Product
(
 productID INTEGER AUTO_INCREMENT PRIMARY KEY,
 userID int(10) NOT NULL,
 description VARCHAR(500) NOT NULL,
 category VARCHAR(20) NOT NULL,
 startPrice int(10) NOT NULL,
 reservePrice int(10) NOT NULL,
 startDateTime DateTime NOT NULL,
 endDateTime DateTime,
 dateAndTime TIMESTAMP
)
ENGINE = InnoDB;";

if ($con->query($sql) === TRUE) {
    echo "Table product created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

$sql = "CREATE TABLE Bid
(
 bidID INTEGER AUTO_INCREMENT PRIMARY KEY,
 userID int(10) NOT NULL,
 productID int(10) NOT NULL,
 bidDateAndTime DateTime NOT NULL,
 amount int(10) NOT NULL,
 dateAndTime TIMESTAMP
)
ENGINE = InnoDB;";

if ($con->query($sql) === TRUE) {
    echo "Table bid created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

$sql = "CREATE TABLE Watchlist
(
 watchlistID INTEGER AUTO_INCREMENT PRIMARY KEY,
 userID int(10) NOT NULL,
 productID int(10) NOT NULL
)
ENGINE = InnoDB;";

if ($con->query($sql) === TRUE) {
    echo "Table watchlist created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

$con->close();
?>
