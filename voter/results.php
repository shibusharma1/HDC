<?php
$title = "Results";
include_once('./candidateheader.php');
require_once '../config/connection.php';

$crn = $_SESSION['crn'];

// Fetch the $student_id from the registerstudent table using the CRN from the session
$sql = "SELECT registerstudent.*, programs.programname 
        FROM registerstudent 
        JOIN programs ON registerstudent.programid = programs.programid 
        WHERE registerstudent.CRN = $crn";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$student_id = $row['student_id'];
$programid = $row['programid'];
$semester = $row['semester'];

// Fetch all candidates from the candidates table
$sql = "SELECT * FROM candidates WHERE programid = $programid AND semester = $semester";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error retrieving candidates: " . mysqli_error($conn));
}

// Fetch vote counts for each candidate
$vote_counts_sql = "SELECT candidate_id, COUNT(*) as vote_count FROM votes GROUP BY candidate_id";
$vote_counts_result = mysqli_query($conn, $vote_counts_sql);
$vote_counts = [];
while ($vote_row = mysqli_fetch_assoc($vote_counts_result)) {
    $vote_counts[$vote_row['candidate_id']] = $vote_row['vote_count'];
}

// Determine the candidate with the maximum votes
$max_votes = 0;
$top_candidate = null;
foreach ($vote_counts as $candidate_id => $vote_count) {
    if ($vote_count > $max_votes) {
        $max_votes = $vote_count;
        $top_candidate = $candidate_id;
    }
}

if ($top_candidate !== null) {
    // Fetch top candidate details
    $top_candidate_sql = "SELECT * FROM candidates WHERE candidate_id = $top_candidate AND programid = $programid AND semester = $semester";
    $top_candidate_result = mysqli_query($conn, $top_candidate_sql);
    $top_candidate_row = mysqli_fetch_assoc($top_candidate_result);
    
    echo "<div class='table-title'>
            <h2>Top Candidate</h2>
          </div>
          <div class='table-content'>
            <table>
                <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Program</th>
                        <th style='text-align:center;'>Votes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                                                <td style='text-align:center;'>" . $max_votes . "</td>
                    </tr>
                </tbody>
            </table>
          </div>";
}

// Fetch and display students of the same program and semester
// $students_sql = "SELECT * FROM registerstudent WHERE programid = $programid AND semester = $semester";
// $students_result = mysqli_query($conn, $students_sql);
// if (!$students_result) {
//     die("Error retrieving students: " . mysqli_error($conn));
// }

// echo "<div class='table-title'>
//         <h2>Students Results</h2>
//       </div>
//       <div class='table-content'>
//         <table>
//             <thead>
//                 <tr>
//                     <th>Student Name</th>
//                     <th>Program</th>
//                     <th>Semester</th>
//                 </tr>
//             </thead>
//             <tbody>";

// while ($student_row = mysqli_fetch_assoc($students_result)) {
//     echo "<tr>
//             <td>" . htmlspecialchars($student_row['firstname']) . "</td>
//             <td>" . htmlspecialchars($student_row['programid']) . "</td>
//             <td>" . htmlspecialchars($student_row['semester']) . "</td>
//           </tr>";
// }

// echo "    </tbody>
//         </table>
//       </div>";

include_once('footer.php');
?>
