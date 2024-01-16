<?php
session_start();
if(isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Admin"){
$errormsg="";
$successmsg="";

$con = mysqlI_connect('localhost','root','','studentregistration');

$sql1 = "select SubjectID,SubjectName from subject";
$result1=mysqli_query($con,$sql1);

if(isset($_POST['submit'])){

    $cid=$_POST["cid"];
    $dep=$_POST["department"];
    $cnm=$_POST["cnm"];
    $cd=$_POST["cd"];
    $sid= $_POST['subjectPicked'];
   

    $sql2 = "insert into course 
    values('{$cid}','{$dep}','{$cnm}','{$cd}')";

    $sql3 =" ";
    foreach ($sid as $value) {
      $sql3 .= "INSERT INTO subject_course(CourseID,SubjectID )VALUES('$cid','$value');";
    } 

    $sql4="select * from course where courseID='{$cid}'  limit 1";
    $re=mysqli_query($con,$sql4);

    $sql5="select * from course where CourseName='{$cnm}'  limit 1";
    $re3=mysqli_query($con,$sql5);

   
   
    if(mysqli_num_rows($re)==1){
      $errormsg="<p>Course ID $cid already exist. Enter Valid Course ID</p>";

    }
    elseif(mysqli_num_rows($re3)==1){
      $errormsg="<p>Course name $cnm already exist. Enter Valid Course name</p>";

    }
    elseif(mysqli_query($con,$sql2)){
      mysqli_multi_query($con,$sql3);
      $successmsg="<p> $cnm course has inserted into database</p>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
       function selectsubject(){
        var select1 = document.getElementById('subjectList');
        var i=select1.selectedIndex;
        if(i==-1){alert('please select one subject for ADD');}
        var value = select1.options[i].value;
        var text = select1.options[i].text;
        var select2 = document.getElementById('subjectPicked');
        select2.options.add(new Option(text, value));
        select1.remove(i); 
       
       }
      
       function removesubject(){
        var select1 = document.getElementById('subjectPicked');
        var i=select1.selectedIndex;
        if(i==-1){alert('please select one subject for Remove');}
        var value = select1.options[i].value;
        var text = select1.options[i].text;
        var select2 = document.getElementById('subjectList');
        select2.options.add(new Option(text, value));
        select1.remove(i); 
       
       }
       function selectAllPicked() 
    { 
        selectBox = document.getElementById("subjectPicked");

        for (var i = 0; i < selectBox.options.length; i++) 
        { 
             selectBox.options[i].selected = true; 
        } 
    }
      // form validation
      function validateFormfn(){
        var pickedSubject = document.getElementById('subjectPicked').options.length;
        var courseName = document.getElementById('cnm').value;
        if(pickedSubject>0){
          selectAllPicked();//set all picked subjects as selected
        }
        if(pickedSubject==0){
          alert("At least one subject should be selected");
          return false;
        }if(!isNaN(courseName)){
          alert("Course name should not be a number")
          return false;
        }
        
        

      }
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
      function marklistFunction() {
        window.location.href="MarkList.php";
      }
</script>
    


    <title>Course Dashboard</title>
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
                <button class="nav-link " id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" onClick="adminFunction()"><b>Add Admin/Student User  </b></button> </a>
                <button class="nav-link active" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="courseFunction()"><b>Add Course</b></button>
                <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="subjectFunction()"><b>Add Subject</b></button>
                <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="marksFunction()"><b>Add Marks</b></button>
                <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="studentListFunction()"><b>Student List</b></button>
                <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="reportFunction()"><b>Delete Details</b></button>
                <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="marklistFunction()"><b>Mark List</b></button>
  
              </div>

               



        </div>
        <hr>
        <img src="Aus.jpg" alt="" width="200px" height="200px" class="rounded-circle"> 
        

    </div>
    <!--Form -->
    <div class="col-md-9" >
       
    
  <form action="" onsubmit= "return validateFormfn()"  method="POST"  style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px;" autocomplete="on">
  <label for="password" class="form-label" style="color: aliceblue;"><?php echo $errormsg; ?> </label>
  <label for="password" class="form-label" style="color: aliceblue;"><?php echo $successmsg; ?> </label>      
  
  <div class="row">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Course ID:</label>
                <input type="text" class="form-control" id="cid" name="cid" required>
              
            </div>

            <div class="col-md-6">
            <label for="inputState" class="form-label" style="color: aliceblue;">Department</label>
            <select id="inputState" class="form-select" name="department">
            <option selected> Science</option>
            <option>Engineering</option>
            <option>Management</option>
            <option>Art and Education</option>
            </select>
            </div>
    </div>     
    <div class="row">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Course Name:</label>
                <input type="text" class="form-control" id="cnm" name="cnm" required>
              </div>
              <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Course Duration (years):</label>
                <input type="number" class="form-control" id="cd" name="cd"  min=2 max=5 required>
              </div>
    </div>
        <div class="row mt-5">
              <div class="col-md-5">
                <label for="subjectList" class="form-label" style="color: aliceblue;">Subject List:</label>
                <select class="form-control" id="subjectList" name="subjectList" data-size="8" multiple>
                  <?php 
                if (mysqli_num_rows($result1) > 0) {
            
                  while($row = mysqli_fetch_assoc($result1)) {
                    echo "<option value=".$row['SubjectID'].">".$row['SubjectName']."</option>";
                  }
                }
                ?>
                </select>
              </div>

              <div class="col-md-2 ">
              <label for="" class="form-label" style="color: aliceblue;">  &nbsp;</label>
              <button type="button" class="btn btn-success form-control " onclick="selectsubject()"> <i class="fa fa-hand-o-right" aria-hidden="true"></i>
              </button>
              <label for="" class="form-label" style="color: aliceblue;">  &nbsp;</label>
              <button type="button" class="btn btn-warning form-control " onclick="removesubject()"> <i class="fa fa-hand-o-left" aria-hidden="true"></i></button>
              </div>

              <div class="col-md-5">
                <label for="subjectPicked" class="form-label" style="color: aliceblue;">Selected Subjects for Course:</label>
                <select class="form-control" id="subjectPicked" name="subjectPicked[]" data-size="8" multiple>
                </select>
              </div>
              

        </div>

        
              <br>

            <div class="row">
                <div class="col-md-6">
                   
              </div>
                <div class="col-md-6">
                <input type="reset" value="cancel" class="btn btn-danger">
                <input type="submit" value="Submit" name="submit" class="btn btn-primary btn-block">

                    <!--<button type="submit" class="btn btn-primary btn-block"  >SUBMIT</button> -->
                  </div>

            </div>
            

                   


            </form>
            

       


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