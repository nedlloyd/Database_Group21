<?php
session_start();
require '../assets/php/connect.php';
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


</head>
<meta charset="utf-8">
<title>Purchase</title>
</head>
<body>
  <div class="wrapperforstickyfooter">
  <div class="content-wrap">

  <fieldset>
        <legend>Purchase</legend>
  </fieldset>

    <form method="POST"  class="form-horizontal">
    <div class="container">
     <?php
     $sql = "SELECT * FROM purchase WHERE productID='".$_GET['id']."'";
     $result = $con -> query($sql);
     $row = $result -> fetch_assoc();
     if($row){
      if($row['userID'] == $_SESSION['userID']){
      ?> 
        <div class="form-group">
            <label for="payementComplete" class="col-sm-4 control-label">payementComplete</label>
            <div class="col-sm-4">
              <select name="payementComplete" class="form-control" id="payementComplete">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
              <span class="error"></span>

            </div>
        </div>

        <div class="form-group">
            <label for="dateAndTimeCompletion" class="col-sm-4 control-label">dateAndTimeCompletion</label>
            <div class="col-sm-4">
            <input name="dateAndTimeCompletion" type="text" class="form-control" id="dateAndTimeCompletion" value="<?php echo date("Y-m-d H:i:s");?>">
              <span class="error"></span>

            </div>
        </div>
        <?php
        }
        ?>
          <div class="form-group">
            <label for="rating" class="col-sm-4 control-label">rating score<br>(10=very satisfied; 1=very poor)</label>
            <div class="col-sm-4">
              <select name="rating" class="form-control" id="rating">
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
                <option value="7">7</option>
                <option value="6">6</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
              </select>
              <span class="error"></span>
            </div>
          </div>       

          <div class="form-group">
            <label for="comments" class="col-sm-4 control-label">comments</label>
            <div class="col-sm-4">
              <input name="comments" type="text" class="form-control" id="comments" placeholder="comments">
              <span class="error"></span>
            </div>
          </div>

          <div class="form-group submit-sign-up">
            <div class="col-sm-8 col-sm-offset-4">
              <button type="submit" name="submit-purchase" value="submit-purchase" class="btn btn-primary">Submit</button>
            </div>
          </div>
          
          <!-- <input name="userID" type="hidden" value="69"/> -->
          <!-- <input name="productID" type="hidden" value="49"/>
          <input name="purchaseID" type="hidden" value="25"/> -->
          <input name="userID" type="hidden" value="<?php echo $row['userID']; ?>"/>
          <input name="productID" type="hidden" value="<?php echo $row['productID']; ?>"/>
          <input name="purchaseID" type="hidden" value="<?php echo $row['purchaseID']; ?>"/> 
      </div>   
    </form>
    </div>
      <?php
      }else{
        echo "Error";
      }
      ?>
  </div>

<?php
if (isset($_POST['submit-purchase'])) {
  if($_POST['userID'] == $_SESSION['userID']){
    $sqlCode = "payementComplete='".$_POST['payementComplete']."', dateAndTimeCompletion='".$_POST['dateAndTimeCompletion']."', commentsBuyer='".$_POST['comments']."', ratingBuyer='".$_POST['rating']."'";
  }else{
   $sqlCode = "commentsSeller='".$_POST['comments']."', ratingSeller='".$_POST['rating']."'";
  }

  
  $stmt = $con->query("UPDATE purchase SET ".$sqlCode.", reg_date='".date("Y-m-d H:i:s")."' WHERE productID='".$_GET["id"]."'");
  // $stmt = $con->prepare("INSERT INTO purchase (purchaseID, userID, productID, payementComplete, dateAndTimeCompletion, reg_date, commentsSeller, commentsBuyer, ratingSeller, ratingBuyer ) VALUES (?,?,?,?,?,?,?,?,?,?)");
  // @$stmt->bind_param("iiibbdssii", $_POST['(purchaseID'], $_POST['userID'], $_POST['productID'], $_POST['payementComplete'], $_POST['dateAndTimeCompletion'], date("Y-m-d H:s:i"), $_POST['commentsSeller'], $_POST['commentsBuyer'], $_POST['ratingSeller'], $_POST['ratingBuyer']);
  // $stmt->execute();
  echo "done";
  $con->close();
}
?>

  <footer>
  </footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>



<?php 
//(“isdb", $id,$name,$score,$image) 代表$id为int型，$name为字符串型，$score为double型，$image为二进制型。 


//if the userID matchs the userID in the purchase table, it is buyerID;  else it is sellerID
//if the rating matchs the buyerID, it is commentBuyer; else it is commentSeller
//if the comment matchs the buyerID, it is ratingBuyer; else it is ratingSeller



//$result = $link->query("UPDATE table SET password='".$password_new."', salt='".$salt_new."' WHERE userId='".$_SESSION["purchase_userID"]."'");
// if($result && $result -> rowCount() > 0){
//     unset($_SESSION['purchase_userID']);
?>