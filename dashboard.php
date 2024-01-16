<?php
session_start();
if(isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Admin"){
$errormsg="";
$updateMsg="";
$con = mysqli_connect('localhost','root','','studentregistration');

$sql_1="SELECT CourseID,CourseName FROM course ";
$result1 = mysqli_query($con, $sql_1);


if(isset($_POST['submit'])){
  #$un=$_POST["un"];
  $pw=md5($_POST["pw"]);
  $fn=$_POST["fn"];
  $ln=$_POST["ln"];
  $ut=$_POST["ut"];
  $dor=$_POST["dor"];
  $ad=$_POST["addres"];
  $tel=$_POST["tel"];
  $dob=$_POST["dob"];
  $gn=$_POST["gender"];
  $email=$_POST["email"];
  $cid=isset($_POST["CourseID"])?$_POST["CourseID"]:"";//admin user has no cousrce
  $lastS = "";
#dimuthu

  // $sql1 = "SELECT UserName FROM user WHERE RegDate = (SELECT MAX(RegDate) FROM user WHERE UserType = '$ut');";
  // $result1 = mysqli_query($con,$sql1);
  // if($result1 == false){
  //   echo mysqli_error($conn);
  //   exit;
  // }else{
  //   $oldUName = mysqli_fetch_row($result1);
  //   if($oldUName == null){ // FOR THE FIRST MEMBER REGISTATION
  //     $lastS = "001";
  //   }else{
  //     $splitON = explode("-",$oldUName[0]); // splited old name by "-"
  //     $lastS = $splitON[2] + 1;
  //     $lastS = sprintf("%03d", $lastS); // present last name in 00x (three digits format)
  //   }
  //   //choose admin or student string patten
  //   if($ut == "Student"){
  //     $uName = "MIT-Student-" . $lastS; // student string patten
  //   }else{
  //     $uName = "MIT-Admin-" . $lastS; // admin string patten
  //   }
  #kbit
  $sql1 = "SELECT count(*) FROM  user ";
  $result1 = mysqli_query($con,$sql1);
  if($result1 == false){
    echo mysqli_error($con);
    exit;
  }else{
      $count = mysqli_fetch_row($result1)[0];
      $lastS = sprintf("%03d", $count+1); // present last name in 00x (three digits format)
    
    //choose admin or student string patten
    if($ut == "Student"){
      $uName = "MIT-Student-" . $lastS; // student string patten
    }else{
      $uName = "MIT-Admin-" . $lastS; // admin string pattern
    }
  
  }



$sql="insert into user 
values('{$uName}','{$pw}','{$fn}','{$ln}','{$ut}','{$dor}','{$ad}','{$tel}','{$dob}','{$gn}','{$email}','{$cid}')";


$sql2="select * from user where UserName='{$uName}'  limit 1";
$re=mysqli_query($con,$sql2);

if(mysqli_num_rows($re)==1){
  $errormsg="<p>User Name $uName already exist. So not insert into database</p>";

}

elseif(mysqli_query($con,$sql) ){
  $updateMsg="<p> $uName Insert into database</p>";
}
elseif( mysqli_errno($con) == 1062) {
  $errormsg="<p>".mysqli_error($con)."</p>";
} 
else {
  $errormsg="<p>Somthing went to wrong!<br>".mysqli_error($con)."</p>";
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

      function showHideCourse(){
        var e = document.getElementById('ut');
        var utype = e.options[e.selectedIndex].value;
        var course=document.getElementById('CourseID');
        
        if(utype =='Admin'){
          course.disabled = true;
        }else{
          course.disabled = false;
        }
      }
      //funtion to validate firstname
      function validatefn(){
            var fname = document.getElementById('fn').value;
            //var lname = document.getElementById('password').value;
            const num=[0,1,2,4,3,5,6,7,8,9];
            var z=0;
            
            for(var i in num){
                if(fname.includes(i)){
                    z=z+1;
                }
            }
            return z;
        }

        function validateLn(){
            var lname = document.getElementById('ln').value;
            //var lname = document.getElementById('password').value;
            const num=[0,1,2,4,3,5,6,7,8,9];
            var z=0;
            
            for(var i in num){
                if(lname.includes(i)){
                    z=z+1;
                }
            }
            return z;
        }
       

      function validateFormfn(){
        var pw=document.getElementById('password').value;
        var dob=document.getElementById('dob').value;
        var dor=document.getElementById('dor').value;
        var d1 = new Date(dob);
        var d2 = new Date(dor);
        var d3 = new Date();
        if(pw.length <=6){
          alert("Password should greater than 6 characters");
          return false;
        }

        if(pw.length >=15){
          alert("Password should less than 15 characters");
          return false;
        }

        if(pw.toLowerCase() == "password"){
          alert("Password can not be password");
          return false;
        }

        

        if(!(validatefn()==0)){
          alert("First name can not have numbers");
          return false;

        }

        if(!(validateLn()==0)){
          alert("Last name can not have numbers");
          return false;

        }

        if((d3.getFullYear()-d1.getFullYear())<18){
          alert("Date of birth must be far at lesat 18 years ");
          return false;

        }
        if((d3.getFullYear()-d2.getFullYear())>=1){
          alert("Course registration shuld be happen nearly within 1 year");
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
    </script>


    <title>Admin Dashboard</title>
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
                  <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" onClick="adminFunction()"><b>Add Admin/Student User  </b></button> 
                  <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="courseFunction()"><b>Add Course</b></button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="subjectFunction()"><b>Add Subject</b></button>
                  <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="marksFunction()"><b>Add Marks</b></button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="studentListFunction()"><b>Student List</b></button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="reportFunction()"><b>Delete Details</b></button>
                  
                  
                </div>

               



        </div>
        <hr>
        <img src="Aus.jpg" alt="" width="200px" height="200px" class="rounded-circle"> 
        

    </div>
    
    <!--Form -->
    <div class="col-md-9" >
    
        <form action="dashboard.php" onsubmit= "return validateFormfn()"  method="POST"  style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px;" autocomplete="on">
        
        <label for="password" class="form-label" style="color: aliceblue;"><?php echo $errormsg; ?> </label>
    <label for="password" class="form-label" style="color: aliceblue;"><?php echo $updateMsg; ?> </label>
        
        <div class="row">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">First Name</label>
                <input type="text" class="form-control" id="fn" name="fn" required>
              </div>

              <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Last Name</label>
                <input type="text" class="form-control" id="ln" name="ln" required>
              </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Email Adress</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
            
              <div class="col-md-4">
                <label for="userType" class="form-label" style="color: aliceblue;">User Type</label>
                <select id="ut" name="ut" class="form-control" onchange="showHideCourse()">
                    <option value="Admin" >Admin</option>
                    <option value="Student" selected>Student</option>
                    
                    
                  </select>
              </div>
              <div class="col-md-2">
                

              </div>
        </div>

              
        
        <div class="row">
                <div class="col-md-6">
                <label for="dob" class="form-label" style="color: aliceblue;">DOB</label>
                <input type="date" class="form-control" id="dob" name="dob" min="1968-01-01" required>
                </div>

                <div class="col-md-6">
                    <label for="dor" class="form-label" style="color: aliceblue;">Date of Registration</label>
                    <input type="date" class="form-control" id="dor" name="dor" required>
                    </div>

              
    </div>
    <div class="row">
              <div class="col-md-6">
              <label for="inputState" class="form-label" style="color: aliceblue;">Gender</label> <br>
                <input type="radio" id="Male" name="gender" value="Male" style="color: aliceblue;" required>
                <label for="Male" style="color: aliceblue;">Male</label>
                <input type="radio" id="Female" name="gender" value="Female" style="color: aliceblue;">
                <label for="Female" style="color: aliceblue;">Female</label><br>
              </div>
              <div class="col-md-6">
              <label for="CourseID" class="form-label" style="color: aliceblue;">Course</label>
                <select class="form-control" id="CourseID" name="CourseID">
                  <option value=""></option>
                  <?php 
                if (mysqli_num_rows($result1) > 0) {
            
                  while($row = mysqli_fetch_assoc($result1)) {
                    echo "<option value=".$row['CourseID'].">".$row['CourseName']."</option>";
                  }
                }
                ?>
                </select>
              </div>
    </div>
    <div class="row">
                <div class="col-md-6">
                    <label for="Adress" class="form-label" style="color: aliceblue;">Address</label>
                    <input type="text" class="form-control" id="Adress" name="addres" required>
                    </div>

                    <div class="col-md-6">
                    <label for="password" class="form-label" style="color: aliceblue;">PassWord </label>
                        <input type="password" class="form-control" id="password" name="pw" required>
                        
                        </div>
    </div>

      
                
                    <div class="col-md-6">
                    <label for="tel" class="form-label" style="color: aliceblue;">Tel.</label>
                        <input type="tel" class="form-control" id="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"  placeholder="077-123-4678" name="tel"required>
                         
                    </div>

    
    

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



