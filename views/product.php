<?php
session_start();
require '../assets/php/connect.php';
?>


<?php
#$message = '';
#$db = new MySQLi('localhost', 'phpwebdes', 'lynda', 'product');
#if ($db->connect_error) {
#	$message = $db->connect_error;
#} else {
#	$sql = "SELECT * FROM arrangements";
#	$result = $db -> query($sql);
#	if ($db -> error) {
#		$message = $db -> error;
#	}
#}
?>


<?php

$message = '';
if ($con->connect_error) {
	$message = $con->connect_error;
} else {
	$sql = "SELECT * FROM product";
	$result = $con -> query($sql);
	if ($con -> error) {
		$message = $con -> error;
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
	    <a class="active" href="login.php">Login</a>
	    <a class="active" href="sign_up.php">Signup</a>
	  </div>
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

		<div class="page open">
			<?php
				$i = 0;
				while ($row = $result -> fetch_assoc()) {
					if ($i % 4 === 0 ) {
					?>
					<div class="section">
						<ul class="product">
						<?php } ?>
							<li> <a href="details.php?id=<?php echo $row['productID'] ?>"> <img src="../images/images/<?php echo $row['image']; // need to change  ?>" alt="<?php echo $row['category']; ?> " height="200" width="200">
								<h3 class="h4"><?php echo $row['productName']; ?></h3>
								<p class="reset">From $<?php echo $row['startPrice']; ?></p>
								</a> </li>

						<?php $i++;
						if ($i % 4 === 0 ) { ?>
						</ul>
					</div>
			<?php } // end of if
			} // end of loop ?>
		</div>

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
