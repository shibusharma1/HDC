<?php
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $voter_id = 1; // Replace with actual voter ID from session or other source
    $crn = $_POST['crn'];

    // Check if voter has already voted
    $check_sql = "SELECT * FROM votes WHERE voter_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $voter_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "You have already voted.";
    } else {
        $vote_sql = "INSERT INTO votes (voter_id, crn) VALUES (?, ?)";
        $stmt = $conn->prepare($vote_sql);
        $stmt->bind_param("ii", $voter_id, $crn);
        if ($stmt->execute()) {
            echo "Your vote has been cast successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}

