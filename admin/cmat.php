<?php
$title = "Student";
require_once '../config/connection.php';
include_once 'adminheader.php';

$sql = "SELECT * FROM registercmat JOIN programs ON registercmat.programid = programs.programid";
$result = mysqli_query($conn, $sql);
?>
<script>
            // Search candidates in the table
            function searchCandidates() {
            const filter = document.getElementById('searchBar').value.toUpperCase();
            const table = document.getElementById('studentsTable');
            const tr = table.getElementsByTagName('tr');
            for (let i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none';
                const td = tr[i].getElementsByTagName('td');
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        if (td[j].innerText.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = '';
                            break;
                        }
                    }
                }
            }
        }

</script>


<div class="table-container">

    <div class="table-title">
        
    
            <h2>CMAT Students Lists</h2>
        <input type="text" id="searchBar" onkeyup="searchCandidates()" placeholder="Search for Student">
    </div>

    <div class="table-content">
        <table id="studentsTable">

            <thead>
                <tr>
                    <th>Student Name</th>
                    <th style="text-align:center;">Program</th>
                    <!-- <th style="text-align:center;">Semester</th> -->
                    <!-- <th style="text-align:center;">CRN</th> -->
                    <!-- <th style="text-align:center;">Random Code</th> -->
                    <th >Action</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']; ?></td>
                            <td style="text-align:center;"><?php echo $row['programname']; ?></td>
                                                        <td>
                        
                            <div class="form-actions" style="display:flex;padding-left:0.2rem;">
                            <form method="POST" action="viewcmat.php">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="delete-button" style="background-color: #c29d4f;">View</button>
                            
                            </form>
                                                        </div>

                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include_once 'footer.php';
?>
