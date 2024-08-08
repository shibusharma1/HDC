<?php
$title = "Program";
require_once '../config/connection.php';
include_once 'adminheader.php';

$sql = "SELECT * FROM programs";
$result = mysqli_query($conn, $sql);

 if (isset($_SESSION['add_program'])): ?>
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
      title: "Program added successfully"
    });
    </script>
    <?php unset($_SESSION['add_program']); ?>
    <?php endif; ?>
    <!-- Program delete messsage -->
  <?php  
 if (isset($_SESSION['delete_error'])): ?>
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
      icon: "warning",
      title: "Program Deleted successfully"
    });
    </script>
    <?php unset($_SESSION['delete_error']); ?>
    <?php endif; ?>
    
<div class="table-container">

    <div class="table-title">
        <a href="addprogram.php">
            <button type="submit" name="addprogram" class="delete-button"
                style="background-color: blue;float:right;">Add Program</button>
        </a>
        <h2>Programs Lists</h2>
    </div>


    <div class="table-content">
        <table>
            <thead>
                <tr>
                    <th >Program Name</th>
                    <th style="text-align:center;">Action</th>
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