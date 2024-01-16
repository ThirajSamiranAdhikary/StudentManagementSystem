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


    <title>Student profile</title>
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
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" onClick="homeFunction()"><b>Home</b></button> 
                  <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="profileEditFunction()"><b>EditProfile</b></button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()"><b>Course Detail</b></button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()">|</button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()">|</button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()">|</button>
                  <button class="nav-link " id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()">|</button>
				</div>
        </div>
        <hr>
        <img src="Aus.jpg" alt="" width="200px" height="200px" class="rounded-circle"> 
        

    </div>
    
    <div class="col-md-9" >
      <!--Form -->    


            <div class="card " aria-hidden="true" style="background-color: black;opacity: 0.8;color:white">
            
              <div class="card-body">

              <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-7"></a>

              <div class="row">

                  <div class="col-sm-4">
                  <img src="profile.png" class="rounded float-right img-thumbnail" alt="...">
                  </div>

                  

                  <div class="col-sm-6">
                  <p class="card-text">
                  <h6 class="card-title">Name : <?php echo $fName." ".$lName; ?></h6>
                  <h6 class="card-title">Email : <?php echo $email; ?></h6>
                  <h6 class="card-title">Gender : <?php echo $gender;?></h6>
                  <h6 class="card-title">DoB : <?php echo $dob; ?></h6>
                  <h6 class="card-title">Register date : <?php echo $regDate;?></h6>
                  <h6 class="card-title">Address : <?php echo $address;?></h6>
                  <h6 class="card-title">Tel. : <?php echo $tel;?></h6>     
                  <h6 class="card-title">User Name : <?php echo $uName;?></h6>
                  </p>
                  </div>
                  
                  <div class="col-sm-2">

                  </div>
              </div>

              
                
                <h5 class="card-title placeholder-glow">
                <span class="placeholder col-7"></span>
                </h5>

                <p class="card-text placeholder-glow">
                  <span class="placeholder col-4"></span>
                  <span class="placeholder col-4"></span>
                  <span class="placeholder col-6"></span>
                  <span class="placeholder col-6"></span>
                  <span class="placeholder col-4"></span>
                  <span class="placeholder col-6"></span>
                  <span class="placeholder col-8"></span>
                  <span class="placeholder col-7"></span>
                  <span class="placeholder col-4"></span>
                </p>
                
              </div>
            </div>

        
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