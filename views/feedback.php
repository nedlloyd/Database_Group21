<?php
session_start();
require '../assets/php/connect.php';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Feedback</title>
</head>
<body>
    <form  action="feedback.php" method="POST" enctype="multipart/form-data">
        <p>*Name: <input name="username" type="text" value="" size="30"  required /><br /><p>
        *email: <input name="email" type="email" value="" size="30"  required /><br />
        *Product Name: <input name="productName" type="text" value="" size="30" required /><br />
        *rating score:
            1 <input type="radio" name="rating" value="1">
            2 <input type="radio" name="rating" value="2">
            3 <input type="radio" name="rating" value="3">
            4 <input type="radio" name="rating" value="4">
            5 <input type="radio" name="rating" value="5" checked> <br>
        feedback comment:<br>
        <input name="comments" rows="7" cols="30"><br>
        <input name="productID" type="hidden" value="1"/>
        <input name="userID" type="hidden" value="2"/>
        <input name="doing" type="hidden" value="feedback"/>
        <input type="submit" value="submit" name="submit-feedback"/>
    </form>
</body>
</html>

<?php
if (isset($_POST['submit-feedback'])) {
$stmt = $con->prepare("INSERT INTO feedback (rating, comments)
VALUES (?,?)");
$stmt->bind_param("ss", $_POST['rating'], $_POST['comments']);
$stmt->execute();
echo "done";
$con->close();
}
?>
