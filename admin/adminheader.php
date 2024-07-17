<?php
session_start();

if (!isset($_SESSION['uid'])) {
   header("Location: ../logout.php");

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | HDC</title>
    <link rel="stylesheet" href="../styles.css">
     <!-- Font Awesome CDN -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
<body>
    <nav class="navbar">
        <ul class="navbar-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="addcandidate.php">Candidates</a></li>
            <li><a href="registerstudent.php">Register</a></li>
            <li><a href="results.php">Results</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </ul>
    </nav>
    </div>

