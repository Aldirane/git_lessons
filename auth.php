<?php

require 'connect.php';
require 'functions.php';
require_once 'paginator.php';

mysqli_set_charset($link, "utf8mb4");
$user_token = isset($_GET['user_token']) ? $_GET['user_token'] : false;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : false;

$emailErr=$passwordErr='';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staff_true = isset($_POST['staff']) ? get_input($_POST['staff']) : 0;
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        require_once('auth.html');
        exit;
        } else {
            $email = get_input($_POST["email"]);
            }
    $user = $link->query("SELECT Id, email, password, staff FROM users WHERE email = '$email' limit 1");

    $user_fetch = mysqli_fetch_array($user, MYSQLI_ASSOC);

    if ($user_fetch) {
        $user_id = $user_fetch['Id'];
        $user_name = $user_fetch['email'];

        if ($staff_true) {
            if ($user_fetch['staff']==1) {
                if (password_verify(get_input($_POST['password']), $user_fetch['password'])) {
                    $users_data = $link->query('SELECT * FROM users');
                    while ($result = mysqli_fetch_array($users_data, MYSQLI_ASSOC)) {
                        $users[] = $result;
                    }
                    $user_token = my_encrypt($user_id);
                    $limit      = isset( $_GET['limit'] ) ? $_GET['limit'] : 5;
                    $page       = isset( $_GET['page'] ) ? $_GET['page'] : 1;
                    $links      = isset( $_GET['links'] ) ? $_GET['links'] : 7;
                    $quest_query = "SELECT questions.Id, questions.course, questions.theme, questions.problem, questions.userfile, users.first_name, users.email, answers.response FROM questions JOIN users ON users.Id = questions.UserId LEFT JOIN answers ON answers.QuestionId=questions.Id";
                    $Page_quest  = new Paginator( $link, $quest_query );
                    $ask_form    = $Page_quest->getData( $limit, $page );
                    
                    // $question_data = $link->query("SELECT questions.Id, questions.course, questions.theme, questions.problem, questions.userfile, users.first_name, users.email, answers.response FROM questions JOIN users ON users.Id = questions.UserId LEFT JOIN answers ON answers.QuestionId=questions.Id");
                    // while ($result = mysqli_fetch_array($question_data, MYSQLI_ASSOC)) {
                    //     $ask_form[] = $result;
                    // }
                    require 'questions.html';
                } else {
                    $failed_verify = 'true';
                    $passwordErr = "Invalid password";
                    require_once 'auth.html';
                    exit;
                }
            } else {
                $not_staff = 'true';
                require 'auth.html';
            } 
        } else {
            if (password_verify(get_input($_POST['password']), $user_fetch['password'])) {
                $_POST['user_id'] = $user_id;
                $_POST['user_name'] = $user_name;
                require('ask.html');
                exit;
            } else {
                $failed_verify = 'true';
                $passwordErr = "Invalid password";
                require_once 'auth.html';
                exit;
            }
        }
    } else {
        $failed_verify = 'true';
        require 'auth.html';
    }

} else  {
    if ($user_token  && $user_id) {

        $user_token = my_decrypt($user_token);
        if ($user_token == $user_id) {

            $user_token = my_encrypt($user_id);
            $limit      = isset( $_GET['limit'] ) ? $_GET['limit'] : 5;
            $page       = isset( $_GET['page'] ) ? $_GET['page'] : 1;
            $links      = isset( $_GET['links'] ) ? $_GET['links'] : 7;
            $quest_query = "SELECT questions.Id, questions.course, questions.theme, questions.problem, questions.userfile, users.first_name, users.email, answers.response FROM questions JOIN users ON users.Id = questions.UserId LEFT JOIN answers ON answers.QuestionId=questions.Id";
            $Page_quest  = new Paginator( $link, $quest_query );
            $ask_form    = $Page_quest->getData( $limit, $page );
            require 'questions.html';

        } else {
            $not_staff = 'true';
            require_once 'auth.html';
            exit;
        }
    } else {
        require_once 'auth.html';
    }
}
mysqli_close($link);

exit;
?>