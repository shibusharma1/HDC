<?php
require_once '../config/connection.php';
session_start();


if (!isset($_SESSION['crn'])) {
   header("Location: logout.php");
  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | HDC</title>
    <link rel="stylesheet" href="../styles.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- <link rel="stylesheet" href="feedback.css"> -->
    <!-- sweetalert cdn -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="../assets/result_background.png" type="image/x-icon"/>

    </head>
<body style="background-color:#E2E7E6;">
<div class="logo-contact">
        <div class="logo">
            <a href="">
                <img src="../assets/logo.png" alt="Himalaya Darshan College">
            </a>

        </div>
        <div class="contacts">
            <ul class="header-top">
                <li>
                    <div class="icon-margin">
                        <i class="fa-solid fa-envelope text-color"></i>
                    </div>
                    <div class="header-top-text">
                        <p> Email:</p>
                        <a href="mailto:himalayadarshan5@gmail.com">himalayadarshan5@gmail.com</a>
                    </div>
                </li>
                <li>
                    <div class="icon-margin">
                        <i class="fa-solid fa-phone text-color"></i>
                    </div>
                    <div class="header-top-text">
                        <p>Phone Number:</p>
                        <a href="tel:021-590471">021-590471</a>

                    </div>
                </li>
            </ul>
        </div>
    </div>
    <nav class="navbar" style="background-color:#EEEEEE;    ">
        <ul class="navbar-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="results.php">Results</a></li>
            <li><a href="feedbacks.php">Feedback</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </ul>
    </nav>
    </div>


    