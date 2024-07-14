<?php

require_once ('createdb.php');
//connecting to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "VOTING";

//create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


//Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//creating table for Admin
$sql = "CREATE TABLE IF NOT EXISTS sadmin(
    sid INT PRIMARY KEY,
    adminusername VARCHAR(30),
    adminpassword varchar(10)
    )";

if (mysqli_query($conn, $sql)) {
    // echo "<br>";
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}

$sql = "INSERT IGNORE INTO sadmin(sid,adminusername,adminpassword) VALUES ('101','admin1@gmail.com','admin123')";
if (mysqli_query($conn, $sql)) {
    // echo "<br>";
    //echo "Data inserted Successfully.";
} else {
    echo "<br>";
    echo "Error Inserting data" . mysqli_error($conn);
}

//creating table for registering CMAT
$sql = "CREATE TABLE IF NOT EXISTS registercmat(
            id INT PRIMARY KEY,
            firstname VARCHAR(30),   
            middlename VARCHAR(30),   
            lastname VARCHAR(30),   
            username VARCHAR(30), 
            phone BIGINT(10),
            program varchar(10),
            admitted_year Date,
            dob DATE,
            passed_out_year DATE,
            referred_by VARCHAR(30),
            gpa INT
            )";
//    print_r("mysqli_query($conn,$sql1)");
if (mysqli_query($conn, $sql)) {
    // echo "<br>";
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}

//creating table for registering student
$sql = "CREATE TABLE IF NOT EXISTS registerstudents(
            student_id INT PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR(30),   
            middlename VARCHAR(30),   
            lastname VARCHAR(30),   
            username VARCHAR(30), 
            phone BIGINT(10),
            program varchar(10),
            admitted_year Date,
            dob DATE,
            passed_out_year DATE,
            referred_by VARCHAR(30),
            gpa INT,
            CRN BIGINT NOT NULL, 
            random_code VARCHAR(30)
            )";

if (mysqli_query($conn, $sql)) {
    // echo "<br>";
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}

//creating table for candidates
$sql = "CREATE TABLE IF NOT EXISTS candidates(
        candidate_id INT PRIMARY KEY AUTO_INCREMENT,
        Name VARCHAR(30) NOT NULL,
        CRN BIGINT NOT NULL,
        Program VARCHAR(30) NOT NULL,
        semester VARCHAR(30) NOT NULL
        )";

if (mysqli_query($conn, $sql)) {
    // echo "<br>";
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}