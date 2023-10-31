<?php
include '../DB-config/db-config.php';
if (isset($_POST['email'])) {

    $email = $connection->real_escape_string($_POST['email']);

    $SELECT = "SELECT email FROM subscription WHERE email = '$email'";
    $sql2 = mysqli_query($connection, $SELECT);
    $num_of_rows = mysqli_num_rows($sql2);

    if ($num_of_rows == 0) {
        $INSERT = "INSERT INTO subscription(email) VALUES('" . $email . "') ";
        $sql1 = mysqli_query($connection, $INSERT);
        if ($sql1) {
            echo '<h3><i class="fa-regular fa-circle-check text-success"></i>&nbsp;Thank you for subscribing!</h3><br><p align="center">You will be receiving our news in your email.</p>';
        } else {
            echo '<h2><i class="fa-regular fa-circle-xmark text-danger"></i>&nbsp;An error happened!</h2><br><p align="center">Please try again and make sure you have internet.</p>';
        }
    } else {
        echo '<h4><i class="fa-solid fa-triangle-exclamation text-warning"></i>&nbsp;That email is already subscribed!</h4><br><p align="center">Enter a different email</p>';
    }
} else {
    echo '<h2><i class="fa-regular fa-circle-xmark"></i>$nbsp;Something is wrong!</h2><p align="center">Please try again</p>';
}

?>