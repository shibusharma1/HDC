<?php
require_once '../config/connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crn = trim($_POST['crn']);
    $sql = "DELETE FROM candidates WHERE CRN = $crn";
    if (mysqli_query($conn, $sql)) {
      $_SESSION['delete_success'] = true;
        header("Location: index.php");
        exit;
      }

}
