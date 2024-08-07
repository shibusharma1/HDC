<?php
$title = "Add Program";
include_once 'adminheader.php';
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $programname = trim($_POST['programname']);
  // Check if the program already exists
  $sql = "SELECT * FROM programs WHERE programname='$programname'";
  $check_result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($check_result) > 0) {
      $error_message = "Program already exists.";
  } else {
      // Insert new program into the database
      $insert_sql = "INSERT INTO programs (programname) VALUES ('$programname')";
      if (mysqli_query($conn, $insert_sql)) {
        $_SESSION['add_program']=1;
          header("Location: program.php");
          // $success_message = "Program added successfully.";
      } else {
          $error_message = "Error adding program: " . mysqli_error($conn);
      }
  }
}
?>

<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
    
      <h1 style="color:black;">Add Program</h1>
      <div class="input-box">
        <label for="programname">Program Name<span style="color:red;">*</span></label>
        <input type="text" placeholder="Program Name" name="programname" required>
      </div>
      <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        } 
        ?>
      <button type="submit" class="btn">Add</button>

    </form>
  </div>
</div>

<?php
 include_once 'footer.php';
