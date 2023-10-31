<?php
session_start();

include '../DB-config/db-config.php';
if (isset($_POST['add'])) {
    $product = $_POST['product'];
    $county = $_POST['county'];
    $market = $_POST['market'];
    $retail = $_POST['retail'];
    $wholesale = $_POST['wholesale'];

    $INSERT = "INSERT INTO prices (product_name, county, market_name, retail_price, wholesale_price) VALUES ('$product', '$county', '$market', '$retail', '$wholesale')";

    mysqli_query($connection, $INSERT);

    $_SESSION['notice'] = 'Added successfully';
    header('location: add-price.php');
}