<?php

require 'connect.php';
require 'functions.php';
require_once 'paginator.php';

mysqli_set_charset($link, "utf8mb4");

$response = '';
$responseErr = '';

$question_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : false;

if ($question_id) {
    if (!$question_number = my_decrypt($question_id)) {
        $not_authorized = true;
        require('auth.html');
        exit;
    } else {
        $question_data = "SELECT questions.theme, questions.problem, questions.userfile, questions.about, answers.response, questions.UserId FROM questions LEFT JOIN answers ON questions.Id=answers.QuestionId WHERE questions.Id='$question_number' limit 1";
        $question_data = $link->query($question_data);
        $question_data = mysqli_fetch_array($question_data, MYSQLI_ASSOC);
        $question_userId = $question_data['UserId'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST["response"])) {
        $responseErr = "Заполните поле";
        require_once('respond.html');
        exit;
        } else {
            $response = get_input($_POST["response"]);

        }
    if (!$question_data['response']) {
        $response_insert = "INSERT INTO answers (QuestionId, UserId, response) VALUES ( '$question_number', '$question_userId', '$response')";
        $result = $link->query($response_insert);
    } else {
        $result = $link->query("UPDATE answers SET response='$response' WHERE Answers.QuestionId='$question_number'");
    }
    if ($result) {
        $response_made = "ОТВЕТ УСПЕШНО СДЕЛАН";
        $user_id = $question_data['UserId'];
        $limit      = isset( $_GET['limit'] ) ? $_GET['limit'] : 5;
        $page       = isset( $_GET['page'] ) ? $_GET['page'] : 1;
        $links      = isset( $_GET['links'] ) ? $_GET['links'] : 7;
        $quest_query = "SELECT questions.Id, questions.course, questions.theme, questions.problem, questions.userfile, users.first_name, users.email, answers.response FROM questions JOIN users ON users.Id = questions.UserId LEFT JOIN answers ON answers.QuestionId=questions.Id";
        $Page_quest  = new Paginator( $link, $quest_query );
        $ask_form    = $Page_quest->getData( $limit, $page );
        // $all_question_data = $link->query("SELECT questions.Id, questions.course, questions.theme, questions.problem, questions.userfile, users.first_name, users.email, answers.response FROM questions JOIN users ON users.Id = questions.UserId LEFT JOIN answers ON answers.QuestionId=questions.Id");
        // while ($result = mysqli_fetch_array($all_question_data, MYSQLI_ASSOC)) {
        //     $ask_form[] = $result;
        // }
        require 'questions.html';
    } else {
        $response_failed = true;
        require 'respond.html';
    }
    
} else {
    require 'respond.html';
}

exit;
?>