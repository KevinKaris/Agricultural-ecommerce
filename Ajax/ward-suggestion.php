<?php
include '../DB-config/db-config.php';
if(!empty($_GET['ward'])){
    $ward = $_GET['ward'];

    $SELECT = "SELECT Ward FROM wards_geocodes WHERE Ward LIKE '$ward%' LIMIT 5";
    $run = mysqli_query($connection, $SELECT);
    $rows = mysqli_num_rows($run);

    if($run){
        if($rows > 0){
            while($details = mysqli_fetch_assoc($run)){
                echo '<p>'.$details['Ward'].'</p>';
            }
        }
        else{
            echo 'No such ward. Check you spelling...';
        }
    }
    else{
        echo 'Something went wrong in the server';
    }
}