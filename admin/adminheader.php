<?php
session_start();
//$_SESSION['uid'] = 1;

if (!isset($_SESSION['uid'])) {
   header("Location: ../logout.php");
  // echo "Admin login";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | HDC</title>
    <link rel="stylesheet" href="../styles.css">
    </head>
<body>
    <nav class="navbar" style="background-color:#aaaca8">
        <ul class="navbar-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="addcandidate.php">Candidates</a></li>
            <li><a href="registerstudent.php">Register</a></li>
            <li><a href="results.php">Results</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </ul>
    </nav>
    </div>

