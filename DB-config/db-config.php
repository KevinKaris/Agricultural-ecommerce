<?php
ini_set('display_errors', 0);
require 'dd.php';
if ($connection->connect_error) {
    die('<h6>Server error! Connection to database failed!</h6>');
}

?>