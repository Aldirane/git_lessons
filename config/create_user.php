<?php

include('connect_super.php');
include_once('../functions.php');

$userErr = 'userErr';
$sql_drop_user = "DROP USER IF EXISTS 'aldar'@'localhost'";
$sql_create_user = "CREATE USER 'aldar'@'localhost' IDENTIFIED BY 'password'";
$sql_grant_priveleges = "GRANT ALL PRIVILEGES ON aldar_mandzhiev.* TO 'aldar'@'localhost'";

$queries = array($sql_drop_user, $sql_create_user, $sql_grant_priveleges);

if ($conn) {
    foreach ($queries as $query_user) {
        sql_func($conn, $query_user, $userErr);
    }
    echo 'New user created successfully' . '<br>';
} else {
    $connect_Err = True;
    $mysql_err = mysqli_connect_error();
    require 'init.html';
    exit;
}
// mysqli_close($conn);

?>