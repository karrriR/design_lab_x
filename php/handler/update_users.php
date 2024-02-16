<?php 
session_start();
require_once '../config/connect.php';

if(empty($_SESSION['user'])) {
        header('Location: ../../authorization.php');
}

if(isset($_POST['update']))
{
        $idd = $_SESSION['user'] ['id_users'];
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $telephone = trim($_POST['tel']);
        $email = trim($_POST['email']);
        $login = trim($_POST['login']);
        $password = md5(trim($_POST['password'])); 
        $country = trim($_POST['country']);
        $city = trim($_POST['city']);
        $dateofbd = trim($_POST['date']);
        $foto = trim($_POST['foto']);
        $id_access_rights = trim($_POST['id_access_rights']);

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
                        $queryr = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `telephone` = '$telephone', `email` = '$email', `login` = '$login', `password` = '$password', `country` = '$country', `city` = '$city', `dateofbd` = '$dateofbd', `photo_profile` = '$nameFile', `id_access_rights` = '$id_access_rights' WHERE `id_users` = '$idd'";
                            mysqli_query($link, $queryr) or die(mysqli_error($link));
                            $_SESSION['message'] = 'Изменения сохранены';
                            header('Location: ../../update_info.php');
                } else {
                        $_SESSION['message'] = 'Ниче не получилось';
                        header('Location: ../../update_info.php');
                        }
            } else {
                $queryr = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `telephone` = '$telephone', `email` = '$email', `login` = '$login', `password` = '$password', `country` = '$country', `city` = '$city', `dateofbd` = '$dateofbd', `photo_profile` = '$foto_profile', `id_access_rights` = '$id_access_rights' WHERE `id_users` = '$idd'";
                mysqli_query($link, $queryr) or die(mysqli_error($link));
                $_SESSION['message'] = 'Изменения сохранены';
                header('Location: ../../update_info.php');
            }

        

}