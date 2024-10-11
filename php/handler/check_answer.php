<?php
session_start();
require_once '../config/connect.php';

if(empty($_SESSION['user'])) {
    header('Location: ../../authorization.php');
}

$selectedAnswer = $_POST['selectedAnswer'];
$currentQuestion = $_POST['currentQuestion'];
$id_test = $_POST['id_test'];

// Получение правильного ответа из базы данных
$sql = "SELECT `correct_answer` FROM `test_questions` WHERE `number_question` = '$currentQuestion' AND `id_test` = '$id_test'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$correctAnswer = $row['correct_answer'];

// Проверка правильности ответа
if ($selectedAnswer === $correctAnswer) {
    echo json_encode(array('result' => 'correct'));
} else {
    echo json_encode(array('result' => 'incorrect'));
}