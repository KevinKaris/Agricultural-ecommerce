<?php
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    include '../DB-config/db-config.php';

    $firstname = $_POST['first-name'];
    $lastname = $_POST['last-name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phone-number'];
    $initial_email = $_POST['initial_email'];

    $firstname = stripcslashes($firstname);
    $lastname = stripcslashes($lastname);
    $email = stripcslashes($email);
    $phonenumber = stripcslashes($phonenumber);
    $initial_email = stripslashes($initial_email);

    $firstname = mysqli_real_escape_string($connection, $firstname);
    $lastname = mysqli_real_escape_string($connection, $lastname);
    $email = mysqli_real_escape_string($connection, $email);
    $phonenumber = mysqli_real_escape_string($connection, $phonenumber);
    $initial_email = mysqli_real_escape_string($connection, $initial_email);

    //update comments table
    $UPDATE2 = "UPDATE comments SET user_email = ? WHERE user_id = '$id' AND user_email = '$initial_email'";

    $statement2 = $connection->prepare($UPDATE2);
    $statement2->bind_param('s', $email);
    $statement2->execute();

    if($statement2){
        //update buyer's profile
        $UPDATE = "UPDATE buyer_signup SET first_name = ?, last_name = ?, email = ?, phone_number = ? WHERE id = $id";

        $statement = $connection->prepare($UPDATE);
        $statement->bind_param('ssss', $firstname, $lastname, $email, $phonenumber);
        $statement->execute();
        $statement->close();
        $_SESSION['profile-edit'] = 'Changes saved!';
        echo '<script>window.location.assign("../Buyer-Portal/profile")</script>';
    }
    else{
        echo '<h3>Some did not go well,</h3> try again!';
    }
}
?>