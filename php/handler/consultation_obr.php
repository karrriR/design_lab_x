<?php
session_start();
require_once '../config/connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['consultation'])) {
        $name = htmlspecialchars($_POST['name']); 
        $email = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['tel']);
        $checkbox = isset($_POST['personal-data']);

        if (empty($name) || empty($email) || empty($tel)) {
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

        $insertQuery = "INSERT INTO `consultations` (`name`, `email`, `telephone`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($link, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $tel);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            $_SESSION['message'] = 'Ваша заявка успешно принята. Ожидайте звонка.'; 
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