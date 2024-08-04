<?php
$title = "Update Student";
require_once '../config/connection.php';
include_once 'adminheader.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CRN = trim($_POST['CRN']);
    
   // Update the SQL query to join with the programs table
$sql = "SELECT registerstudent.*, programs.programname 
FROM registerstudent 
JOIN programs ON registerstudent.programid = programs.programid 
WHERE registerstudent.CRN = $CRN";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result)

?>

<div class="register-body">
    <div class="wrapper">
        <form action="validate.php" method="POST">
            <img src="../assets/logo.png" alt="Himalaya Darshan College" title="Himalaya Darshan College" style="display:block;margin:auto;">
            <h2 style="color:black;">Update Student in HDC</h2>
            <p>Please enter your details into the fields below.</p>

            <div class="input-box">
                <label for="firstname">First Name<span style="color:red;">*</span></label>
                <input type="hidden" id="student_id" name="student_id" placeholder="student_id" value="<?php echo $row['student_id']; ?>">
                <input type="text" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $row['firstname']; ?>" required>
                <?php if (isset($errors['firstname_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['firstname_error'] ?></label>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <label for="middlename">Middle Name</label>
                <input type="text" id="middlename" name="middlename" placeholder="Middle Name" value="<?php echo $row['middlename']; ?>">
                <?php if (isset($errors['middlename_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['middlename_error'] ?></label>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <label for="lastname">Last Name<span style="color:red;">*</span></label>
                <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $row['lastname']; ?>" required>
                <?php if (isset($errors['lastname_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['lastname_error'] ?></label>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <label for="dob">DOB(AD)<span style="color:red;">*</span></label>
                <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>" required>
                <?php if (isset($errors['dob_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['dob_error'] ?></label>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <label for="phone">Contact Number<span style="color:red;">*</span></label>
                <input type="tel" id="phone" name="phone" placeholder="Contact Number" value="<?php echo $row['phone']; ?>" required>
                <?php if (isset($errors['phone_error'])): ?>
                    <p style="color:red;margin-left:2.2rem;"><?= $errors['phone_error'] ?></p>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <label for="email">Email<span style="color:red;">*</span></label>
                <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" required>
                <?php if (isset($errors['email_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['email_error'] ?></label>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <label for="admitted_year">Admitted Year(AD)<span style="color:red;">*</span></label>
                <input type="date" id="admitted_year" name="admitted_year" value="<?php echo $row['admitted_year']; ?>" required>
                <?php if (isset($errors['admitted_year_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['admitted_year_error'] ?></label>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <label for="programs">Program<span style="color:red;">*</span></label>
                <select id="programs" name="programs" onchange="filterSemesters()" required>
                    <option value="<?php echo $row['programid']; ?>" selected><?php echo $row['programname']; ?></option>
                    <?php
                    $sql = "SELECT * FROM programs";
                    $result = mysqli_query($conn, $sql);
                    while ($program = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $program['programid'] . '">' . $program['programname'] . '</option>';
                    }
                    ?>
                </select>
                <?php if (isset($errors['programs_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['programs_error'] ?></label>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <label for="semester">Semester<span style="color:red;">*</span></label>
                <select id="semester" name="semester" required>
                    <option value="<?php echo $row['semester']; ?>" selected><?php echo $row['semester']; ?></option>
                    <option value="1" class="bbs">First</option>
                    <option value="2" class="bbs">Second</option>
                    <option value="3" class="bbs">Third</option>
                    <option value="4" class="bbs">Fourth</option>
                    <option value="5">Fifth</option>
                    <option value="6">Sixth</option>
                    <option value="7">Seventh</option>
                    <option value="8">Eighth</option>
                </select>
                <?php if (isset($errors['semester_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['semester_error'] ?></label>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <label for="referred_by">Referred By</label>
                <input type="text" id="referred_by" name="referred_by" placeholder="Referred By" value="<?php echo $row['referred_by']; ?>">
                <?php if (isset($errors['referred_by_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['referred_by_error'] ?></label>
                <?php endif; ?>
            </div>

            <input type="hidden" id="CRN" name="CRN" placeholder="CRN" value="<?php echo $row['CRN']; ?>">
            <input type="hidden" id="random_code" name="random_code" placeholder="random_code" value="<?php echo $row['random_code']; ?>">

            <div class="input-box1" style="display:flex;color:black;">
                <input type="checkbox" id="checkbox" name="checkbox" checked required>
                <label for="checkbox" style="display:inline;padding-left:2rem;padding-top:.5rem;"> All the information above are correct as per my knowledge.</label>
            </div>

            <button type="submit" class="btn">Apply</button>
        </form>
    </div>
</div>

<script>
    function filterSemesters() {
        const programSelect = document.getElementById('programs');
        const semesterSelect = document.getElementById('semester');
        const selectedProgram = programSelect.options[programSelect.selectedIndex].text;

        const options = semesterSelect.options;
        for (let i = 0; i < options.length; i++) {
            options[i].style.display = 'block';
        }

        if (selectedProgram === 'BBS') {
            for (let i = 0; i < options.length; i++) {
                if (!options[i].classList.contains('bbs')) {
                    options[i].style.display = 'none';
                }
            }
        }

        semesterSelect.value = '';
    }
</script>

<?php
}
include_once 'footer.php';
?>
