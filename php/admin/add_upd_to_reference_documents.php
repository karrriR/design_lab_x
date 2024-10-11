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
            $id = $_POST['id_reference_documents'];
            $id_lecture = $_POST['id_lecture'];
            $link_lecture = htmlspecialchars($_POST['link']);

            if (empty($id_lecture) || empty($link_lecture)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }

            // Проверка существования лекции
            $stmt = $link->prepare("SELECT * FROM lectures WHERE id_lectures=?");
            $stmt->bind_param("i", $id_lecture);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанной лекции не существует.'));
                exit;
            }

            $stmt = $link->prepare("UPDATE reference_documents SET id_lecture=?, link=? WHERE id_reference_documents=?");
            $stmt->bind_param("isi", $id_lecture, $link_lecture, $id);

            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно обновлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка обновления записи: ' . $link->error));
            }

            $stmt->close();
        } else {
            $id_lecture = $_POST['id_lecture'];
            $link_lecture = htmlspecialchars($_POST['link']);

            if (empty($id_lecture) || empty($link_lecture)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }

            // Проверка существования лекции
            $stmt = $link->prepare("SELECT * FROM lectures WHERE id_lectures=?");
            $stmt->bind_param("i", $id_lecture);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанной лекции не существует.'));
                exit;
            }

            $stmt = $link->prepare("INSERT INTO reference_documents (id_lecture, link) VALUES (?, ?)");
            $stmt->bind_param("is", $id_lecture, $link_lecture);

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