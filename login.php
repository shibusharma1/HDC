<?php
// Get the client's IP address
$ipAddress = $_SERVER['REMOTE_ADDR'];
// Get the client's device name (hostname)
$deviceName = gethostbyaddr($ipAddress);
$detail=$deviceName ." is trying to access Admin Panel and it's IP Address is ".$ipAddress.".If this is not you please modify the Admin Credentials via Code.";
$title = "Admin Login";
//starting the session
session_start();

require_once ('config/connection.php');
include_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  #Prevent from mysqli injection
  $username = stripcslashes($_POST['username']);
  $password = $_POST['password'];
  $username = mysqli_real_escape_string($conn, $username);

  $sql = "select * from sadmin where adminusername = '$username' and adminpassword = '$password'";

  $sresult = mysqli_query($conn, $sql);

  $scount = mysqli_num_rows($sresult);

  if ($scount == 1) {
    $row = mysqli_fetch_assoc($sresult);
    if ($row['adminusername'] == $username && $row['adminpassword'] == $password) {
      $_SESSION['login_success'] = true;
      $_SESSION['uid'] = $row['sid'];
      header("Location: admin/index.php");
    }}else{
    // SMS ALERT FOR LOGIN
      // URL for the API endpoint
$url = "https://sms.api.sinch.com/xms/v1/cdd67d05519f49b685338453378b1735/batches";

// The data you want to send in the POST request
$data = array(
    "from" => "447441421754",
    "to" => array("9779769707280"),
    "body" => $detail
);

// Convert the data to JSON format
$jsonData = json_encode($data);

// Initialize cURL session
$ch = curl_init($url);

// Set the Authorization header
$headers = array(
    "Authorization: Bearer e1e61d634e7c4ccaa79b9c365999c17e",
    "Content-Type: application/json"
);

// Set the cURL options
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Add headers
curl_setopt($ch, CURLOPT_POST, true);           // Set method to POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Add the JSON data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

// Execute the POST request
$response = curl_exec($ch);

// Check if any error occurred
if (curl_errno($ch)) {
    // echo 'Error:' . curl_error($ch);
} else {
    // Print the response from the server
    // echo 'Response: ' . $response;
}

// Close the cURL session
curl_close($ch);
}

    
      $_SESSION['login_error'] = true;
      $error_message="Invalid Credentials";
     if (isset($_SESSION['login_error'])): ?>
        <script>
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 4000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });
        Toast.fire({
          icon: "warning",
          title: "Invalid Credentials"
        });
        </script>
        <?php unset($_SESSION['login_error']); ?>
        <?php endif;} ?>
        
      
    
  

<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      <h1>LOGIN</h1>
      <div class="input-box">
        <label for="username">Username</label>
        <input type="username" placeholder="Username" name="username" required>
        <box-icon type='solid' name='user'></box-icon>

      </div>

      <div class="input-box">
        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" required>
        <box-icon name='lock'></box-icon>
      </div>
      <?php if (isset($error_message)): ?>
                    <label style="color:red;float:left;display:none;"><?= $error_message ?></label>
                <?php endif; ?>
      <div class="remember-forget">
        <label><input type="checkbox"> Remember me</label>
        <a href="forgetpassword.php">Forget password?</a>
      </div>
      <button type="submit" class="btn">Login</button>

      <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register</a></p>
      </div>

    </form>
  </div>
</div>
<?php
include_once 'includes/footer.php';
?>