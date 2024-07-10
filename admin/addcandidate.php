
<?php
include_once './includes/adminheader.php';
?>
<div class="body-login">
  <div class="wrapper">
    <form action="" method="POST">
      <!-- <img src="assets/logo.png" alt=""> -->
      <h1>Add Candiate</h1>
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
        <label for="semester">Sem</label>
        <select id="semester" name="semester" required>
          <option value="" disabled selected>Select a Semester</option>
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
      

      <button type="submit" class="btn">Add</button>

    </form>
  </div>
</div>
<?php
include_once './includes/footer.php';
?>