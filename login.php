<?php
// Get the client's IP address
$ipAddress = $_SERVER['REMOTE_ADDR'];
// Get the client's device name (hostname)
$deviceName = gethostbyaddr($ipAddress);
$detail = $deviceName . " is trying to access Admin Panel and its IP Address is " . $ipAddress . ". If this is not you, please modify the Admin Credentials via Code.";
$title = "Admin Login";

// Start the session
session_start();

require_once('config/connection.php');
include_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prevent SQL injection
    $username = mysqli_real_escape_string($conn, stripcslashes($_POST['username']));
    $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // MD5 hash the password

    // Check credentials against the database
    $sql = "SELECT * FROM admin WHERE adminusername = '$username' AND adminpassword = '$password'";
    $sresult = mysqli_query($conn, $sql);
    $scount = mysqli_num_rows($sresult);

    if ($scount == 1) {
        $row = mysqli_fetch_assoc($sresult);
        $_SESSION['login_success'] = true;
        $_SESSION['uid'] = $row['sid'];
        header("Location: admin/index.php");
        exit;
    } else {
        // SMS Alert for failed login attempt
        $url = "https://sms.api.sinch.com/xms/v1/c0f9b524b0d34f3c8af3420e61de607b/batches";
        $data = array(
            "from" => "447441421754",
            "to" => array("9779769707284"),
            "body" => $detail
        );

        $jsonData = json_encode($data);
        $ch = curl_init($url);
        $headers = array(
            "Authorization: Bearer 8d0c9a2e2db34c278fafdd742fc60139",
            "Content-Type: application/json"
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle the error if necessary
            // echo 'Error:' . curl_error($ch);
        } else {
            // Optionally handle the successful response
            // echo 'Response: ' . $response;
        }

        curl_close($ch);

        $_SESSION['login_error'] = true;
        $error_message = "Invalid Credentials";
    }
}
?>

<?php if (isset($error_message)): ?>
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
        title: "<?= $error_message ?>"
    });
    </script>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>

<div class="body-login">
    <div class="wrapper">
        <form action="" method="POST">
            <h1>LOGIN</h1>
            <div class="input-box">
                <label for="username">Username</label>
                <input type="text" placeholder="Username" name="username" required>
                <box-icon type='solid' name='user'></box-icon>
            </div>

            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" required>
                <box-icon name='lock'></box-icon>
            </div>

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
