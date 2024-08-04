<?php
include '../config/connection.php';

$candidate_id = $_GET['candidate_id'];

$query = "SELECT v.student_id, s.firstname as student_name 
          FROM votes v
          JOIN registerstudent s ON v.student_id = s.student_id
          WHERE v.candidate_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $candidate_id);
$stmt->execute();

$result = $stmt->get_result();

// Generate the HTML table
echo '<table border="1"><tr><th>Student ID</th><th>Student Name</th></tr>';

while ($row = $result->fetch_assoc()) {
    echo '<tr><td>' . htmlspecialchars($row['student_id']) . '</td><td>' . htmlspecialchars($row['student_name']) . '</td></tr>';
}

echo '</table>';