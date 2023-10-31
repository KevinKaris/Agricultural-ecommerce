<?php
session_start();
if (isset($_SESSION['id']) && isset($_POST['delete-button'])) {
    $id = $_POST['edit_id'];

    include '../DB-config/db-config.php';

    $DELETE = "DELETE FROM product WHERE product_id = $id";
    $SELECT = "SELECT * FROM product WHERE product_id = $id";

    if ($connection->connect_error) {
        echo '<h4>Database connection failed!</h4>';
    } else {
        $sql = mysqli_query($connection, $SELECT);
        $row = mysqli_fetch_assoc($sql);
        $string = explode(',', $row['product_image']);
        for ($i = 0; $i < count($string); $i++) {
            $path = "../" . $string[$i];
            unlink($path);
        }
        $sql = mysqli_query($connection, $DELETE);
        echo '<script>window.location.assign("../Farmer-Portal/products")</script>';
    }
} else {
    echo '<script>window.location.assign("../Farmer-Portal/Farmer-login-signup.php")</script>';
}
?>