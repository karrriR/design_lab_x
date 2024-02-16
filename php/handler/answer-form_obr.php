<?php
session_start();
require_once '../config/connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['answer'])) {
        $name = htmlspecialchars($_POST['name']); 
        $email = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['tel']);
        $message = htmlspecialchars($_POST['message']);
        $checkbox = isset($_POST['personal-data']);

        if (empty($name) || empty($email) || empty($tel) || empty($message)) {
            $_SESSION['message'] = 'Сначала введите все данные в поля.'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
            exit;
        }
        if (!$checkbox) {
            $_SESSION['message'] = 'Дайте согласие на обработку персональных данных'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = 'Email некорректный'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
            exit;
        }

        $insertQuery = "INSERT INTO `answers` (`name`, `email`, `telephone`, `message`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $tel, $message);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            $_SESSION['message'] = 'Ваш вопрос будет рассмотрен. Ожидайте ответа.'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
            exit;
        } else {
            $_SESSION['message'] = 'Произошла ошибка. Попробуйте заново.'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
            exit;
        }
    }

} else {
    $_SESSION['message'] = 'Недопустимый метод запроса';
    header('Location:' . $_SERVER['HTTP_REFERER']); 
    exit;
}