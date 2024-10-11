<?php
session_start(); 
require_once '../config/connect.php';

if(empty($_SESSION['user'])) {
    header('Location: ../../authorization.php');
}

if (isset($_POST['saveResults'])) {
    $id_user = $_SESSION['user']['id_users'];
    $id_test = $_POST['id_test']; // Используем значение id теста, полученное из формы
    $attemptsLeft = $_POST['attemptsLeft'];

    $totalQuestionsSql = "SELECT COUNT(*) AS total_questions FROM `test_questions` WHERE `id_test` = '$id_test'";
    $totalQuestionsResult = mysqli_query($link, $totalQuestionsSql);

    if ($totalQuestionsResult && $row = mysqli_fetch_assoc($totalQuestionsResult)) {
        $questions_total = $row['total_questions'];
        $questions_right = $_POST['correctAnswersCount'];
        $test_attempts = $attemptsLeft;  // Использование количества оставшихся попыток
        $test_completed = ($questions_right < $questions_total / 2) ? 0 : 1;  // Проверка на завершенность теста

        $sql = "INSERT INTO `user_test_progress` (`id_user`, `id_test`, `questions_total`, `questions_right`, `test_attempts`, `test_completed`) 
          VALUES ('$id_user', '$id_test', '$questions_total', '$questions_right', '$test_attempts', '$test_completed')";

        if (mysqli_query($link, $sql)) {
            echo "Результаты успешно сохранены";
        } else {
            echo "Ошибка при сохранении результатов: " . mysqli_error($link);
        }
        
    } else {
        echo "Ошибка при получении количества вопросов";
    }
}
