<?php

$db_server = "localhost";
$db_name = "webid";
$db_user = "root";
$db_pwd = "CYH2ljudjou";

$dsn = "mysql:host=".$db_server.";dbname=".$db_name.";charset=utf8";
$link = new PDO($dsn, $db_user, $db_pwd);
?>