<?php

$title = "Log out";
$active = "logout";
include_once 'includes/header.php';

session_start();
session_unset();
session_destroy();
header("Location:login.php");
?>
<br>
<button style="
color:black;
background-color:blue;
">
<h1>
<a href="login.php" style="
text-decoration:none;
color:black;
background-color:light-blue;
">Go to Login Page</a>
</h1>
</button>