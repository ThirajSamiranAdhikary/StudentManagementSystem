<?php
session_start();
if(isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Student"){
$con = mysqli_connect('localhost','root','','studentregistration');
$uName =$_SESSION["uName "] ;  //'MIT-Student-001';
$msg="";
$msg_class="error";
$sql_1 = "SELECT FirstName, LastName, Address, Tel, DOB, Email,RegDate,Gender FROM `user` WHERE UserName = '$uName' ";

$result_1 = mysqli_query($con, $sql_1);

if($result_1 == false){
	echo mysqli_error($con);
	exit;
}else{
	$studentDetails = mysqli_fetch_row($result_1);
	$fName = $studentDetails[0];
	$lName = $studentDetails[1];
	$address = $studentDetails[2];
	$tel = $studentDetails[3];
	$dob = $studentDetails[4];
	$email = $studentDetails[5];
	$regDate=$studentDetails[6];
	$gender=$studentDetails[7];
}

if(isset(($_POST['submit']))){
	
	$pw=$_POST["pw"];
	$fn=$_POST["fn"];
	$ln=$_POST["ln"];
	$ad=$_POST["addres"];
	$tel=$_POST["tel"];
	$dob=$_POST["dob"];
	$gn=$_POST["gender"];
	$email=$_POST["email"];
	
    $sql_2="upodate user set
    FirstName='".$fn."',
    LastName='".$ln."',
    Address='".$address."',
    Tel='".$tel."',
    DOB='".$dob."',
    Email='".$email."',
    Gender='".$gn."'"; 
  if(mysqli_query($con,$sql_2)){
	$msg="<p> Insert into database</p>";
  }
  }
  $alert="<div class='".$msg_class."'><span class='closebtn'>&times;</span><span id='msg'>". $msg."</span></div> ";
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
      function homeFunction() {
        window.location.href="studentProfile.php";
      }
      function profileEditFunction() {
        window.location.href="studentDetailsEdit.php";
      }
      function courseDetailFunction() {
        window.location.href="courseDetails.php";
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
                <h3 style="color: white;">Student Dashboard</h3>
                
            </div>

            <div class="col-md-4 pt-3">
               
            </div>



        </div>

    </div>

    <div class="row">
        <div class="col-md-2" style="background-color: black; opacity: 0.7; height: 100%; border-radius: 5px;">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-6" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="size: 40px;">
                <button class="nav-link " id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" onClick="homeFunction()"><b>Home</b></button> 
                  <button class="nav-link active" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="profileEditFunction()"><b>EditProfile</b></button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()"><b>Course Detail</b></button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()">|</button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()">|</button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()">|</button>

				</div>
        </div>
        <hr>
        <img src="Aus.jpg" alt="" width="200px" height="200px" class="rounded-circle"> 
        

    </div>
    <!--Form -->
    <div class="col-md-9" >
        <form action="studentDetails.php" onsubmit= "return validateFormfn()"  method="POST"  style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;padding: 5px;" autocomplete="on">
        <div class="row">
                <div class="col-md-12"> 
                  <?php echo $alert; ?> 
                </div>
            </div>
			<div class="row">
            <div class="col-md-4">
              
            </div>
            <div class="col-md-8">
              
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
              
            </div>
        </div>
        
        
        
        <div class="row">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">First Name</label>
                <input type="text" class="form-control" id="fn" name="fn"  value="<?php echo $fName; ?>" required>
              </div>

              <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Last Name</label>
                <input type="text" class="form-control" id="ln" name="ln" value="<?php echo $lName; ?>" required>
              </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label" style="color: aliceblue;">Email Adress</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
              </div>
            
              
              <div class="col-md-6">
                <label for="inputState" class="form-label" style="color: aliceblue;">Gender</label> <br>
                <input type="radio" id="Male" name="gender" value="Male" style="color: aliceblue;" <?php echo($gender=='Male'?'checked':'')?> required>
                <label for="Male" style="color: aliceblue;">Male</label>
                <input type="radio" id="Female" name="gender" value="Female" style="color: aliceblue;" <?php echo($gender=='Female'?'checked':'')?> >
                <label for="Female" style="color: aliceblue;" >Female</label><br>

              </div>
        </div>

              
        
        <div class="row">
                <div class="col-md-6">
                <label for="dob" class="form-label" style="color: aliceblue;">DOB</label>
                <input type="date" class="form-control" id="dob" name="dob" min="1988-01-01" value="<?php echo $dob; ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="dor" class="form-label" style="color: aliceblue;">Date of Registration</label>
                    <input type="text" class="form-control" id="dor" name="dor" value="<?php echo $regDate; ?>" readonly>
                </div>

         </div>

        

		<div class="row">
					<div class="col-md-6">
						<label for="Adress" class="form-label" style="color: aliceblue;">Address</label>
						<input type="text" class="form-control" id="Adress" name="addres" value="<?php echo $address; ?>" required>
					</div>
          <div class="col-md-6">
                    <label for="uname" class="form-label" style="color: aliceblue;">Student ID</label>
                    <input type="text" class="form-control" id="uname" placeholder="MIT-Student-000" name="un" value="<?php echo $uName; ?>" readonly>
                  </div>
					
		</div>

   <div class="row">
          <div class="col-md-6">
          <label for="tel" class="form-label" style="color: aliceblue;">Tel.</label>
          <input type="tel" class="form-control" id="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"  placeholder="077-123-4678" name="tel"  value="<?php echo $tel; ?>" required>  
        </div>
    
        <div class="col-md-6">
            
        </div>

    </div>
 

            <div class="row mt-5">
                <div class="col-md-6"> 
                </div>
                <div class="col-md-6">
                <input type="reset" value="cancel" class="btn btn-danger">
                <input type="submit" value="Update" name="submit" class="btn btn-primary btn-block">
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