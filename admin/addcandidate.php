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

  $sql = "SELECT * FROM registerstudent WHERE CRN = $CRN;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $searchprogram = $row['programid'];
      $searchsemester = $row['semester'];
      $searchstudent_id = $row['student_id'];
    }
  }

  $bol = $searchprogram == $programs && $searchsemester == $semester && empty($errors);
  if ($bol) {
    $sql = "INSERT INTO candidates(Name,CRN,programid,semester) VALUES ('$name','$CRN','$programs','$semester')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
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
