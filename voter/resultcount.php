<?php
include_once 'candidateheader.php';

require_once '../config/connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "File reached Successfully:";
    $crn = trim($_POST['crn']);
    // $sql = "DELETE FROM candidates WHERE CRN = $crn";
    if (True) {
        header("Location: index.php");
        exit;
      }

}

include_once 'footer.php';