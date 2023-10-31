<?php
session_start();
$_SESSION['login-time'] = time();

include '../DB-config/db-config.php';

$firstname = $_POST['first-name'];
$lastname = $_POST['last-name'];
$email = $_POST['email'];
$phone_number = $_POST['phone-number'];
$county = $_POST['county'];
$subcounty = $_POST['sub-county'];
$location = $_POST['location'];
$user_id = $_POST['user_id'];
$initial_email = $_POST['initial_email'];
$_SESSION['phone-number'] = $phone_number;

$firstname = stripcslashes($firstname);
$lastname = stripcslashes($lastname);
$email = stripcslashes($email);
$phone_number = stripcslashes($phone_number);
$county = stripcslashes($county);
$subcounty = stripcslashes($subcounty);
$location = stripcslashes($location);
$user_id = stripcslashes($user_id);
$initial_email = stripcslashes($initial_email);

$firstname = mysqli_real_escape_string($connection, $firstname);
$lastname = mysqli_real_escape_string($connection, $lastname);
$email = mysqli_real_escape_string($connection, $email);
$phone_number = mysqli_real_escape_string($connection, $phone_number);
$county = mysqli_real_escape_string($connection, $county);
$subcounty = mysqli_real_escape_string($connection, $subcounty);
$location = mysqli_real_escape_string($connection, $location);
$user_id = mysqli_real_escape_string($connection, $user_id);
$initial_email = mysqli_real_escape_string($connection, $initial_email);


if ($connection->connect_error) {
    die('<h4>Connection to database failed!</h4>'.$connection->connect_error);
} else {
    $UPDATE = "UPDATE farmer_signup SET first_name = ?, last_name = ?, email = ?, phone_number = ?, county = ?, sub_county = ?, location = ? WHERE id = $user_id";

    //updating comments table
    $UPDATE2 = "UPDATE comments SET user_email = ? WHERE user_id = '$user_id' AND user_email = '$initial_email'";

    $statement2 = $connection->prepare($UPDATE2);
    $statement2->bind_param('s', $email);
    $statement2->execute();

    if($statement2){
        //Updating farmers profile
        $statement = $connection->prepare($UPDATE);
        $statement->bind_param('sssssss', $firstname, $lastname, $email, $phone_number, $county, $subcounty, $location);
        $statement->execute();
        $_SESSION['profile-edit'] = 'Changes saved!';
        echo '<script>window.location.assign("../Farmer-Portal/profile")</script>';
        $statement->close();
    }
    else{
        echo '<h3>Some did not go well,</h3> try again!';
    }
}
?>