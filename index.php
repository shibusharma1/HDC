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
    <title>Dashboard | HDC</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="logo-contact">
        <div class="logo">
            <a href="">
                <img src="assets/logo.png" alt="Himalaya Darshan College">
            </a>

        </div>
        <div class="contacts">
            <ul>
                <li>
                    <p>Email:</p>
                    <a href="mailto:himalayadarshan5@gmail.com">himalayadarshan5@gmail.com</a>
                </li>
                <li>
                    <p>Phone Number:</p>
                    <a href="tel:021-590471">021-590471</a>
                </li>
            </ul>
        </div>
    </div>
    <br>
    <nav class="navbar">


        <!-- <input type="checkbox" id="navbar-toggle" class="navbar-checkbox"> -->
        <!-- <label for="navbar-toggle" class="navbar-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </label> -->
        <ul class="navbar-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <!-- <li class="dropdown">
                <a href="#" class="dropbtn">Departments</a>
                <div class="dropdown-content">
                    <a href="#">Science</a>
                    <a href="#">Mathematics</a>
                    <a href="#">Arts</a>
                </div>
            </li> -->
            <li><a href="contact.php">contact</a></li>
            <li><a href="vote.php">Vote</a></li>
            <li><a href="about.php">About us</a></li>
        </ul>
    </nav>
    </div>
    <div class="hero-section">
        <div class="hero-msg">
            <p>Welcome to Himalaya
                <br> Darshan College
            </p>
        </div>
    </div>
    <table class="tale-content">
        <tr class="table-row">
            <td colspan="2" class="table-title">STUDENT TESTIMONIAL</td>
        </tr>
        <tr>
            <td class="std-img">
                <img src="assets/limadidi.png" alt="limadidi" width="50%">
            </td>
            <td class=std-description>
                <p class="std-name"> Lima Sapkota</p>
                <br>
                <br>
                Himalaya Darshan College is the place where student voices are heard and counted. It is difficult to sum
                up the memories and experience of four years in a few lines. HDC has helped me to develop a positive
                attitude towards my studies and discover more about myself. Apart from my study, I have been involved
                with various community groups where I used my academic and professional skills to yield good outcomes. I
                have grown both personally and professionally.

            </td>
        </tr>
        <tr class="table-row">
            <td colspan="2" class="table-title">Program We Offer:</td>
        </tr>
        <tr>
            <td class="std-img">
                <img src="assets/limadidi.png" alt="limadidi" width="px">
            </td>
            <td class=std-description>
                <p class="std-name"> Lima Sapkota</p>
                <br>
                <br>
                Himalaya Darshan College is the place where student voices are heard and counted. It is difficult to sum
                up the memories and experience of four years in a few lines. HDC has helped me to develop a positive
                attitude towards my studies and discover more about myself. Apart from my study, I have been involved
                with various community groups where I used my academic and professional skills to yield good outcomes. I
                have grown both personally and professionally.

            </td>
        </tr>
    </table>
</body>

</html>