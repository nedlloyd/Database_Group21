<?php
session_start();
require '../assets/php/connect.php';
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


<?php

if (isset($_POST['addtobasket'])) {
	foreach ($_POST AS $key => $value) {
		if (strpos($key, 'qty_') === 0) {
			$_SESSION['quantity'][substr($key, 4)] = $value;
		}
		if (strpos($key, 'image_') === 0) {
			$_SESSION['image'][substr($key, 6)] = $value;
		}
		if (strpos($key, 'price_') === 0) {
			$_SESSION['price'][substr($key, 6)] = $value;
		}
	}
}

// unset($_SESSION['quantity']['Peruvian_Lilies']);
if (isset($_POST['cancel'])) {
	$_SESSION = array();
	session_destroy();
}

$total = 0;
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
  <link rel="stylesheet" href="../../Database_Group21/assets/stylesheets/application.css">

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

		<div class="top-container">
	    <div class="header" id="header">
	      <a class="active" href="http://localhost/Database_Group21/views/product.php">Home</a>
				<a class="active" href="http://localhost/Database_Group21/views/buyer_dashboard.php">Dashboard</a>
				<a class="active" href="http://localhost/Database_Group21/views/logout.php">Logout</a>
	      </div>
	    </div>
	  </div>

  </header>


</head>
<body>
	<div id="content">
		<div id="col_1" role="main">

			<?php if ($message) {
			echo "<h2>$message</h2>";
			} else { ?>

            <h1 class="inline_block">Your Order</h1>
            <?php if (!isset($_SESSION['quantity']) || array_sum($_SESSION['quantity']) === 0) { ?>
            <p>Your basket is empty.</p>
            <?php } else { ?>
            <p>Please check the details of your order.</p>
				<table id="order_details">
				    <tr>
				        <th scope="col">&nbsp;</th>
				        <th scope="col">Item</th>
				        <th scope="col">Quantity</th>
				        <th scope="col">Cost</th>
			        </tr>
                    <?php foreach ($_SESSION['quantity'] AS $productid => $amount):
					if ($amount > 0) :
					?>
				    <tr>
				        <td><img src="../images/images/<?php echo $_SESSION['image'][$productid]; ?>"
								 alt="" width="80" height="80"/></td>

				        <td><?php echo $amount; ?></td>
				        <td>$<?php echo $cost = $amount * intval($_SESSION['price'][$productid]);
						$total += $cost; ?></td>
			        </tr>
                    <?php
					endif;
					endforeach; ?>
                    <tr>
                       <td>Shipping</td>
                       <td><?php
                       if ($total < 35) {
						   echo '$5';
						   $total += 5;
					   } else {
						   echo 'FREE';
					   }
					   ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>$<?php echo $total; ?></td>
                    </tr>
			    </table>
            <div id="order_buttons">
            <form method="post">
                <input class="btn alt" value="Cancel Order" name="cancel" id="cancel" type="submit">
                <input class="btn checkout" value="Confirm Order" type="submit">
            </form>
            </div>
            <?php } ?>

			<?php }  // end of page ?>
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
