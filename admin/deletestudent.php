<?php
require_once '../config/connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CRN = trim($_POST['CRN']);
    
    $sql = "DELETE FROM registerstudent WHERE CRN = $CRN";
    if (mysqli_query($conn, $sql)) {
        header("Location: students.php");
        exit;
      }
      else{
        $_SESSION['delete_error']=1;
        header("Location: students.php");
      }
}
