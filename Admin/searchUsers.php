<!DOCTYPE html>
<html>
<head>
<script src="https://kit.fontawesome.com/439a1fb029.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
  background-color: gray;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}
.dropbtn:hover, .dropbtn:focus {
  background-color: black;
}

#myInput {
  box-sizing: border-box;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
  border-bottom: 1px solid #ddd;
}

#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
</head>
<body>



 <form method="POST"> 
    
    <input type="text" placeholder="Search Email" id="myInput" name="email">
    <select name="choice">
    <option value="">Select Choice</option>
    <option value="Student">Student</option>
    <option value="Lecturer">Lecturer</option>
    </select>
    <input type="submit" value="Search" name="submit" >
        </form>


</body>
</html>

<?php
  include "../connectDb.php";
 $sqlChoice="";
  $sqlQ=$resultQ="";
  $resultQuery=FALSE;
  $fname=$lname=$email=$phone=$regD="";
  $flag=0;
if(isset($_POST["submit"]))
{
$displayChoice=$_POST["choice"];
$email=$_POST["email"];

// echo $displayChoice." ".$limitValue;
echo "
<table>
<tr class='table-light'>
<th>Firstname</th>
<th>Lastname</th>
<th>Grade</th>
<th>Email</th>
<th>Phone</th>
<th>Registration Date</th>
</tr>";
if($displayChoice==="Lecturer"){
// echo "yes";
$sqlQ=$conn->query("SELECT * FROM LecturerTable WHERE LecturerEmailId='$email'");
if($sqlQ){
while($row =$sqlQ->fetch_assoc()) {
// $fid=$row['Farmer_Id'];
$grade=$row['GradeId'];
$fname=$row['Fname'];
$lname=$row['Lname'] ;
$email=$row['LecturerEmailId'] ;
$phone=$row['phone'];
$regD=$row['reg_date'];

  echo "<tr>";
  echo "<td>" . $grade . "</td>";
  echo "<td>" . $fname . "</td>";
  echo "<td>" . $lname . "</td>";
  echo "<td>" . $email. "</td>";
  echo "<td>" . $phone. "</td>";
  echo "<td>" . $regD . "</td>";
  echo "<td>" . "<a style='color:red;' href='delete.php?email=$email&choice=$displayChoice'> <i class='fas fa-trash-alt'></i></a>". "</td>";
  echo "</tr>";

// echo "</table>";
// mysqli_close($conn);
}
}
else{ echo "No Result Found";}
echo "</table>";

}

// else if it is client
else{
$client=$conn->query("SELECT * FROM StudentTable WHERE StudentEmailId='$email'");
if($client){
while($row =$client->fetch_assoc()) {
$grade=$row["Grade"];
// $fname=$row['FName'];
$fname=$row["FName"];
$lname=$row["LName"] ;
$email1=$row["StudentEmailId"] ;
$phone=$row["phone"];
$regD=$row["reg_date"];

  echo "<tr>";
  echo "<td>" . $grade . "</td>";
  echo "<td>" . $fname . "</td>";
  echo "<td>" . $lname . "</td>";
  echo "<td>" . $email1. "</td>";
  echo "<td>" . $phone. "</td>";
  echo "<td>" . $regD . "</td>";
  echo "<td>" . "<a style='color:red;' href='deleteUser.php?email=$email&choice=$displayChoice'> <i class='fas fa-trash-alt'></i></a>". "</td>";
  echo "</tr>";

// echo "</table>";

}
}
else{
echo "result not found";
}

}
}
mysqli_close($conn);

?>