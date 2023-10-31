<?php

include '../DB-config/db-config.php';

if (!empty($_POST['page_url'])) {
    $page_url = $connection->real_escape_string($_POST['page_url']);

    $SELECT = "SELECT page_url FROM comments WHERE page_url = '$page_url'";

    $sql = mysqli_query($connection, $SELECT);
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        echo $count;
    } else {
        echo '0';
    }
}

?>