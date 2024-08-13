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
    adminpassword varchar(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

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

//programs table
$sql = "CREATE TABLE IF NOT EXISTS programs(
    programid INT PRIMARY KEY AUTO_INCREMENT,
    programname VARCHAR(30) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    )";

if (mysqli_query($conn, $sql)) {
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}


//creating table for registering CMAT
$sql = "CREATE TABLE IF NOT EXISTS registercmat(
            id INT PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR(30) NOT NULL,   
            middlename VARCHAR(30),   
            lastname VARCHAR(30) NOT NULL,   
            dob DATE NOT NULL,
            gender ENUM('MALE','FEMALE','OTHERS') NOT NULL,
            phone BIGINT(10) NOT NULL,
            email VARCHAR(50) NOT NULL,   
            programid INT NOT NULL,
            collegename varchar(100) NOT NULL,
            passed_out_year Date NOT NULL,
            gpa INT NOT NULL,
            referred_by VARCHAR(30) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (programid) REFERENCES programs(programid)
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
            gender ENUM('MALE','FEMALE','OTHERS') NOT NULL,
            phone BIGINT(10) NOT NULL UNIQUE,
            email VARCHAR(50) NOT NULL UNIQUE,
            programid INT NOT NULL,
            semester varchar(30) NOT NULL,
            admitted_year Date NOT NULL,
            referred_by VARCHAR(30),
            CRN BIGINT UNIQUE, 
            random_code VARCHAR(30) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (programid) REFERENCES programs(programid)
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
        -- student_id INT,
        Name VARCHAR(255) NOT NULL,
        CRN BIGINT NOT NULL UNIQUE,
        programid INT NOT NULL,
        semester VARCHAR(30) NOT NULL,
        suppoter1 VARCHAR(50) NOT NULL UNIQUE,
        suppoter2 VARCHAR(50) NOT NULL UNIQUE,
        FOREIGN KEY (programid) REFERENCES programs(programid),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

if (mysqli_query($conn, $sql)) {
    // echo "<br>";
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}

// votes table
$sql = "CREATE TABLE IF NOT EXISTS votes(
    vote_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    candidate_id INT,
    FOREIGN KEY (student_id) REFERENCES registerstudent(student_id),
    FOREIGN KEY (candidate_id) REFERENCES candidates(candidate_id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 )";

if (mysqli_query($conn, $sql)) {
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}

//Vote_status table
$sql = "CREATE TABLE IF NOT EXISTS vote_status(
    vote_status_id INT PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(1) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

if (mysqli_query($conn, $sql)) {
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}
//result_update table
$sql = "CREATE TABLE IF NOT EXISTS result_update(
    result_update_id INT PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(1) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

if (mysqli_query($conn, $sql)) {
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}

//feedback table
$sql = "CREATE TABLE IF NOT EXISTS feedback(
    feedback_id INT PRIMARY KEY AUTO_INCREMENT,
    CRN BIGINT, 
    email VARCHAR(255) NOT NULL,
    message VARCHAR(255) NOT NULL,
    FOREIGN KEY (CRN) REFERENCES registerstudent(CRN),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

if (mysqli_query($conn, $sql)) {
    //echo "Table Created Successfully.";
} else {
    echo "<br>";
    echo "Error Creating table" . mysqli_error($conn);
}
