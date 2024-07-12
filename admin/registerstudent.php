<?php
include_once '../includes/adminheader.php';
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
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
      </div>

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
          <option value="BIM">BIM</option>
          <option value="BCA">BCA</option>
          <option value="BSc.CSIT">BSc.CSIT</option>
          <option value="BHM">BHM</option>
          <option value="BBS">BBS</option>
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
        <input type="date" id="passed_out_year" name="passed_out_year" placeholder="Passed Out Year" required>
      </div>

      <div class="input-box">
        <label for="referred_by">Referred By</label>
        <input type="text" id="referred_by" name="referred_by" placeholder="Referred By">
      </div>

      <div class="input-box">
        <label for="gpa">GPA</label>
        <input type="number" step="0.01" id="gpa" name="gpa" placeholder="GPA" min=0 max=4required>
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
 include_once 'footer.php';
?>