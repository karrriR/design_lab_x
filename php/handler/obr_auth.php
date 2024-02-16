<?php
session_start();
require_once '../config/connect.php';

if(!empty($_POST['auth']))
{
    $login = trim($_POST['login']);
    $pass = md5(trim($_POST['password']));

    if(isset($_POST['g-recaptcha-response'])){
        $recapcha = $_POST['g-recaptcha-response'];
        if(!$recapcha) {
            $_SESSION['message'] = 'Подтвердите, что вы не робот';
            header('Location:' . $_SERVER['HTTP_REFERER']);
        } else {
            $secretKey = '6LeBxtMmAAAAAOSJA4XI2nSeyC00NV9B82I8Z29v';
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$recapcha;
            $response = file_get_contents($url);
            $responseKey = json_decode($response, true);
    
            if($responseKey['success']){
                if(!empty($_POST['login']) and !empty($_POST['password'])) {
                    $check_user = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login'");
                    if (mysqli_num_rows($check_user) > 0) {
            
                        $user = mysqli_fetch_assoc($check_user);
                        $_SESSION['user'] = [
                            "id_users" => $user['id_users'],
                            "name" => $user['name'],
                            "surname" => $user['surname'],
                            "telephone" => $user['telephone'],
                            "email" => $user['email'],
                            "login" => $user['login'],
                            "password" => $user['password'],
                            "country" => $user['country'],
                            "city" => $user['city'],
                            "dateofbd" => $user['dateofbd'],
                            "photo_profile" => $user['photo_profile'],
                            "id_access_rights" => $user['id_access_rights']
                        ];
                        header('Location: ../../profile.php');
                    } elseif (mysqli_num_rows($check_user) == 0) {
                        $_SESSION['message'] = 'Неправильный логин или пароль';
                        header('Location:' . $_SERVER['HTTP_REFERER']);
                    }
                } else {
                    $_SESSION['message'] = 'Введите логин и пароль';
                    header('Location:' . $_SERVER['HTTP_REFERER']);
                    }
            } else {
                $_SESSION['message'] = 'Произошла ошибка. Попробуйте снова.';
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
} 