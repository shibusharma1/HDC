<?php
$title = "Student";
require_once '../config/connection.php';
include_once 'adminheader.php';

$sql = "SELECT * FROM registerstudent JOIN programs ON registerstudent.programid = programs.programid";
$result = mysqli_query($conn, $sql);
?>

<div class="table-container">

    <div class="table-title">
        <a href="registerstudent.php">
            <button type="submit" name="addStudent" class="delete-button" style="background-color: blue;float:right;">Add Student</button>
        </a>
        <h2>Students Lists</h2>
    </div>

    <div class="table-content">
        <table>
            <thead>
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
                                <!-- <form method="POST" action="deleteStudent.php">
                                    <input type="hidden" name="Studentid" value="<?php echo $row['Student_id']; ?>">
                                    <button type="submit" class="delete-button" style="background-color: red;">Delete</button>
                                </form> -->

                            <div class="form-actions" style="display:flex;padding-left:0.2rem;">
                            <form method="POST" action="updatestudent.php">
                            <input type="hidden" name="CRN" value="<?php echo $row['CRN']; ?>">
                            <button type="submit" class="delete-button" style="background-color: #5CB85C;">update</button>
                            
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
