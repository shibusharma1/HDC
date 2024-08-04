<?php
$title = "Result";
require_once '../config/connection.php';
include_once 'adminheader.php';


// Fetch vote counts for each candidate in the same program and semester
$vote_counts_sql = "SELECT v.candidate_id, COUNT(*) as vote_count 
                    FROM votes v
                    JOIN candidates c ON v.candidate_id = c.candidate_id
                    GROUP BY v.candidate_id";
$vote_counts_result = mysqli_query($conn, $vote_counts_sql);

// Initialize an array to store vote counts
$vote_counts = [];
while ($vote_row = mysqli_fetch_assoc($vote_counts_result)) {
    $vote_counts[$vote_row['candidate_id']] = $vote_row['vote_count'];
}


if ($top_candidate !== null) {
    // Fetch top candidate details
    $sql = "SELECT * FROM candidates c JOIN programs p
            WHERE c.programid =p.programid";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='table-title'>
                <h2>Top Candidate</h2>
              </div>
              <div class='table-content'>
                <table>
                    <thead>
                        <tr>
                            <th>Candidate Name</th>
                            <th>Program</th>
                            <th>Semester</th>
                            <th style='text-align:center;'>Votes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>" . htmlspecialchars($row['Name']) . "</td>
                            <td>" . htmlspecialchars($row['programname']) . "</td>
                            <td>" . htmlspecialchars($row['semester']) . "</td>
                            /<td style='text-align:center;'>" . htmlspecialchars($max_votes) . "</td>
                        </tr>
                    </tbody>
                </table>
              </div>";
    }
} else {
    echo "<p>No data found</p>";
}

include_once('footer.php');



