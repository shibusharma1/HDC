<?php
require_once '../config/connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $programid = trim($_POST['programid']);
    $sql = "DELETE FROM programs WHERE programid = $programid";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
      }

}
