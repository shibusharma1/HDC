<?php
// session_start();
//$_SESSION['uid'] = 1;

if (isset($_SESSION['uid'])) {
  // header("Location:login.php");
  echo "Admin login";
  echo "<a href='../logout.php'>Logout</a>";
}
?>
<?php
include_once('adminheader.php')
?>

  <div class="container d-flex justify-content-center">
    <div class="row">
      <div class="col text-center">
        <h1> !!!Welcome Admin!!!</h1>
        <?php
        include_once ('../config/select.php');
        ?>
      </div>
    </div>
  </div>
  
<?php
    include_once('adminfooter.php');
?>