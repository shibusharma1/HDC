<?php

require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "TRUNCATE TABLE vote_status";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();  // Ensure the script stops after the redirect
    } else {
        echo "Error truncating the table: " . mysqli_error($conn);
    }
}
?>
