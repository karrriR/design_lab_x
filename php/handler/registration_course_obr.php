<?php
session_start();
require_once '../config/connect.php';

if(!isset($_SESSION['user'])) {
    $_SESSION['message'] = 'Пожалуйста, пройдите авторизацию для записи на курс.'; 
    header('Location:' . $_SERVER['HTTP_REFERER']); 
exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['registration_course'])) {
        $name = htmlspecialchars($_POST['name']); 
        $email = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['tel']);
        $checkbox = isset($_POST['personal-data']);
        $rate = $_POST['rate'];

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
        if (empty($rate)) {
            $_SESSION['message'] = 'Пожалуйста, выберите тариф перед отправкой заявки.'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = 'Email некорректный'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
            exit;
        }
        $course_id = $_POST['id_course'];
        $user_id = $_SESSION['user']['id_users'];
        $sending_date = date("Y-m-d H:i:s");
        $application_status = "pending";

        $queryuser = "SELECT * FROM `users` WHERE `id_users` = '$user_id'";
        $resultuser = mysqli_query($link, $queryuser);
        $user_profile = mysqli_fetch_assoc($resultuser);

        if (empty($user_profile['name']) || empty($user_profile['telephone']) || empty($user_profile['email'])) {
            $_SESSION['message'] = 'Сначала полностью заполните ваш профиль.'; 
            header('Location:' . $_SERVER['HTTP_REFERER']); 
            exit;
        }
        if ($name !== $user_profile['name'] || $tel !== $user_profile['telephone'] || $email !== $user_profile['email']) {
            $_SESSION['message'] = 'Пожалуйста, убедитесь, что все ваши данные внесены корректно. Проверьте ваш профиль и убедитесь, что данные в полях совпадают с вашими данными профиля.';
            header('Location:' . $_SERVER['HTTP_REFERER']); 
            exit;
        }

        $sql = "SELECT * FROM `course_registration` WHERE `id_user`='$user_id' AND `id_course`='$course_id'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = 'Вы уже отправили заявку на данный курс.';
            header('Location:' . $_SERVER['HTTP_REFERER']);
        } else {
            $query = "INSERT INTO `course_registration` (`id_user`, `id_course`, `tariff_name`, `sending_date`, `application_status`) VALUES ('$user_id', '$course_id', '$rate', '$sending_date', '$application_status')";
            $result_reg = mysqli_query($link, $query); 
            if ($result_reg) {
                $_SESSION['message'] = 'Ваша заявка успешно принята. Ожидайте звонка для подтверждения записи на курс.'; 
                header('Location:' . $_SERVER['HTTP_REFERER']); 
                exit;
            } else {
                $_SESSION['message'] = 'Произошла ошибка. Попробуйте заново.'; 
                header('Location:' . $_SERVER['HTTP_REFERER']); 
                exit;
            }
        }
    }

} else {
    $_SESSION['message'] = 'Недопустимый метод запроса';
    header('Location:' . $_SERVER['HTTP_REFERER']); 
    exit;
}