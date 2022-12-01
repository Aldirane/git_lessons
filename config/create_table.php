<?php 

include('connect_super.php');
include_once '../functions.php';

$tableErr = 'tableErr';
$select_db = 'USE aldar_mandzhiev';

if ($conn) {
    if (mysqli_query($conn, $select_db)) {
        echo "Database aldar_mandzhiev selected successfully" . "<br>";
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

$sql_drop_table = "DROP TABLE IF EXISTS users, questions, answers";

$sql_create_table_users = "CREATE TABLE Users(
    Id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(256) NOT NULL,
    last_name VARCHAR(256) NOT NULL,
    email VARCHAR(256) NOT NULL UNIQUE,
    gender CHAR(1) NOT NULL,
    password VARCHAR(256) NOT NULL,
    staff TINYINT(1) NOT NULL)";

$sql_create_table_questions = "CREATE TABLE Questions(
    Id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    theme VARCHAR (256) NOT NULL,
    course VARCHAR (256) NOT NULL,
    UserId INT(11) NOT NULL,
    problem VARCHAR (256) NOT NULL,
    about TEXT NOT NULL,
    userfile VARCHAR (256) NULL,
    FOREIGN KEY (UserId) REFERENCES Users(Id) ON DELETE CASCADE)";

$sql_create_table_answers = "CREATE TABLE Answers(
    AnswerId INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    response TEXT NOT NULL,
    UserId INT(11) NOT NULL,
    QuestionId INT(11) NOT NULL,
    FOREIGN KEY (QuestionId) REFERENCES Questions(Id) ON DELETE CASCADE,
    FOREIGN KEY (UserId) REFERENCES Users(Id) ON DELETE CASCADE)";

$queries = array($sql_drop_table, $sql_create_table_users, $sql_create_table_questions, $sql_create_table_answers);

 

foreach ($queries as $query) {
    sql_func($conn, $query, $tableErr);
}


mysqli_close($conn);

?>