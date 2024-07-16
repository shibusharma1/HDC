<?php
include_once 'adminheader.php';
require_once '../config/connection.php';


$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = trim($_POST['name']);
  $CRN = $_POST['crn'];
  $programs = $_POST['programs'];
  $semester = $_POST['semester'];

 


  //  Name Validation
  if (empty($name)) {
    $errors['name_error'] = "First name is required.";
  } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
    $errors['name_error'] = "First name can't contain digits and special characters.";
  }


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


  $sql = "SELECT * FROM registerstudent";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['CRN'] == $CRN) {
        $searchCRN = $CRN;
        $fullname = $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'];
        break;
      } else {
        $errors['msg_error'] = "CRN doesnot exists:";
        // header("Location: addcandidate.php");

      }
    }
  }
  if(isset($searchCRN)){
  $sql = "SELECT * FROM registerstudent WHERE CRN = $searchCRN;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $searchprogram = $row['programs'];
      $searchsemester = $row['semester'];
    }}



    $bol = $searchCRN == $CRN &&  $searchprogram == $programs &&   $searchsemester == $semester && empty($errors); 
  //If no errors, insert into database
  if($bol) {
      $sql = "INSERT INTO candidates(Name,CRN,Program,semester) VALUES ('$name','$CRN','$programs','$semester')";
      $result = mysqli_query($conn,$sql);
      // echo $programs;
      if($result){
          // echo "hello";exit;
        header("Location: index.php");
        exit;
      }
    }
  } else {
    // $errors['msg_error'] = "Invalid Credential:";
  }
}















//         // If no errors, insert into database
//         if (empty($errors)) {
//           $sql = "INSERT INTO candidates (name,CRN, programs,semester) VALUES ('$name','$CRN','$programs','$semester')";
//           if (mysqli_query($conn, $sql)) {
//             header("Location: admin/index.php");
//             exit;
//           } else {
//              "Error adding the details: " . $sql . "<br>" . mysqli_error($conn);
//           }
//         }
//       }
//       else{
//         $errors['msg_error']="Details of Students didnot matched!!!";

//       }

//     }
//   } else {

//     $errors['msg_error']="Details of  not found!!!";
//   }




// }
?>

<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      <!-- <img src="assets/logo.png" alt=""> -->
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
        <input type="crn" placeholder="CRN" name="crn" required>
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