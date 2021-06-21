



<!DOCTYPE html>
<html lang="en">
<head>
<title> lecturer Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
session_start();
include "../connectDb.php";
$grade=$_SESSION["Grade"];
// $searchEmail="";
$fname=$lname=$email=$phone=$regD="";
// if(isset($_POST["ShowQuery"])){
// $searchEmail=htmlSpecialCharacters( $_POST["Email"]);
// if($searchOption =="Email"){
$Email="";
$fullName="";
$selectChoice="";

$sql="SELECT * FROM StudentTable WHERE Grade = '$grade'";
$result=mysqli_query($conn,$sql);

// }
// }
echo "
<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white table' style=''>
    <tr class='table-light'>
<th>Firstname</th>
<th>Lastname</th>
<th>Email</th>
<th>Phone</th>
<th>Course</th>
</tr>

   
";
if($result==TRUE){
while($row=$result->fetch_assoc())
{

$fname=$row['Fname'] ;
$lname=$row['Lname'] ;
$email=$row['StudentEmailId'] ;
$phone=$row['phone'];
// $regD=$row['CourseTaught'];


  echo "<tr>";
  echo "<td>" . $fname . "</td>";
  echo "<td>" . $lname . "</td>";
  echo "<td>" . $email. "</td>";
  echo "<td>" . $phone. "</td>";
  echo "<td>" . $grade . "</td>";
//   echo "<td>" . "<a style='color:red;' href='deleteUser.php?Email=$searchEmail'> <i class='fas fa-trash-alt'></i></a>". "</td>";
  echo "</tr>";
}



}
else{echo "error";}
echo " </table>";
?>



<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>