<?php

$servername = "localhost";
$username = "aldar";
$db_password = "password";
$database = "aldar_mandzhiev";


$link = mysqli_connect($servername, $username, $db_password, $database);

if ($link === false) {
    die('ERROR: could not connect ' . mysqli_connect_error());
} else {
}
// mysqli_close($link);
