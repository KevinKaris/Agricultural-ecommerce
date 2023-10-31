<?php
include '../DB-config/db-config.php';
if(!empty($_POST['link_url'])){
    $page_url = $_POST['link_url'];

    $UPDATE = "UPDATE comments SET viewed = '1' WHERE page_url = '$page_url'";

    $sql = mysqli_query($connection, $UPDATE);
    if($sql){
        echo 'yes';
    }
    else{
        echo 'no';
    }
}
?>