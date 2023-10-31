<?php
include '../DB-config/db-config.php';

$SELECT = "SELECT DISTINCT product_title FROM product WHERE product_title LIKE '%" . $_POST['txt'] . "%' LIMIT 10 ";
$sql = mysqli_query($connection, $SELECT);
$num_of_rows = mysqli_num_rows($sql);

if ($num_of_rows > 0) {
    while ($row_details = mysqli_fetch_assoc($sql)) {
        echo '<a href="javascript:void();">' . $row_details['product_title'] . '</a>';
    }
}

?>