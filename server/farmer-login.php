<?php
session_start();
error_reporting(0);
$_SESSION['login-time'] = time();

$phone_number = $_POST['phone-number'];
$password = $_POST['password'];

include '../DB-config/db-config.php';

$phone_number = stripcslashes($phone_number);
$password = stripcslashes($password);

$phone_number = mysqli_real_escape_string($connection, $phone_number);
$password = mysqli_real_escape_string($connection, $password);

if ($connection->connect_error) {
    echo '<h4>server error! Database connection failed!</h4>';
} else {
    $SELECT = "SELECT * FROM farmer_signup WHERE phone_number = $phone_number";

    $result = mysqli_query($connection, $SELECT);
    $num_of_rows = mysqli_num_rows($result);
    $details = mysqli_fetch_assoc($result);
    $id = $details['id'];
    $idfarmeremail = $details['email'];
    $_SESSION['id'] = $id;
    $_SESSION['idfarmeremail'] = $idfarmeremail;

    if ($num_of_rows < 1) {
        echo 'Incorrect phone number';
    } else {
        $decryp_password = password_verify($password, $details['password']);
        if ($decryp_password) {
            echo 'decrypted';
        } else {
            echo 'Incorrect password';
        }
    }
}
?>