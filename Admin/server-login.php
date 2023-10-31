<?php
session_start();
$_SESSION['login-time'] = time();

$email = $_POST['email'];
$password = $_POST['password'];

include '../DB-config/db-config.php';

$email = stripcslashes($email);
$password = stripcslashes($password);

$email = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password);

if ($connection->connect_error) {
    echo '<h4>Database connection failed!</h4>';
}
else {
    $SELECT = "SELECT * FROM admin WHERE email = '$email'";

    $result = mysqli_query($connection, $SELECT);
    $num_of_rows = mysqli_num_rows($result);
    $details = mysqli_fetch_assoc($result);
    $email2 = $details['email'];
    $_SESSION['email'] = $email2;

    if ($num_of_rows < 1) {
        echo '<script>alert("You are not an admin!!");</script>';
        echo '<script>window.location.assign("login.html")</script>';
    }
    else {
        if ($details['password'] === $_POST['password']) {
            echo '<script>alert("Sucessful!!");</script>';
            echo '<script>window.location.assign("index.php")</script>';
        }
        else {
            echo '<script>alert("Incorrect email or password")</script>';
            echo '<script>window.location.assign("login.html")</script>';
        }
    }
}
?>