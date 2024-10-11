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
            $id = $_POST['id_tests'];
            $id_course = $_POST['id_course'];
            $id_section = $_POST['id_section'];
            $description = htmlspecialchars($_POST['description']);

            if (empty($id_course) || empty($id_section) || empty($description)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }

            // Проверка существования курса
            $stmt = $link->prepare("SELECT * FROM courses WHERE id_courses=?");
            $stmt->bind_param("i", $id_course);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанного курса не существует.'));
                exit;
            }

            // Проверка существования секции курса
            $stmt = $link->prepare("SELECT * FROM course_sections WHERE id_course_sections=? AND id_course=?");
            $stmt->bind_param("ii", $id_section, $id_course);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанного раздела курса не существует.'));
                exit;
            }

             // Проверяем, изменились ли поля курса и секции
            $stmt = $link->prepare("SELECT id_course, id_section FROM tests WHERE id_tests=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $old_test_data = $result->fetch_assoc();
            $stmt->close();
 
            if ($old_test_data['id_course'] != $id_course || $old_test_data['id_section'] != $id_section) {
                // Проверка на уникальность теста внутри секции курса
                $stmt = $link->prepare("SELECT * FROM tests WHERE id_course=? AND id_section=?");
                $stmt->bind_param("ii", $id_course, $id_section);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo json_encode(array('error' => 'Тест для указанного раздела курса уже существует.'));
                    exit;
                }
                $stmt->close();
            }

            $stmt = $link->prepare("UPDATE tests SET id_course=?, id_section=?, description=? WHERE id_tests=?");
            $stmt->bind_param("iisi", $id_course, $id_section, $description, $id);

            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно обновлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка обновления записи: ' . $link->error));
            }

            $stmt->close();
        } else {
            $id_course = $_POST['id_course'];
            $id_section = $_POST['id_section'];
            $description = htmlspecialchars($_POST['description']);

            if (empty($id_course) || empty($id_section) || empty($description)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }

            // Проверка существования курса
            $stmt = $link->prepare("SELECT * FROM courses WHERE id_courses=?");
            $stmt->bind_param("i", $id_course);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанного курса не существует.'));
                exit;
            }

            // Проверка существования секции курса
            $stmt = $link->prepare("SELECT * FROM course_sections WHERE id_course_sections=? AND id_course=?");
            $stmt->bind_param("ii", $id_section, $id_course);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанного раздела курса не существует.'));
                exit;
            }

            // Проверка на уникальность теста внутри секции курса
            $stmt = $link->prepare("SELECT * FROM tests WHERE id_course=? AND id_section=?");
            $stmt->bind_param("ii", $id_course, $id_section);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo json_encode(array('error' => 'Тест для указанного раздела курса уже существует.'));
                exit;
            }

            $stmt = $link->prepare("INSERT INTO tests (id_course, id_section, description) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $id_course, $id_section, $description);

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