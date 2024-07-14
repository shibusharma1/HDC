<?php
include_once 'includes/header.php';
include_once 'config/connection.php';
?>
<?php
require_once('config/connection.php');

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $country = $_POST['country'];
    $phone = trim($_POST['phone_number']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirmpassword']);



    // First Name Validation
    if (empty($fname)) {
        $errors['fname_error'] = "First name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $fname)) {
        $errors['fname_error'] = "First name can't contain digits and special characters.";
    }

    // Last Name Validation
    if (empty($lname)) {
        $errors['lname_error'] = "Last name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $lname)) {
        $errors['lname_error'] = "Last name can't contain digits and special characters.";
    }

    // Email Validation
    if (empty($email)) {
        $errors['email_error'] = "Email can't be blank.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email_error'] = "Email address is not valid.";
    }

    // Phone Validation
    if (empty($phone)) {
        $errors['phone_error'] = "Phone number is required.";
    } elseif (!preg_match("/^9[87][0-9]{8}$/", $phone)) {
        $errors['phone_error'] = "Phone number is not valid.";
    }

    // Country Validation
    if (empty($country)) {
        $errors['country_error'] = "Please select your country.";
    }

    // Password Validation
    if (empty($password)) {
        $errors['password_error'] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors['password_error'] = "Password should be at least 8 characters.";
    } elseif (!preg_match("/^[a-zA-Z0-9@.#]+$/", $password)) {
        $errors['password_error'] = "Password is not valid.";
    }

    // Confirm Password Validation
    if (empty($confirm_password)) {
        $errors['confirm_password_error'] = "Confirm password is required.";
    } elseif ($confirm_password !== $password) {
        $errors['confirm_password_error'] = "Passwords do not match.";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $password = md5($password);
        $sql = "INSERT INTO cregister (fname, lname, email, password, country, phone) VALUES ('$fname', '$lname', '$email', '$password', '$country', '$phone')";

        if (mysqli_query($conn, $sql)) {
            header("Location: login.php");
            exit;
        } else {
            echo "Error adding the details: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
<div class="register-body">
  <div class="wrapper">
    <form action="" method="POST">
      <img src="assets/logo.png" alt="Himalaya Darshan College" title="Himalaya Darshan College"
        style="display:block;margin:auto;">
      <!-- <h1>Himalaya Darshan College</h1> -->
       <h2 style="color:black;">Register Student in HDC</h2>
      <p>Please enter your details into the fields below.</p>

      <div class="input-box">
        <label for="firstname">First Name<span style="color:red;">*</span></label>
        
        <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
      </div>
      <?php if (isset($errors['fname_error'])): ?>
            <label style="color:red">** <?php echo $errors['fname_error']; ?></label>
        <?php endif; ?>


      <div class="input-box">
        <label for="middlename">Middle Name</label>
        <input type="text" id="middlename" name="middlename" placeholder="Middle Name">
      </div>

      <div class="input-box">
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" placeholder="Last Name" required>
      </div>

      <div class="input-box">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>

      <div class="input-box">
        <label for="phone">Contact Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Contact Number" required>
      </div>

      <div class="input-box">
        <label for="programs">Program</label>
        <select id="programs" name="programs" required>
          <option value="" disabled selected>Select a Program</option>
          <option value="1">BIM</option>
          <option value="2">BCA</option>
          <option value="3">BSc. CSIT</option>
          <option value="4">BHM</option>
          <option value="5">BBS</option>
        </select>
      </div>

      <div class="input-box">
        <label for="admitted_year">Admitted Year</label>
        <input type="date" id="admitted_year" name="admitted_year" placeholder="Admitted Year" required>
      </div>

      <div class="input-box">
        <label for="dob">DOB</label>
        <input type="date" id="dob" name="dob" placeholder="Date of Birth" required>
      </div>

      <div class="input-box">
        <label for="passed_out_year">Passed Out Year</label>
        <input type="number" id="passed_out_year" name="passed_out_year" placeholder="Passed Out Year" required>
      </div>

      <div class="input-box">
        <label for="referred_by">Referred By</label>
        <input type="text" id="referred_by" name="referred_by" placeholder="Referred By">
      </div>

      <div class="input-box">
        <label for="gpa">GPA</label>
        <input type="number" step="0.01" id="gpa" name="gpa" placeholder="GPA" min=0 max=4 required>
      </div>

      <div class="input-box1" style="display:flex;color:black;">
        <input type="checkbox" id="checkbox" name="checkbox" required>
        <label for="checkbox" style="display:inline;padding-left:2rem;padding-top:.5rem;"> All the information above are correct as per
          my knowledge.</label>
      </div>

      <button type="submit" class="btn">Apply</button>

      <div class="register-link">
        <p>Already have an account? <a href="login.php">Login Here</a></p>
      </div>

    </form>

  </div>
</div>
<?php
include_once 'includes/footer.php';
?>