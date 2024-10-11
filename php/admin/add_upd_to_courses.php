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
            $id = $_POST['id_courses'];
            $name = htmlspecialchars($_POST['name']);
            $short_description = htmlspecialchars($_POST['short_description']);
            $long_description = htmlspecialchars($_POST['long_description']);
            $duration = htmlspecialchars($_POST['duration']);
            $date_begin = htmlspecialchars($_POST['date_begin']);
            $format_course = htmlspecialchars($_POST['format_course']);
            $busyness = htmlspecialchars($_POST['busyness']);
            $basic_cost = htmlspecialchars($_POST['basic_cost']);
    
            if (empty($name) || empty($short_description) || empty($long_description) || empty($duration) || empty($date_begin) || empty($format_course) || empty($busyness) || empty($basic_cost)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }
            if (!filter_var($basic_cost, FILTER_VALIDATE_INT) || $basic_cost < 1000) {
                echo json_encode(array('error' => 'Цена должна быть числом и быть больше 1000.'));
                exit;
            }
            if (strtotime($date_begin) < time()) {
                echo json_encode(array('error' => 'Дата начала курса не может быть в прошлом.'));
                exit;
            }
    
            $stmt = $link->prepare("UPDATE courses SET name=?, short_description=?, long_description=?, duration=?, date_begin=?, format_course=?, busyness=?, basic_cost=? WHERE id_courses=?");
            $stmt->bind_param("ssssssssi", $name, $short_description, $long_description, $duration, $date_begin, $format_course, $busyness, $basic_cost, $id);
    
            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно обновлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка обновления записи: ' . $link->error));
            }
    
            $stmt->close();
        } else {
            $name = htmlspecialchars($_POST['name']);
            $short_description = htmlspecialchars($_POST['short_description']);
            $long_description = htmlspecialchars($_POST['long_description']);
            $duration = htmlspecialchars($_POST['duration']);
            $date_begin = htmlspecialchars($_POST['date_begin']);
            $format_course = htmlspecialchars($_POST['format_course']);
            $busyness = htmlspecialchars($_POST['busyness']);
            $basic_cost = htmlspecialchars($_POST['basic_cost']);
        
            if (empty($name) || empty($short_description) || empty($long_description) || empty($duration) || empty($date_begin) || empty($format_course) || empty($busyness) || empty($basic_cost)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }
            if (!filter_var($basic_cost, FILTER_VALIDATE_INT) || $basic_cost < 1000) {
                echo json_encode(array('error' => 'Цена должна быть числом и быть больше 1000.'));
                exit;
            }
            if (strtotime($date_begin) < time()) {
                echo json_encode(array('error' => 'Дата начала курса не может быть в прошлом.'));
                exit;
            }
            $stmt = $link->prepare("INSERT INTO courses (name, short_description, long_description, duration, date_begin, format_course, busyness, basic_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $name, $short_description, $long_description, $duration, $date_begin, $format_course, $busyness, $basic_cost);
            
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