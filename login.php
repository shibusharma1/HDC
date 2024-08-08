<?php
$title = "Admin Login";
//starting the session
session_start();

require_once ('config/connection.php');
include_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  #Prevent from mysqli injection
  $username = stripcslashes($_POST['username']);
  $password = $_POST['password'];
  $username = mysqli_real_escape_string($conn, $username);

  $sql = "select * from sadmin where adminusername = '$username' and adminpassword = '$password'";

  $sresult = mysqli_query($conn, $sql);

  $scount = mysqli_num_rows($sresult);

  if ($scount == 1) {
    $row = mysqli_fetch_assoc($sresult);
    if ($row['adminusername'] == $username && $row['adminpassword'] == $password) {
      $_SESSION['login_success'] = true;
      $_SESSION['uid'] = $row['sid'];
      header("Location: admin/index.php");
    }
    else{
      $_SESSION['login_error'] = true;
      $error_message="Invalid Credentials";
      // header("Location: login.php");
    }
  }
}

?>

<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      <h1>LOGIN</h1>
      <div class="input-box">
        <label for="username">Username</label>
        <input type="username" placeholder="Username" name="username" required>
        <box-icon type='solid' name='user'></box-icon>

      </div>

      <div class="input-box">
        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" required>
        <box-icon name='lock'></box-icon>
      </div>
      <?php if (isset($error_message)): ?>
                    <label style="color:red;float:left;"><?= $error_message ?></label>
                <?php endif; ?>
      <div class="remember-forget">
        <label><input type="checkbox"> Remember me</label>
        <a href="forgetpassword.php">Forget password?</a>
      </div>
      <button type="submit" class="btn">Login</button>

      <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register</a></p>
      </div>

    </form>
  </div>
</div>
<?php if (isset($_SESSION['login_error'])): ?>
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
  title: "Login unsuccessfully"
});
</script>
<?php unset($_SESSION['login_error']); ?>
<?php endif; ?>
<?php
include_once 'includes/footer.php';
?>