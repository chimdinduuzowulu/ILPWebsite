<?php 
  include "../connectDb.php";
$displayChoice=isset($_GET["choice"])? strval($_GET["choice"]):null;
$email=isset($_GET["email"]) ? strval($_GET["email"]):null;
if($displayChoice==="Lecturer"){
$sqlQ=$conn->query("DELETE FROM LecturerTable WHERE LecturerEmailId='$email'");
if($sqlQ){
header("location:searchUsers.php ");

}
else{echo "could not delete user";}

}

else{
$sqlQ=$conn->query("DELETE FROM LecturerTable WHERE StudentEmailId='$email'");
if($sqlQ){
header("location:searchUsers.php ");

}
else{echo "could not delete user";}

}



?>