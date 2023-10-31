<?php
session_start();
include '../DB-config/db-config.php';
if (isset($_SESSION['id'])) {
    $session_id = $_SESSION['id'];
    $UPDATE = "UPDATE farmer_signup SET last_login = Now() WHERE id ='$session_id'";
    $sql = mysqli_query($connection, $UPDATE);

    if($sql){
        session_destroy();
        session_unset();

        echo '<script>window.location.assign("../home")</script>';
    }
}

?>