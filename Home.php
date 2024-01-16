<?php
session_start();
$errormsg="";
$con = mysqlI_connect('localhost','root','','studentregistration');
if(isset($_POST['submit'])){

    $un=$_POST["un"];
    $pw=$_POST["pw"];
   
    $sql = "select * from user where UserName='".$un."' and Password='".md5($pw)."' limit 1";
    $re=mysqli_query($con,$sql);

    if(mysqli_num_rows($re)==1 ){
        $row = mysqli_fetch_array($re);
        $_SESSION["UserType"] =$row["UserType"];
        $_SESSION["uName "] =$un;

        if($row["UserType"]=="Admin"){
            header("location:dashboard.php");
            }else{
            header("location:StudentProfile.php");
            }
                
            exit();
        
    }
    else
    $errormsg="<p> Invalid User Name and Password</p>";
    #echo"<script>alert('Invalid User Name and Password')</script>";
    
    


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
    <style>
        body{
            background-image: url(image1.jpg);
            background-repeat:no-repeat ;
            background-size: 100% ;
            
           
        }
    </style>
    <title>Home</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">

        <a class="navbar-brand" href=""><p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;color: azure;"> Institute of Higher Education</p> </a>
      
        <ul class="navbar-nav " style="margin-left: auto;"  >
            
        </ul>


    </nav>
    <!-- Navigation Bar End-->

    <div class="container" >
        <div class="row">
            <div class="col-md-8">
                <!-- Title -->
                <h1 style="color: aliceblue;">Student Registration System</h1>
                
            </div>

            <div class="col-md-4 pt-3">
               
            </div>



        </div>

    </div>

    <div class="container pt-3" ></div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>

            <!-- Form -->

            <div class="col-md-6">
                <form action="" method="POST" id="form1" style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;text-align: center;">
                   <hr>
                   <img src="log.webp" alt="" width="70px" height="70px">
                   <h1 style="color: aliceblue;">LOG IN</h1>
                   <h3 style="color: aliceblue;">Enter Your User-name and PassWord</h3>

                 

                   <hr>
                    <label for="" style="color: aliceblue;">User Name</label> 
                    <input type="text"  name="un" class="text" required> <br>
                    <small id="demo1"></small>
                    

                    <hr>
        
                    <label for="" style="color: aliceblue;">Password</label> 
                    <input type="password"  name="pw" class="text" required> <br>
                    <small id="demo1" style="color:red"> <?php echo $errormsg; ?></small>

                    <hr>

                    <a href="http://localhost/Assignment/reset.php"><button type="button" class="btn btn-dark " >Reset </button></a>
                    
        
                    
                    <input type="reset" value="cancel" class="btn btn-danger">
                    <!--<button type="submit" class="btn btn-primary" name="submit">LOGIN</button> -->
                    <input type="Submit" name="submit"  class="btn btn-primary" value="log In">
                    
                    
                    
        
        
                </form>
            </div>
        </div>


    </div>

 
        

</body>
</html>

