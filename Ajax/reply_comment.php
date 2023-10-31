<?php

include '../DB-config/db-config.php';

if (!empty($_POST['parent_comment_id']) && !empty($_POST['comment_text']) && !empty($_POST['user_id']) && !empty($_POST['user_email'])){

    $comment = $connection->real_escape_string($_POST['comment_text']);
    $user_email = $connection->real_escape_string($_POST['user_email']);
    $user_id = $connection->real_escape_string($_POST['user_id']);
    $parent_comment_id = $connection->real_escape_string($_POST['parent_comment_id']);
    $page_url = $connection->real_escape_string($_POST['page_url']);

    $INSERT = "INSERT INTO comments (user_id, user_email, page_url, parent_id, comment) VALUES ('" . $user_id . "', '" . $user_email . "','" . $page_url . "', '" . $parent_comment_id . "', '" . $comment . "')";

    $sql = mysqli_query($connection, $INSERT);
}

?>