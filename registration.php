<?php

require('connect.php');
require('functions.php');

mysqli_set_charset($link, "utf8mb4");
// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';


if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$first_name=$last_name=$email=$gender=$password=$staff='';
$first_nameErr=$emailErr=$genderErr=$passwordErr='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (empty($_POST["first_name"])) {
        $first_nameErr = "Name is required";
        require_once('registration.html');
        exit;
      } else {
        $first_name = get_input($_POST["first_name"]);
      }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        require_once('registration.html');
        exit;
        } else {
        $email = get_input($_POST["email"]);
            }
    
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        require_once('registration.html');
        exit;
        } else {
        $gender = get_input($_POST["gender"]);
        }
    
        
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        require_once('registration.html');
        exit;
        } else {
        $password = password_hash(get_input($_POST['password']), PASSWORD_BCRYPT);;
        }
        
    $last_name = get_input($_POST['last_name']);
    $staff = isset($_POST['staff']) ? get_input($_POST['staff']) : 0;

    $user_is_created = $link->query("INSERT INTO users (first_name, last_name, email, gender, password, staff) VALUES ('$first_name', '$last_name', '$email', '$gender', '$password', '$staff')");
    
    if ($user_is_created) {
        require_once('registration.html');
    } else {
        $user_not_created = 'true';
        require_once('registration.html');
    }

} else {
    require('registration.html');
}

mysqli_close($link);

exit;
?>
