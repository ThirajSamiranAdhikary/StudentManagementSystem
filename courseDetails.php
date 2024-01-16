<?php
session_start();
if(isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Student"){
$con = mysqli_connect('localhost','root','','studentregistration');
$uName = $_SESSION["uName "] ; //'MIT-Student-003'
//To get student marks

 $sql_1="SELECT CourseName FROM `user`INNER JOIN course 
 ON user.CourseID = course.CourseID WHERE UserName = '$uName' ";
$result_1 = mysqli_query($con, $sql_1);
if(mysqli_num_rows($result_1)==0){
    $coursename="-" ; 
}else{
    $coursename=mysqli_fetch_row($result_1)[0];
}

$sql_2 = "SELECT Mark, SubjectName, Credits FROM `student_subject` INNER JOIN subject 
	ON student_subject.SubjectID = subject.SubjectID WHERE StudentID = '$uName' "; 
$result_2 = mysqli_query($con, $sql_2);
$marks = array();

if($result_2 == false){
	echo mysqli_error($con);
	exit;
}
else{
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


    <title>Course Detail</title>
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
                  <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="profileEditFunction()"><b>EditProfile</b></button>
                  <button class="nav-link active" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" onClick="courseDetailFunction()"><b>Course Detail</b></button>
                <br><br><br><br><br>
            </div>
        </div>
        <hr>
        <img src="Aus.jpg" alt="" width="200px" height="200px" class="rounded-circle"> 
        
    </div>
    
    <div class="col-md-9" >
    <!-- mainstage-->
    
    <table class="table table-dark table-hover">
    
    <thead>
        <tr>
            <th colspan=5><h5> Course Name:<?php echo " ".$coursename; ?></h5></th>
        </tr>
      <tr>
        <th>Subject Name</th>
        <th>Mark</th>
        <th>Grades</th>
        <th>Credits</th>
        <th>G.P.V</th>
      </tr>
    </thead>
    <tbody>
        <?php
           function gradLt($marks){
            $grade="";
            if( $marks > 79)   {$grade= 'A+';}   
            elseif($marks > 69){$grade= 'A';}   
            elseif( $marks > 59){$grade= 'A-';}  
            elseif( $marks > 49){$grade= 'B';}   
            elseif( $marks > 39){$grade= 'C';}   
            elseif( $marks > 32){$grade= 'D';}
            elseif( $marks > 0) {$grade='F';}
            return $grade;
        }
        function gradPt($marks){
            $points=0;
            if($marks > 79)   {$points= 5.00;}   
            elseif( $marks > 69){$points= 4.00;}   
            elseif( $marks > 59){$points= 3.50;}  
            elseif( $marks > 49){$points= 3.00;}   
            elseif( $marks > 39){$points= 2.00;}   
            elseif( $marks > 32){$points=1.00 ;}
            elseif( $marks > 0) {$points=0.00;}
            return $points;
        }
            
            $total_credits=0;
            $total_qpt=0;
            $y=mysqli_num_rows($result_2);
            if ( $y> 0) {
            
                while($row = mysqli_fetch_assoc($result_2)) {
                $gr=gradLt($row['Mark']);
                $gp=gradPt($row['Mark']);
                $cr=$row['Credits'];
                $total_credits+=$cr;
                $total_qpt+=$cr*$gp;
                echo "<tr>";
                echo "<td>".$row['SubjectName']."</td>";
                echo "<td>".$row['Mark']."</td>";
                echo "<td>".$gr."</td>";
                echo "<td>".$cr."</td>";
                echo "<td>".$gp."</td>";
                echo "</tr>";
                }
                echo "<tr><td colspan=4>G.P.A.</td><td>".round($total_qpt/$total_credits,2)."</td></tr>";

            } else {
              for ($x = 0; $x <= 5-$y; $x++) {
                echo "<tr>";
                echo "<td>-</td>";
                echo "<td>-</td>";
                echo "<td>-</td>";
                echo "<td>-</td>";
                echo "<td>-</td>";
                echo "</tr>";
              }
            }

                

        }

     
        ?>
      
    </tbody>
  </table>
    </ul>
     <!-- mainstage--> 
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
