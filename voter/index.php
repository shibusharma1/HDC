<?php
$title = "Candidates";
require_once '../config/connection.php';
include_once 'candidateheader.php';

// Fetching the $student_id from registerstudent
$crn = $_SESSION['crn'];
$sql = "SELECT * FROM registerstudent where CRN=$crn";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$student_id = $row['student_id'];
// mysqli_close();



//fetching the data of candidates
$sql = "SELECT * FROM candidates";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error retrieving candidates: " . mysqli_error($conn));
}
?>

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
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['Name']) . "</td>
                            <td>" . htmlspecialchars($row['Program']) . "</td>
                            <td>
                                <form method='POST' action='Viewcandidatedetails.php'>
                                    <input type='hidden' name='crn' value='" . htmlspecialchars($row['CRN']) . "'>
                                    <button type='submit' class='delete-button' style='background-color: #c29d4f;'>View</button>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='vote.php'>
                                    <input type='hidden' name='candidate_id' value='" . $row['candidate_id'] . "'>
                                    <input type='hidden' name='student_id' value='" . $student_id . "'>
                                    
                                    <button type='submit' class='delete-button' style='background-color: #3B43D6;'>Vote</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No candidates found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include_once 'footer.php';
?>