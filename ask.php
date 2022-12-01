<?php

require 'connect.php';
require_once 'functions.php';
require 'sendmail.php';

mysqli_set_charset($link, "utf8mb4");

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

$theme=$course=$problem=$about='';
$themeErr=$courseErr=$problemErr=$aboutErr='';

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : false;

if ($mode) {
    if ($mode=='auth') {
        $not_authorized = true;
        require 'auth.html';
        exit;
    } else {
        $user_id = my_decrypt($mode);
        if (!$user_id) {
            $not_authorized = true;
            require('auth.html');
            exit;
        } else {
            $user = $link->query("SELECT users.email FROM users WHERE users.Id = '$user_id' limit 1");
            $user_fetch = mysqli_fetch_array($user, MYSQLI_ASSOC);
            $user_name = $user_fetch['email'];
            $_POST['user_name'] = $user_name;
            $mode=false;
            require 'ask.html';
            exit;
        }
    }
}


if (isset($_POST['user_id'])) {
    $user_id = get_input($_POST['user_id']);
    $user_name = get_input($_POST['user_name']);
    
} else {
    $user_idErr = 'Авторизуйтесь';
    require 'ask.html';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST["theme"])) {
        $themeErr = "Выберите тему";
        require_once('ask.html');
        exit;
    } else {
        $theme = get_input($_POST["theme"]);
    }
    if (empty($_POST["course"])) {
        $courseErr = "Выберите курс";
        require_once('ask.html');
        exit;
    } else {
        $course = get_input($_POST["course"]);
    }
    if (empty($_POST["problem"])) {
        $problemErr = "Опишите проблему";
        require_once('ask.html');
        exit;
    } else {
        $problem = get_input($_POST["problem"]);
    }

    if (empty($_POST["about"])) {
        $aboutErr = "Задайте вопрос";
        require_once('ask.html');
        exit;
    } else {
        $about = get_input($_POST["about"]);
    }
    
    $userfile = get_input($_POST["userfile"]);

    $mail->isHTML(true);
    $mail->Subject = 'Новая запись по форме обратной связи';
    $mail->Body    = '' .$user_name . ' оставил вопрос по форме: <br> Курс: '.$course .'<br> Тема: '.$theme.'<br> Проблема: ' . $problem.'<br>';
    $mail->AltBody = '';
        
    $mail->addAddress('kirubush@mail.ru', "симтек");  //Кому письмо
    if ($user_name != '') {    
        if(!$mail->send()) {
            echo $mail->ErrorInfo;
        } else {
            // echo 'Отправленно уведомление на почту администратору';
        }
    }
    $question_created = $link->query("INSERT INTO questions (theme, course, userid, problem, about, userfile) VALUES ('$theme', '$course', '$user_id', '$problem', '$about', '$userfile')");
    
    if ($question_created) {
        require_once('ask.html');
    } else {
        $question_not_created = 'true';
        require_once('ask.html');
    }

} else {
    require('ask.html');
}



exit;
?>