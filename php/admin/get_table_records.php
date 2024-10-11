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

if(isset($_POST['tableName'])) {
  $tableName = $_POST['tableName'];
  $columns = array();
  $result = $link->query("SHOW COLUMNS FROM " . $tableName);
  while($row = $result->fetch_assoc()) {
    $columns[] = $row['Field'];
  }

  $sql = "SELECT * FROM " . $tableName;

  $result = $link->query($sql);

  if ($result->num_rows > 0) {
    $records = array();
    while($row = $result->fetch_assoc()) {
      if ($tableName === "lectures" && array_key_exists('document', $row)) {
        $stmt = $link->prepare("SELECT document FROM " . $tableName . " WHERE id_lectures = ?");
        $stmt->bind_param("i", $row['id_lectures']);
        $stmt->execute();
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();
        $row['document'] = base64_encode($data['document']);
      }
      $records[] = $row;
    }
    echo json_encode(array('columns' => $columns, 'data' => $records));
  } else {
    echo "0 results";
  }
  $link->close();
} else {
  echo "Ошибка: имя таблицы не задано";
}
?>