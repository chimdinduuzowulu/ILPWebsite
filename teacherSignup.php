<?php
error_reporting (E_ALL ^ E_NOTICE); 
include "connectDb.php";
// Create connection
$conn = mysqli_connect($serverName, $userName, $password,$database);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$fname = $_POST["first_name"];
$lname = $_POST["last_name"];
$gradeId = $_POST["GradeId"];
$course = htmlspecialchars( $_POST["course"]);
// $state = $_POST["state"];
$Email = $_POST["email"];
$phone = $_POST["phone"];
$passW = $_POST["password"];
$Qualifications = $_POST["textbox"];
$UsedEmail ="";
$passwordNoM="";
$flag = false;
if(isset($_POST["submit"]))
{

$checkEmail = "SELECT * FROM LecturerTable";
        $result = mysqli_query($conn, $checkEmail);
        if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
            if($row["LecturerEmailId"]==$Email){
            $flag=TRUE;
            $UsedEmail="This email already exits...";
            
            }
         }

        }

if($flag ==false) {

$put = "INSERT INTO LecturerTable (FName,LName,phone,LecturerEmailId,GradeId,pass,CourseTaught,Qualifications)
VALUES('$fname','$lname','$phone','$Email','$gradeId','$passW','$course','$Qualifications')";

if (mysqli_query($conn, $put)){
$success="Your Account was created successfully";
header("location: teacherLogin.php");
} 
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);}

}
}


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <!-- Title Page-->
    <title>Lecturer Registration </title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <!-- beutifying css -->
	<link rel="stylesheet" type="text/css" href="../css/login.css">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
   <p>LECTURER SIGN UP</p>

<form method="POST">

    <div class="form-row">
        <div class="form-group col-md-5">
          <label for="firstName">First Name</label>
          <input type="text" name="first_name" class="form-control" id="inputfirstName">
        </div>
        <br>
        <div class="form-row">
            <div class="form-group col-md-4">
              <label for="lastName">Last Name</label>
              <input type="text" name="last_name" class="form-control" id="inputlastName">
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="contactNo">Contact Number</label>
                  <input type="number" name="phone" class="form-control" id="inputcontactNumber">
                </div>
                <br>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email">
      </div>
      <br>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password">
      </div>
    </div>
    <br>
    <p>Select the grade(s) and course(s) you would like to teach</p>
    
        <input type="checkbox" id="grade1" name="GradeId" value="Grade1">
        <label for="grade1"> Grade 1</label><br>
        <input type="checkbox" id="grade2" name="GradeId" value="Grade2">
        <label for="grade2"> Grade 2</label><br>
        <input type="checkbox" id="grade3" name="GradeId" value="Grade3">
        <label for="grade1"> Grade 3</label><br>
        <input type="checkbox" id="grade4" name="GradeId" value="Grade4">
        <label for="grade4"> Grade 1</label><br>
        <input type="checkbox" id="grade5" name="GradeId" value="Grade5">
        <label for="grade5"> Grade 5</label><br>
        <input type="checkbox" id="grade6" name="GradeId" value="Grade6">
        <label for="grade6"> Grade 6</label><br>
        
      <br>
      <select name="course" id="course" class="input--style-5" value='<?php echo $course?>' required> 
                                 <option value="">Select Course...</option>
                                    <option value="Arabic">Arabic</option>
                                    <option value="Qur'an">Qur'an</option>
                                    <option value="Imla'i">Imla'i</option>
                                    <option value="Huruf Reading">Huruf Reading</option>
                                    <option value="Huruf Writing">Huruf Writing</option>
                                    <option value="Hadith">Hadith</option>
                                    <option value="Fiqhu">Fiqhu</option>
                                    <option value="Tauheed">Tauheed</option>
                                    <option value="Tajweed">Tajweed</option>
                                    <option value="Seerah">Seerah</option>
                                    <option value="Nahawu">Nahawu</option>
                                    </select>
     

        
    
      <br><br>
      <!-- <div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="passWord" placeholder="Password" value="<?php echo $uP?>" required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div> -->
						
      <label for="w3review">Educational qualification:</label>
      <br> <br>
      <textarea id="textbox" name="textbox" rows="7" cols="70"></textarea><br><br>

      
        <!-- <label for="myfile">Upload files instead:</label>
        <br><br>
        <input type="file" id="myfile" name="myfile" multiple> -->
        <br><br>
      

    <button type="submit" name="submit" class="btn btn-primary">Sign up</button>  <button type="submit" name="submit" class="btn btn-primary"><a href="teacherLogin.php">Login</a></button>
  </form>
     

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
