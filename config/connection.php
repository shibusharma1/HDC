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
    sid INT PRIMARY KEY AUTO_INCREMENT,
    adminusername VARCHAR(30) NOT NULL,
    adminpassword varchar(10) NOT NULL
    )";

if (mysqli_query($conn, $sql)) {
    // echo "<br>";
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}

$sql = "INSERT IGNORE INTO sadmin(sid,adminusername,adminpassword) VALUES ('101','admin@gmail.com','admin123')";
if (mysqli_query($conn, $sql)) {
    // echo "<br>";
    //echo "Data inserted Successfully.";
} else {
    echo "<br>";
    echo "Error Inserting data" . mysqli_error($conn);
}


//creating table for registering CMAT
$sql = "CREATE TABLE IF NOT EXISTS registercmat(
            id INT PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR(30) NOT NULL,   
            middlename VARCHAR(30),   
            lastname VARCHAR(30) NOT NULL,   
            dob DATE NOT NULL,
            phone BIGINT(10) NOT NULL,
            email VARCHAR(50) NOT NULL,   
            programs varchar(10) NOT NULL,
            collegename varchar(100) NOT NULL,
            passed_out_year Date NOT NULL,
            gpa INT NOT NULL,
            referred_by VARCHAR(30) NOT NULL
            )";

if (mysqli_query($conn, $sql)) {
    // echo "<br>";
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}

//creating table for registering student
$sql = "CREATE TABLE IF NOT EXISTS registerstudent(
            student_id INT PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR(30) NOT NULL,   
            middlename VARCHAR(30),   
            lastname VARCHAR(30) NOT NULL,   
            dob DATE NOT NULL,
            phone BIGINT(10) NOT NULL,
            email VARCHAR(50) NOT NULL,
            programs varchar(30) NOT NULL,
            semester varchar(30) NOT NULL,
            admitted_year Date NOT NULL,
            -- gpa DECIMAL(10, 2) NOT NULL,
            referred_by VARCHAR(30),
            CRN BIGINT, 
            random_code VARCHAR(30) NOT NULL
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

//programs table
$sql = "CREATE TABLE IF NOT EXISTS programs(
    programid INT PRIMARY KEY AUTO_INCREMENT,
    programname VARCHAR(30) NOT NULL
    )";

if (mysqli_query($conn, $sql)) {
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}

//voters table
$sql = "CREATE TABLE IF NOT EXISTS voters (
    voter_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
)";

if (mysqli_query($conn, $sql)) {
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}


// votes table
$sql = "CREATE TABLE votes (
    vote_id INT AUTO_INCREMENT PRIMARY KEY,
    voter_id INT,
    crn INT,
    FOREIGN KEY (voter_id) REFERENCES voters(voter_id),
    FOREIGN KEY (crn) REFERENCES candidates(CRN)
)";

if (mysqli_query($conn, $sql)) {
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}
