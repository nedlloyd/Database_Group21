<?php
if (isset($_POST['submit-login'])) {
  $_SESSION['message'] = "";
  $email = mysqli_escape_string($con, $_POST['email']);
  $password = mysqli_escape_string($con, $_POST['password']);

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($con, $sql) or die ($mysqli->error());
  if ($result->num_rows == 0) {

    $_SESSION['message'] = "Email does not exist";
    header("location: ../views/login.php");
  } else {
    $user = $result->fetch_assoc();
    if ( password_verify($password, $user['password'])) {
        if ($user['active'] == TRUE) {
          $_SESSION['userID'] = $user['id'];
          $_SESSION['role'] = $user['role'];
          header("location: search_product.php");
        } else {
          $_SESSION['message'] = "Your account had been deactivated";
        }
    } else {
      $_SESSION['message'] = "You have entered the wrong password";
    }
  }
}
?>
