<?php
$title = "Log out";
include_once 'adminheader.php';

// session_start();
session_unset();
session_destroy();
?>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    Toast.fire({
        icon: "success",
        title: "Logged out successfully"
    });

    // Redirect after the SweetAlert toast is shown
    setTimeout(() => {
        window.location.href = "../login.php";
    }, 300); // Adjust the delay to match the toast duration
</script>
