<?php
session_start();
include '../DB-config/db-config.php';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $county = $_POST['county'];
    $route = $_POST['route'];
    $vehicle = $_POST['vehicle'];
    $phone = $_POST['phone'];

    $name = stripcslashes($name);
    $county = stripcslashes($county);
    $route = stripcslashes($route);
    $vehicle = stripcslashes($vehicle);
    $phone = stripcslashes($phone);

    $name = mysqli_real_escape_string($connection, $name);
    $county = mysqli_real_escape_string($connection, $county);
    $route = mysqli_real_escape_string($connection, $route);
    $vehicle = mysqli_real_escape_string($connection, $vehicle);
    $phone = mysqli_real_escape_string($connection, $phone);

    if ($connection->connect_error) {
        echo '<h4>Server error! Connection to database failed!</h4>';
    }
    else {
        $SELECT = "SELECT phone from transporter where phone = ?";
        $INSERT = "INSERT INTO transporter (name, county, route, vehicle, phone) VALUES (?, ?, ?, ?, ?)";
    
        //prepare statement
        $statement = $connection->prepare($SELECT);
        $statement->bind_param('s', $phone);
        $statement->execute();
        $statement->bind_result($phone);
        $statement->store_result();
        $num_row = $statement->num_rows;
    
        if ($num_row < 1) {
            $statement = $connection->prepare($INSERT);
            $statement->bind_param('sssss', $name, $county, $route, $vehicle, $phone);
            $statement->execute();
            $_SESSION['transporter-info'] = 'Registered Successfully';
            $statement->close();
            echo '<script>window.location.assign("../Farmer-Portal/transport")</script>';
        }
        else {
            $_SESSION['transporter-info'] = 'Your phone number exists.';
            echo '<script>window.location.assign("../Farmer-Portal/transport")</script>';
        }
    }
}

?>