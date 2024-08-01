<?php
// Set the page title
$title = "Candidates";
// Include the database connection configuration
require_once '../config/connection.php';
// Include the header file for the candidates page
include_once 'candidateheader.php';

// Fetch the $student_id from the registerstudent table using the CRN from the session
$crn = $_SESSION['crn'];
// Update the SQL query to join with the programs table
$sql = "SELECT registerstudent.*, programs.programname 
        FROM registerstudent 
        JOIN programs ON registerstudent.programid = programs.programid 
        WHERE registerstudent.CRN = $crn";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$student_id = $row['student_id']; // Store the fetched student_id
$programid = $row['programid'];
$semester = $row['semester'];

// Fetch all candidates from the candidates table
$sql = "SELECT * FROM candidates WHERE program = $programid AND semester = $semester";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error retrieving candidates: " . mysqli_error($conn)); // Display error message if the query fails
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
?>

<!-- HTML for displaying the candidate list in a table -->
<div class="table-container">
    <div class="table-title">
        <h2>Candidate Lists</h2>
    </div>
    <div class="table-content">
        <table>
            <thead>
                <tr>
                    <th>Candidate Name</th>
                    <th>Program</th>
                    <th style="text-align:center;">View</th>
                    <th style="text-align:center;">Action</th>
                    <th style="text-align:center;">Votes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any candidates fetched
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each candidate
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Check if the student has already voted
                        $vote_check_sql = "SELECT * FROM votes WHERE student_id = '$student_id'";
                        $vote_check_result = mysqli_query($conn, $vote_check_sql);
                        $has_voted = mysqli_num_rows($vote_check_result) > 0;

                        // Get vote count for the current candidate
                        $candidate_id = $row['candidate_id'];
                        $votes = isset($vote_counts[$candidate_id]) ? $vote_counts[$candidate_id] : 0;
                        
                        // Display the candidate details in a table row
                        echo "<tr>
                            <td>" . htmlspecialchars($row['Name']) . "</td>
                            <td>" . htmlspecialchars($row['programname']) . "</td>
                            <td>
                                <form method='POST' action='Viewcandidatedetails.php'>
                                    <input type='hidden' name='crn' value='" . htmlspecialchars($row['CRN']) . "'>
                                    <button type='submit' class='delete-button' style='background-color: #c29d4f;'>View</button>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='vote.php'>";
                                
                        // Display the vote button if the student has not voted yet
                        if (!$has_voted) {
                            echo "<input type='hidden' name='candidate_id' value='" . htmlspecialchars($row['candidate_id']) . "'>
                                  <input type='hidden' name='student_id' value='" . htmlspecialchars($student_id) . "'>
                                  <button type='submit' class='delete-button' style='background-color: #3B43D6;'>Vote</button>";
                        } else {
                            // Display a disabled button if the student has already voted
                            echo "<button type='button' class='delete-button' style='background-color: #32CD32;' disabled>Voted</button>";
                        }

                        echo "    </form>
                            </td>
                            <td style='text-align:center;'>" . $votes . "</td>
                        </tr>";
                    }
                } else {
                    // Display a message if no candidates are found
                    echo "<tr><td colspan='5'>No candidates found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
if ($top_candidate !== null) {
    // Fetch top candidate details
    $top_candidate_sql = "SELECT * FROM candidates WHERE candidate_id = $top_candidate";
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
                        <td>" . htmlspecialchars($top_candidate_row['Name']) . "</td>
                        <td>" . htmlspecialchars($top_candidate_row['Program']) . "</td>
                        <td style='text-align:center;'>" . $max_votes . "</td>
                    </tr>
                </tbody>
            </table>
          </div>";
}

// Include the footer file
include_once 'footer.php';
?>
