<?php
include '../DB-config/db-config.php';

if (!empty($_POST['comment_text']) && !empty($_POST['user_email']) && !empty($_POST['user_id']) && !empty($_POST['page_url'])) {

    $comment = $connection->real_escape_string($_POST['comment_text']);
    $user_email = $connection->real_escape_string($_POST['user_email']);
    $user_id = $connection->real_escape_string($_POST['user_id']);
    $page_url = $connection->real_escape_string($_POST['page_url']);


    $INSERT = "INSERT INTO comments (user_id, user_email, page_url, parent_id, comment) VALUES ('" . $user_id . "', '" . $user_email . "','" . $page_url . "', '0', '" . $comment . "')";

    $sql = mysqli_query($connection, $INSERT);
}
?>