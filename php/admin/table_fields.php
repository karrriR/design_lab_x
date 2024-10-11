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

$tableFields = array(
    'answers' => array(
      array('name' => 'id_answer', 'type' => 'hidden'),
      array('name' => 'name', 'type' => 'text', 'placeholder' => 'Введите имя'),
      array('name' => 'email', 'type' => 'email', 'placeholder' => 'Введите email'),
      array('name' => 'telephone', 'type' => 'tel', 'id'=> 'phone', 'placeholder' => 'Введите телефон'),
      array('name' => 'message', 'type' => 'text', 'placeholder' => 'Введите вопрос'),
    ),
    'consultations' => array(
      array('name' => 'id_consultation', 'type' => 'hidden'),
      array('name' => 'name', 'type' => 'text', 'placeholder' => 'Введите имя'),
      array('name' => 'email', 'type' => 'email', 'placeholder' => 'Введите email'),
      array('name' => 'telephone', 'type' => 'tel', 'id'=> 'phone', 'placeholder' => 'Введите телефон'),
    ),
    'courses' => array(
      array('name' => 'id_courses', 'type' => 'hidden'),
      array('name' => 'name', 'type' => 'text', 'placeholder' => 'Введите наименование курса'),
      array('name' => 'short_description', 'type' => 'text', 'placeholder' => 'Введите короткое описание курса'),
      array('name' => 'long_description', 'type' => 'text', 'placeholder' => 'Введите длинное описание курса'),
      array('name' => 'duration', 'type' => 'text', 'placeholder' => 'Введите длительность'),
      array('name' => 'date_begin', 'type' => 'date', 'placeholder' => 'Выберите дату начала'),
      array('name' => 'format_course', 'type' => 'text', 'placeholder' => 'Введите формат курса'),
      array('name' => 'busyness', 'type' => 'text', 'placeholder' => 'Введите занятость курса'),
      array('name' => 'basic_cost', 'type' => 'number', 'placeholder' => 'Введите цену за базовый тариф курса'),
    ),
    'users' => array(
      array('name' => 'id_users', 'type' => 'hidden'),
      array('name' => 'name', 'type' => 'text', 'placeholder' => 'Введите имя'),
      array('name' => 'surname', 'type' => 'text', 'placeholder' => 'Введите фамилию'),
      array('name' => 'telephone', 'type' => 'tel', 'id'=> 'phone', 'placeholder' => 'Введите телефон'),
      array('name' => 'email', 'type' => 'email', 'placeholder' => 'Введите email'),
      array('name' => 'login', 'type' => 'text', 'placeholder' => 'Введите логин'),
      array('name' => 'password', 'type' => 'password', 'placeholder' => 'Введите пароль'),
      array('name' => 'country', 'type' => 'text', 'placeholder' => 'Введите страну'),
      array('name' => 'city', 'type' => 'text', 'placeholder' => 'Введите город'),
      array('name' => 'datebd', 'type' => 'date', 'placeholder' => 'Выберите дату рождения'),
      array('name' => 'photo_profile', 'type' => 'text'),
      array('name' => 'id_access_rights', 'type' => 'number', 'placeholder' => 'Введите право доступа'),
    ),
    'course_registration' => array(
      array('name' => 'id_course_registration', 'type' => 'hidden'),
      array('name' => 'id_user', 'type' => 'number', 'placeholder' => 'Введите ID пользователя'),
      array('name' => 'id_course', 'type' => 'number', 'placeholder' => 'Введите ID курса'),
      array('name' => 'tariff_name', 'type' => 'text', 'placeholder' => 'Введите название тарифа: 1. basic 2. optimal 3. vip'),
      array('name' => 'application_status', 'type' => 'text', 'placeholder' => 'Введите статус заявки: pending - в расммотрении, approved - одобрено'),
    ),
    'course_sections' => array(
      array('name' => 'id_course_sections', 'type' => 'hidden'),
      array('name' => 'id_course', 'type' => 'number', 'placeholder' => 'Введите ID курса'),
      array('name' => 'name', 'type' => 'text', 'placeholder' => 'Введите наименование раздела'),
      array('name' => 'description', 'type' => 'text', 'placeholder' => 'Введите описание раздела'),
    ),
    'lectures' => array(
      array('name' => 'id_lectures', 'type' => 'hidden'),
      array('name' => 'id_section', 'type' => 'number', 'placeholder' => 'Введите ID раздела курса'),
      array('name' => 'name', 'type' => 'text', 'placeholder' => 'Введите наименование лекции'),
      array('name' => 'description', 'type' => 'text', 'placeholder' => 'Введите описание лекции'),
      array('name' => 'document', 'type' => 'text'),
    ),
    'reference_documents' => array(
      array('name' => 'id_reference_documents', 'type' => 'hidden'),
      array('name' => 'id_lecture', 'type' => 'number', 'placeholder' => 'Введите ID лекции'),
      array('name' => 'link', 'type' => 'text', 'placeholder' => 'Введите ссылку'),
    ),
    'tests' => array(
      array('name' => 'id_tests', 'type' => 'hidden'),
      array('name' => 'id_course', 'type' => 'number', 'placeholder' => 'Введите ID курса'),
      array('name' => 'id_section', 'type' => 'number', 'placeholder' => 'Введите ID раздела курса'),
      array('name' => 'description', 'type' => 'text', 'placeholder' => 'Введите описание теста'),
    ),
    'test_questions' => array(
      array('name' => 'id', 'type' => 'hidden'),
      array('name' => 'id_test', 'type' => 'number', 'placeholder' => 'Введите ID теста'),
      array('name' => 'number_question', 'type' => 'number', 'placeholder' => 'Введите номер вопроса'),
      array('name' => 'question', 'type' => 'text', 'placeholder' => 'Введите вопрос'),
      array('name' => 'answer1', 'type' => 'text', 'placeholder' => 'Введите первый ответ'),
      array('name' => 'answer2', 'type' => 'text', 'placeholder' => 'Введите второй ответ'),
      array('name' => 'answer3', 'type' => 'text', 'placeholder' => 'Введите третий ответ'),
      array('name' => 'correct_answer', 'type' => 'text', 'placeholder' => 'Введите правильный ответ'),
    ),
    'user_course_progress' => array(
      array('name' => 'id', 'type' => 'hidden'),
      array('name' => 'id_user', 'type' => 'number', 'placeholder' => 'Введите ID пользователя'),
      array('name' => 'id_course', 'type' => 'number', 'placeholder' => 'Введите ID курса'),
      array('name' => 'completed_sections', 'type' => 'number', 'placeholder' => 'Введите количество завершенных разделов'),
      array('name' => 'total_sections', 'type' => 'number', 'placeholder' => 'Введите количество разделов всего'),
    ),
    'user_section_progress' => array(
      array('name' => 'id', 'type' => 'hidden'),
      array('name' => 'id_user', 'type' => 'number', 'placeholder' => 'Введите ID пользователя'),
      array('name' => 'id_course', 'type' => 'number', 'placeholder' => 'Введите ID курса'),
      array('name' => 'id_section', 'type' => 'number', 'placeholder' => 'Введите ID раздела курса'),
      array('name' => 'section_completed', 'type' => 'number', 'placeholder' => 'Введите 0 - если раздел не завершен, и 1 - если завершен'),
    ),
    'user_test_progress' => array(
      array('name' => 'id', 'type' => 'hidden'),
      array('name' => 'id_user', 'type' => 'number', 'placeholder' => 'Введите ID пользователя'),
      array('name' => 'id_test', 'type' => 'number', 'placeholder' => 'Введите ID теста'),
      array('name' => 'questions_total', 'type' => 'number', 'placeholder' => 'Введите количество вопросов всего'),
      array('name' => 'questions_right', 'type' => 'number', 'placeholder' => 'Введите количество правильных ответов'),
      array('name' => 'test_attempts', 'type' => 'number', 'placeholder' => 'Введите количество попыток'),
      array('name' => 'test_completed', 'type' => 'number', 'placeholder' => 'Введите 0 - если тест не пройден, и 1 - если пройден'),
    ),
);