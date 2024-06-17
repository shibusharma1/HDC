<?php
  //starting the session
  session_start();

  // $title = "Log in";
  // $active = "login";
  require_once('config/connection.php');

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  #Prevent from mysqli injection
  $username = stripcslashes($_POST['username']);
  $password = $_POST['password'];
  $username = mysqli_real_escape_string($conn,$username);
  
  $sql = "select * from sadmin where adminusername = '$username' and adminpassword = '$password'";
  
  $sresult = mysqli_query($conn,$sql);
  
  $scount = mysqli_num_rows($sresult);
    // echo $password;
    // echo $username;

  if($scount == 1){
      $row = mysqli_fetch_assoc($sresult);
      if($row['adminusername'] == $username && $row['adminpassword'] == $password){
          $_SESSION['uid'] = $row['sid'];
          header("Location: admin/dashboard.php");
          echo "hello";
      }
    }

  $password = md5($password);
  $sql = "select * from students where username = '$username' and password = '$password'";
  
  $result = mysqli_query($conn,$sql);
  
  $count = mysqli_num_rows($result);

  if($count == 1){
      $row = mysqli_fetch_assoc($result);
      if($row['username'] == $username && $row['password'] == $password){
          $_SESSION['uid'] = $row['id'];
          header("Location: index.php");
      }else{
          echo "<h1>Login failed due to invalid username or password</h1>";
      }
      
  }
  else{
      echo "<h1>User Doesnot Exist </h1>";
  }

}

include_once 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | HDC</title>
  <link rel="stylesheet" href="css/login.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="wrapper">
    <form action="" method="POST">
      <!-- <img src="assets/logo.png" alt=""> -->
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
        <p>Don't have an account? <a href="student_register.php">Register</a></p>
      </div>

    </form>
  </div>
</body>

</html>