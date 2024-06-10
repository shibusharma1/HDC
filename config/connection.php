<?php
require_once('createdb.php');
//connecting to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HDC";

//create a connection
$conn = mysqli_connect($servername,$username,$password,$dbname);


//Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//creating table for cregister
$sql="CREATE TABLE IF NOT EXISTS students(
    sid INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    address VARCHAR(30) NOT NULL,
    crn varchar(50) NOT NULL,
    gurdian_name VARCHAR(30) NOT NULL,
    phone BIGINT(10) NOT NULL
    )";

    if(mysqli_query($conn,$sql)){
       // echo "<br>";
        //echo "Table Created Successfully.";
    }else{
        echo "<br>";
        echo "Error Creating table".mysqli_error($conn);
    }
 
