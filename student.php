<?php

$errormsg="";
$updateMsg="";
$con = mysqli_connect('localhost','root','','studentregistration');

if(isset(($_POST['submit']))){
  $un=$_POST["un"];
  $pw=$_POST["pw"];
  $fn=$_POST["fn"];
  $ln=$_POST["ln"];
  $ut=$_POST["ut"];
  $dor=$_POST["dor"];
  $ad=$_POST["addres"];
  $tel=$_POST["tel"];
  $dob=$_POST["dob"];
  $gn=$_POST["gender"];
  $email=$_POST["email"];
  $cou=$_POST["department"];
  


$sql="insert into user 
values('{$un}','{$pw}','{$fn}','{$ln}','{$ut}','{$dor}','{$ad}','{$tel}','{$dob}','{$gn}','{$email}','{$cou}')";

$sql2="select * from user where UserName='{$un}'  limit 1";
$re=mysqli_query($con,$sql2);

if($dob>$dor){
  $errormsg="<p>Invalid input of date of birth</p>";

}
elseif(mysqli_num_rows($re)==1){
  $errormsg="<p>User Name $un already exist. So not insert into database</p>";

}

elseif(mysqli_query($con,$sql) and strpos($un,"Student")){
  $updateMsg="<p> Insert into database</p>";
}


else{
  $errormsg="<p>Invalid User Name</p>";
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
        var un=document.getElementById('uname').value;
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

        if(un.length <=12 && un.includes("Student")){
          alert("User name should be follow 'MIT-Student-000' format ");
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
        



      }

    </script>


    <title>Student Dashboard</title>
</head>
<body>
<!-- Navigation Bar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">

        <a class="navbar-brand" href=""><p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;color: azure;"> Institute Of Higher Education.</p> </a>
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
                  <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" ><b>Add Admin User  </b></button> </a>
                  <button class="nav-link " id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><b>Add New Student </b></button>
                  <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><b>Add Course</b></button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><b>Add Subject</b></button>
                  <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><b>Add Marks</b></button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><b>Delete Details</b></button>
                </div>

               



        </div>
        <hr>
        <img src="Aus.jpg" alt="" width="200px" height="200px" class="rounded-circle"> 
        

    </div>
    <!--Form -->
    <div class="col-md-9" >
        <form action="student.php" onsubmit= "return validateFormfn()"  method="POST"  style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px;" autocomplete="on">
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
                <select id="userType" name="ut" class="form-control" >
                    
                    <option value="Student" selected>Student</option>
                    
                  </select>
              </div>
              <div class="col-md-2">
                <label for="inputState" class="form-label" style="color: aliceblue;">Gender</label> <br>
                <input type="radio" id="Male" name="gender" value="Male" style="color: aliceblue;" required>
                <label for="Male" style="color: aliceblue;">Male</label>
                <input type="radio" id="Female" name="gender" value="Female" style="color: aliceblue;">
                <label for="Female" style="color: aliceblue;">Female</label><br>

              </div>
        </div>

              
        
        <div class="row">
                <div class="col-md-6">
                <label for="dob" class="form-label" style="color: aliceblue;">DOB</label>
                <input type="date" class="form-control" id="dob" name="dob" min="1988-01-01" required>
                </div>

                <div class="col-md-5">
                    <label for="dor" class="form-label" style="color: aliceblue;">Date of Registration</label>
                    <input type="date" class="form-control" id="dor" name="dor" required>
                    </div>

              </div>

              <div class="col-md-4">
                <label for="inputState" class="form-label" style="color: aliceblue;">Department</label>
                <select id="inputState" class="form-select" name="department">
                  <option selected> Science</option>
                  <option>Engineering</option>
                  <option>Management</option>
                  <option>Art and Education</option>
                </select>
              </div>

    <div class="row">
                <div class="col-md-6">
                    <label for="Adress" class="form-label" style="color: aliceblue;">Address</label>
                    <input type="text" class="form-control" id="Adress" name="addres" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tel" class="form-label" style="color: aliceblue;">Tel.</label>
                        <input type="tel"  id="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"  placeholder="077-123-4678" name="tel"required>
                       
                        </div>
    </div>

              <div class="row">
                <div class="col-md-6">
                    <label for="uname" class="form-label" style="color: aliceblue;">User Name</label>
                    <input type="text" class="form-control" id="uname" placeholder="MIT-Student-01" name="un" required>
                    <small style="color:red;">Follow MIT-Student-000 format</small> 
                  </div>
                
                    <div class="col-md-6">
                        <label for="password" class="form-label" style="color: aliceblue;">PassWord </label>
                        <input type="text" class="form-control" id="password" name="pw" required>
                        </div>

    </div>
 

            <div class="row">
                <div class="col-md-6"> 
                <label for="password" class="form-label" style="color: aliceblue;"><?php echo $errormsg; ?> </label>
                <label for="password" class="form-label" style="color: aliceblue;"><?php echo $updateMsg; ?> </label>
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






