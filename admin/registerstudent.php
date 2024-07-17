<?php
include_once 'adminheader.php';
require_once '../config/connection.php';
require 'crn_generator.php';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $firstname = trim($_POST['firstname']);
  $middlename = trim($_POST['middlename']);
  $lastname = trim($_POST['lastname']);
  $dob = trim($_POST['dob']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $programs = $_POST['programs'];
  $semester = $_POST['semester'];
  $admitted_year = $_POST['admitted_year'];
  // $gpa = $_POST['gpa'];
  $referred_by = trim($_POST['referred_by']);



  // First Name Validation
  if (empty($firstname)) {
    $errors['firstname_error'] = "First name is required.";
  } elseif (!preg_match("/^[a-zA-Z ]+$/", $firstname)) {
    $errors['firstname_error'] = "First name can't contain digits and special characters.";
  }

  // Middle Name Validation
  if (empty($middlename)) {
    // $errors['middlename_error'] = "Middle name is required.";
  } elseif (!preg_match("/^[a-zA-Z ]+$/", $middlename)) {
    $errors['middlename_error'] = "Middle name can't contain digits and special characters.";
  }
  // last Name Validation
  if (empty($lastname)) {
    $errors['lastname_error'] = "Last name is required.";
  } elseif (!preg_match("/^[a-zA-Z ]+$/", $lastname)) {
    $errors['lastname_error'] = "Last name can't contain digits and special characters.";
  }


  //Date of birth validation
// Step 1: Validate the Date Format
  $pattern = '/^\d{4}-\d{2}-\d{2}$/';
  if (!preg_match($pattern, $dob)) {
    $errors['dob_error'] = "Invalid date format.";
  } else {
    // Step 2: Check if the Date is Not in the Future
    $inputDate = DateTime::createFromFormat('Y-m-d', $dob);
    $today = new DateTime('today');

    // Check if the date object is valid and not in the future
    if (!$inputDate) {
      $errors['dob_error'] = "Invalid date.";
    } elseif ($inputDate > $today) {
      $errors['dob_error'] = "DOB is in the future.";
    } else {
      // $errors['dob_error'] = "The date is valid and not in the future.";
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

  // Semester Validation
  if (empty($semester)) {
    $errors['semester_error'] = "Please select your semester.";
  }

  //Admitted year validation
// Step 1: Validate the Date Format
  $pattern = '/^\d{4}-\d{2}-\d{2}$/';
  if (!preg_match($pattern, $admitted_year)) {
    $errors['admitted_year_error'] = "Invalid date format.";
  } else {
    // Step 2: Check if the Date is Not in the Future
    $inputDate = DateTime::createFromFormat('Y-m-d', $admitted_year);
    $today = new DateTime('today');

    // Check if the date object is valid and not in the future
    if (!$inputDate) {
      $errors['admitted_year_error'] = "Invalid date.";
    } elseif ($inputDate > $today) {
      $errors['admitted_year_error'] = "Admitted year is in the future.";
    } else {
      // $errors['admitted_year_error'] = "The date is valid and not in the future.";
    }
  }

  // gpa Validation
  // if (empty($gpa)) {
  //   $errors['gpa_error'] = "GPA is required.";
  // } elseif (!preg_match("/^([0-3](\.\d{1,2})?|4(\.0{1,2})?)$/", $gpa)) {
  //   $errors['gpa_error'] = "GPA is not valid.";
  // }
  //referred_by Validation
  if (empty($referred_by)) {
    // $errors['referred_by_error'] = "Referred by is required.";
  } elseif (!preg_match("/^[a-zA-Z ]+$/", $referred_by)) {
    $errors['referred_by_error'] = "Referred by can't contain digits and special characters.";
  }

  $random_code = random_int(10000, 99999);
  // Generate a new CRN
  $CRN = generateCRN();
  ;
  ;

  // If no errors, insert into database
  if (empty($errors)) {
    $sql = "INSERT INTO registerstudent (firstname,middlename, lastname,dob,phone,email, programs,semester,admitted_year,referred_by,CRN,random_code) VALUES ('$firstname','$middlename', '$lastname','$dob', '$phone','$email','$programs','$semester','$admitted_year','$referred_by','$CRN','$random_code')";

    if (mysqli_query($conn, $sql)) {
      header("Location: index.php");
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
      <img src="../assets/logo.png" alt="Himalaya Darshan College" title="Himalaya Darshan College"
        style="display:block;margin:auto;">
      <!-- <h1>Himalaya Darshan College</h1> -->
      <h2 style="color:black;">Register Student in HDC</h2>
      <p>Please enter your details into the fields below.</p>

      <div class="input-box">
        <label for="firstname">First Name<span style="color:red;">*</span></label>

        <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
      </div>
      <?php
      if (isset($errors['firstname_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['firstname_error'];
          ?></label>
        <?php
      endif;
      ?>


      <div class="input-box">
        <label for="middlename">Middle Name</label>
        <input type="text" id="middlename" name="middlename" placeholder="Middle Name">
      </div>
      <?php
      if (isset($errors['middlename_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['middlename_error'];
          ?></label>
        <?php
      endif;
      ?>


      <div class="input-box">
        <label for="lastname">Last Name<span style="color:red;">*</span></label>
        <input type="text" id="lastname" name="lastname" placeholder="Last Name" required>
      </div>
      <?php
      if (isset($errors['lastname_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['lastname_error'];
          ?></label>
        <?php
      endif;
      ?>


      <div class="input-box">
        <label for="dob">DOB<span style="color:red;">*</span></label>
        <input type="date" id="dob" name="dob" placeholder="Date of Birth" required>
      </div>
      <?php
      if (isset($errors['dob_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['dob_error'];
          ?></label>
        <?php
      endif;
      ?>



      <div class="input-box">
        <label for="phone">Contact Number<span style="color:red;">*</span></label>
        <input type="tel" id="phone" name="phone" placeholder="Contact Number" required>
      </div>
      <?php
      if (isset($errors['phone_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['phone_error'];
          ?></label>
        <?php
      endif;
      ?>


      <div class="input-box">
        <label for="email">Email<span style="color:red;">*</span></label>
        <input type="text" id="email" name="email" placeholder="Email" required>
      </div>
      <?php
      if (isset($errors['email_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['email_error'];
          ?></label>
        <?php
      endif;
      ?>

      <div class="input-box">
        <label for="admitted_year">Admitted Year<span style="color:red;">*</span></label>
        <input type="date" id="admitted_year" name="admitted_year" placeholder="Admitted Year" required>
      </div>
      <?php
      if (isset($errors['admitted_year_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['admitted_year_error'];
          ?></label>
        <?php
      endif;
      ?>

      <div class="input-box">
        <label for="programs">Program<span style="color:red;">*</span></label>
        <select id="programs" name="programs" onchange="filterSemesters()">
          <option value="" disabled selected>Select a Program</option>
          <option value="BIM">BIM</option>
          <option value="BCA">BCA</option>
          <option value="BSc.CSIT">BSc. CSIT</option>
          <option value="BHM">BHM</option>
          <option value="BBS" class="bbs">BBS</option>
        </select>
      </div>
      <?php
      if (isset($errors['programs_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['programs_error'];
          ?></label>
        <?php
      endif;
      ?>



      <div class="input-box">
        <label for="semester">Semester<span style="color:red;">*</span></label>
        <select id="semester" name="semester" required>
          <option value="" disabled selected>Select a Semester</option>
          <option value="1" class="bbs">First</option>
          <option value="2" class="bbs">Second</option>
          <option value="3" class="bbs">Third</option>
          <option value="4" class="bbs">Fourth</option>
          <option value="5">Fifth</option>
          <option value="6">Sixth</option>
          <option value="7">Seventh</option>
          <option value="8">Eighth</option>
        </select>
      </div>
      <?php
      if (isset($errors['semester_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['semester_error'];
          ?></label>
        <?php
      endif;
      ?>






      <!-- <div class="input-box">
        <label for="gpa">GPA<span style="color:red;">*</span></label>
        <input type="number" step="0.01" id="gpa" name="gpa" placeholder="GPA" min=0 max=4 required>
      </div>
      <?php
      // if (isset($errors['gpa_error'])):
      ?>
        <label style="color:red;float:left;">
          <?php
          // echo $errors['gpa_error'];
          ?></label>
        <?php
        // endif;
        ?> -->



      <div class="input-box">
        <label for="referred_by">Referred By</label>
        <input type="text" id="referred_by" name="referred_by" placeholder="Referred By">
      </div>
      <?php
      if (isset($errors['referred_by_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['referred_by_error'];
          ?></label>
        <?php
      endif;
      ?>



      <div class="input-box1" style="display:flex;color:black;">
        <input type="checkbox" id="checkbox" name="checkbox" required>
        <label for="checkbox" style="display:inline;padding-left:2rem;padding-top:.5rem;"> All the information above are
          correct as per
          my knowledge.</label>
      </div>

      <button type="submit" class="btn">Apply</button>



    </form>

  </div>
</div>

<script>
  function filterSemesters() {
    const programSelect = document.getElementById('programs');
    const semesterSelect = document.getElementById('semester');
    const selectedProgram = programSelect.value;

    // Show all options initially
    const options = semesterSelect.options;
    for (let i = 0; i < options.length; i++) {
      options[i].style.display = 'block';
    }

    // If BBS is selected, show only specific options
    if (selectedProgram === 'BBS') {
      for (let i = 0; i < options.length; i++) {
        if (options[i].classList.contains('bbs')) {
          options[i].style.display = 'block';
        } else {
          options[i].style.display = 'none';
        }
      }
    }

    // Reset the selected option to the default
    semesterSelect.value = '';
  }
</script>

<?php
include_once 'footer.php';
?>