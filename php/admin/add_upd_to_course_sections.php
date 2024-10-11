<?php
session_start();
require_once '../config/connect.php';

if (empty($_SESSION['user'])) {
    header('Location: authorization.php');
    exit;
} else {
    $id_access_rights = $_SESSION['user']['id_access_rights'];
    if ($id_access_rights == 1) {
        header('Location: profile.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'updateRecordButton') {
            $id = $_POST['id_course_sections'];
            $id_course = $_POST['id_course'];
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            // Проверка на существование id_course в таблице courses
            $stmt_check_course = $link->prepare("SELECT * FROM courses WHERE id_courses = ?");
            $stmt_check_course->bind_param("i", $id_course);
            $stmt_check_course->execute();
            $result_check_course = $stmt_check_course->get_result();
            if ($result_check_course->num_rows === 0) {
                echo json_encode(array('error' => 'Курс с указанным ID не существует.'));
                exit;
            }
            $stmt_check_course->close();
            // Получение изначального названия раздела
            $stmt_get_original_name = $link->prepare("SELECT name FROM course_sections WHERE id_course_sections = ?");
            $stmt_get_original_name->bind_param("i", $id);
            $stmt_get_original_name->execute();
            $result_original_name = $stmt_get_original_name->get_result();
            $original_name = $result_original_name->fetch_assoc()['name'];
            $stmt_get_original_name->close();
            // Проверка длины наименования раздела
            if (strlen($name) > 50) {
                echo json_encode(array('error' => 'Слишком длинное наименование раздела.'));
                exit;
            }
            // Если название раздела не изменилось, просто обновляем запись
            if ($name === $original_name) {
                $stmt = $link->prepare("UPDATE course_sections SET id_course=?, name=?, description=? WHERE id_course_sections=?");
                $stmt->bind_param("issi", $id_course, $name, $description, $id);
            } else {
                // Проверка на уникальность нового названия раздела для данного курса
                $stmt_check_unique = $link->prepare("SELECT * FROM course_sections WHERE id_course = ? AND name = ?");
                $stmt_check_unique->bind_param("is", $id_course, $name);
                $stmt_check_unique->execute();
                $result_check_unique = $stmt_check_unique->get_result();
                if ($result_check_unique->num_rows > 0) {
                    echo json_encode(array('error' => 'Раздел с таким наименованием уже существует для данного курса.'));
                    exit;
                }
                $stmt_check_unique->close();

                // Обновление записи
                $stmt = $link->prepare("UPDATE course_sections SET id_course=?, name=?, description=? WHERE id_course_sections=?");
                $stmt->bind_param("issi", $id_course, $name, $description, $id);
            }

            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно обновлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка обновления записи: ' . $link->error));
            }

            $stmt->close();
        } else {
            $id_course = $_POST['id_course'];
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            // Проверка на существование id_course в таблице courses
            $stmt_check_course = $link->prepare("SELECT * FROM courses WHERE id_courses = ?");
            $stmt_check_course->bind_param("i", $id_course);
            $stmt_check_course->execute();
            $result_check_course = $stmt_check_course->get_result();
            if ($result_check_course->num_rows === 0) {
                echo json_encode(array('error' => 'Курс с указанным ID не существует.'));
                exit;
            }
            $stmt_check_course->close();
            // Проверка длины наименования раздела
            if (strlen($name) > 50) {
                echo json_encode(array('error' => 'Слишком длинное наименование раздела.'));
                exit;
            }
            // Проверка на уникальность наименования раздела для данного курса
            $stmt_check_unique = $link->prepare("SELECT * FROM course_sections WHERE id_course = ? AND name = ?");
            $stmt_check_unique->bind_param("is", $id_course, $name);
            $stmt_check_unique->execute();
            $result_check_unique = $stmt_check_unique->get_result();
            if ($result_check_unique->num_rows > 0) {
                echo json_encode(array('error' => 'Раздел с таким наименованием уже существует для данного курса.'));
                exit;
            }
            $stmt_check_unique->close();
            // Вставка новой записи
            $stmt = $link->prepare("INSERT INTO course_sections (id_course, name, description) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $id_course, $name, $description);

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