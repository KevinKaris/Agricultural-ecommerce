<?php
session_start();
if (isset($_POST['post-button'])) {

    include '../DB-config/db-config.php';

    $product_title = $_POST['product-title'];
    $stock_available = $_POST['stock-available'];
    $product_category = $_POST['product-category'];
    $product_expiry = $_POST['product-expiry'];
    $product_price1 = $_POST['product-price-amount'];
    $product_price2 = $_POST['product-price-unit'];
    $product_price = $product_price1 . $product_price2;
    $product_description = $_POST['product-description'];
    $product_keywords = $_POST['product-keywords'];
    $county_location = $_POST['county-location'];
    $sub_county_location = $_POST['sub-county-location'];
    $product_specific_location = $_POST['Product-specific-Location'];
    $id = $_POST['farmer-id'];

    //dealing with image
    $modifier = md5(time());

    //image resizing function
    function compressImage($source, $destination, $quality)
    {
        $imgInfo = getimagesize($source);
        $dataMine = $imgInfo['mime'];

        switch ($dataMine) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($source);
                break;
            case 'image/jpg':
                $image = imagecreatefromjpeg($source);
                break;
            default:
                $image = imagecreatefromjpeg($source);
        }

        imagejpeg($image, $destination, $quality);

        // final Return compressed image 
        return $destination;
    }

    for ($i = 0; $i < count($_FILES['product-image']['name']); $i++) {

        $image_name1 = $_FILES['product-image']['name'];
        $target_directory = "../images/products/" . $modifier . $image_name1[$i];
        $array[] = "images/products/" . $modifier . $image_name1[$i];
        $image_name = implode(',', $array);
        $stored_directory = $image_name;

        if ($_FILES['product-image']['size'][$i] <= 5000000) {
            //compressed image
            //move_uploaded_file($_FILES['product-image']['tmp_name'], $target_directory);
            $compressedImage = compressImage($_FILES['product-image']['tmp_name'][$i], $target_directory, 30);
        } else {
            $_SESSION['image-size'] = 'Your image is too large (more than 5mbs). Select an image of size 5mbs or less';
            echo '<script>window.location.assign("../Farmer-Portal/post")</script>';
        }
    }
    $INSERT = "INSERT INTO product (farmer_id, product_title, stock_available, product_category, product_expiry, product_image, product_price, product_description, product_keywords, county_location, sub_county_location, specific_location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($connection->connect_error) {
        echo '<h4>Database connection failed!</h4>';
    } else {
        $statement = $connection->prepare($INSERT);
        $statement->bind_param('ssssssssssss', $id, $product_title, $stock_available, $product_category, $product_expiry, $stored_directory, $product_price, $product_description, $product_keywords, $county_location, $sub_county_location, $product_specific_location);
        $statement->execute();
        $statement->close();
        $_SESSION['update-status'] = 'Your product was successfully posted!';
        echo '<script>window.location.assign("../Farmer-Portal/products")</script>';
    }
} else {
    echo '<script>window.location.assign("../Farmer-Portal/farmer-login-signup.")</script>';
}

?>