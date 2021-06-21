<?php
include "../connectDb.php";
$grade=$_SESSION["Grade"];

$promote=$conn->query(
"UPDATE StudentTable SET Grade=$gradePromote WHERE Grade='$grade'");
if($promote){
header("location:LDashboard.php");
}



?>