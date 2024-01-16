<?php
session_start();
if(isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Admin"){
$errormsg1="";
$data1="";
$errormsg2="";
$data2="";
$errormsg3="";
$data3="";

$con = mysqlI_connect('localhost','root','','studentregistration');
if(isset($_POST['submit'])){

  $sid=$_POST["sid"];
  

  $sql="select * from user where UserName='{$sid}'  ";
  $re=mysqli_query($con,$sql);
 
  
  if(mysqli_num_rows($re)==1){
    $sql2="delete from user where UserName='{$sid}'  ";
    
    if(mysqli_query($con,$sql2)){
    
      $data1="<p> $sid Deleted succesfully </p>";

    }

    
  }
  
  else{
    $errormsg1="<p>Not a valid user</p>";
    echo "bad";
  }
  

}

if(isset($_POST['cdelete'])){

  $cid=$_POST["sid"];
  

  $sql="select * from course where courseID='{$cid}'  ";
  $re=mysqli_query($con,$sql);
 
 
  if(mysqli_num_rows($re)==1){
    
    
    $sql2="select * from user where courseID='{$cid}'";
    $re3=mysqli_query($con,$sql2);
    $n=mysqli_num_rows($re3);
    if($n>0){
      $errormsg2="<p>Can't delete there is ".$n." students who follow the course</p>";  
    }else{
      $sql3="delete from course where courseID='{$cid}'";
      if(mysqli_query($con,$sql3)){
        $data2="<p> $cid Deleted succesfully </p>";
  
      }

    }

    

    
  }
  
  else{
    $errormsg2="<p>Not a valid course ID</p>";
  }
  

}

if(isset($_POST['sdelete'])){

  $sid=$_POST["sid"];
  

  $sql="select * from subject where subjectID='{$sid}'  ";
  $re=mysqli_query($con,$sql);

 
  if(mysqli_num_rows($re)==1){
    $sql2="select * from subject_course where SubjectID='{$sid}'";
    $re3=mysqli_query($con,$sql2);
    $n=mysqli_num_rows($re3);
    if($n>0){
      $errormsg3="<p>Can't delete there is ".$n."  course which releted to this subject</p>";  
    }else{
      $sql3="delete  from subject where subjectID='{$sid}'  ";
      if(mysqli_query($con,$sql3)){
        $data3="<p> $sid Deleted succesfully </p>";
      }
    }

    
  }
  
  else{
    $errormsg3="<p>Not a valid Subject ID</p>";
  }
  

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
     //functions to jump pages
     function adminFunction() {
        window.location.href="dashboard.php";
      }
      function courseFunction() {
        window.location.href="course.php";
      }
      function subjectFunction() {
        window.location.href="subject.php";
      }
      function marksFunction() {
        window.location.href="marks.php";
      }

       function reportFunction() {
        window.location.href="report.php";
      }
      function studentListFunction() {
        window.location.href="studentList.php";
      }
</script>

   


    <title>Delete Dashboard</title>
</head>
<body>
<!-- Navigation Bar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">

        <a class="navbar-brand" href=""><p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;color: azure;"> Institute of Higher Education</p> </a>
        <ul class="navbar-nav " style="margin-left: auto;"  >
            
            <li class="navbar-item" > <a href="logout.php" class="nav-link  active">LOG OUT <img src="log.webp" alt="loging"  style="opacity: 0.5; width: 25px; height: 25px;"></a></li>
        </ul>

    </nav>


<div class="bg-image" style=" background-image: url(background.jpg);height:100vh; ">


    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-8">
                <h3 style="color: white;">Admin Dashboard</h3>
                
            </div>

            <div class="col-md-4 pt-3">
               
            </div>



        </div>

    </div>

    <div class="row">
        <div class="col-md-2" style="background-color: black; opacity: 0.7; height: 100%; border-radius: 5px;">
            <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-6" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="size: 40px;">
            <button class="nav-link " id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" onClick="adminFunction()"><b>Add Admin/Student User  </b></button> 
            <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="courseFunction()"><b>Add Course</b></button>
            <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="subjectFunction()"><b>Add Subject</b></button>
            <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="marksFunction()"><b>Add Marks</b></button>
            <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="studentListFunction()"><b>Student List</b></button>
            <button class="nav-link active" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="reportFunction()"><b>Delete Details</b></button>
                
              </div>

               



        </div>
        <hr>
        <img src="Aus.jpg" alt="" width="200px" height="200px" class="rounded-circle"> 
        

    </div>
    <!--Form -->
    <div class="col-md-9" >
        <form action="" onsubmit= "return validateFormfn()"  method="POST"  style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px;" autocomplete="on">
        <div class="row">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Student ID:</label>
                <input type="text" class="form-control" id="cid" name="sid" required>
              </div>

              
              <br>

            <div class="row">
                <div class="col-md-6"> 
                <label for="password" class="form-label" style="color: aliceblue;"><?php echo $errormsg1; ?> </label>
                <label for="password" class="form-label" style="color: aliceblue;"><?php echo $data1; ?> </label>
                </div>
                <div class="col-md-6">
                <input type="reset" value="cancel" class="btn btn-danger">
                <input type="submit" value="Delete User" name="submit" class="btn btn-primary btn-block">

                   
                  </div>

            </div>

              

        </div>

            </form>
            <!--End of From-->
            
            <br>
            <div class="col-md-12" >
        <form action="" onsubmit= "return validateFormfn()"  method="POST"  style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px;" autocomplete="on">
        <div class="row">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Course ID:</label>
                <input type="text" class="form-control" id="cid" name="sid" required>
              </div>

              
              <br>

            <div class="row">
                <div class="col-md-6"> 
                <label for="password" class="form-label" style="color: aliceblue;"><?php echo $errormsg2; ?> </label>
                <label for="password" class="form-label" style="color: aliceblue;"><?php echo $data2; ?> </label>
                </div>
                <div class="col-md-6">
                <input type="reset" value="cancel" class="btn btn-danger">
                <input type="submit" value="Delete Course" name="cdelete" class="btn btn-primary btn-block">

                   
                  </div>

            </div>

              

        </div>

            </form>
            <!--End of From-->
        
            <br>
            <div class="col-md-12" >
        <form action="" onsubmit= "return validateFormfn()"  method="POST"  style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px;" autocomplete="on">
        <div class="row">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Subject ID:</label>
                <input type="text" class="form-control" id="cid" name="sid" required>
              </div>

              
              <br>

            <div class="row">
                <div class="col-md-6"> 
                <label for="password" class="form-label" style="color: aliceblue;"><?php echo $errormsg3; ?> </label>
                <label for="password" class="form-label" style="color: aliceblue;"><?php echo $data3; ?> </label>
                </div>
                <div class="col-md-6">
                <input type="reset" value="cancel" class="btn btn-danger">
                <input type="submit" value="Delete Subject" name="sdelete" class="btn btn-primary btn-block">

                   
                  </div>

            </div>

              

        </div>

            </form>
            <!--End of From-->
       


    </div>

  
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">hiii</div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
  </div>
</div>
</div>
 
 
        

</body>
</html>
<?php
}
else{
  header("location:home.php");
}
?>


