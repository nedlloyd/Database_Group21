<?php
session_start();
require '../assets/php/connect.php';


$sql = "SELECT userID FROM product WHERE productID=49;";
$r_query = mysqli_query($con, $sql);
$productUserID = '';
if ($r_query != null) {
while ($row = mysqli_fetch_array($r_query)) {
  $productUserID = $row['userID'];
}
}

if ($_SESSION['userID'] != $productUserID){
$sql = "UPDATE product SET views= views + 1 WHERE productID=49";
$con->query($sql);
}
?>

<?php
$descriptionErr = $startPriceErr = $reservePriceErr = $productNameErr = $endDateTimeErr = $categoryErr = "";

if (isset($_POST['submit-product'])) {
  if (empty($_POST["description"])) {
    $descriptionErr = "Description is required";
  } else {
    $description = mysqli_escape_string($con, $_POST['description']);
  }
  if (empty($_POST["startPrice"])) {
    $startPriceErr = "Start price is required";
  } else {
    $startPrice = mysqli_escape_string($con, $_POST['startPrice']);
  }
  if (empty($_POST["reservePrice"])) {
    $reservePriceErr = "reservePrice is required";
  } else {
    $reservePrice = mysqli_escape_string($con, $_POST['reservePrice']);
  }
  if (empty($_POST["productName"])) {
    $productNameErr = "Product Name is required";
  } else {
    $productName = mysqli_escape_string($con, $_POST['productName']);
  }
  if (empty($_POST["endDateTime"])) {
    $endDateTimeErr = "End Date and Time is required";
  } else {
    if (time() > strtotime($_POST["endDateTime"])) {
      $endDateTimeErr = "Date and Time must not be in the past";
    } else {
    $endDateTime = mysqli_escape_string($con, $_POST['endDateTime']);
  }
  }
  if (empty($_POST["category"])) {
    $categoryErr = "Category is required";
  } else {
    $category = mysqli_escape_string($con, $_POST['category']);
  }


  $stmt = $con->prepare("INSERT INTO product (description, startPrice, reservePrice, productName, endDateTime, category, userID)
  VALUES (?,?,?,?,?,?,?)");
  $stmt->bind_param("sssssss", $description, $startPrice, $reservePrice, $productName, $endDateTime, $category, $_SESSION['userID']);
  $stmt->execute();

  echo "New records created successfully";

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
        <a class="active" href="buyer_dashboard.php">Dashboard</a>
        <a class="active" href="logout.php">Logout</a>
        </div>
      </div>

  </header>


</head>
<body>
    <div class="wrapperforstickyfooter">
  <div class="content-wrap">
    <div class="container">
    <form class="form-horizontal" method="post">
      <fieldset>
        <legend>Add New Product</legend>

        <div class="form-group">
          <label for="productName" class="col-sm-4 control-label">Product Title</label>
          <div class="col-sm-4">
            <input name="productName" type="text" class="form-control" columns="7" id="productName" placeholder="Title">
            <span class="error"><?php echo $productNameErr;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-sm-4 control-label">Description</label>
          <div class="col-sm-4">
            <input name="description" type="text" class="form-control" id="description" placeholder="description">
            <span class="error"><?php echo $descriptionErr;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="startPrice" class="col-sm-4 control-label">Start Price</label>
          <div class="col-sm-4">
            <input name="startPrice" type="number" min="0" class="form-control" columns="7" id="startPrice" placeholder="Reserve Price">
            <span class="error"><?php echo $startPriceErr;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="reservePrice" class="col-sm-4 control-label">Reserve Price</label>
          <div class="col-sm-4">
            <input name="reservePrice" type="number" min="0" class="form-control" columns="7" id="reservePrice" placeholder="Reserve Price">
            <span class="error"><?php echo $reservePriceErr;?></span>
          </div>
        </div>



        <div class="form-group">
          <label for="endDateTime" class="col-sm-4 control-label">End Date and Time</label>
          <div class="col-sm-4">
            <input class="form-control" name="endDateTime" id="endDateTime" type="datetime-local" min="<?php echo date('Y-m-d\Th:m'); ?>">
            <span class="error"><?php echo $endDateTimeErr;?></span>
          </div>
        </div>

        </*?php echo date('Y-m-d\Th:m'); */?>
        <br>
        </*?php echo date("h:m"); ?*/>

        <div class="form-group">
          <label for="category" class="col-sm-4 control-label">category</label>
          <div class="col-sm-4">
            <input list="category" name="category" class="form-control">
  <datalist id="category" name="category">
    <?php
    $sql = "SELECT category FROM product;";
    $r_query = mysqli_query($con, $sql);
    $category_array = array();
    while ($row = mysqli_fetch_array($r_query)){
      $category = $row['category'];
      if (!(in_array($category, $category_array))) {
        array_push($category_array, $category);
      echo "<option value='$category'>";
    }
    }
    $con->close();
     ?>
  </datalist>
          </div>
        </div>

        <div class="form-group submit-sign-up">
          <div class="col-sm-8 col-sm-offset-4">
            <button type="submit" name="submit-product" value="submit-product" class="btn btn-primary">Submit</button>
          </div>
        </div>

      </fieldset>
    </form>

</*input name="setTodaysDate" type="date"*/>

    </div>
  </div>
</div>
</body>

  <script> var today = new DateTime().toISOString().split('T')[0];
document.getElementsByName("setTodaysDate")[0].setAttribute('min', today);</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</html>
