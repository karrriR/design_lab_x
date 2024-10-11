<?php
session_start();
require_once '../config/connect.php';

if (empty($_SESSION['user'])) {
    header('Location: ../../authorization.php');
    exit;
}

if (isset($_POST['update'])) {
    $idd = $_POST['idd'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $user = $_SESSION['user'];
    $storedPassword = $user['password'];

    if (!empty($oldPassword) && !empty($newPassword) && !empty($confirmPassword)) {
        if (password_verify($oldPassword, $storedPassword)) {
            if ($newPassword === $confirmPassword) {
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $query = "UPDATE `users` SET `password` = '$hashedNewPassword' WHERE `id_users` = '$idd'";
                mysqli_query($link, $query) or die(mysqli_error($link));
                $_SESSION['message'] = 'Пароль успешно изменен.';
                header('Location: ../../profile.php');
                exit;
            } else {
                $_SESSION['message'] = 'Новые пароли не совпадают.';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            $_SESSION['message'] = 'Старый пароль неверный.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } else {
        $_SESSION['message'] = 'Пожалуйста, заполните все поля.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>