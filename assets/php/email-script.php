<?php
    $email=$_POST['email'];
    $subject = 'third attempt';
    $message = 'form with SO';

    mail($email, $subject, $message);
    header("Location: ../../views/search_product.php")
?>
