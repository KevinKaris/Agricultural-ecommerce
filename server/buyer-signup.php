<?php
session_start();
include '../DB-config/db-config.php';

$firstname = $_POST['first-name'];
$lastname = $_POST['last-name'];
$email = $_POST['email'];
$phone_number = $_POST['phone-number'];
$password = $_POST['password'];
$con_password = $_POST['con-password'];

$firstname = stripcslashes($firstname);
$lastname = stripcslashes($lastname);
$email = stripcslashes($email);
$phone_number = stripcslashes($phone_number);
$password = stripcslashes($password);
$con_password = stripcslashes($con_password);

$firstname = mysqli_real_escape_string($connection, $firstname);
$lastname = mysqli_real_escape_string($connection, $lastname);
$email = mysqli_real_escape_string($connection, $email);
$phone_number = mysqli_real_escape_string($connection, $phone_number);
$password = mysqli_real_escape_string($connection, $password);
$con_password = mysqli_real_escape_string($connection, $con_password);

if ($connection->connect_error) {
    die('<h4>Connection to database failed!</h4>');
}
else {
    $SELECT = "SELECT email from buyer_signup where email = ? LIMIT 1";
    $INSERT = "INSERT INTO buyer_signup (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)";

    //prepare statement
    $statement = $connection->prepare($SELECT);
    $statement->bind_param('s', $email);
    $statement->execute();
    $statement->bind_result($email);
    $statement->store_result();
    $num_row = $statement->num_rows;

    if ($num_row <= 0) {
        $statement->close();
        $encryp_password = password_hash($password, PASSWORD_DEFAULT);

        if ($password == $con_password) {
            $statement = $connection->prepare($INSERT);
            $statement->bind_param('sssss', $firstname, $lastname, $email, $phone_number, $encryp_password);
            $statement->execute();
            echo 'Signup was successful. Now log in...';
            $statement->close();
        }
    }
    else {
        echo "Your email exists.";
    }
}
?>