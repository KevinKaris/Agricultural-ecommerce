<?php
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    include '../DB-config/db-config.php';

    $password = $_POST['new-password'];

    $password = stripcslashes($password);

    $password = mysqli_real_escape_string($connection, $password);

    $encryp_password = password_hash($password, PASSWORD_DEFAULT);

    $UPDATE = "UPDATE buyer_signup SET password = ? WHERE id = $id";

    $statement = $connection->prepare($UPDATE);
    $statement->bind_param('s', $encryp_password);
    $statement->execute();
    $statement->close();
    echo '<script>alert("Successful!")</script>';
    echo '<script>window.location.assign("../Buyer-Portal/profile")</script>';
}
?>