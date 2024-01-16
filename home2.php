<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home 2</title>
</head>
<body>
    <h1>LogIN</h1>

    <form action="" method="post">
        Name <br>
        <input type="text" name="un" class="text" required>
        <br>

        Password <br>
        <input type="password" name="pw" class="text" required> <br>

        <br>
        <input type="Submit" name="submit">
    </form>
</body>
</html>

<?php
$con = mysqlI_connect('localhost','root','','studentregistration');

if(isset($_POST['submit'])){

    $un=$_POST["un"];
    $pw=$_POST["pw"];
    $sql = "select Password from user where UserName='$un' limit=1";
    $re=mysqli_query($con,$sql);

    if(mysqli_num_rows($re)==1){
        $row=mysqli_fetch_assoc($re);

        if($row["Password"]==$pw){
            header("location:dashboard.html");
            exit();

        }
        else
        echo "<script> alert(Invalid Password) </script>";
    }
    else
    echo"<script> alert(Invalid User Name)</script>";


}

?>