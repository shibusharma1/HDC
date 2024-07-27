<?php
$title = "candidate Details";
include_once 'candidateheader.php';

require_once '../config/connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crn = trim($_POST['crn']);
}
$sql = "SELECT * FROM candidates where CRN=$crn";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result)

?>

<div class="table-container">
    <div class="table-title">
        <h2><?php
        echo $row['Name']."'s";
        ?> Details
        </h2>
    </div>
    <div class="table-content">
        <table>
            <tbody>
                <tr>
                    <td>NAME:</td>
                    <td>
                        <?php
                        echo $row['Name'];
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>PROGRAM:</td>
                    <td> <?php
                    echo $row['Program'];
                    ?></td>
                </tr>
                <tr>
                    <td>SEMESTER/YEAR:</td>
                    <td> <?php
                    echo $row['semester'];
                    ?></td>
                </tr>

                <tr>
                    <td>CRN:</td>
                    <td> <?php
                    echo $row['CRN'];
                    ?></td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>

<?php
 include_once 'footer.php';
?>