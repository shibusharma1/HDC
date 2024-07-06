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
        <ul class="navbar-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>

            <li><a href="contact.php">Contact</a></li>
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
                <img src="assets/limadidi.png" alt="limadidi" width="350px">
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
    <div class="program-title">
        <p> Programs We Offer
    </div> 
    <div class="program-section">
        <div class="box1 box">
            <div class="box-content">
                <h2>BIM</h2>
                <div class="box-img" style="background-image:url('assets/bim.png');"></div>
            </div>
        </div>
        <div class="box2 box">
            <div class="box-content">
                <h2>BCA</h2>
                <div class="box-img" style="background-image: url('assets/bca.png');"></div>

            </div>
        </div>
        <div class="box3 box">
            <div class="box-content">
                <h2>Bsc. CSIT</h2>
                <div class="box-img" style="background-image: url('assets/bsccsit.png');"></div>

            </div>
        </div>
        <div class="box4 box">
            <div class="box-content">
                <h2>BHM</h2>
                <div class="box-img" style="background-image: url('assets/bhm.png');"></div>

            </div>
        </div>
        <div class="box5 box">
            <div class="box-content">
                <h2>BSS</h2>
                <div class="box-img" style="background-image: url('assets/bbs.png');"></div>

            </div>
        </div>
    </div>
    <footer>

        <div class="foot-panel1">
            <ul>
                <p>Contact us</p>
                <a href="#">Email</a>
                <a href="mailto:himalayadarshan5@gmail.com">himalayadarshan5@gmail.com</a>
                <a href="#">Phone Number:</a>
                <a href="tel:021-590471">021-590471</a>

                <a href="#">Address</a>
                <a href="#"> Main Road,Biratnagar-09</a>

            </ul>
            <ul>
                <p>Follow us</p>
                <a href="https://www.facebook.com/215660679312132?ref=embed_page" target="_blank"><img
                        src="assets/facebook.png" height="50" width="50" alt=""></a>

            </ul>
        </div>


        <div class="foot-panel2">
            <div class="copyright">
                Copyright &copy; 2019, All rights reserved. Himalaya Darshan College.
            </div>
        </div>
    </footer>

</body>

</html>