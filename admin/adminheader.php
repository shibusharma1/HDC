<?php
session_start();
//$_SESSION['uid'] = 1;

if (!isset($_SESSION['uid'])) {
   header("Location: ../logout.php");
  // echo "Admin login";
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Admin Dashboard</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      .bd-navbar{
        min-height: 4rem;
        background-color: #563d7c;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .05), inset 0 -1px 0 rgba(0, 0, 0, .1);
      }
      .nav-link, .navbar-brand{
        color:white !important;

      }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bd-navbar">
  <a class="navbar-brand" href="index.php">Himalaya Darshan College</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="managestudent.php">Manage students</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="managecomplaints.php">Manage Complaint</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          More
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="routine.php">Routine</a>
          <a class="dropdown-item" href="exam.php">Exam</a>
          <a class="dropdown-item" href="notice.php">Notice</a>
        </div>
      </li>
    </ul>
    <div class="nav-link">
    <a class="nav-link" href="../logout.php">Logout</a>
    </div>
  </div>
</nav>
