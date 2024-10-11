<?php
session_start();
require_once '../config/connect.php';
require_once 'table_fields.php';

if(empty($_SESSION['user'])) {
  header('Location: authorization.php');
} else {
  $id_access_rights = $_SESSION['user']['id_access_rights'];
  if($id_access_rights == 1) {
      header('Location: profile.php');
  }
}

if(isset($_POST['id'])) {
  $tableName = $_POST['tableName'];
  $idColumnName = $_POST['idColumnName'];
  $id = $_POST['id'];
  $sql = "SELECT * FROM `$tableName` WHERE `$idColumnName`=$id";
  $result = mysqli_query($link, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if ($tableName === 'lectures' && array_key_exists('document', $row)) {
      $document = $row['document'];
      // Получаем содержимое документа в base64, чтобы передать его в JSON
      if (!empty($document)) {
          $document = base64_encode($document);
      }
      $row['document'] = $document;
    }
    
    echo json_encode(array("fields" => $tableFields[$tableName], "record" => $row));
  } else {
    echo json_encode([]);
  }
} else {
  $tableName = $_POST['tableName'];
  if (isset($tableFields[$tableName])) {
    echo json_encode($tableFields[$tableName]);
  } else {
    echo json_encode([]);
  }
}
?>