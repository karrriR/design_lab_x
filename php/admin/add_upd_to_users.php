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
            $id_users = htmlspecialchars($_POST['id_users']);
            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $telephone = preg_replace("/\D+/", "", $_POST['telephone']);
            $email = htmlspecialchars($_POST['email']);
            $login = htmlspecialchars($_POST['login']);
            $country = htmlspecialchars($_POST['country']);
            $city = htmlspecialchars($_POST['city']);
            $datebd = !empty($_POST['datebd']) ? htmlspecialchars($_POST['datebd']) : null;
            $id_access_rights = htmlspecialchars($_POST['id_access_rights']);
            // $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null; // Хешируем пароль, если он указан
            
            // Проверка обязательных полей
            if(empty($name) || empty($surname) || empty($telephone) || empty($email) || empty($login) || empty($id_access_rights)) {
                echo json_encode(array('error' => 'Пожалуйста, заполните все обязательные поля.'));
                exit;
            }

            $stmt = $link->prepare("SELECT login FROM users WHERE id_users=?");
            $stmt->bind_param("i", $id_users);
            $stmt->execute();
            $result = $stmt->get_result();
            $user_data = $result->fetch_assoc();
            $stmt->close();

            // Проверка уникальности логина, если он был изменен
            if($login !== $user_data['login']) {
                $stmt = $link->prepare("SELECT * FROM users WHERE login=?");
                $stmt->bind_param("s", $login);
                $stmt->execute();
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    echo json_encode(array('error' => 'Логин уже занят.'));
                    exit;
                }
                $stmt->close();
            }

            // Проверка прав доступа
            if ($id_access_rights != 1 && $id_access_rights != 2) {
                echo json_encode(array('error' => 'Недопустимое значение для прав доступа.'));
                exit;
            }

            // Проверка фотографии
            if (!empty($_FILES['img']['name'])) {
                $path = 'img/';
                $types = array('image/gif', 'image/png', 'image/jpeg');
                $size = 1024009990;
                $namez = $_FILES['img']['name'];
                $ext = substr($namez, strpos($namez,'.'), strlen($namez)-1);

                if (!in_array($_FILES['img']['type'], $types)) {
                    echo json_encode(array('error' => 'Запрещенный тип файла.'));
                    exit;
                }

                if ($_FILES['img']['size'] > $size) {
                    echo json_encode(array('error' => 'Слишком большой размер файла.'));
                    exit;
                }

                $nameFile =  uniqid($namez).'.'.$ext;

                if (!move_uploaded_file($_FILES['img']['tmp_name'], $path . $nameFile)) {
                    echo json_encode(array('error' => 'Ошибка загрузки файла.'));
                    exit;
                }

                // Обновляем поле фотографии в запросе и параметры
                $query = "UPDATE users SET name=?, surname=?, telephone=?, email=?, login=?, country=?, city=?, datebd=?, id_access_rights=?, photo_profile=?";
                $params = array($name, $surname, $telephone, $email, $login, $country, $city, $datebd, $id_access_rights, $nameFile);
            } else {
                // Обновляем запись без изменения фотографии
                $query = "UPDATE users SET name=?, surname=?, telephone=?, email=?, login=?, country=?, city=?, datebd=?, id_access_rights=?";
                $params = array($name, $surname, $telephone, $email, $login, $country, $city, $datebd, $id_access_rights);
            }

            // Добавление пароля, если он указан
            if (!empty($_POST['password'])) {
                $password = $_POST['password'];
                // Проверка длины пароля
                if (strlen($password) < 6) {
                    echo json_encode(array('error' => 'Пароль должен содержать не менее 6 символов.'));
                    exit;
                }
                // Хэшируем пароль
                $password = password_hash($password, PASSWORD_DEFAULT);
                // Добавляем хэшированный пароль в запрос и параметры
                $query .= ", password=?";
                $params[] = $password;
            }

            $query .= " WHERE id_users=?";
            $params[] = $id_users;

            // Выполнение запроса
            $stmt = $link->prepare($query);
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно обновлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка обновления записи: ' . $stmt->error));
            }

            $stmt->close();
        } else if ($action === 'addRecordButton') {
           // Получение данных из формы
           $name = htmlspecialchars($_POST['name']);
           $surname = htmlspecialchars($_POST['surname']);
           $telephone = preg_replace("/\D+/", "", $_POST['telephone']);
           $email = htmlspecialchars($_POST['email']);
           $login = htmlspecialchars($_POST['login']);
           $country = htmlspecialchars($_POST['country']);
           $city = htmlspecialchars($_POST['city']);
           $datebd = !empty($_POST['datebd']) ? htmlspecialchars($_POST['datebd']) : null;
           $id_access_rights = htmlspecialchars($_POST['id_access_rights']);
           $password = htmlspecialchars($_POST['password']);
           
           // Проверка обязательных полей
           if(empty($name) || empty($surname) || empty($telephone) || empty($email) || empty($login) || empty($password) || empty($id_access_rights)) {
               echo json_encode(array('error' => 'Пожалуйста, заполните все обязательные поля.'));
               exit;
           }

           // Проверка уникальности логина
           $stmt = $link->prepare("SELECT * FROM users WHERE login=?");
           $stmt->bind_param("s", $login);
           $stmt->execute();
           $result = $stmt->get_result();
           if($result->num_rows > 0) {
               echo json_encode(array('error' => 'Логин уже занят.'));
               exit;
           }

           if (strlen($password) < 6) {
            echo json_encode(array('error' => 'Пароль должен содержать не менее 6 символов.'));
            exit;
            }

           // Проверка прав доступа
           if ($id_access_rights != 1 && $id_access_rights != 2) {
               echo json_encode(array('error' => 'Недопустимое значение для прав доступа.'));
               exit;
           }
           
           $password = password_hash($password, PASSWORD_DEFAULT);

           // Проверка фотографии
           if (!empty($_FILES['img']['name'])) {
            $path = 'img/';
            $types = array('image/gif', 'image/png', 'image/jpeg');
            $size = 1024009990;
            $namez = $_FILES['img']['name'];
            $ext = substr($namez, strpos($namez,'.'), strlen($namez)-1);

            if (!in_array($_FILES['img']['type'], $types)) {
                echo json_encode(array('error' => 'Запрещенный тип файла.'));
                exit;
            }

            if ($_FILES['img']['size'] > $size) {
                echo json_encode(array('error' => 'Слишком большой размер файла.'));
                exit;
            }

            $nameFile =  uniqid($namez).'.'.$ext;

            if (!move_uploaded_file($_FILES['img']['tmp_name'], $path . $nameFile)) {
                echo json_encode(array('error' => 'Ошибка загрузки файла.'));
                exit;
            }

               // Добавляем поле фотографии в запрос и параметры
               $query = "INSERT INTO users (name, surname, telephone, email, login, country, city, datebd, id_access_rights, photo_profile, password)";
               $values = "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
               $params = array($name, $surname, $telephone, $email, $login, $country, $city, $datebd, $id_access_rights, $nameFile, $password);
           } else {
               // Если фотография не была загружена, устанавливаем стандартное значение
               $query = "INSERT INTO users (name, surname, telephone, email, login, country, city, datebd, id_access_rights, photo_profile, password)";
               $values = "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
               $params = array($name, $surname, $telephone, $email, $login, $country, $city, $datebd, $id_access_rights, 'empty_foto_profile.jpg', $password);
           }

           // Выполнение запроса
            $stmt = $link->prepare($query . " " . $values . ")");
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                echo json_encode(array('message' => 'Запись успешно добавлена!'));
            } else {
                echo json_encode(array('error' => 'Ошибка добавления записи: ' . $stmt->error));
            }

            $stmt->close();
        }
    }
}
?>