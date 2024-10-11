<?php
session_start();
require_once '../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user']['id_users'];
    $deleteQuery = "DELETE FROM `users` WHERE `id_users` = $userId"; 
    $result = mysqli_query($link, $deleteQuery);

    if ($result) {
        session_destroy();
        header('Location: ../../authorization.php');
        exit;
    } else {
        $_SESSION['message'] = 'Произошла ошибка при удалении профиля';
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
} else {
    $_SESSION['message'] = 'Недопустимый метод запроса';
    header('Location:' . $_SERVER['HTTP_REFERER']);
}