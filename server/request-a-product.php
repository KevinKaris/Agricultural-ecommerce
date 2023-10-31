<?php
session_start();
if (isset($_POST['post-button'])) {

    include '../DB-config/db-config.php';

    $product_title = $_POST['product-title'];
    $request_category = $_POST['request-category'];
    $stock_needed = $_POST['stock-needed'];
    $product_description = $_POST['product-description'];
    $preferred_location = $_POST['preferred-location'];
    $id = $_SESSION['id'];

    if ($_FILES['product-image']['size'] <= 3000000) {
        //dealing with image
        $modifier = md5(time());
        $image_name = $_FILES['product-image']['name'];
        $target_directory = "../images/buyer-request/$modifier$image_name";
        $stored_directory = "images/buyer-request/$modifier$image_name";

        //compressed image
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

        $INSERT = "INSERT INTO buyer_request(buyer_id, product_title, request_category, stock_needed, product_image, product_description, preferred_location) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($connection->connect_error) {
            echo '<h4>Database connection failed!</h4>';
        } else {
            $compressedImage = compressImage($_FILES['product-image']['tmp_name'], $target_directory, 30);
            //move_uploaded_file($_FILES['product-image']['tmp_name'], $target_directory);
            $statement = $connection->prepare($INSERT);
            $statement->bind_param('sssssss', $id, $product_title, $request_category, $stock_needed, $stored_directory, $product_description, $preferred_location);
            $statement->execute();
            $statement->close();
            $_SESSION['post-status'] = 'Your product request posted successfully!';
            echo '<script>window.location.assign("../Buyer-Portal/requests")</script>';
        }
    } else {
        $_SESSION['image-size'] = 'Your image is too large (more than 3mbs). Select an image of size 3mbs or less';
        echo '<script>window.location.assign("../Buyer-Portal/requests")</script>';
    }
} else {
    echo '<script>window.location.assign("../Buyer-Portal/buyer-login-signup.php")</script>';
}

?>