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
            $id = $_POST['id'];
            $id_test = $_POST['id_test'];
            $number_question = $_POST['number_question'];
            $question = htmlspecialchars($_POST['question']);
            $answer1 = htmlspecialchars($_POST['answer1']);
            $answer2 = htmlspecialchars($_POST['answer2']);
            $answer3 = htmlspecialchars($_POST['answer3']);
            $correct_answer = htmlspecialchars($_POST['correct_answer']);

            if (empty($id_test) || empty($number_question) || empty($question) || empty($answer1) || empty($answer2) || empty($answer3) || empty($correct_answer)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }

            // Проверка существования теста
            $stmt = $link->prepare("SELECT * FROM tests WHERE id_tests=?");
            $stmt->bind_param("i", $id_test);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанного теста не существует.'));
                exit;
            }

            // Проверяем, было ли изменено значение номера вопроса
            $stmt = $link->prepare("SELECT number_question FROM test_questions WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $old_number_question = $result->fetch_assoc()['number_question'];
            $stmt->close();

            // Если номер вопроса не изменился, пропускаем проверку на уникальность
            if ($old_number_question != $number_question) {
                // Проверка на уникальность номера вопроса в рамках теста
                $stmt = $link->prepare("SELECT * FROM test_questions WHERE id_test=? AND number_question=?");
                $stmt->bind_param("ii", $id_test, $number_question);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo json_encode(array('error' => 'Такой номер вопроса уже существует в рамках данного теста.'));
                    exit;
                }
                $stmt->close();
            }

            if ($number_question <= 0) {
                echo json_encode(array('error' => 'Номер вопроса должен быть больше нуля.'));
                exit;
            }

            if ($correct_answer !== 'answer1' && $correct_answer !== 'answer2' && $correct_answer !== 'answer3') {
                echo json_encode(array('error' => 'Неверное значение для правильного ответа. Правильный ответ должен быть "answer1", "answer2" или "answer3".'));
                exit;
            }

            $stmt = $link->prepare("UPDATE test_questions SET id_test=?, number_question=?, question=?, answer1=?, answer2=?, answer3=?, correct_answer=? WHERE id=?");
            $stmt->bind_param("iisssssi", $id_test, $number_question, $question, $answer1, $answer2, $answer3, $correct_answer, $id);

            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно обновлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка обновления записи: ' . $link->error));
            }

            $stmt->close();
        } else {
            $id_test = $_POST['id_test'];
            $number_question = $_POST['number_question'];
            $question = htmlspecialchars($_POST['question']);
            $answer1 = htmlspecialchars($_POST['answer1']);
            $answer2 = htmlspecialchars($_POST['answer2']);
            $answer3 = htmlspecialchars($_POST['answer3']);
            $correct_answer = htmlspecialchars($_POST['correct_answer']);

            if (empty($id_test) || empty($number_question) || empty($question) || empty($answer1) || empty($answer2) || empty($answer3) || empty($correct_answer)) {
                echo json_encode(array('error' => 'Сначала введите все данные в поля.'));
                exit;
            }

            // Проверка существования теста
            $stmt = $link->prepare("SELECT * FROM tests WHERE id_tests=?");
            $stmt->bind_param("i", $id_test);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo json_encode(array('error' => 'Указанного теста не существует.'));
                exit;
            }

            // Проверка на уникальность номера вопроса в рамках теста
            $stmt = $link->prepare("SELECT * FROM test_questions WHERE id_test=? AND number_question=?");
            $stmt->bind_param("ii", $id_test, $number_question);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo json_encode(array('error' => 'Такой номер вопроса уже существует в рамках данного теста.'));
                exit;
            }
            $stmt->close();

            if ($number_question <= 0) {
                echo json_encode(array('error' => 'Номер вопроса должен быть больше нуля.'));
                exit;
            }

            if ($correct_answer !== 'answer1' && $correct_answer !== 'answer2' && $correct_answer !== 'answer3') {
                echo json_encode(array('error' => 'Неверное значение для правильного ответа. Правильный ответ должен быть "answer1", "answer2" или "answer3".'));
                exit;
            }

            $stmt = $link->prepare("INSERT INTO test_questions (id_test, number_question, question, answer1, answer2, answer3, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisssss", $id_test, $number_question, $question, $answer1, $answer2, $answer3, $correct_answer);

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