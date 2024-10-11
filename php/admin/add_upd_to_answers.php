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
            $id = $_POST['id_answer'];
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $telephone = preg_replace("/\D+/", "", $_POST['telephone']);
            $message = htmlspecialchars($_POST['message']);
    
            if (empty($name) || empty($email) || empty($telephone) || empty($message)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(array('error' => 'Email некорректный'));
                exit;
            }
    
            $stmt = $link->prepare("UPDATE answers SET name=?, email=?, telephone=?, message=? WHERE id_answer=?");
            $stmt->bind_param("ssssi", $name, $email, $telephone, $message, $id);
    
            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно обновлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка обновления записи: ' . $link->error));
            }
    
            $stmt->close();
        } else {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $telephone = preg_replace("/\D+/", "", $_POST['telephone']);
            $message = htmlspecialchars($_POST['message']);
        
            if (empty($name) || empty($email) || empty($telephone) || empty($message)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(array('error' => 'Email некорректный'));
                exit;
            }
            $stmt = $link->prepare("INSERT INTO answers (name, email, telephone, message) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $telephone, $message);
            
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