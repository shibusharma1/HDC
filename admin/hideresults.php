<?php

require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "TRUNCATE TABLE result_update";

    if (mysqli_query($conn, $sql)) {
        header("Location: results.php");
        exit();  // Ensure the script stops after the redirect
    } else {
        echo "Error truncating the table: " . mysqli_error($conn);
    }
}

