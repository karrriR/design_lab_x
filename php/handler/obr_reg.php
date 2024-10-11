<?php
session_start();
require_once '../config/connect.php';

if(isset($_POST['reg'])) 
{
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $password = trim($_POST['password']); 
    $confirmPassword = trim($_POST['confirmPassword']); 
    if(!empty($password) and !empty($confirmPassword) and !empty($email) and !empty($login)) { 
        $sql = "SELECT * FROM `users` WHERE `login` = '$login'"; 
        $result = mysqli_query($link, $sql); 
        $count = mysqli_num_rows($result); 
        if($count > 0) { 
            $_SESSION['message'] = 'Такой логин уже существует. Придумайте другой'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
        } else {
            if (strlen($password) >= 6) { 
                if (preg_match('/^[\w\.-]+@[\w\.-]+\.\w+$/', $email)) { 
                    $email = addslashes($email); 
                    $login = addslashes($login);
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    if (password_verify($confirmPassword, $hashedPassword)) {
                        $reg_user = "INSERT INTO `users` (`name`, `surname`, `telephone`, `email`, `login`, `password`, `country`, `city`, `datebd`, `photo_profile`, `id_access_rights`) VALUES ('', '', '', '$email', '$login', '$hashedPassword', '', '', NULL, 'empty_foto_profile.jpg', '1')"; 
                        $result_reg = mysqli_query($link, $reg_user); 
                        $_SESSION['message'] = 'Регистрация прошла успешно'; 
                        header('Location:' . $_SERVER['HTTP_REFERER']); 
                    } else {
                        $_SESSION['message'] = 'Повторный пароль не соответствует паролю'; 
                        header('Location:' . $_SERVER['HTTP_REFERER']); 
                    }
                } else {
                    $_SESSION['message'] = 'Email некорректный';
                    header('Location:' . $_SERVER['HTTP_REFERER']);
                }
            } else {
                $_SESSION['message'] = 'Пароль должен быть не менее 6 символов'; 
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    } else {
        $_SESSION['message'] = 'Сначала введите все данные в поля.';
        header('Location:' . $_SERVER['HTTP_REFERER']);
        
    }
}