<?php
require_once '../config/connection.php';
include_once 'candidateheader.php';
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
                    <th>Candidate Name</th>
                    <th>Program</th>
                    <th>View</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr> 
            <td>" . $row['Name'] . "</td>
            <td>" . $row['Program'] . "</td>
            <td>"
                            ?>
                        <form method='POST' action='Viewcandidatedetails.php'>
                            <input type="hidden" name="crn" value="<?php echo $row['CRN'] ?>">
                            <button type="submit" class="delete-button" style="background-color: #c29d4f;">View</button>
                        </form>
                        </td>
                        <td>

                            <form method="POST" action="resultcount.php">
                                <input type="hidden" name="crn" value="<?php echo $row['CRN'] ?>">
                                <button type="submit" class="delete-button" style="background-color: #3B43D6;">Vote</button>
                            </form>

                        </td>
                        </tr>;
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