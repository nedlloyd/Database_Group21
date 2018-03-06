<?php
session_start();
require '../assets/php/connect.php';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>purchase</title>
</head>
<body>
<h1>purchase</h1>
    <form  action="do.php" method="POST" enctype="multipart/form-data">
        *purchase_orderID: <input name="purchase_orderID" type="text" value="" size="30"  required /><br />
        *productID: <input name="productID" type="text" value="" size="30"  required /><br />
        *purchase comfirmation :
            Yes <input type="radio" name="Yes" value="1">
            No<input type="radio" name=" No" value="2" checked> <br>
        *payment:
            credit card<input type="radio" name="cride card" value="1">
            paypal<input type="radio" name=" paypal" value="2">
            other<input type="radio" name=" other" value="3" checked> <br>

        <input name="productID" type="hidden" value="1"/>
        <input name="userID" type="hidden" value="$_SESSION['userID']"/>
        <input name="doing" type="hidden" value="feedback"/>
        <input type="submit" value="submit" name="submit-purchase"/>
    </form>
</body>
</html>
