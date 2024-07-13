
<?php
include_once '../includes/adminheader.php';
?>
<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      <!-- <img src="assets/logo.png" alt=""> -->
      <h1 style="color:black;">Add Candidate</h1>
      <div class="input-box">
        <label for="name">Name</label>
        <input type="name" placeholder="Name" name="name" required>

        <box-icon type='solid' name='user'></box-icon>

      </div>

      <div class="input-box">
        <label for="crn">CRN</label>
        <input type="crn" placeholder="CRN" name="crn" required>
        <box-icon name='lock'></box-icon>
      </div>

      <div class="input-box">
        <label for="programs">Program</label>
        <select id="programs" name="programs" onchange="filterSemesters()">
          <option value="" disabled selected>Select a Program</option>
          <option value="BIM">BIM</option>
          <option value="BCA">BCA</option>
          <option value="BSc.CSIT">BSc. CSIT</option>
          <option value="BHM">BHM</option>
          <option value="BBS" class="bbs">BBS</option>
        </select>
      </div>
      <div class="input-box">
        <label for="semester">Semester</label>
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