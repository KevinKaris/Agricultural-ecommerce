<?php
session_start();

include '../DB-config/db-config.php';

if (!empty($_POST['name']) && !empty($_POST['message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $name = stripcslashes($name);
    $message = stripcslashes($message);
    $email = stripcslashes($email);

    $name = mysqli_real_escape_string($connection, $name);
    $message = mysqli_real_escape_string($connection, $message);
    $email = mysqli_real_escape_string($connection, $email);

    $INSERT = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";

    $statement = $connection->prepare($INSERT);
    $statement->bind_param('sss', $name, $email, $message);
    $statement->execute();
    $statement->close();

    $_SESSION['message-sent'] = 'Message sent successfully! Thank you for contacting us, we will get back to you through the email you have sent us';
    echo "<script>window.location.assign('about')</script>";
}
?>