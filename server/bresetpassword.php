<?php
include '../DB-config/db-config.php';

    $password = $_POST['password'];
    $cpassword = $_POST['Cpassword'];
    $id = $_POST['id'];

    $password = stripcslashes($password);
    $cpassword = stripcslashes($cpassword);
    $id = stripcslashes($id);

    $password = mysqli_real_escape_string($connection, $password);
    $cpassword = mysqli_real_escape_string($connection, $cpassword);
    $id = mysqli_real_escape_string($connection, $id);

    $decoded_id = base64_decode($id);

    if($password == $cpassword){
        $encryp_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE buyer_signup SET password = '$encryp_password' WHERE id = '$decoded_id'";
        $run = mysqli_query($connection, $sql);

        if($run){
            echo '1';
        }
    }