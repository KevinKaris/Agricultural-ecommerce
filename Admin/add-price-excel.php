<?php
require '../DB-config/db-config.php';

if(isset($_POST['fileSubmit'])){
    $filename = $_FILES['upload']['name'];
    $fileextension = explode('.', $filename);
    $fileextension = strtolower(end($fileextension));

    $newFilename = date('Y.m.d').'-'. date('h.i.sa'). '.' . $fileextension;

    $targetDirectory = './uploads/' . $newFilename;
    move_uploaded_file($_FILES['upload']['tmp_name'], $targetDirectory);

    ini_set('display_errors', 0);
    error_reporting(0);

    require '../includes/excelReader/excel_reader2.php';
    require '../includes/excelReader/SpreadsheetReader.php';

    $reader = new SpreadsheetReader($targetDirectory);
    foreach($reader as $key => $row){
        $product_name = $row[0];
        $county = $row[1];
        $market_name = $row[2];
        $retail_price = $row[3];
        $wholesale_price = $row[4];

        mysqli_query($connection, "INSERT INTO prices(product_name, county, market_name, retail_price, wholesale_price) VALUES ('$product_name', '$county', '$market_name', '$retail_price', '$wholesale_price')");
    }

    echo '<script>alert("Successfully imported!");</script>';
    echo '<script>window.location.assign("add-price.php")</script>';
}