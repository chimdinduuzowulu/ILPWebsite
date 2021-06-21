<?php
include "../connectDb.php";
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$passError= $UserNameError="";
if(isset($_POST["submit"])){
$grades= $_POST["grades"];
$courses= $_POST["courses"];
$courseIdd=0;
// $files=$_POST["myfile"];

   // name of the uploaded file
$filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } 
    elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } 
    else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
        // echo "hey";
        $uploadCourse=$conn->query("INSERT INTO Course(CourseName,Grade) VALUES('$courses','$grades')");
        if($uploadCourse){
        $fecthCourseID=$conn->query("SELECT * FROM Course WHERE CourseName='$courses' AND Grade='$grades'");
        if($fecthCourseID){
        while($row=$fecthCourseID->fetch_assoc()){$courseId=$row["CourseId"];}

  $courseIdd=$courseId;
        echo "$courseId";echo "$filename";echo "$grades";
            $sql1 =$conn->query("INSERT INTO CourseFiles(CourseId,GradeId,FileNames) VALUES('$courseId','$grades','$filename')");
            if ($sql1) {
echo " okay";
                echo "File uploaded successfully";
            }

        
        }
        
        }
      
        } 
        // if main in else
        
        else {
            echo "Failed to upload file.";
        }

        // 
    }

}
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            File Upload
        </title>
        <style>
             header {
            background-color:teal;
            padding: 30px;
            text-align: center;
            font-size: 35px;
            color: white;
 
          }
          #mainBody {
            background-color:grey;
            padding: 30px;
            text-align: center;
            font-size: 15px;
            color: white;

          }

        </style>
        
        </head>
        <body style="background-color: #F2F3F4;">

            <header>
            <input type="button" name=""><a href="LDashboard.php"> Back to Dashboard</a></button>
                <h2>UPLOAD FILES</h2>
              </header>
              <br>
              <br>
              <div id="mainBody">
              <form  method="POST" enctype="multipart/form-data">
                <label for="grades">Select Grade:</label>
                <select name="grades" id="grades">
                <option value=''>select Grade Level</option>
                  <option value="Grade1">Grade1</option>
                  <option value="Grade2">Grade2</option>
                  <option value="Grade3">Grade3</option>
                  <option value="Grade4">Grade4</option>
                  <option value="Grade5">Grade5</option>
                  <option value="Grade6">Grade6</option>
                </select>
                <br><br>
                <label for="grades">Select Subject:</label>
                <select name="courses" id="courses">
                <option value=''>select Grade Course</option>
                  <option value="Arabic">Arabic</option>
                  <option value="Maths">Maths</option>
                  <option value="Science">Science</option>
                  <option value="Biology">Biology</option> 
        
                </select>
                <br><br><br><br>
                 <label for="myfile">Select files:</label>
                    <input type="file" id="myfile" name="myfile">
                    <br><br>
                    <input type="submit" value="Submit" name="submit">
                    
              </form>
              <br><br>

              
              </div>
</body>
</html>