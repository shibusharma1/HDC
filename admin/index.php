<?php
$title = "Admin Dashboard";
require_once '../config/connection.php';
include_once 'adminheader.php';

$sql = "SELECT * FROM candidates";
$result = mysqli_query($conn, $sql);
?>

<div class="table-container">
    <div class="table-title">
        <h2>Candidate Lists</h2>
    </div>

    <div class="table-content">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>CRN</th>
                    <th>Program</th>
                    <th>Semester</th>
                    <th style="text-align:center;">View</th>
                    <th style="text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr> 
            <td>" . $row['Name'] . "</td>
            <td>" . $row['CRN'] . "</td>
            <td>" . $row['Program'] . "</td>
            <td>" . $row['semester'] . "</td>
            <td>"
                            ?>
                        <form method='POST' action='Viewcandidatedetails.php'>
                            <input type="hidden" name="crn" value="<?php echo $row['CRN'] ?>">
                            <button type='submit' style="border: none; background: none;">
                                <i class="fa-sharp fa-regular fa-eye fa-bounce" style="font-size:1.8rem;"></i>
                            </button>
                        </form>
                        </td>
                        <td>

                            <form method="POST" action="delete.php">
                                <input type="hidden" name="crn" value="<?php echo $row['CRN'] ?>">
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