<?php
$errormsg="";
$successmsg="";

$con = mysqlI_connect('localhost','root','','studentregistration');
if(isset($_POST['reset'])){

    $un=$_POST["un"];
    $pw=md5($_POST["pw"]);
    $pw2=md5($_POST["pw2"]);

    $sql = "select * from user where UserName='".$un."' and Password='".$pw."' limit 1";
    $re=mysqli_query($con,$sql);

   
        if(mysqli_num_rows($re)==1 ){
            $sql2="update user set Password='".$pw2."' where UserName='".$un."'";
    
            
            if(mysqli_query($con,$sql2)){
                $successmsg = "<p>Password Updated Succesfully </p>";
                #echo"<script> alert('Password Updated Succesfully ')</script>";
            }    
            
        }
        else
        $errormsg="<p> Invalid User Name and Password</p>";
       # echo"<script> alert('Invalid User Name and Password')</script>";

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

    <script> 
    var ps1 = document.getElementById('passWord1').value;
    var ps2 = document.getElementById('passWord2').value;

    function formValidate(){
        var ps1 = document.getElementById('passWord1').value;
        var ps2 = document.getElementById('passWord2').value;

        if(ps1==ps2){
            alert("passwords can not be same");
            //document.getElementById('passWord1').innerHTML = 'passwords can not be same';
            return false;

        }
        if(ps2 =='password'){
            alert("passwords can not be password");

            //document.getElementById('passWord1').innerHTML = 'passwords can not be password';
            return false;
        }



    }

    function setCancel(){
        getElementById('passWord1').innerHTML = '';
        getElementById('passWord2').innerHTML = '';


    }


</script> 


    <title>Home</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">

        <a class="navbar-brand" href=""><p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;color: azure;"> Institute of Higher Education</p> </a>
      
        <ul class="navbar-nav " style="margin-left: auto;"  >
            <li class="navbar-item "> <a href="logout.php" class="nav-link  active">Home</a></li>
            <li class="navbar-item"> <a href="" class="nav-link ">Causes</a></li>
            <li class="navbar-item"> <a href="" class="nav-link ">Lectures/Instructors</a></li>
            <li class="navbar-item" > <a href="logout.php" class="nav-link  active">LOG IN <img src="log.webp" alt="loging"  style="opacity: 0.5; width: 25px; height: 25px;"></a></li>
        </ul>


    </nav>

    <div class="container" >
        <div class="row">
            <div class="col-md-8">
                <h1 style="color: aliceblue;">Student Registration System</h1>
                <p></p>
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

            <div class="col-md-6">
                <form action="" onsubmit= "return formValidate()" method="post"  style="border: 3px ; background-color: black; border-radius: 5px;opacity: 0.8;text-align: center;">
                   <hr>
                   

                   <img src="log.webp" alt="" width="70px" height="70px">
                   <h1 style="color: aliceblue;">Reset Password</h1>
                   <h3 style="color: aliceblue;">Enter Your User-name and PassWord</h3>

                   <hr>
                   <div class="row">
                   <div class="col-md-4"><label for="" style="color: aliceblue;">User Name   </label>  </div>
                   <div class="col-md-4"><input type="text" id="userName" name="un" required> <br></div>
                   </div>
                    
                   <hr>
                   <div class="row"> 
                   <div class="col-md-4"><label for="" style="color: aliceblue;">Previous PassWord</label> </div>
                   <div class="col-md-4"><input type="password" id="passWord1" name="pw" required> <br>  </div>
                   
                
               
                   

                   </div>
                   <small id='demo' style="color:red;"><?php echo $errormsg; ?></small>
                    

                    <hr>
                    <div class="row"> 
                   <div class="col-md-4"><label for="" style="color: aliceblue;">New PassWord</label>  </div>
                   <div class="col-md-4"><input type="password" id="passWord2" name="pw2" required> <br> </div>
                   <small id='demo' style="color:white;"><?php echo $successmsg; ?></small>

    </div>
        
                
                    

                    <hr>
        
                    
                    <input type="reset" value="cancel" class="btn btn-danger">
                    <!--<button type="Submit" class="btn btn-dark">Reset Password</button> -->
                    <input type="Submit" name="reset"  class="btn btn-dark">
                    
                    
                    
                    
        
        
                </form>
            </div>
        </div>


    </div>
 
 
        

</body>
</html>





