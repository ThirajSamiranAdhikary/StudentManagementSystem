<?php
session_start();
if(isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Admin"){
$errormsg="";
$updateMsg="";

$con = mysqli_connect('localhost','root','','studentregistration');
if(isset($_POST['submit'])){

    $sid=$_POST["sid"];
    $sn=$_POST["sn"];
    $scd=$_POST["scd"];
    
   

    $sql = "insert into subject(SubjectID,SubjectName,Credits) values('".$sid."','".$sn."','".$scd."')";
    $sql2="select * from subject where subjectID='{$sid}'  limit 1";
    $re=mysqli_query($con,$sql2);

  
    $sql3="select * from subject where subjectName='{$sn}'  limit 1";
    $re2=mysqli_query($con,$sql3);

        if(mysqli_num_rows($re)==1){
          $errormsg="<p>Subject ID $sid already exist. Enter Valid User ID</p>";
          }

        elseif(mysqli_num_rows($re2)==1){
            $errormsg="<p>Subject name $sn already exist. Enter Valid Subject Name</p>";
            }
        elseif(mysqli_query($con,$sql)){
            
          $updateMsg="<p> Updated Succesfully</p>";
        }
       
        else
        $errormsg="<p> Not Inserted Data </p>";
       

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
      function marklistFunction() {
        window.location.href="MarkList.php";
      }
</script>
    

    <title>Add Subject</title>
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
                <button class="nav-link active" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="subjectFunction()"><b>Add Subject</b></button>
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
        <form action="" onsubmit= ""  method="POST"  style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px;" autocomplete="on">
        <label for="password" class="form-label" style="color: aliceblue;"><?php echo $errormsg; ?> </label>
        <label for="password" class="form-label" style="color: aliceblue;"><?php echo $updateMsg; ?> </label>
        <div class="row">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Subject ID:</label>
                <input type="text" class="form-control" id="cid" name="sid" required>
              </div>

              

        </div>
      
        <div class="row">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Subject Name:</label>
                <input type="text" class="form-control" id="sn" name="sn" required>
              </div>

              

        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Number of Credits:</label>
                <input type="number" class="form-control" id="cd" name="scd"  min=1 max=4 required>
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
            <!--End of From-->
            <p id="demo1"></p>

       


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
