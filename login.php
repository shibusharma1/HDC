<?php
$title = "Admin Login";
//starting the session
session_start();

require_once ('config/connection.php');

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
  }
}

?>

<?php
include_once 'includes/header.php';
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
<?php
include_once 'includes/footer.php';
?>