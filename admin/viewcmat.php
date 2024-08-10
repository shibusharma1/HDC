<?php
$title = "View row";
include_once 'adminheader.php';
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crn = trim($_POST['id']);
}

// Update the SQL query to join with the programs table
$sql = "SELECT registercmat.*, programs.programname 
        FROM registercmat 
        JOIN programs ON registercmat.programid = programs.programid 
        WHERE registercmat.id = $crn";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<div class="table-container">
            <div class="table-title">
                <h2><?php echo $row['firstname'];?>'s Details</h2>
            </div>
            <div class="table-content">
                <table>
                    <tbody>
                        <tr>
                            <td>NAME:</td>
                            <td><?php echo $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']; ?></td>
                        </tr>
                        <tr>
                            <td>DOB:</td>
                            <td><?php echo $row['dob']; ?></td>
                        </tr>
                        <tr>
                            <td>GENDER:</td>
                            <td><?php echo $row['gender']; ?></td>
                        </tr>
                        <tr>
                            <td>PHONE NUMBER:</td>
                            <td><?php echo $row['phone']; ?></td>
                        </tr>
                        <tr>
                            <td>EMAIL:</td>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                        <tr>
                            <td>PROGRAM ID:</td>
                            <td><?php echo $row['programname']; ?></td>
                        </tr>
                        <tr>
                            <td>COLLEGE NAME:</td>
                            <td><?php echo $row['collegename']; ?></td>
                        </tr>
                        <tr>
                            <td>PASSED OUT YEAR:</td>
                            <td><?php echo $row['passed_out_year']; ?></td>
                        </tr>
                        <tr>
                            <td>GPA:</td>
                            <td><?php echo $row['gpa']; ?></td>
                        </tr>
                        <tr>
                            <td>REFERRED BY:</td>
                            <td><?php echo $row['referred_by']; ?></td>
                        </tr>
                        <tr>
                            <td>CREATED AT:</td>
                            <td><?php echo $row['created_at']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

      
<?php

include_once 'footer.php';
?>
