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
            <button type="submit" name="addStudent" class="delete-button"
                style="background-color: blue;float:right;">Add Student</button>
        </a>
        <h2>Students Lists</h2>
    </div>


    <div class="table-content">
        <table>
            <thead>
                <tr>
                    <th >Student Name</th>
                    <th style="text-align:center;">Pogram</th>
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
                        echo "<tr> 
            <td>" . $row['firstname']." ". $row['middlename'] ."". $row['lastname']. "</td>
            <td style='text-align:center;'>".$row['programname']."</td>
            <td style='text-align:center;'>".$row['semester']."</td>
            <td style='text-align:center;'>".$row['CRN']."</td>
            <td style='text-align:center;'>".$row['random_code']."</td>

            <td>";
                            ?>
                        <form method="POST" action="deleteStudent.php">
                            <input type="hidden" name="Studentid" value="<?php echo $row['Studentid']; ?>">
                            <button type="submit" class="delete-button" style="background-color: red;">Delete</button>
                        </form>
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