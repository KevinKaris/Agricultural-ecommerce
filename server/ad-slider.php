<?php
session_start();
if (isset($_POST['submit'])) {

    include '../DB-config/db-config.php';

    $id = $_POST['update-id'];
    $product_id = $_POST['product-id'];

    if ($_FILES['picture']['size'] <= 3000000) {
        //dealing with image
        $modifier = md5(time());
        $image_name = $_FILES['picture']['name'];
        $target_directory = "../images/ad-slides/$modifier$image_name";
        $stored_directory = "images/ad-slides/$modifier$image_name";

        //compressed image
        function compressImage($source, $destination, $quality)
        {
            $imgInfo = getimagesize($source);
            $dataMine = $imgInfo['mime'];

            switch ($dataMine) {
                case 'picture/jpeg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'picture/png':
                    $image = imagecreatefrompng($source);
                    break;
                case 'picture/webp':
                    $image = imagecreatefromwebp($source);
                    break;
                default:
                    $image = imagecreatefromjpeg($source);
            }

            imagejpeg($image, $destination, $quality);

            // final Return compressed image 
            return $destination;
        }

        $UPDATE = "UPDATE ad_slider SET image = ?, product_id = ? WHERE id = $id";

        if ($connection->connect_error) {
            echo '<h4>Server error! Database connection failed!</h4>';
        } else {
            $compressedImage = compressImage($_FILES['picture']['tmp_name'], $target_directory, 30);
            //move_uploaded_file($_FILES['product-image']['tmp_name'], $target_directory);
            $statement = $connection->prepare($UPDATE);
            $statement->bind_param('ss', $stored_directory, $product_id);
            $statement->execute();
            $statement->close();
            echo '<script>window.location.assign("../Admin/slider-ads.php")</script>';
        }
    } else {
        echo '<script>Your image is too large (more than 3mbs). Select an image of size 3mbs or less</script>';
        echo '<script>window.location.assign("../Admin/slider-ads.php")</script>';
    }
}

?>