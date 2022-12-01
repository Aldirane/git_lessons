<?php

include_once('../functions.php');


$super_user = $super_password = '';
$super_userErr = $super_passwordErr = '';

if ($_SERVER['REQUEST_METHOD']=='POST') {

    if (empty($_POST['super_user'])) {
        $super_userErr = 'Введите суперпользователя';
        require_once 'init.html';
        exit;
    } else {
        $super_user = get_input($_POST['super_user']);
    }
    
    if (empty($_POST['super_password'])) {
        $super_password = 'Введите пароль суперюзера';
        require_once 'init.html';
        exit;
    } else {
        $super_password = get_input($_POST['super_password']);
    }

    $hostname = get_input($_POST['hostname']);
    
    include('create_user.php');
    include('create_db.php');
    // include('create_table.php');

    echo 'Инициализация прошла успешна. <br> Импортируйте дамп в новую базу aldar_mandzhiev из config/aldar_mandzhiev <br>';

} else {
    require_once('init.html');
    exit;
}

exit;
?>