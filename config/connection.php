<?php
// require_once ('createdb.php');
// //connecting to database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "HDC";

// //create a connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);


// //Check Connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }


// //creating table for cregister
// $sql = "CREATE TABLE IF NOT EXISTS students(
//     sid INT PRIMARY KEY AUTO_INCREMENT,
//     crn varchar(50) NOT NULL,
//     fname VARCHAR(30) NOT NULL,
//     lname VARCHAR(30) NOT NULL,
//     gurdian_name VARCHAR(30) NOT NULL,
//     address VARCHAR(30) NOT NULL,
//     username VARCHAR(30) NOT NULL,
//     phone BIGINT(10) NOT NULL
//     password VARCHAR(255) NOT NULL,
//     confirmpassword VARCHAR(255) NOT NULL
//     )";

// if (mysqli_query($conn, $sql)) {
//     // echo "<br>";
//     //echo "Table Created Successfully.";
// } else {
//     echo "<br>";
//     echo "Error Creating table" . mysqli_error($conn);
// }
// //creating table for cregister
// $sql = "CREATE TABLE IF NOT EXISTS sadmin(
//     sid INT PRIMARY KEY default 101,
//     username VARCHAR(30) default 'admin1@gmail.com',
//     password varchar(10) default 'admin123'
//     )";

// if (mysqli_query($conn, $sql)) {
//     // echo "<br>";
//     //echo "Table Created Successfully.";
// } else {
//     echo "<br>";
//     echo "Error Creating table" . mysqli_error($conn);
// }

// $sql = "INSERT IGNORE INTO sadmin(sid,username,password) VALUES ('101','admin1','admin123')";
// if (mysqli_query($conn, $sql)) {
//     // echo "<br>";
//     //echo "Data inserted Successfully.";
// } else {
//     echo "<br>";
//     echo "Error Inserting data".mysqli_error($conn);
// }
require_once('createdb.php');
//connecting to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "VOTING";

//create a connection
$conn = mysqli_connect($servername,$username,$password,$dbname);


//Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//creating table for cregister
// $sql="CREATE TABLE IF NOT EXISTS students(
//     id UNSIGNEDBIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
//     firstname VARCHAR(30) NOT NULL,
//     middlename VARCHAR(30),
//     lastname VARCHAR(30) NOT NULL,
//     username VARCHAR(30) NOT NULL,
//     phone VARCHAR(10) NOT NULL,
//     admitted_year DATE NOT NULL,
//     dob DATE NOT NULL,
//     passed_out_year DATE NOT NULL,
//     referred_by VARCHAR(40)
//     )";

//     if(mysqli_query($conn,$sql)){
//        // echo "<br>";
//         //echo "Table Created Successfully.";
//     }else{
//         echo "<br>";
//         echo "Error Creating table".mysqli_error($conn);
//     }
 
    //creating table for Admin
    $sql="CREATE TABLE IF NOT EXISTS sadmin(
    sid INT PRIMARY KEY,
    adminusername VARCHAR(30),
    adminpassword varchar(10)
    )";

    if(mysqli_query($conn,$sql)){
       // echo "<br>";
        //echo "Table Created Successfully.";
    }else{
        echo "<br>";
        echo "Error Creating table".mysqli_error($conn);
    }

    $sql = "INSERT IGNORE INTO sadmin(sid,adminusername,adminpassword) VALUES ('101','admin1@gmail.com','admin123')";
    // if (mysqli_query($conn, $sql)) {
    //     // echo "<br>";
    //     //echo "Data inserted Successfully.";
    // } else {
    //     echo "<br>";
    //     echo "Error Inserting data" . mysqli_error($conn);
    // }
    
        // creating table for vote
        // $sql1="CREATE TABLE IF NOT EXISTS vote(
        //     vote_id INT PRIMARY KEY AUTO_INCREMENT,
        //     no_of_vote INT,
        //     voted_at date,
        //     candidate_id unsignedbigint,
        //     )";

        $sql="CREATE TABLE IF NOT EXISTS smin(
            sid INT PRIMARY KEY,
            adminusername VARCHAR(30),
            adminpassword varchar(10)
            )";
        //    print_r("mysqli_query($conn,$sql1)");
            if(mysqli_query($conn,$sql)){
               // echo "<br>";
                //echo "Table Created Successfully.";
            }else{
                echo "<br>";
                echo "Error Creating table".mysqli_error($conn);
            }
        