<?php
include '../config/connection.php';
$title = "Students Voted";
include_once 'adminheader.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
$candidate_id = $_POST['candidate_id'];
$candidate = $_POST['hello'];
// echo $candidate;
 

$query = "SELECT v.student_id, s.firstname as student_name,CRN 
          FROM votes v
          JOIN registerstudent s ON v.student_id = s.student_id
          WHERE v.candidate_id = $candidate_id";

$result = $conn->query($query);
?>

<div class="table-container">
    <div class="table-title" style="display: flex; align-items: center; justify-content: space-between;">
        <h2 style="flex: 1; text-align: center; margin: 0;">
            <?php echo htmlspecialchars($candidate); ?>'s Voter
        </h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <!-- <th>Student Name</th> -->
                <th>CRN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<tr><td>' . htmlspecialchars($row['student_id']) . '</td><td>' . htmlspecialchars($row['CRN']) . '</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>


<?php
}
include_once 'footer.php';
