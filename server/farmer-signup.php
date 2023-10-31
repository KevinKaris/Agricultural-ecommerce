<?php
session_start();
include '../DB-config/db-config.php';

$firstname = $_POST['first-name'];
$lastname = $_POST['last-name'];
$email = $_POST['email'];
$phone_number = $_POST['phone-number'];
$county = $_POST['county'];
$subcounty = $_POST['sub-county'];
$location = $_POST['location'];
$password = $_POST['password'];
$con_password = $_POST['con-password'];
$_SESSION['phone-number'] = $phone_number;

$firstname = stripcslashes($firstname);
$lastname = stripcslashes($lastname);
$email = stripcslashes($email);
$phone_number = stripcslashes($phone_number);
$county = stripcslashes($county);
$subcounty = stripcslashes($subcounty);
$location = stripcslashes($location);
$password = stripcslashes($password);
$con_password = stripcslashes($con_password);

$firstname = mysqli_real_escape_string($connection, $firstname);
$lastname = mysqli_real_escape_string($connection, $lastname);
$email = mysqli_real_escape_string($connection, $email);
$phone_number = mysqli_real_escape_string($connection, $phone_number);
$county = mysqli_real_escape_string($connection, $county);
$subcounty = mysqli_real_escape_string($connection, $subcounty);
$location = mysqli_real_escape_string($connection, $location);
$password = mysqli_real_escape_string($connection, $password);
$con_password = mysqli_real_escape_string($connection, $con_password);


if ($connection->connect_error) {
    echo '<h4>Server error! Connection to database failed!</h4>';
}
else {
    $SELECT = "SELECT email from farmer_signup where email = ? LIMIT 1";
    $INSERT = "INSERT INTO farmer_signup (first_name, last_name, email, phone_number, county, sub_county, location, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    //prepare statement
    $statement = $connection->prepare($SELECT);
    $statement->bind_param('s', $email);
    $statement->execute();
    $statement->bind_result($email);
    $statement->store_result();
    $num_row = $statement->num_rows;

    if ($num_row == 0) {
        $statement->close();
        $encryp_password = password_hash($password, PASSWORD_DEFAULT);

        if ($password == $con_password) {
            $statement = $connection->prepare($INSERT);
            $statement->bind_param('ssssssss', $firstname, $lastname, $email, $phone_number, $county, $subcounty, $location, $encryp_password);
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