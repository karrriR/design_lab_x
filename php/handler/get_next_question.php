<?php
session_start();
require_once '../config/connect.php';

if(empty($_SESSION['user'])) {
  header('Location: ../../authorization.php');
}

if (isset($_POST['questionNumber']) && isset($_POST['id_test'])) {
  $questionNumber = $_POST['questionNumber'];
  $id_test = $_POST['id_test'];
  
  $sql = "SELECT * FROM `test_questions` WHERE `id_test` = '$id_test' AND `number_question` = '$questionNumber'";
  $result = mysqli_query($link, $sql);
  $nextQuestion = mysqli_fetch_assoc($result);
  
  header('Content-Type: application/json');
  echo json_encode($nextQuestion);
} else {
  header('Content-Type: application/json');
  echo json_encode(["error" => "questionNumber or id_test parameter is missing"]);
}
?>