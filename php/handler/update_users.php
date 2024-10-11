<?php 
session_start();
require_once '../config/connect.php';

if(empty($_SESSION['user'])) {
        header('Location: ../../authorization.php');
}

if(isset($_POST['update']))
{
        $idd = $_POST['idd'];
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $telephone = trim($_POST['tel']);
        $email = trim($_POST['email']);
        $login = trim($_POST['login']);
        $country = trim($_POST['country']);
        $city = trim($_POST['city']);
        $dateofbd = trim($_POST['date']);
        $foto = trim($_POST['foto']);
        $id_access_rights = trim($_POST['id_access_rights']);

        if(empty($name) || empty($telephone) || empty($email) || empty($login)) {
                $_SESSION['message'] = 'Пожалуйста, заполните поля с именем/телефоном/почтой/логином.';
                header('Location: ../../update_info.php');
                exit;
        }

        $stmt = $link->prepare("SELECT `login` FROM `users` WHERE `id_users`=?");
        $stmt->bind_param("i", $idd);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_data = $result->fetch_assoc();
        $stmt->close();

        // Проверка уникальности логина, если он был изменен
        if($login !== $user_data['login']) {
                $stmt = $link->prepare("SELECT * FROM `users` WHERE `login`=?");
                $stmt->bind_param("s", $login);
                $stmt->execute();
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                        $_SESSION['message'] = 'Такой логин уже занят.';
                        header('Location: ../../update_info.php');
                        exit;
                }
                $stmt->close();
        }

        $path = '../admin/img/';
        $path2 = 'php/admin/img/';
        $types = array('image/gif', 'image/png', 'image/jpeg');
        $size = 1024009990;
        $namez = $_FILES['img']['name'];
        $ext = substr($namez, strpos($namez,'.'), strlen($namez)-1);

        if(!empty($namez)) {
                if (!in_array($_FILES['img']['type'], $types))
                die('Запрещенный тип файла.');
                if ($_FILES['img']['size'] > $size)
                die('Слишком большой размер файла.');
                $nameFile =  uniqid($namez).'.'.$ext;
                if (copy($_FILES['img']['tmp_name'], $path . $nameFile)) {
                        if ($dateofbd === '') { 
                                $queryr = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `telephone` = '$telephone', `email` = '$email', `login` = '$login', `country` = '$country', `city` = '$city', `datebd` = NULL, `photo_profile` = '$nameFile', `id_access_rights` = '$id_access_rights' WHERE `id_users` = '$idd'";
                        } else {
                                $queryr = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `telephone` = '$telephone', `email` = '$email', `login` = '$login', `country` = '$country', `city` = '$city', `datebd` = '$dateofbd', `photo_profile` = '$nameFile', `id_access_rights` = '$id_access_rights' WHERE `id_users` = '$idd'";
                        }
                            mysqli_query($link, $queryr) or die(mysqli_error($link));
                            $_SESSION['message'] = 'Изменения сохранены';
                            header('Location: ../../update_info.php');
                } else {
                        $_SESSION['message'] = 'Что-то произошло не так. Попробуйте заново.';
                        header('Location: ../../update_info.php');
                        }
        } else {
                if ($dateofbd === '') { 
                        $queryr = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `telephone` = '$telephone', `email` = '$email', `login` = '$login', `country` = '$country', `city` = '$city', `datebd` = NULL, `photo_profile` = IF(`photo_profile` = '', 'empty_foto_profile.jpg', `photo_profile`), `id_access_rights` = '$id_access_rights' WHERE `id_users` = '$idd'";
                } else {
                        $queryr = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `telephone` = '$telephone', `email` = '$email', `login` = '$login', `country` = '$country', `city` = '$city', `datebd` = '$dateofbd', `photo_profile` = IF(`photo_profile` = '', 'empty_foto_profile.jpg', `photo_profile`), `id_access_rights` = '$id_access_rights' WHERE `id_users` = '$idd'";
                }
                mysqli_query($link, $queryr) or die(mysqli_error($link));
                $_SESSION['message'] = 'Изменения сохранены';
                header('Location: ../../update_info.php');
            }
}