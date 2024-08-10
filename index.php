<?php
$title = "Dashboard";
include_once 'includes/header.php';
?>

<!-- model for website -->
<div id="registrationModal" class="modal">
        <div class="modal-content">
            <button class="close-button">CLOSE</button>
            <h2>Registration Form</h2>
            <p><a href="https://www.tudoms.org/bachelor/cmat/form" class="registration-link" target="_blank">CMAT/BCA Entrance Preparation Registration Form</a></p>
            <p><a href="registercmat.php" class="register" target="_blank">Click Link For Registration</a></p>
        </div>
    </div>

<!-- Implementing Crousal -->
<div class="hero-section">
    <div class="carousel">
        <div class="carousel-images">
            <div class="carousel-item">
                <img src="assets/hero1.jpg" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="assets/hero2.jpg" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="assets/hero3.jpg" alt="Slide 3">
            </div>
            <div class="carousel-item">
                <img src="assets/hero4.jpg" alt="Slide 3">
            </div>
        </div>
    </div>
</div>

<div class="program-title">
    <p> STUDENT TESTIMONIAL</p>
</div>
<div class="program-section">
    <div style="display:flex;padding:0 10rem;">
        <div class="std-img">
            <img src="assets/limadidi.png" alt="limadidi" width="350px">
        </div>
        <div class="std-description" style="display:flex; flex-direction:column;justify-content:center;">
            <p class="std-name" style="font-size:2.5rem;"> Lima Sapkota</p>

            <br>
            Himalaya Darshan College is the place where student voices are heard and counted. It is difficult to sum
            up the memories and experience of four years in a few lines. HDC has helped me to develop a positive
            attitude towards my studies and discover more about myself. Apart from my study, I have been involved
            with various community groups where I used my academic and professional skills to yield good outcomes. I
            have grown both personally and professionally.

        </div>
    </div>
</div>
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
<br>

<!-- Tie-up Sections -->
<div class="tie-up-title">
    <p>TIE-UPS & MOUS</p>
</div>
<div class="tie-up-section">
    <div class="box-content">
        
    <div class="box1 tie-up">
            <div class="tie-up-img" style="background-image:url('assets/tie1.png');"></div>
             </div>
    </div>
    
    <div class="box2 tie-up">
        <div class="box-content">
            <div class="tie-up-img" style="background-image: url('assets/tie2.gif');"></div>
        </div>
    </div>
    <div class="box3 tie-up">
        <div class="box-content">
            <div class="tie-up-img" style="background-image: url('assets/tie3.jpg');"></div>

        </div>
    </div>
    <div class="box4 tie-up">
        <div class="box-content">
            <div class="tie-up-img" style="background-image: url('assets/tie4.png');"></div>

        </div>
    </div>
    <div class="box5 tie-up">
        <div class="box-content">
            <div class="tie-up-img" style="background-image: url('assets/tie5.png');"></div>
        </div>
    </div>
    <div class="box6 tie-up">
        <div class="box-content">
            <div class="tie-up-img" style="background-image: url('assets/tie6.png');"></div>

        </div>
    </div>
</div>


<?php
// include_once 'model/hdcmodel.php';
include_once 'includes/footer.php';
?>

<!-- Link to the external JavaScript file -->
<script src="modelscript.js"></script>
<script src="carousel.js"></script>