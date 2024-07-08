<?php
session_start();
//$_SESSION['uid'] = 1;

if (isset($_SESSION['uid'])) {
    // header("Location:login.php");
    echo "Student login";
    echo "<a href='logout.php'>Logout</a>";
}
?>
<?php
include_once 'includes/header.php';
?>

    <div class="hero-section">
        <div class="hero-msg">
            <p>Welcome to Himalaya
                <br> Darshan College
            </p>
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

<?php
include_once 'includes/footer.php';
?>