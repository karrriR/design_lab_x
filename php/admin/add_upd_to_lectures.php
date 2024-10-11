<?php
session_start();
require_once '../config/connect.php';

if(empty($_SESSION['user'])) {
    header('Location: authorization.php');
    exit; 
} else {
    $id_access_rights = $_SESSION['user']['id_access_rights'];
    if($id_access_rights == 1) {
        header('Location: profile.php');
        exit; 
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['action'])) {
        $action = $_POST['action'];

        if($action === 'updateRecordButton') {
            // Получение данных из формы
            $id_lectures = htmlspecialchars($_POST['id_lectures']);
            $id_section = htmlspecialchars($_POST['id_section']);
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $document = isset($_FILES['doc']) ? $_FILES['doc'] : null;

            // Проверка обязательных полей
            if (empty($id_section) || empty($name) || empty($description)) {
                echo json_encode(array('error' => 'Пожалуйста, заполните все обязательные поля.'));
                exit;
            }

            // Проверка существования раздела курса
            $stmt = $link->prepare("SELECT * FROM course_sections WHERE id_course_sections=?");
            $stmt->bind_param("i", $id_section);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанного раздела курса не существует.'));
                exit;
            }
            $stmt->close();

            // Проверка загрузки документа
            if (!empty($document['name'])) {
                $path = 'documents/';
                $allowed_types = array('application/pdf');
                $max_size = 10485760; // Максимальный размер файла (в байтах), здесь 10 MB

                // Проверка типа файла
                if (!in_array($document['type'], $allowed_types)) {
                    echo json_encode(array('error' => 'Запрещенный тип файла.'));
                    exit;
                }

                // Проверка размера файла
                if ($document['size'] > $max_size) {
                    echo json_encode(array('error' => 'Файл слишком большой.'));
                    exit;
                }

                // Генерация уникального имени файла
                $file_name = uniqid() . '_' . $document['name'];

                // Перемещение файла из временного хранилища в указанную директорию
                if (!move_uploaded_file($document['tmp_name'], $path . $file_name)) {
                    echo json_encode(array('error' => 'Ошибка загрузки файла.'));
                    exit;
                }
            }

            // Обновление записи
            if (!empty($document['name'])) {
                // Если документ загружен, формируем запрос с вставкой документа
                $query = "UPDATE lectures SET id_section=?, name=?, description=?, document=? WHERE id_lectures=?";
                $stmt = $link->prepare($query);
                $stmt->bind_param("isssi", $id_section, $name, $description, $file_name, $id_lectures);
            } else {
                // Если документ не загружен, формируем запрос без вставки документа
                $query = "UPDATE lectures SET id_section=?, name=?, description=? WHERE id_lectures=?";
                $stmt = $link->prepare($query);
                $stmt->bind_param("isss", $id_section, $name, $description, $id_lectures);
            }

            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно обновлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка обновления записи: ' . $stmt->error));
            }

            $stmt->close();
        } else if ($action === 'addRecordButton') {
            // Получение данных из формы
            $id_section = htmlspecialchars($_POST['id_section']);
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $document = isset($_FILES['doc']) ? $_FILES['doc'] : null;
            
            // Проверка обязательных полей
            if(empty($id_section) || empty($name) || empty($description) || empty($document['name'])) {
                echo json_encode(array('error' => 'Пожалуйста, заполните все обязательные поля.'));
                exit;
            }

            // Проверка существования раздела курса
            $stmt = $link->prepare("SELECT * FROM course_sections WHERE id_course_sections=?");
            $stmt->bind_param("i", $id_section);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанного раздела курса не существует.'));
                exit;
            }
            $stmt->close();

            // Загрузка документа
            $path = 'documents/';
            $allowed_types = array('application/pdf');
            $max_size = 10485760; // Максимальный размер файла (в байтах), здесь 10 MB

            // Проверка типа файла
            if (!in_array($document['type'], $allowed_types)) {
                echo json_encode(array('error' => 'Запрещенный тип файла.'));
                exit;
            }

            // Проверка размера файла
            if ($document['size'] > $max_size) {
                echo json_encode(array('error' => 'Файл слишком большой.'));
                exit;
            }

            // Генерация уникального имени файла
            $file_name = uniqid() . '_' . $document['name'];

            // Перемещение файла из временного хранилища в указанную директорию
            if (move_uploaded_file($document['tmp_name'], $path . $file_name)) {
                // Добавление записи в базу данных
                $query = "INSERT INTO lectures (id_section, name, description, document) VALUES (?, ?, ?, ?)";
                $stmt = $link->prepare($query);
                $stmt->bind_param("isss", $id_section, $name, $description, $file_name);

                if ($stmt->execute()) {
                    echo json_encode(array('message' => 'Запись успешно добавлена!'));
                } else {
                    echo json_encode(array('error' => 'Ошибка добавления записи: ' . $stmt->error));
                }

                $stmt->close();
            } else {
                echo json_encode(array('error' => 'Ошибка загрузки файла.'));
            }
        }
    }
}
?>