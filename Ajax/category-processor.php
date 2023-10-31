<?php
include '../DB-config/db-config.php';

$search_value = $_POST['value'];

$SELECT = "SELECT * FROM product WHERE product_category LIKE '%$search_value%'";

$run = mysqli_query($connection, $SELECT);
$num_of_rows = mysqli_num_rows($run);

if ($num_of_rows <= 0) {
    echo '<h2>No product under this category!</h2>';
}
else {
    while ($row = mysqli_fetch_assoc($run)) {
        echo $row['product_title'];
        echo $row['product_id'];
        echo $row['product_image'];
        echo $row['product_price'];
    }
}
?>