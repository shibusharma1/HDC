<?php
$title = "Program";
require_once '../config/connection.php';
include_once 'adminheader.php';

$sql = "SELECT * FROM programs";
$result = mysqli_query($conn, $sql);
?>

<div class="table-container">
    <div class="table-title">
        <h2>Programs Lists</h2>
    </div>

    <div class="table-content">
        <table>
            <thead>
                <tr>
                    <th>Program Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr> 
            <td>" . $row['programname'] . "</td>
            <td>"
                            ?>
                        <form method="POST" action="deleteprogram.php">
                            <input type="hidden" name="programid" value="<?php echo $row['programid']; ?>">
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