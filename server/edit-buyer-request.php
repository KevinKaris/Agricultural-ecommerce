<?php
session_start();
if (isset($_POST['update-button']) && isset($_SESSION['id'])) {
    $edit_id = $_POST['edit-id'];

    include '../DB-config/db-config.php';

    $product_title = $_POST['product-title'];
    $stock_needed = $_POST['stock-needed'];
    $product_description = $_POST['product-description'];
    $preferred_location = $_POST['preferred-location'];

    //dealing with image
    if (!empty($_FILES['product-image']['name'])) {
        $modifier = md5(time());
        $image_name = $_FILES['product-image']['name'];
        $target_directory = "../images/products/$modifier$image_name";
        $stored_directory = "images/products/$modifier$image_name";
        move_uploaded_file($_FILES['product-image']['tmp_name'], $target_directory);

        $UPDATE = "UPDATE buyer_request SET product_title = ?, stock_needed = ?, product_image = ?, product_description = ?, preferred_location = ? WHERE request_id = $edit_id";

        if ($connection->connect_error) {
            echo '<h4>Database connection failed!</h4>';
        } else {
            $statement = $connection->prepare($UPDATE);
            $statement->bind_param('sssss', $product_title, $stock_needed, $stored_directory, $product_description, $preferred_location);
            $statement->execute();
            $statement->close();
            $_SESSION['update-status'] = 'Your product request updated successfully!';
            echo '<script>window.location.assign("../Buyer-Portal/requests")</script>';
        }
    } else {
        $UPDATE = "UPDATE buyer_request SET product_title = ?, stock_needed = ?, product_description = ?, preferred_location = ? WHERE request_id = $edit_id";

        if ($connection->connect_error) {
            echo '<h4>Database connection failed!</h4>';
        } else {
            $statement = $connection->prepare($UPDATE);
            $statement->bind_param('ssss', $product_title, $stock_needed, $product_description, $preferred_location);
            $statement->execute();
            $statement->close();
            $_SESSION['update-status'] = 'Your product request updated successfully!';
            echo '<script>window.location.assign("../Buyer-Portal/requests")</script>';
        }
    }
} else {
    echo '<script>window.location.assign("../Buyer-Portal/buyer-login-signup.php")</script>';
}

?>