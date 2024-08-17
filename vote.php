<?php
$title = "Vote";
include_once 'includes/header.php';
?>

<div class="program-section">
    <div class="box1 boxvote">
        <div class="box-contentvote">
            <div class="box-msg">
                <h2>Voter Login</h2>
                <img src="assets/vote.png" alt="" width="200px" height="200px">
                <br>
                <button><a href="loginforvote.php">Click Here</a></button>
            </div>
        </div>
    </div>
    <div class="box2 boxvote">
        <div class="box-contentvote">
            <div class="box-msg">
                <h2>Admin Login</h2>
                <img src="assets/candidate.png" alt="" width="200px" height="200px">
                <br>
                <button><a href="login.php">Click Here</a></button>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'includes/footer.php';
?>