<?php

require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT IGNORE INTO vote_status(status) VALUES ('T')";

    if (mysqli_query($conn, $sql)) {
      header("Location: index.php");
      
    } else {
      echo "Error adding the details: " . $sql . "<br>" . mysqli_error($conn);
    } 

}

