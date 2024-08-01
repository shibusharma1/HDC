<?php
$title = "Add Candidate";
include_once 'adminheader.php';
require_once '../config/connection.php';


$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = trim($_POST['name']);
  $CRN = $_POST['crn'];
  $programs = $_POST['programs'];
  $semester = $_POST['semester'];




  //  Name Validation
  // if (empty($name)) {
  //   $errors['name_error'] = "Full name is required.";
  // } elseif (!preg_match("/^[a-zA-Z]+$/", $name)) {
  //   $errors['name_error'] = "Full name can't contain digits and special characters.";
  // }


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


  // if (isset($searchCRN)) {
    $sql = "SELECT * FROM registerstudent WHERE CRN = $CRN;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $searchprogram = $row['programid'];
        $searchsemester = $row['semester'];
      }
    }



    $bol = $searchprogram == $programs && $searchsemester == $semester && empty($errors);
    //If no errors, insert into database
    if ($bol) {
      $sql = "INSERT INTO candidates(Name,CRN,programid,semester) VALUES ('$name','$CRN','$programs','$semester')";
      $result = mysqli_query($conn, $sql);
      // echo $programs;
      if ($result) {
        
        header("Location: index.php");
        exit;
      }
    }
  } 

?>

<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      
      <h1 style="color:black;">Add Candidate</h1>
      <?php
      if (isset($errors['msg_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['msg_error'];
          ?></label>
        <?php
      endif;
      ?>
      <div class="input-box">
        <label for="name">Name<span style="color:red;">*</span></label>
        <input type="name" placeholder="Name" name="name" required>
      </div>
      <?php
      if (isset($errors['name_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['name_error'];
          ?></label>
        <?php
      endif;
      ?>


      <div class="input-box">
      <label for="crn">CRN<span style="color:red;">*</span></label>
          <select type="crn" placeholder="CRN" name="crn" required>
          <option value="" disabled selected>Select a CRN</option>
        <?php
        $sql = "SELECT * FROM registerstudent";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          $students = [];  // Array to hold all student data
          // Fetch all rows into an array
          while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
          }
          // Iterate over the array using foreach
            foreach ($students as $student) {
              // Now you can access each student's data
              ?>
              <option>
                <?php
                echo $student['CRN'];
                ?>
              </option>
              <?php
            }
        }
        ?>
        </select>

      </div>
      <?php
      if (isset($errors['CRN_error'])):
        ?>
        <label style="color:red;float:left;">
          <?php
          echo $errors['CRN_error'];
          ?></label>
        <?php
      endif;
      ?>


<div class="input-box">
        <label for="programs">Program<span style="color:red;">*</span></label>
        <select id="programs" name="programs" onchange="filterSemesters()">
          <option value="" disabled selected>Select a Program</option>
          <?php
        $sql = "SELECT * FROM programs";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          $programs = [];  // Array to hold all student data
          // Fetch all rows into an array
          while ($row = mysqli_fetch_assoc($result)) {
            $programs[] = $row;
          }
          // Iterate over the array using foreach
          foreach ($programs as $program) {
            // Now you can access each student's data
            if($program['programname'] == "BBS"){
              ?>
                <option value="<?php echo $program['programid']; ?>" class="bbs"><?php echo $program['programname'];?></option>
                <?php

            }else{
            ?>
            
            
            <option value="<?php echo $program['programid']; ?>">
              <?php
              echo $program['programname'];
              ?>
            </option>
            <?php
          }}
      }
      ?>
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
          <option value="" disabled selected>Select a Semester/Year</option>
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

      <button type="submit" class="btn">Add</button>

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