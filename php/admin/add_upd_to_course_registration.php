<?php
session_start();
require_once '../config/connect.php';

if(empty($_SESSION['user'])) {
    header('Location: authorization.php');
} else {
    $id_access_rights = $_SESSION['user']['id_access_rights'];
    if($id_access_rights == 1) {
        header('Location: profile.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['action'])) {
        $action = $_POST['action'];

        if($action === 'updateRecordButton') {
            $id = $_POST['id_course_registration'];
            $id_user = $_POST['id_user'];
            $id_course = $_POST['id_course'];
            $tariff_name = htmlspecialchars($_POST['tariff_name']);
            $application_status = htmlspecialchars($_POST['application_status']);

            // Проверка на существование id_user и id_course в таблицах courses и users
            $stmt_check_user = $link->prepare("SELECT * FROM users WHERE id_users = ?");
            $stmt_check_user->bind_param("i", $id_user);
            $stmt_check_user->execute();
            $result_check_user = $stmt_check_user->get_result();
            if($result_check_user->num_rows === 0) {
                echo json_encode(array('error' => 'Пользователь с указанным ID не существует.'));
                exit;
            }
            $stmt_check_user->close();

            $stmt_check_course = $link->prepare("SELECT * FROM courses WHERE id_courses = ?");
            $stmt_check_course->bind_param("i", $id_course);
            $stmt_check_course->execute();
            $result_check_course = $stmt_check_course->get_result();
            if($result_check_course->num_rows === 0) {
                echo json_encode(array('error' => 'Курс с указанным ID не существует.'));
                exit;
            }
            $stmt_check_course->close();

            $allowed_tariffs = array("basic", "optimal", "vip");
            if (!in_array($tariff_name, $allowed_tariffs)) {
                echo json_encode(array('error' => 'Недопустимое значение для тарифа.'));
                exit;
            }

            // Проверка значения поля application_status
            if ($application_status !== 'pending' && $application_status !== 'approved') {
                echo json_encode(array('error' => 'Недопустимое значение для статуса заявки.'));
                exit;
            }

            // Обновление записи
            $stmt = $link->prepare("UPDATE course_registration SET id_user=?, id_course=?, tariff_name=?, application_status=? WHERE id_course_registration=?");
            $stmt->bind_param("iissi", $id_user, $id_course, $tariff_name, $application_status, $id);

            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно обновлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка обновления записи: ' . $link->error));
            }

            $stmt->close();
        } else {
            $id_user = $_POST['id_user'];
            $id_course = $_POST['id_course'];
            $tariff_name = htmlspecialchars($_POST['tariff_name']);
            $application_status = "pending"; // При добавлении записи статус заявки "pending"
            $sending_date = date('Y-m-d H:i:s'); // Текущая дата и время

            // Проверка на существование id_user и id_course в таблицах courses и users
            $stmt_check_user = $link->prepare("SELECT * FROM users WHERE id_users = ?");
            $stmt_check_user->bind_param("i", $id_user);
            $stmt_check_user->execute();
            $result_check_user = $stmt_check_user->get_result();
            if($result_check_user->num_rows === 0) {
                echo json_encode(array('error' => 'Пользователь с указанным ID не существует.'));
                exit;
            }
            $stmt_check_user->close();

            $stmt_check_course = $link->prepare("SELECT * FROM courses WHERE id_courses = ?");
            $stmt_check_course->bind_param("i", $id_course);
            $stmt_check_course->execute();
            $result_check_course = $stmt_check_course->get_result();
            if($result_check_course->num_rows === 0) {
                echo json_encode(array('error' => 'Курс с указанным ID не существует.'));
                exit;
            }
            $stmt_check_course->close();

            $allowed_tariffs = array("basic", "optimal", "vip");
            if (!in_array($tariff_name, $allowed_tariffs)) {
                echo json_encode(array('error' => 'Недопустимое значение для тарифа.'));
                exit;
            }

            // Вставка новой записи
            $stmt = $link->prepare("INSERT INTO course_registration (id_user, id_course, tariff_name, application_status, sending_date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisss", $id_user, $id_course, $tariff_name, $application_status, $sending_date);
            
            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно добавлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка добавления записи: ' . $link->error));
            }

            $stmt->close();
        }

    }
}
?>