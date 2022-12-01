<?php

$conn = mysqli_connect($hostname, $super_user, $super_password, '');

if (!$conn) {
    $connect_Err = True;
    $mysql_err = mysqli_connect_error();
    require 'init.html';
    exit;
}


?>