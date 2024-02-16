<?php
session_start();
require_once '../config/connect.php';

if(isset($_POST['reg'])) 
{
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $telephone = trim($_POST['tel']);
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $password = md5(trim($_POST['password'])); 
    if(!empty($_POST['name']) and !empty(md5($_POST['password'])) and !empty($_POST['surname']) and !empty($_POST['tel']) and !empty($_POST['email']) and !empty($_POST['login'])) { 
        $sql = "SELECT * FROM `users` WHERE `login` = '$login'"; 
        $result = mysqli_query($link, $sql); 
        $count = mysqli_num_rows($result); 
        if($count > 0) { 
            $_SESSION['message'] = 'Такой логин уже существует. Придумайте другой'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
        } else {
            if (strlen($_POST['password']) >= 6) { 
                if (preg_match('/^[\w\.-]+@[\w\.-]+\.\w+$/', $email)) { 
                    $name = addslashes($name); 
                    $surname = addslashes($surname); 
                    $telephone = addslashes($telephone); 
                    $email = addslashes($email); 
                    $login = addslashes($login);
                    $password = addslashes($password);
                    $reg_user = "INSERT INTO `users` (`name`, `surname`, `telephone`, `email`, `login`, `password`, `country`, `city`, `dateofbd`, `photo_profile`, `id_access_rights`) VALUES ('$name', '$surname', '$telephone', '$email', '$login', '$password', '', '', '', '', '1')"; 
                    $result_reg = mysqli_query($link, $reg_user); 
                    $_SESSION['message'] = 'Регистрация прошла успешно'; 
                    header('Location:' . $_SERVER['HTTP_REFERER']); 
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
