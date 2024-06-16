<?php
session_start();
//$_SESSION['uid'] = 1;

if (isset($_SESSION['uid'])) {
  // header("Location:login.php");
  echo "Student login";
  echo "<a href='logout.php'>Logout</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<header>
    <div class="navbar">
        <div class="nav-logo border">
            <div class="logo"></div>
        </div> 
        <a href="login.php">Login</a>
        
</div>
</body>
</html>