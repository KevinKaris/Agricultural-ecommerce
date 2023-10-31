<?php

include '../DB-config/db-config.php';

if (!empty($_POST['comment_id'])) {
    $comment_id = $connection->real_escape_string($_POST['comment_id']);

    $DELETE = "DELETE FROM comments WHERE id = '$comment_id'";

    $sql = mysqli_query($connection, $DELETE);
}

?>