<?php
//starting the session
// session_start();

// $title = "Log in";
// $active = "login";
// require_once ('config/connection.php');

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   #Prevent from mysqli injection
//   $username = stripcslashes($_POST['username']);
//   $password = $_POST['password'];
//   $username = mysqli_real_escape_string($conn, $username);

//   $sql = "select * from sadmin where adminusername = '$username' and adminpassword = '$password'";

//   $sresult = mysqli_query($conn, $sql);

//   $scount = mysqli_num_rows($sresult);
//   // echo $password;
//   // echo $username;

//   if ($scount == 1) {
//     $row = mysqli_fetch_assoc($sresult);
//     if ($row['adminusername'] == $username && $row['adminpassword'] == $password) {
//       $_SESSION['uid'] = $row['sid'];
//       header("Location: dashboard.php");
//       echo "hello";
//     }
//   }

//   $password = md5($password);
//   $sql = "select * from students where username = '$username' and password = '$password'";

//   $result = mysqli_query($conn, $sql);

//   $count = mysqli_num_rows($result);

//   if ($count == 1) {
//     $row = mysqli_fetch_assoc($result);
//     if ($row['username'] == $username && $row['password'] == $password) {
//       $_SESSION['uid'] = $row['id'];
//       header("Location: admin/dashboard.php");
//     } else {
//       echo "<h1>Login failed due to invalid username or password</h1>";
//     }

//   } else {
//     echo "<h1>User Doesnot Exist </h1>";
//   }

// }

// include_once 'includes/header.php';
?>
<?php
include_once 'includes/header.php';
?>
<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      <h1>LOGIN for Vote</h1>
      <div class="input-box">
        <label for="username">Enter your CRN</label>
        <input type="username" placeholder="Please enter your Random Code" name="username" required>
        

      </div>

      <div class="input-box">
        <label for="password">Enter your Random Code</label>
        <input type="password" placeholder="Please enter your CRN" name="password" required>
        
      </div>
      <div class="remember-forget">
        <label><input type="checkbox"> Remember me</label>
        <a href="forgetpassword.php">Forget random code?</a>
      </div>
      
      <button type="submit" class="btn">Login</button>

    </form>
  </div>
</div>
<?php
include_once 'includes/footer.php';
?>