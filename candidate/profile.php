<?php
include_once 'candidateheader.php';
$crn = $_SESSION['crn'];
$sql = "SELECT * FROM registerstudent where CRN=$crn";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result)
?>

<div class="table-container">
    <div class="table-title">
        <h2>Personal Details</h2>
    </div>
    <div class="table-content">
        <table>
            <tbody>
                <tr>
                    <td>NAME:</td>
                    <td>
                        <?php
                        echo $row['firstname'] ." ". $row['middlename'] ." ". $row['lastname'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>DOB:</td>
                    <td>
                        <?php
                        echo $row['dob'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>PHONE NUMBER:</td>
                    <td> <?php
                    echo $row['phone'];
                    ?></td>
                </tr>
                <tr>
                    <td>EMAIL:</td>
                    <td> <?php
                    echo $row['email'];
                    ?></td>
                </tr>
                <tr>
                    <td>ADMITTED YEAR:</td>
                    <td> <?php
                    echo $row['admitted_year'];
                    ?></td>
                </tr>
                <tr>
                    <td>PROGRAM:</td>
                    <td> <?php
                    echo $row['programs'];
                    ?></td>
                </tr>
                <tr>
                    <td>SEMESTER/Year:</td>
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
                <tr>
                    <td>RANDOM CODE:</td>
                    <td> <?php
                    echo $row['random_code'];
                    ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
include_once 'footer.php';
?>