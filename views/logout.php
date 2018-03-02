<?php
session_start();
require '../assets/php/connect.php';

$_SESSION = array();
session_destroy();
header("location: login.php");
exit;
?>
