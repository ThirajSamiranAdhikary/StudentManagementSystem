<?php
session_start();
if(isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Admin"){
include 'fetchStudentList.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body{
            background-image: url(background.jpg);
            background-repeat:no-repeat ;
            background-size: 100% ;


        }
    </style>
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
    <title>student List</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">

        <a class="navbar-brand" href=""><p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;color: azure;"> Institute of Higher Education</p> </a>
        <ul class="navbar-nav " style="margin-left: auto;"  >
            
            <li class="navbar-item" > <a href="logout.php" class="nav-link  active">LOG OUT <img src="log.webp" alt="loging"  style="opacity: 0.5; width: 25px; height: 25px;"></a></li>
        </ul>

    </nav>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-8">
                <h3 style="color: aliceblue;">Admin Dashboard</h3>

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
                <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="courseFunction()"><b>Add Course</b></button>
                <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="subjectFunction()"><b>Add Subject</b></button>
                <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="marksFunction()"><b>Add Marks</b></button>
                <button class="nav-link active" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="studentListFunction()"><b>Student List</b></button>
                <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="reportFunction()"><b>Delete Details</b></button>
                <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="marklistFunction()"><b>Mark List</b></button>
  
              </div>
        </div>
        <hr>
        <img src="Aus.jpg" alt="" width="200px" height="200px" class="rounded-circle">


    </div>
    <div class="col-md-9" >
        <form action="" method="POST" style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px;">
            <hr>
                   

            </form>
            <table style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px; width:100%;">
              <tr style="border: 3px ;">
                <th style="color: aliceblue;">Student ID</th>
                <th style="color: aliceblue;">Name</th>
                <th style="color: aliceblue;">Telephone</th>
                <th style="color: aliceblue;">Email</th>
              </tr>
              <?php foreach ($students as $student): ?>
                <tr style="height:50px">
                  <td style="color: aliceblue;"><?=$student["UserName"] ?></td>
                  <td style="color: aliceblue;"><?=$student["FirstName"] . " " . $student["LastName"]; ?></td>
                  <td style="color: aliceblue;"><?=$student["Tel"]; ?></td>
                  <td style="color: aliceblue;"><?=$student["Email"]; ?></td>
                </tr>
              <?php endforeach; ?>



            </table>



    </div>


  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">hiii</div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
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