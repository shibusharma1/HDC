<?php
include_once 'adminheader.php';
require_once '../config/connection.php';

$sql="SELECT * FROM candidates";
$result = mysqli_query($conn,$sql);
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
                    <th>View</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
            if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr> 
            <td>".$row['Name']."</td>
            <td>".$row['CRN']."</td>
            <td>".$row['Program']."</td>
            <td>".$row['semester']."</td>
            </tr>";
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