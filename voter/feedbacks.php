<?php
// Set the page title
$title = "Feedback Form";
// Include the database connection configuration
require_once '../config/connection.php';
// Include the header file for the candidates page
include_once 'candidateheader.php';
$crn = $_SESSION['crn'];
// echo $crn;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $email = $_POST['email'];


    // Email Validation
    if (empty($email)) {
        $errors['email_error'] = "Email can't be blank.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email_error'] = "Email address is not valid.";
    }
 // If no errors, insert into database
 if (empty($errors)) {
    $sql = "INSERT INTO feedback (CRN, email,message) 
            VALUES ('$crn','$email','$message')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['feedback']=1;
        header("Location: feedbacks.php");
        exit;
    } else {
        echo "Error adding the details: " . $sql . "<br>" . mysqli_error($conn);
    }
}
}
?>
<?php if (isset($_SESSION['feedback'])): ?>

   
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
title: "Feedback Send successfully"
});
</script>
<?php unset($_SESSION['feedback']); // Unset the session variable ?>
<?php endif; ?>


<div class="feedback-container"
    style="display: flex; justify-content: space-between; max-width: 900px; margin: 20px auto; padding: 20px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;">
    <div class="feedback-info" style="width: 45%;">
        <img src="../assets/logo.png" alt="HDC logo">
        <h3 style="margin-bottom: 10px;">Contact Us</h3>
        <p style="margin-bottom: 5px;"><strong>Email:</strong> himalayadarshan5@gmail.com</p>
        <p style="margin-bottom: 5px;"><strong>Phone Number:</strong> 021-590471</p>
        <p style="margin-bottom: 5px;"><strong>Address:</strong> Main Road, Biratnagar-09</p>
    </div>
    <div class="feedback-form" style="width: 55%;">
        <form action="" method="POST">
            <div class="input-box" style="margin-bottom: 15px;">
                <label for="email">Email<span style="color:red;">*</span></label>

                <input type="email" id="email" name="email" placeholder="Enter your email" class="feedback-input"
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                <?php if (isset($errors['email_error'])): ?>
                    <label style="color:red;float:left;"><?= $errors['email_error'] ?></label>
                <?php endif; ?>

            </div>
            <div class="input-box message-box" style="margin-bottom: 15px;">
                <label for="message">Message<span style="color:red;">*</span></label>

                <textarea id="message" name="message" placeholder="Write your message here" class="feedback-textarea"
                    style="width: 100%; padding: 35px; border: 1px solid #ccc; border-radius: 4px; height: 8rem; resize: none;"></textarea>
            </div>
            <div class="button" style="text-align: right;">
                <button type="submit" value="Send Message" class="feedback-button"
                    style="width: 100%; background: #00529C; color: #fff; padding: 10px 69px; border: none; border-radius: 4px; cursor: pointer;">Send
                    Message</button>
            </div>
        </form>
    </div>
</div>

<?php
// Include the footer file
include_once 'footer.php';
?>