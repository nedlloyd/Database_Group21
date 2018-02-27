<?php
require '../assets/php/connect.php';
?>

<!DOCTYPE html>
<html>
<head>
<p> Buyer </p>
</head>
<body>

  <form method="post" action="bid.php">

    <label for="userID">userID</label>
    <input type="text" id="userID" name="userID">

    <label for="productID">productID</label>
    <input type="text" id="productID" name="productID">

    <label for="amount">amount</label>
    <input type="float" id="amount" name="amount">

    <div class="input-group">
        <input type="submit" value="Submit">
    </div>

</form>
</body>
</html>

<?php
if (isset($_POST['submit-buyer'])) {
$stmt = $con->prepare("INSERT INTO bid (amount)
VALUES (?)");
$stmt->bind_param("ss", $_POST['amount']);
$stmt->execute();
echo "done";
$con->close();
}
?>
