<?php
include_once 'adminheader.php';
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $programname = trim($_POST['programname']);


$sql = "INSERT INTO programs(programname) VALUES ('$programname')";
      $result = mysqli_query($conn, $sql);
      // echo $programs;
      if ($result) {
        // echo "hello";exit;
        header("Location: program.php");
        exit;
      }
    }
?>
<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      <!-- <img src="assets/logo.png" alt=""> -->
      <h1 style="color:black;">Add Program</h1>
      <div class="input-box">
        <label for="programname">Program Name<span style="color:red;">*</span></label>
        <input type="text" placeholder="Program Name" name="programname" required>
      </div>
      <button type="submit" class="btn">Add</button>

    </form>
  </div>
</div>

<?php
 include_once 'footer.php';
