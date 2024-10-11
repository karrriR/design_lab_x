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

$tableName = $_POST['tableName'];
$idColumnName = $_POST['idColumnName'];
$id = $_POST['id'];

$sql = "DELETE FROM " . $tableName . " WHERE " . $idColumnName . " = " . $id;

if ($link->query($sql) === TRUE) {
    echo json_encode(array('message' => 'Запись успешно удалена'));
} else {
    echo json_encode(array('error' => 'Ошибка удаления записи: ' . $link->error));
}

$link->close();
?>