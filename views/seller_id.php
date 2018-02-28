<?php
require '../assets/php/connect.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
<p> Seller </p>
</head>
<body>
  <div>
    <form method="get">
  </div>
  </form>
  <?php
    if (isset($_POST['userID'])) {
      $endtime= mysqli_escape_string($con, $_POST['endtime']);

      $sql_et = "SELECT endtime FROM bid;";
      $result_endtime = mysqli_query($con, $sql_et);
//* $starttime and similar needs cleaning before database querying, etc.
      $countdown = $result_starttime->diff($result_endtime);



    $sql = "SELECT MAX(amount) AS Current Bid FROM bid;";
    $r_query_max = mysqli_query($con, $sql);

    $sql = "SELECT * FROM product;";
    $r_query = mysqli_query($con, $sql);

    }
    ?>

    <?php
    $sql = "SELECT endDateTime FROM product WHERE productID=30;";
    $r_query_DT = mysqli_query($con, $sql);
    $time = '';
    if ($r_query_DT != null) {
    while ($row = mysqli_fetch_array($r_query_DT)) {
      $time = $row['endDateTime'];
      echo $time;
    }
  }
     ?>


    <p id="timer"></p>

    <script>
    var countdownDate = new Date("<?php echo $time ?>").getTime();
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countdownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("timer").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "EXPIRED";
        }
    }, 1000);
    </script>

    <div class="container">
        <p><?php echo $_SESSION['userID'];?><p>
      <h2>Current Status</h2>
      <a class="btn btn-lg btn-primary btn-block" href="bid.php">Current Status</a>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Start Price</th>
            <th>Amount</th>
            <th>Time Remaining</th>
            <th>ProductID</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($r_query != null) {
          while ($row = mysqli_fetch_array($r_query)) { ?>
          <tr>
            <td><?php echo $row['productName'];?></td>
            <td><?php echo $row['startPrice'];?></td>
            <td><?php echo $row['amount'];?></td>
            <td><p id="timer"></p></td>
            <td><?php echo $row['productID'];?></td>
            <form method="post">
            <input type="hidden" name="productID" value="<?php echo $row['productID']; ?>">
            </form>
          </tr>
        <?php }
      } ?>

</form>
</body>
<?php
if (isset($_POST['submit-seller'])) {
$stmt = $con->prepare("INSERT INTO feedback (minprice, starttime, endtime)
VALUES (?,?,?)");
$stmt->bind_param("ss", $_POST['minprice'], $_POST['starttime'], $_POST['endtime']);
$stmt->execute();
echo "done";
$con->close();
}
?>
</html>
