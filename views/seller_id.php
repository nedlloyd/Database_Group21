<?php
require '../assets/php/connect.php';
session_start();

?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/application.css">

  <header role="banner" class="header-reports">
    <div class="content-wrap">
      <img class="logo" src="../images/Logo-Logo.svg.png" alt="AMRC Logo">
      <div class='btn-toolbar pull-right'>
        <div class='btn-group'>
          <button type="button" class="btn btn-default templateBtnToolbar contactLogin">
            <a class="active" href="contactemail.php"></span> Contact Us</a>
          </button>
        </div>
        
        <div>

        </div>

        <script>
        function goForward() {
            window.history.forward();
        }
        </script>
        <script>
          function goBack() {
              window.history.back()
          }
          </script>
        <body>
          <a button onclick="goBack()">&laquo; Previous</a>
          <a button onclick="goForward()">Next &raquo;</a>
        </body>
      </div>
      <h1 class="loginTitle"> Esway </h1>
    </div>

    <div class="top-container">
      <div class="header" id="header">
        <a class="active" href="search_product.php">Home</a>
        <a class="active" href="logout.php">Logout</a>
        </div>
      </div>
    </div>

  </header>
</form>

<!DOCTYPE html>
<html>
<head>
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
    $sql = "SELECT endDateTime FROM product WHERE productID=60;";
    $r_query_DT = mysqli_query($con, $sql);
    $time = '';
    if ($r_query_DT != null) {
    while ($row = mysqli_fetch_array($r_query_DT)) {
      $time = $row['endDateTime'];
      echo $time;
    }   /*$_POST['varname'] = $var_name;?>*/
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
      <h2>Current Product Bidding Status</h2>
      <button onclick="myFunction()">Refresh page</button>
      <script>
      function myFunction() {
          location.reload();
      }

      </script>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>ProductID</th>
            <th>Start Price</th>
            <th>Amount</th>
            <th>Time Remaining</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($r_query != null) {
          while ($row = mysqli_fetch_array($r_query)) { ?>
          <tr>
            <td><?php echo $row['productName'];?></td>
            <td><?php echo $row['productID'];?></td>
            <td><?php echo $row['startPrice'];?></td>
            <td><?php echo $row['amount'];?></td>
            <td><p id="timer"></p></td>
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
$stmt = $con->prepare("INSERT INTO bid (amount, timer)
VALUES (?,?,?)");
$stmt->bind_param("ss", $_POST['amount'], $_POST['timer']);
$stmt->execute();
echo "done";
$con->close();
}
?>
</html>
