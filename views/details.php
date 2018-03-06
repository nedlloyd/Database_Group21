<?php
session_start();
require '../assets/php/connect.php';
?>


<?php
$message = '';

$productID = mysqli_escape_string($con, $_GET['id']);
echo $_GET['id'];

$sql = "SELECT userID FROM product WHERE productID=$productID;";
$r_query = mysqli_query($con, $sql);
$productUserID = '';
if ($r_query != null) {
while ($row = mysqli_fetch_array($r_query)) {
  $productUserID = $row['userID'];
}
}
echo $_SESSION['userID'];
if ($_SESSION['userID'] != $productUserID){
$sql = "UPDATE product SET views= views + 1 WHERE productID=$productID";
$con->query($sql);
}

if ($con->connect_error) {
	$message = $con->connect_error;
} else {
	$sql = "SELECT * FROM product WHERE productID=" . $con->real_escape_string($_GET['id']);
	$result = $con -> query($sql);
	if ($con -> error) {
		$message = $con -> error;
	} else {
		$row = $result -> fetch_assoc();

	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- Viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- IE Edge Meta Tag// edge means the browser should use the best and newest machine -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="../assets/stylesheets/application.css">

  <!-- Optional IE8 Support -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Minified CSS -->

  <header role="banner" class="header-reports">
    <div class="content-wrap">
      <img class="logo" src="../images/Logo-Logo.svg.png" alt="AMRC Logo">
      <div class='btn-toolbar pull-right'>
        <div class='btn-group'>
          <button type="button" class="btn btn-default templateBtnToolbar contactLogin">
            <span class="glyphicon glyphicon-envelope"></span> Contact Us
          </button>
        </div>
      </div>

      <h1 class="loginTitle"> Esway </h1>

    </div>
  </header>


</head>


<body>
	<div id="site">
		<div id="content">


			<div id="col_1" role="main">

				<?php if ($message) {
				echo "<h2>$message</h2>";
				} else { ?>

				<form action="basket.php" method="post" id="bab_form" class="basket_add clearfix">
				<h1 class="inline_block"><?php echo $row['productName']; ?></h1>
            	<p class="figure"><img src="../images/images/<?php echo $row['image']; ?>" alt="<?php echo $row['category']; ?>" width="200" height="200">Price from $<?php echo $row['startPrice']; ?></p>
            	<?php echo $row['description']; ?>

				<div class="qty">
                       <label for="qty">Quantity</label>
                       <input value="0" name="qty_<?php echo $row['productID'] ?>" id="qty" class="text" type="number" min="0">
                </div>

				<input type="hidden" name="price_<?php echo $row['productID'] ?>" value="<?php echo $row['startPrice'] ?>">

				<input type="hidden" name="image_<?php echo $row['productID'] ?>" value="<?php echo $row['image'] ?>">


				<div id="addtobask">
					<!-- if not login, jump into login page -->

					<input class="btn checkout" value="Add to Basket" type="submit" name="addtobasket">
				</div>


				</form>
				<?php
				if (isset($_POST['addtobasket'])){
					print_r($_POST);
				}
				?>

				<?php }  // end of page ?>
			</div>


		</div>
	</div>
</body>

  <footer>

  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</html>
