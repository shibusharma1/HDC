<?php
$title = "Candidate Login";
//starting the session
session_start();

require_once ('config/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  #Prevent from mysqli injection
  $CRN = $_POST['CRN'];
  $random_code = $_POST['random_code'];
  // $CRN = mysqli_real_escape_string($conn, $CRN);

  $sql = "select * from registerstudent where CRN = '$CRN' and random_code = '$random_code'";

  $result = mysqli_query($conn, $sql);

  $scount = mysqli_num_rows($result);

  if ($scount == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['CRN'] == $CRN && $row['random_code'] == $random_code) {
      $_SESSION['crn'] = $row['CRN'];
      header("Location: voter/index.php");
      
    }
  }
}


?>
<?php
include_once 'includes/header.php';
?>
<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      <h1>LOGIN for Vote</h1>
      <div class="input-box">
        <label for="CRN">Enter your CRN</label>
        <input type="CRN" placeholder="Please enter your CRN" name="CRN" required>


      </div>

      <div class="input-box">
        <label for="random_code">Enter your Random Code</label>
        <input type="random_code" placeholder="Please enter your Random Code" name="random_code" required>

      </div>
      <div class="remember-forget">
        <label><input type="checkbox"> Remember me</label>
        <a href="forgetrandom_code.php">Forgot random code?</a>
      </div>

      <button type="submit" class="btn">Login</button>

    </form>
  </div>
</div>
<?php
include_once 'includes/footer.php';
?>