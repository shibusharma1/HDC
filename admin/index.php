<?php
$title = "Admin Dashboard";
require_once '../config/connection.php';
include_once 'adminheader.php';

// $sql = "SELECT * FROM candidates";
$sql = "SELECT candidates.*, programs.programname 
        FROM candidates 
        JOIN programs ON candidates.programid = programs.programid 
        ";
$result = mysqli_query($conn, $sql);
?>

<!-- Login success alert -->
<?php if (isset($_SESSION['login_success'])): ?>

    <script>
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  title: "Signed in successfully"
});
</script>
<?php unset($_SESSION['login_success']); // Unset the session variable ?>
<?php endif; ?>


<!-- Delete success alert -->
<?php if (isset($_SESSION['delete_success'])): ?>

    <script>
const Toast1 = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast1.fire({
  icon: "success",
  title: "Candidate deleted successfully"
});
</script>
<?php unset($_SESSION['delete_success']); // Unset the session variable ?>
<?php endif; ?>

<div class="table-container">
    <div class="table-title" style="display: flex; align-items: center; justify-content: space-between;">
        <h2 style="flex: 1; text-align: center; margin: 0;">Candidate Lists</h2>
        
    <?php 
    $sql = "SELECT * FROM vote_status WHERE status = 'T'";
    $sresults = mysqli_query($conn, $sql); 
    $scount = mysqli_num_rows($sresults);
    if ($scount > 0) {
    ?>  <form action="endvote.php" method="POST" style="margin-left: auto;">
        <button type="submit" name="endvote" class="delete-button" style="background-color: red; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            End Vote
        </button>
        </form>
    <?php 
    } else {     
    ?>  <form action="startvote.php" method="POST" style="margin-left: auto;">
        <button type="submit" name="startvote" class="delete-button" style="background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Start Vote
        </button>
    <?php 
    } 
    ?>
</form>
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
            <td>" . $row['programname'] . "</td>
            <td>" . $row['semester'] . "</td>
            <td>"
                            ?>
                        <form method='POST' action='Viewcandidatedetails.php'>
                            <input type="hidden" name="crn" value="<?php echo $row['CRN'] ?>">
                            <button type='submit' style="border: none; background: none;">
                                <i class="fa-sharp fa-regular fa-eye" style="font-size:1.8rem;"></i>
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
