<?php
$title = "CMAT Register";
include_once 'includes/header.php';
require_once 'config/connection.php';

$errors = array();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $firstname = trim($_POST['firstname']);
  $middlename = trim($_POST['middlename']);
  $lastname = trim($_POST['lastname']);
  $dob = trim($_POST['dob']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $programs = $_POST['programs'];
  $collegename = $_POST['collegename'];
  $passed_out_year = $_POST['passed_out_year'];
  $gpa = $_POST['gpa'];
  $referred_by = trim($_POST['referred_by']);
  $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';

  // First Name Validation
  if (empty($firstname)) {
    $errors['firstname_error'] = "First name is required.";
  } elseif (!preg_match("/^[a-zA-Z ]+$/", $firstname)) {
    $errors['firstname_error'] = "First name can't contain digits and special characters.";
  }

  // Middle Name Validation
  if (!empty($middlename) && !preg_match("/^[a-zA-Z ]+$/", $middlename)) {
    $errors['middlename_error'] = "Middle name can't contain digits and special characters.";
  }

  // Last Name Validation
  if (empty($lastname)) {
    $errors['lastname_error'] = "Last name is required.";
  } elseif (!preg_match("/^[a-zA-Z ]+$/", $lastname)) {
    $errors['lastname_error'] = "Last name can't contain digits and special characters.";
  }

  // Date of Birth Validation
  $pattern = '/^\d{4}-\d{2}-\d{2}$/';
  if (!preg_match($pattern, $dob)) {
    $errors['dob_error'] = "Invalid date format.";
  } else {
    $inputDate = DateTime::createFromFormat('Y-m-d', $dob);
    $today = new DateTime('today');
    if (!$inputDate) {
      $errors['dob_error'] = "Invalid date.";
    } elseif ($inputDate > $today) {
      $errors['dob_error'] = "DOB is in the future.";
    }
  }

  // Phone Validation
  if (empty($phone)) {
    $errors['phone_error'] = "Phone number is required.";
  } elseif (!preg_match("/^9[87][0-9]{8}$/", $phone)) {
    $errors['phone_error'] = "Phone number is not valid.";
  }

  // Email Validation
  if (empty($email)) {
    $errors['email_error'] = "Email can't be blank.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email_error'] = "Email address is not valid.";
  }

  // Programs Validation
  if (empty($programs)) {
    $errors['programs_error'] = "Please select your programs.";
  }

  // +2 College Name Validation
  if (empty($collegename)) {
    $errors['collegename_error'] = "College name is required.";
  } elseif (!preg_match("/^[a-zA-Z ]+$/", $collegename)) {
    $errors['collegename_error'] = "College name can't contain digits and special characters.";
  }

  // +2 Passed Out Year Validation
  if (!preg_match($pattern, $passed_out_year)) {
    $errors['passed_out_year_error'] = "Invalid date format.";
  } else {
    $inputDate = DateTime::createFromFormat('Y-m-d', $passed_out_year);
    $today = new DateTime('today');
    if (!$inputDate) {
      $errors['passed_out_year_error'] = "Invalid Passed Year.";
    } elseif ($inputDate > $today) {
      $errors['passed_out_year_error'] = "+2 Passed Year is in the future.";
    }
  }

  // GPA Validation
  if (empty($gpa)) {
    $errors['gpa_error'] = "GPA is required.";
  } elseif (!preg_match("/^([0-3](\.\d{1,2})?|4(\.0{1,2})?)$/", $gpa)) {
    $errors['gpa_error'] = "GPA is not valid.";
  }

  // Referred By Validation
  if (!empty($referred_by) && !preg_match("/^[a-zA-Z ]+$/", $referred_by)) {
    $errors['referred_by_error'] = "Referred by can't contain digits and special characters.";
  }

  // Gender Validation
  if (empty($gender)) {
    $errors['gender_error'] = "Gender is required.";
  }

  // If no errors, insert into database
  if (empty($errors)) {
    $sql = "INSERT INTO registercmat (firstname, middlename, lastname, dob, phone, email, programid, collegename, passed_out_year, gpa, referred_by, gender) VALUES ('$firstname', '$middlename', '$lastname', '$dob', '$phone', '$email', '$programs', '$collegename', '$passed_out_year', '$gpa', '$referred_by', '$gender')";
    if (mysqli_query($conn, $sql)) {
      $_SESSION['form_success'] = true;
      header("Location: registercmat.php");
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
      <img src="assets/logo.png" alt="Himalaya Darshan College" title="Himalaya Darshan College" style="display:block;margin:auto;">
      <h2 style="color:black;">Register for Free CMAT</h2>
      <p>Please enter your details into the fields below.</p>

      <div class="input-box">
        <label for="firstname">First Name<span style="color:red;">*</span></label>
        <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
      </div>
      <?php if (isset($errors['firstname_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['firstname_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label for="middlename">Middle Name</label>
        <input type="text" id="middlename" name="middlename" placeholder="Middle Name">
      </div>
      <?php if (isset($errors['middlename_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['middlename_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label for="lastname">Last Name<span style="color:red;">*</span></label>
        <input type="text" id="lastname" name="lastname" placeholder="Last Name" required>
      </div>
      <?php if (isset($errors['lastname_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['lastname_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label for="dob">DOB(AD)<span style="color:red;">*</span></label>
        <input type="date" id="dob" name="dob" placeholder="Date of Birth" required>
      </div>
      <?php if (isset($errors['dob_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['dob_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label>Gender<span style="color:red;">*</span></label>
        <input type="radio" id="gender_male" name="gender" value="Male" required>
        <label for="gender_male">Male</label>
        <input type="radio" id="gender_female" name="gender" value="Female" required>
        <label for="gender_female">Female</label>
        <input type="radio" id="gender_other" name="gender" value="Other" required>
        <label for="gender_other">Other</label>
      </div>
      <?php if (isset($errors['gender_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['gender_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label for="phone">Contact Number<span style="color:red;">*</span></label>
        <input type="tel" id="phone" name="phone" placeholder="Contact Number" required>
      </div>
      <?php if (isset($errors['phone_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['phone_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label for="email">Email<span style="color:red;">*</span></label>
        <input type="text" id="email" name="email" placeholder="Email" required>
      </div>
      <?php if (isset($errors['email_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['email_error']; ?></label>
      <?php endif; ?>

      <div class="input-box">
        <label for="programs">Interested Program<span style="color:red;">*</span></label>
        <select id="programs" name="programs">
          <option value="" disabled selected>Select a Program</option>
          <?php
          $sql = "SELECT * FROM programs";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['programid'] . '">' . $row['programname'] . '</option>';
              }
          }
          ?>
        </select>
        <?php if (isset($errors['programs_error'])): ?>
          <label style="color:red;float:left;"><?php echo $errors['programs_error']; ?></label>
        <?php endif; ?>
      </div>

      <div class="input-box">
        <label for="collegename">+2 College Name<span style="color:red;">*</span></label>
        <input type="text" id="collegename" name="collegename" placeholder="+2 College Name">
      </div>

      <div class="contact_div">
        <div class="contacts">
          <div class="input-box">
            <label for="passed_out_year">+2 Passed Out Year(AD)<span style="color:red;">*</span></label>
            <input type="date" id="passed_out_year" name="passed_out_year" placeholder="Passed Out Year" required>
          </div>

          <div class="input-box">
            <label for="gpa">+2 GPA<span style="color:red;">*</span></label>
            <input type="number" step="0.01" id="gpa" name="gpa" placeholder="GPA" min=0 max=4 required>
          </div>
        </div>
        <?php if (isset($errors['passed_out_year_error'])): ?>
          <label style="color:red;float:left;"><?php echo $errors['passed_out_year_error']; ?></label>
        <?php endif; ?>
      </div>

      <div class="input-box" style="margin-top:10px;">
        <label for="referred_by">Referred By</label>
        <input type="text" id="referred_by" name="referred_by" placeholder="Referred By">
      </div>
      <?php if (isset($errors['referred_by_error'])): ?>
        <label style="color:red;float:left;"><?php echo $errors['referred_by_error']; ?></label>
      <?php endif; ?>

      <div class="input-box1 all_the_info">
        <input type="checkbox" id="checkbox" name="checkbox" required>
        <label for="checkbox"> All the information above are correct as per my knowledge.</label>
      </div>

      <button type="submit" class="btn">Apply</button>
    </form>
  </div>
</div>

<?php
include_once 'includes/footer.php';
?>
<?php if (isset($_SESSION['form_success'])): ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });
    Toast.fire({
      icon: "success",
      title: "Form Submitted successfully"
    }).then(function() {
      window.location.href = 'registercmat.php'; // Redirect after user closes the alert
    });
  </script>
  <?php unset($_SESSION['form_success']); // Unset the session variable ?>
<?php endif; ?>
