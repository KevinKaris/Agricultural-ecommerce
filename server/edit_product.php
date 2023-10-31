<?php
session_start();
if (isset($_POST['update-button']) && isset($_SESSION['id'])) {
    $id = $_POST['edit_id'];

    include '../DB-config/db-config.php';

    $product_title = $_POST['product-title'];
    $stock_available = $_POST['stock-available'];
    $product_category = $_POST['product-category'];
    $product_expiry = $_POST['product-expiry'];
    $product_price = $_POST['product-price'];
    $product_description = $_POST['product-description'];
    $product_keywords = $_POST['product-keywords'];
    $specific_location = $_POST['product-location'];

    if (!empty($_FILES['product-image']['name'][0])) {
    //compressing image function
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
            default:
                $image = imagecreatefromjpeg($source);
        }

        imagejpeg($image, $destination, $quality);

        // final Return compressed image 
        return $destination;
    }
    $modifier = md5(time());
    //dealing with image

        for ($i = 0; $i < count($_FILES['product-image']['name']); $i++) {
            if ($_FILES['product-image']['size'][$i] <= 5000000) {

                $image_name1 = $_FILES['product-image']['name'];
                $target_directory = "../images/products/" . $modifier . $image_name1[$i];
                $array[] = "images/products/" . $modifier . $image_name1[$i];
                $image_name = implode(',', $array);
                $stored_directory = $image_name;

                $compressedImage = compressImage($_FILES['product-image']['tmp_name'][$i], $target_directory, 30);

                $UPDATE = "UPDATE product SET product_title = ?, stock_available = ?, product_category = ?, product_expiry = ?, product_image = ?, product_price = ?, product_description = ?, product_keywords = ?, specific_location = ? WHERE product_id = $id";

                if ($connection->connect_error) {
                    echo '<h4>Database connection failed!</h4>';
                } else {
                    $statement = $connection->prepare($UPDATE);
                    $statement->bind_param('sssssssss', $product_title, $stock_available, $product_category, $product_expiry, $stored_directory, $product_price, $product_description, $product_keywords, $specific_location);
                    $statement->execute();
                    $statement->close();
                    $_SESSION['update-status'] = 'Your product was successfully updated!';
                    echo '<script>window.location.assign("../Farmer-Portal/products")</script>';
                }
            } else {
                $_SESSION['image-size'] = 'Your image is too large (more than 5mbs). Select an image of size 5mbs or less';
                echo '<script>window.location.assign("../Farmer-Portal/edit")</script>';
            }
        }
    } else {
        $UPDATE = "UPDATE product SET product_title = ?, stock_available = ?, product_category = ?, product_expiry = ?, product_price = ?, product_description = ?, product_keywords = ?, specific_location = ? WHERE product_id = $id";

        if ($connection->connect_error) {
            echo '<h4>Database connection failed!</h4>';
        } else {
            $statement = $connection->prepare($UPDATE);
            $statement->bind_param('ssssssss', $product_title, $stock_available, $product_category, $product_expiry, $product_price, $product_description, $product_keywords, $specific_location);
            $statement->execute();
            $statement->close();
            $_SESSION['update-status'] = 'Your product was successfully updated!';
            echo '<script>window.location.assign("../Farmer-Portal/products")</script>';
        }
    }
} else {
    echo '<script>window.location.assign("../Farmer-Portal/farmer-login-signup.html")</script>';
}

?>