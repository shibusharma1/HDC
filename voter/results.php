<?php
$title = "Results ";
include_once ('./candidateheader.php');
require_once '../config/connection.php';

$crn = $_SESSION['crn'];

$sql = "SELECT * FROM result_update WHERE status = 'T'";
$sresults = mysqli_query($conn, $sql);
$scount = mysqli_num_rows($sresults);
if ($scount > 0) {

    // Fetch the student details from the registerstudent table using the CRN from the session
    $sql = "SELECT rs.*, p.programname 
        FROM registerstudent rs
        JOIN programs p ON rs.programid = p.programid 
        WHERE rs.CRN = $crn";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $student_id = $row['student_id'];
    $programid = $row['programid'];
    $semester = $row['semester'];

    // Fetch vote counts for each candidate in the same program and semester
    $vote_counts_sql = "SELECT v.candidate_id, COUNT(*) as vote_count 
                    FROM votes v
                    JOIN candidates c ON v.candidate_id = c.candidate_id
                    WHERE c.programid = $programid AND c.semester = '$semester'
                    GROUP BY v.candidate_id";
    $vote_counts_result = mysqli_query($conn, $vote_counts_sql);

    // Initialize an array to store vote counts
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
        $sql = "SELECT * FROM candidates c JOIN programs p
            WHERE c.programid =p.programid AND candidate_id = $top_candidate AND c.programid = $programid AND semester = '$semester'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            ?>
            <!-- <div class="winner" style="display:flex;"> -->
            <div style="display: flex; justify-content: space-between;">

        
            <div class="winner-container">
                <div class="winner-card">
                    <h2 style="text-align: center; font-size: 3rem;margin-bottom:1rem;">Winner</h2>
                    <div class="winner-image">
                        <img src="../assets/maleimg.png" alt="Shibu Sharma">
                    </div>
                    <div class="winner-info">
                        <h2><?php echo htmlspecialchars($row['Name']); ?></h2>
                        <p><strong>Program:</strong><?php echo htmlspecialchars($row['programname']); ?> </p>
                        <p><strong>Semester:</strong> <?php echo htmlspecialchars($row['semester']); ?></p>
                        <p><strong>Votes:</strong> <?php echo htmlspecialchars($max_votes); ?></p>
                    </div>
                </div>
            </div>
            <!-- <br> -->

            <?php
            // Query to fetch candidates with vote counts
            $query = "SELECT c.candidate_id, c.Name, c.CRN, c.programid, c.semester, COUNT(v.vote_id) as vote_count
          FROM candidates c
          LEFT JOIN votes v ON c.candidate_id = v.candidate_id
          WHERE c.programid = $programid AND c.semester = '$semester'
          GROUP BY c.candidate_id ORDER BY COUNT(v.vote_id) DESC";

            $result = $conn->query($query);

            if (!$result) {
                die('Query Error: ' . $conn->error);
            }
            ?>
            <div class="table-container">
                <div class="table-title" style="display: flex; align-items: center; background-color:#52AB90;">
                    <h2 style="flex: 1; text-align: center; margin: 0;">Vote Results</h2>

                </div>


                <div class="table-content">

                    <table id="candidatesTable">
                        <thead>
                            <tr>
                                <th>Candidate ID</th>
                                <th>Name</th>
                                <th>CRN</th>
                                <th>Program</th>
                                <th>Semester</th>
                                <th>Vote Count</th>
                                <!-- <th style="text-align:center;">Action</th> -->
                            </tr>
                        </thead>
                        <tbody id="candidatesTableBody">
                            <?php
                            // Generate the table rows
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['candidate_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['Name']) . '</td>';
                                echo '<td style="text-align:center;">' . htmlspecialchars($row['CRN']) . '</td>';
                                echo '<td style="text-align:center;">' . htmlspecialchars($row['programid']) . '</td>';
                                echo '<td style="text-align:center;">' . htmlspecialchars($row['semester']) . '</td>';
                                echo '<td style="text-align:center;">' . htmlspecialchars($row['vote_count']) . '</td>';

                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            </div>
            <?php
        }
    } else {
        echo "<p>No data found</p>";
    }

} else {
    ?>
    <h1 style="margin:1px 0px;text-align: center;padding:10rem; background-color:#E2E7E6;">No Results Found</h1>

    <?php
}
// Include the footer file
include_once 'footer.php';
