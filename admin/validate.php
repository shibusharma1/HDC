<?php
include_once 'adminheader.php';
require_once '../config/connection.php';
require 'crn_generator.php';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = trim($_POST['student_id']);
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname = trim($_POST['lastname']);
    $dob = trim($_POST['dob']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $programid = $_POST['programs'];
    $semester = $_POST['semester'];
    $admitted_year = trim($_POST['admitted_year']);
    $referred_by = trim($_POST['referred_by']);
    $random_code = trim($_POST['random_code']);
    $CRN = trim($_POST['CRN']);

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
        if (!$inputDate || $inputDate > $today) {
            $errors['dob_error'] = "Invalid or future date.";
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
    if (empty($programid)) {
        $errors['programs_error'] = "Please select your program.";
    }

    // Semester Validation
    if (empty($semester)) {
        $errors['semester_error'] = "Please select your semester.";
    }

    // Admitted Year Validation
    if (!preg_match($pattern, $admitted_year)) {
        $errors['admitted_year_error'] = "Invalid date format.";
    } else {
        $inputDate = DateTime::createFromFormat('Y-m-d', $admitted_year);
        $today = new DateTime('today');
        if (!$inputDate || $inputDate > $today) {
            $errors['admitted_year_error'] = "Invalid or future date.";
        }
    }

    // Referred By Validation
    if (!empty($referred_by) && !preg_match("/^[a-zA-Z ]+$/", $referred_by)) {
        $errors['referred_by_error'] = "Referred by can't contain digits and special characters.";
    }

    // If no errors, update the database
    if (empty($errors)) {
        $sql = "UPDATE registerstudent SET 
                    firstname = '$firstname', 
                    middlename = '$middlename', 
                    lastname = '$lastname', 
                    dob = '$dob', 
                    phone = '$phone', 
                    email = '$email', 
                    programid = '$programid', 
                    semester = '$semester', 
                    admitted_year = '$admitted_year', 
                    referred_by = '$referred_by', 
                    CRN = '$CRN', 
                    random_code = '$random_code' 
                WHERE student_id = '$student_id'";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['update_success'] = 1;
            $fullname = $firstname . ' ' . $middlename . ' ' . $lastname;

            // Update the candidate if the student is also a candidate
            $sql_candidate = "UPDATE candidates SET 
                                Name = '$fullname', 
                                CRN = '$CRN', 
                                programid = '$programid', 
                                semester = '$semester' 
                            WHERE CRN = '$CRN'";

            mysqli_query($conn, $sql_candidate);

            header("Location: students.php");
            exit;
        } else {
            echo "Error updating the details: " . mysqli_error($conn);
        }
    }
}
?>
