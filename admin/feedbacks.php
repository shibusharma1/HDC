<?php
$title = "Register Student";
include_once 'adminheader.php';
require_once '../config/connection.php';

$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql);
?>

<div class="table-container">

    <div class="table-title">

        <h2>Feedback Lists</h2>
    </div>


    <div class="table-content">
        <table>
            <thead>
                <tr>
                    <th >CRN</th>
                    <th >Email</th>
                    <th >Message</th>
                    <th >Received Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr> 
            <td>" . $row['CRN'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['message'] . "</td>
            <td>" . $row['created_at'] . "</td>";}}
?>
            </tbody>
        </table>
    </div>
</div>

<?php
include_once 'footer.php';
?>        
<?php
include_once 'footer.php';
?>