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

    // // Check if voter has already voted
    // $check_sql = "SELECT * FROM votes WHERE voter_id = ?";
    // $stmt = $conn->prepare($check_sql);
    // $stmt->bind_param("i", $voter_id);
    // $stmt->execute();
    // $result = $stmt->get_result();

    // if ($result->num_rows > 0) {
    //     echo "You have already voted.";
    // } else {
    //     $vote_sql = "INSERT INTO votes (voter_id, crn) VALUES (?, ?)";
    //     $stmt = $conn->prepare($vote_sql);
    //     $stmt->bind_param("ii", $voter_id, $crn);
    //     if ($stmt->execute()) {
    //         echo "Your vote has been cast successfully.";
    //     } else {
    //         echo "Error: " . $stmt->error;
    //     }
    // }

    // $stmt->close();
    // $conn->close();
}

