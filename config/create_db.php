<?php

include('connect_super.php');

$databaseErr = 'databaseErr';
$sql_create_db = "CREATE DATABASE aldar_mandzhiev CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
$sql_drop_db = "DROP DATABASE IF EXISTS aldar_mandzhiev";

if ($conn) {
    if (mysqli_query($conn, $sql_drop_db)) {
        if (mysqli_query($conn, $sql_create_db)) {
            echo "Database created successfully" . "<br>";
        } else {
            $databaseErr = True;
            $mysql_err = mysqli_connect_error();
            require 'init.html';
            exit;
        }
    } else {
        $databaseErr = True;
        $mysql_err = mysqli_connect_error();
        require 'init.html';
        exit;
    }
} else {
    $connect_Err = True;
    $mysql_err = mysqli_connect_error();
    require 'init.html';
    exit;
}

mysqli_close($conn);

?>