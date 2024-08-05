<?php
include '../config/connection.php';
$title = "Results";
include_once 'adminheader.php';

// Query to fetch candidates with vote counts
$query = "SELECT c.candidate_id, c.Name, c.CRN, c.programid, c.semester, COUNT(v.vote_id) as vote_count
          FROM candidates c
          LEFT JOIN votes v ON c.candidate_id = v.candidate_id
          GROUP BY c.candidate_id";

$result = $conn->query($query);

if (!$result) {
    die('Query Error: ' . $conn->error);
}
?>
    <div class="table-container">
    <div class="table-title" style="display: flex; align-items: center; justify-content: space-between;">
        <h2 style="flex: 1; text-align: center; margin: 0;">Vote Results</h2>
        
        <?php 
        $sql = "SELECT * FROM result_update WHERE status = 'T'";
        $sresults = mysqli_query($conn, $sql); 
        $scount = mysqli_num_rows($sresults);
        if ($scount > 0) {
            ?>  
            <form action="hideresults.php" method="POST" style="margin-left: auto;">
                <button type="submit" name="hideresults" class="delete-button" style="background-color: red; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    Hide Results
                </button>
            </form>
            <?php 
        } else {     
            ?>  
            <form action="showresults.php" method="POST" style="margin-left: auto;">
                <button type="submit" name="showresults" class="delete-button" style="background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    Show Results
                </button>
            </form>
            <?php 
        } 
        ?>
    </div>

    <!-- Search Bar -->
    <input type="text" id="searchBar" onkeyup="searchCandidates()" placeholder="Search for Candidates..">

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
                <th style="text-align:center;">Action</th>
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
                echo '<td>
                <form action="fetch_students.php" method="POST">
                <input type="hidden" name="candidate_id" value = ' . htmlspecialchars($row['candidate_id']) . '>
                <input type="hidden" name="hello" value = ' . htmlspecialchars($row['Name']) . '>
                <button type="submit" class="delete-button" style="background-color:#4CAF50;text-align:center;">
                View Students
                </button>
                
                </form>
                </td>';
                
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Modal for displaying students -->
    <div id="studentsModal">
        <div id="studentsModalContent">
            <span onclick="closeModal()">&times;</span>
            <!-- Student details will be inserted here -->
        </div>
    </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // No need for fetchCandidates() here if you're populating table directly with PHP
        });

        // Search candidates in the table
        function searchCandidates() {
            const filter = document.getElementById('searchBar').value.toUpperCase();
            const table = document.getElementById('candidatesTable');
            const tr = table.getElementsByTagName('tr');
            for (let i = 1; i < tr.length; i++) {
                let found = false;
                const td = tr[i].getElementsByTagName('td');
                for (let j = 0; j < td.length; j++) {
                    if (td[j] && td[j].innerText.toUpperCase().includes(filter)) {
                        found = true;
                        break;
                    }
                }
                tr[i].style.display = found ? '' : 'none';
            }
        }

      
    </script>

<?php
include_once 'footer.php';
