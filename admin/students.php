<?php
$title = "Student";
require_once '../config/connection.php';
include_once 'adminheader.php';
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

<!-- Update student successfully -->
<?php if (isset($_SESSION['update_success'])): ?>
<script>
const Toast3 = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast3.fire({
  icon: "success",
  title: "Student Updated successfully"
});
</script>
<?php unset($_SESSION['update_success']); ?>
<?php endif; ?>


<div class="table-container">

    <div class="table-title">
        <a href="registerstudent.php">
            <button type="submit" name="addStudent" class="delete-button" style="background-color: blue;float:right;">Add Student</button>
        </a>
        <h2>Students Lists</h2>
        <input type="text" id="searchBar" onkeyup="searchCandidates()" placeholder="Search for Student">
    </div>

    <div class="table-content">
        <table id="studentsTable">

            <thead>
                <tr>
                    <th>Total Students</th>
                    <th colspan="5"><?php 
                     $sql="SELECT count(*) from registerstudent";
                     $result = mysqli_query($conn, $sql);
                     $row1 = mysqli_fetch_assoc($result);
                     $total=$row1['count(*)'];
                     echo $row1['count(*)'];
                     ?></th>
                    
                </tr>
                <tr>
                    <th>Voted Students</th>
                    <th colspan="5"><?php 
                     $sql="SELECT count(*) from votes";
                     $result = mysqli_query($conn, $sql);
                     $row1 = mysqli_fetch_assoc($result);
                     $voted=$row1['count(*)'];
                     echo $row1['count(*)'];
                     ?></th>
                </tr>
                <tr>
                    <th>Not Voted Students</th>
                    <th colspan="5"><?php echo $total-$voted;?></th>
                </tr>
                <tr>
                    <th colspan="6"></th>
                </tr>
                <tr>
                    <th>Student Name</th>
                    <th style="text-align:center;">Program</th>
                    <th style="text-align:center;">Semester</th>
                    <th style="text-align:center;">CRN</th>
                    <th style="text-align:center;">Random Code</th>
                    <th style="text-align:center;">Action</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                
$sql = "SELECT * FROM registerstudent JOIN programs ON registerstudent.programid = programs.programid";
$result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']; ?></td>
                            <td style="text-align:center;"><?php echo $row['programname']; ?></td>
                            <td style="text-align:center;"><?php echo $row['semester']; ?></td>
                            <td style="text-align:center;"><?php echo $row['CRN']; ?></td>
                            <td style="text-align:center;"><?php echo $row['random_code']; ?></td>
                            <td>
                        
                            <div class="form-actions" style="display:flex;padding-left:0.2rem;">
                            <form method="POST" action="updatestudent.php">
                            <input type="hidden" name="CRN" value="<?php echo $row['CRN']; ?>">
                            <button type="submit" class="delete-button" style="background-color: #5CB85C;">Edit</button>
                            
                            </form>
                            <form method="POST" action="deletestudent.php">
                            <input type="hidden" name="CRN" value="<?php echo $row['CRN']; ?>">
                            <button type="submit" class="delete-button" style="background-color: red; margin-left:0.3rem;">Delete</button>
                            
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
