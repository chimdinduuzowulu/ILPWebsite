<?php
session_start();
include "../connectDb.php";
$email=$_SESSION["Email"];
$emailHold=$_SESSION["Email"];
  $sql = "SELECT * FROM LecturerTable WHERE LecturerEmailId='$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row  
        while($row = mysqli_fetch_assoc($result)) {
        // if($row["LecturerEmailId"]==$uEmail && $row["pass"]==$uP){
        $passError=$UserNameError="";
		$fnamehold=$row["Fname"];
		$lnamehold=$row["Lname"];
		$email=$row["LecturerEmailId"];
        $Qualification=$row["Qualifications"];
        $phone=$row["phone"];
		$upass=$row["pass"];
        $_SESSION["name"] = $fnamehold." ".$lnamehold;
        // $_SESSION["Password"] = $uPass;
		$_SESSION["Email"]=$email;
        // header("location:updateProfile.php");
        }
        } 

if (isset($_POST["submit"])){
		$fnamehold=$_POST["name"];
		$lnamehold=$_POST["Lname"];
		$email=$_POST["email"];
        $Qualification=$_POST["Qualifications"];
        $phone=$_POST["telephone"];
		$upass=$_POST["Cpassword"];
        $sql="UPDATE LecturerTable
        SET Fname='$fnamehold',
        Lname='$lnamehold',
        phone='$phone',
        LecturerEmailId='$email',
        pass='$upass',
        Qualifications='$Qualification'
        WHERE LecturerEmailId='$emailHold'
        ";
        $result = mysqli_query($conn, $sql);
        if ($result===TRUE) {
        // output data of each row 
        echo "";
        
        } 
        else{echo "sorry error occurred";}
        
        // $passError=$UserNameError="password or username Error: *";
        
}

 if(isset($_POST["upload"])){
// $profileImage="";
 // File upload configuration 
    $targetDir = "LecturerProfile/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $fileName = $_FILES['profileImage']['name']; 
    $imgaefile=$_FILES['profileImage']['name'];
    // $fileName = basename($_FILES['profile']['name']); 
    $targetFilePath = $targetDir . $fileName; 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    // to check if the file type is valid from the giving array of extensions
    if(in_array($fileType, $allowTypes)){
    // upload the file to server..............
    move_uploaded_file($_FILES["profileImage"]["tmp_name"],$targetFilePath);
    $insertValuesSQL =$fileName;
    if(!empty($insertValuesSQL)){
    $updateQuery="UPDATE LecturerTable
                SET profileImage ='$insertValuesSQL'";
                if(mysqli_query($conn,$updateQuery) ===TRUE){
                $profileMessage="Profile Picture updated";
                
                }
                else{
                $profileMessage="failed to update";
                
                }
                
    
    }
    else{
    echo "<script>alert('Select Image');</script>";
    }

    }
    else{
    $profileMessage="image must be: png,jpeg,gif or jpg";
    }
 }

// fecthing the profile
$ProfileImage=$conn->query("SELECT * FROM LecturerTable WHERE LecturerEmailId='$emailHold'");
        if($ProfileImage){
        while($row=$ProfileImage -> fetch_assoc()){
        // $userName =$row["AdminUserName"];
                $profileImage = 'LecturerProfile/'.$row["profileImage"];
                
                 }         }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>UPDATE Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
    margin-top:20px;
    background:#f8f8f8
}
    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row flex-lg-nowrap">
  
<form method="POST">
  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                      <!-- <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;"><?php echo $profileImage;?></span> -->
                      <img src="<?php echo $profileImage;?>" width="120px" height="120px">
                     <!-- <?php echo $profileImage;?> -->
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $_SESSION["name"]?></h4>
                    
                    <!-- <div class="mt-2">

                    
                    </div> -->
                  </div>
                  <div class="text-center text-sm-right">
                    <span class="badge badge-secondary">Lecturer</span>
                    <div class="text-muted"><small>Joined 09 Dec 2017</small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <form class="form" novalidate="">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>First Name</label>
                              <input class="form-control" type="text" name="name" placeholder="<?php echo $fnamehold?>" value="<?php echo $fnamehold?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input class="form-control" type="text" name="Lname" placeholder="<?php echo $lnamehold?>" value="<?php echo $lnamehold?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Contact Number</label>
                              <input class="form-control" type="number" name="telephone" placeholder="<?php echo $phone?>" value="<?php echo $phone?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" type="email" name="email" placeholder="<?php echo $email?>" value="<?php echo $email?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>Qualification</label>
                              <textarea class="form-control" name="Qualifications" rows="5" placeholder="<?php echo $Qualification?>" value="<?php echo $Qualification?>"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <div class="mb-2"><b>Password</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Current Password</label>
                              <input class="form-control" name=" " type="password" placeholder="<?php echo $upass?>" value="<?php echo $upass?>">
                            </div>
                            <div class="form-group">
                              <label>New Password</label>
                              <input class="form-control" name="Cpassword" type="password" placeholder="••••••">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          
                        </div>
                        <div class="row">
                         
                        </div>
                      </div>
                      <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                        <div class="mb-2"><b>School Grades</b></div>
                        <div class="row">
                          <div class="col">
                            <label>Grades Teaching</label>
                            <div class="custom-controls-stacked px-2">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                                <label class="custom-control-label" for="notifications-blog">Grade 1</label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifications-news" checked="">
                                <label class="custom-control-label" for="notifications-news">Grade 2</label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifications-offers" checked="">
                                <label class="custom-control-label" for="notifications-offers">Grade 3</label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                                <label class="custom-control-label" for="notifications-blog">Grade 4</label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                                <label class="custom-control-label" for="notifications-blog">Grade 5</label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                                <label class="custom-control-label" for="notifications-blog">Grade 6</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" name="submit" type="submit">Update Profile</button>   <button class="btn btn-primary" style="margin-left:23px;"> <a href="LDashboard.php" style="text-decoration:none;color:white;">Dashboard</a></button>
                      </div>
                    </div>
                    
                  </form>
                  

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-3 mb-3">
        <div class="card mb-3">
          <div class="card-body">
            <div class="px-xl-3">
              <button class="btn btn-block btn-secondary">
                <i class="fa fa-sign-out"></i>
                <span><a href="../logout.php" style="text-decoration:none;color:white;">Logout</a></span>
              </button>
            </div>
          </div>
        </div>
        <div class="card">
          <form method="POST" enctype="multipart/form-data">
                <label>Upload profile picture</label>
                    <input type="file" name="profileImage" value="choose Image" style="height:30px;width:70%;background-color:;color:black;;margin:auto;border-radius:8px;margin:29px;margin-bottom:3px;"> <br><br>
                    <input type="submit" name="upload" value="Change" style="">
                    <!-- <div class="mt-3"> -->
                    <form>
                    
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
</form>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>