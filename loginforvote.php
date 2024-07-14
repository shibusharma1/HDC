<?php
//starting the session
session_start();

require_once ('config/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  #Prevent from mysqli injection
  $CRN = stripcslashes($_POST['CRN']);
  $random_code = $_POST['random_code'];
  $CRN = mysqli_real_escape_string($conn, $CRN);

  $sql = "select * from registerstudents where CRN = '$CRN' and random_code = '$random_code'";

  $result = mysqli_query($conn, $sql);

  $scount = mysqli_num_rows($result);
  // echo $random_code;
  // echo $CRN;

  if ($scount == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['CRN'] == $CRN && $row['random_code'] == $random_code) {
      $_SESSION['crn'] = $row['CRN'];
      header("Location: candidate/index.php");
      
    }
  }
}
//   $random_code = md5($random_code);
//   $sql = "select * from students where CRN = '$CRN' and random_code = '$random_code'";

//   $result = mysqli_query($conn, $sql);

//   $count = mysqli_num_rows($result);

//   if ($count == 1) {
//     $row = mysqli_fetch_assoc($result);
//     if ($row['CRN'] == $CRN && $row['random_code'] == $random_code) {
//       $_SESSION['uid'] = $row['id'];
//       header("Location: admin/dashboard.php");
//     } else {
//       echo "<h1>Login failed due to invalid CRN or random_code</h1>";
//     }

//   } else {
//     echo "<h1>User Doesnot Exist </h1>";
//   }

// }


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