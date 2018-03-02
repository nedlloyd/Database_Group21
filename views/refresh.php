<?php
session_start();
require '../assets/php/connect.php';
?>

<!DOCTYPE html>
<html>
<body>

<button onclick="myFunction()">Refresh</button>

<script>
function myFunction() {
    location.reload();
}
</script>

</body>
</html>
