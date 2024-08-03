<?php
$title = "Vote";
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $candidate_id = $_POST['candidate_id'];
     $student_id = $_POST['student_id'];

    $sql = "INSERT INTO votes (candidate_id,student_id) VALUES ('$candidate_id','$student_id')";

    if (mysqli_query($conn, $sql)) {
      header("Location: index.php");
      
    } else {
      echo "Error adding the details: " . $sql . "<br>" . mysqli_error($conn);
    } 

}

