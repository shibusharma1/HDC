<?php

$title = "Log out";
$active = "logout";
include_once 'includes/header.php';

session_start();
session_unset();
session_destroy();
header("Location:login.php");
