<?php
include "connectDb.php";

if (!$conn) {
  die();
}

$ql1 = "CREATE TABLE IF NOT EXISTS Course (
CourseId INT(6) PRIMARY KEY AUTO_INCREMENT,
CourseName VARCHAR (30),
Grade VARCHAR (30)
)";

$ql2 = "CREATE TABLE IF NOT EXISTS CourseFiles(
CourseFileid INT(6) AUTO_INCREMENT PRIMARY KEY,
CourseId INT(6), 
GradeId VARCHAR (288),
FileNames VARCHAR (266),
FOREIGN KEY (CourseId) REFERENCES Course(CourseId)
)";

$ql3 = "CREATE TABLE IF NOT EXISTS StudentTable (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Fname VARCHAR (30) NOT NULL, 
Lname VARCHAR (30) NOT NULL,
phone VARCHAR (30) NOT NULL,
profileImage VARCHAR(30),
StudentEmailId VARCHAR (30) UNIQUE,
passW VARCHAR (30) NOT NULL,
Grade VARCHAR (30) DEFAULT 'Grade1',
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
// lecturer tables
$ql4 = "CREATE TABLE IF NOT EXISTS LecturerTable (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Fname VARCHAR (30), 
Lname VARCHAR (30),
phone VARCHAR (30),
LecturerEmailId VARCHAR (30),
profileImage VARCHAR(30),
GradeId VARCHAR (30),
pass VARCHAR (30),
CourseTaught VARCHAR (30),
Qualifications VARCHAR (255),
CourseId INT(6), 
FOREIGN KEY (CourseId) REFERENCES Course(CourseId),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";


if(mysqli_query($conn, $ql1)===TRUE && mysqli_query($conn, $ql2)===TRUE && mysqli_query($conn, $ql3)===TRUE && mysqli_query($conn, $ql4)===TRUE ) {
          echo("");
       }

else{
echo  " ".mysqli_error($conn);
} 

$serverName = "localhost";
$userName = "root";
$password = "";
$database="ILPDatabase";
$conn = mysqli_connect($serverName, $userName, $password,$database);


