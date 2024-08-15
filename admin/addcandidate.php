<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Correctly include Composer's autoloader

$mail = new PHPMailer(true);

// The rest of your PHPMailer code...

$title = "Add Candidate";
include_once 'adminheader.php';
require_once '../config/connection.php';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = trim($_POST['name']);
  $CRN = $_POST['crn'];
  $programs = $_POST['programs'];
  $semester = $_POST['semester'];
  $suppoter1 = $_POST['suppoter1'];
  $suppoter2 = $_POST['suppoter2'];

  // CRN Validation
  if (empty($CRN)) {
    $errors['CRN_error'] = "CRN number is required.";
  } elseif (!preg_match("/^[0-9]*$/", $CRN)) {
    $errors['CRN_error'] = "CRN number is not valid.";
  }

  // Programs Validation
  if (empty($programs)) {
    $errors['programs_error'] = "Please select your programs.";
  }

  // Semester Validation
  if (empty($semester)) {
    $errors['semester_error'] = "Please select your semester.";
  }
      // Suppoter 1 Name Validation
      if (empty($suppoter1)) {
        $errors['suppoter1_error'] = "Suppoter 1 name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $suppoter1)) {
        $errors['suppoter1_error'] = "suppoter 1 name can't contain digits and special characters.";
    }   
   
      // Suppoter 2 Name Validation
      if (empty($suppoter2)) {
        $errors['suppoter1_error'] = "Suppoter 2 name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $suppoter2)) {
        $errors['suppoter2_error'] = "suppoter 2 name can't contain digits and special characters.";
    }   
   

  $sql = "SELECT * FROM registerstudent WHERE CRN = $CRN;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $searchprogram = $row['programid'];
      $searchsemester = $row['semester'];
      $searchstudent_id = $row['student_id'];
    }
  }
  $sql = "SELECT * FROM candidates WHERE CRN = $CRN;";
  $check_result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($check_result) > 0) {
      $error_message = "Candidate already exists.";
  }
  $bol = $searchprogram == $programs && $searchsemester == $semester && empty($errors);
  if ($bol) {
    $sql = "INSERT INTO candidates(Name,CRN,programid,semester,suppoter1,suppoter2) VALUES ('$name','$CRN','$programs','$semester','$suppoter1','$suppoter2')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'hdcvoting@gmail.com';                 // SMTP username
        $mail->Password   = 'ygcp xbpo pwnn civc';                    // SMTP password (Use App Password if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
    
        // Recipients
        $mail->setFrom('hdcvoting@gmail.com', 'HDC');        // Sender's email and name
        $mail->addAddress($email, $firstname); // Add a recipient
    
        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Voting 2081';                     // Email subject
        $mail->Body    = '<h4>Dear '.$firstname.',Your have been <strong>Elected</strong> in Voting 2081</h4><br><h3> CRN '.$CRN.'</h3><h3></h3><br><br><br>With regards,<br><h5>Himalaya Darshan College<br>Biratnagar-09</h5>'; // HTML message body
        $mail->AltBody = 'Please Contact with College administration for your Voting Details.';     // Plain text message body for non-HTML email clients
    
        $mail->send();
        echo 'Email has been sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

      $_SESSION['add_candidate']=1;
      header("Location: index.php");
      exit;
    }
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['fetch_data']) && isset($_GET['crn'])) {
  $CRN = $_GET['crn'];
  $sql = "SELECT * FROM registerstudent WHERE CRN = $CRN;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $fullname = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];
      echo "<script>
        window.parent.document.getElementById('name').value = '" . addslashes($fullname) . "';
        window.parent.document.getElementById('programs').value = '" . addslashes($row['programid']) . "';
        window.parent.document.getElementById('semester').value = '" . addslashes($row['semester']) . "';
      </script>";
    }
  }
  exit;
}
?>

<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      <h1 style="color:black;">Add Candidate</h1>
      <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        } 
        ?>
      <?php if (isset($errors['msg_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['msg_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label for="crn">CRN<span style="color:red;">*</span></label>
        <select id="crn" name="crn" onchange="fetchData(this.value)" required>
          <option value="" disabled selected>Select a CRN</option>
          <?php
          $sql = "SELECT * FROM registerstudent";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['CRN']}'>{$row['CRN']}</option>";
            }
          }
          ?>
        </select>
      </div>

      <div class="input-box">
        <label for="name">Name<span style="color:red;">*</span></label>
        <input type="text" id="name" name="name" placeholder="Name" required>
      </div>
      <?php if (isset($errors['name_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['name_error']; ?></label>
      <?php endif; ?>

      <?php if (isset($errors['CRN_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['CRN_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label for="programs">Program<span style="color:red;">*</span></label>
        <select id="programs" name="programs" required>
          <option value="" disabled selected>Select a Program</option>
          <?php
          $sql = "SELECT * FROM programs";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['programid']}'>{$row['programname']}</option>";
            }
          }
          ?>
        </select>
      </div>
      <?php if (isset($errors['programs_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['programs_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label for="semester">Semester<span style="color:red;">*</span></label>
        <select id="semester" name="semester" required>
          <option value="" disabled selected>Select a Semester/Year</option>
          <option value="1">First</option>
          <option value="2">Second</option>
          <option value="3">Third</option>
          <option value="4">Fourth</option>
          <option value="5">Fifth</option>
          <option value="6">Sixth</option>
          <option value="7">Seventh</option>
          <option value="8">Eighth</option>
        </select>
      </div>
      <?php if (isset($errors['semester_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['semester_error']; ?></label>
      <?php endif; ?>
      <div class="input-box">
        <label for="name">Suppoter 1<span style="color:red;">*</span></label>
        <input type="text" id="suppoter1" name="suppoter1" placeholder="Name" required>
      </div>
      <?php if (isset($errors['suppoter1_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['suppoter1_error']; ?></label>
      <?php endif; ?>
      <div class="input-box">
        <label for="name">Suppoter 2<span style="color:red;">*</span></label>
        <input type="text" id="suppoter2" name="suppoter2" placeholder="Name" required>
      </div>
      <?php if (isset($errors['suppoter2_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['suppoter2_error']; ?></label>
      <?php endif; ?>


      <button type="submit" class="btn">Add</button>
    </form>
  </div>
</div>

<iframe id="data-fetch-frame" style="display:none;"></iframe>

<script>
  function fetchData(crn) {
    const iframe = document.getElementById('data-fetch-frame');
    iframe.src = '?fetch_data=1&crn=' + crn;
  }
</script>

<?php
include_once 'footer.php';
?>
