<?php

require 'connect.php';
require 'functions.php';
require 'paginator.php';

mysqli_set_charset($link, "utf8mb4");

$mode = isset($_GET['mode']) ? $_GET['mode'] : false;
$users = isset($_GET['users']) ? $_GET['users'] : false;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : false;

if ($users) {
    if (!$users = my_decrypt($users)) {
        $not_authorized = true;
        require('auth.html');
        exit;
    } else {
        $limit      = isset( $_GET['limit'] ) ? $_GET['limit'] : 5;
        $page       = isset( $_GET['page'] ) ? $_GET['page'] : 1;
        $links      = isset( $_GET['links'] ) ? $_GET['links'] : 4;
        $user_query = "SELECT * FROM users";
        $Page_user = new Paginator( $link, $user_query );
        $user_data = $Page_user->getData($limit, $page);
        $users = my_encrypt($users);
        require 'users.html';
        exit;
    }
}


if ($user_id && $user_id = my_decrypt($user_id)) {
    echo $user_id;
    $limit      = isset( $_GET['limit'] ) ? $_GET['limit'] : 5;
    $page       = isset( $_GET['page'] ) ? $_GET['page'] : 1;
    $links      = isset( $_GET['links'] ) ? $_GET['links'] : 7;
    $answer_query = "SELECT questions.theme, questions.problem, answers.response FROM questions LEFT JOIN answers ON questions.Id=answers.QuestionId WHERE questions.UserId='$user_id'";
    $Page_ans  = new Paginator( $link, $answer_query );
    $user_data = $Page_ans->getData($limit, $page);
    $user = $link->query("SELECT users.email FROM users WHERE users.Id = '$user_id' limit 1");
    $user_fetch = mysqli_fetch_array($user, MYSQLI_ASSOC);
    $user_name = $user_fetch['email'];
    $user_id = my_encrypt($user_id);
    require 'answers.html';
    exit;
} else {
    $not_authorized = true;
    require('auth.html');
    exit;
}

if ($mode=='auth') {
    require('auth.html');
    exit;
} else {
    require('auth.html');
    exit;
}
exit;
?>