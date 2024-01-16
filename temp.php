<?php
session_start();
if(isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Admin"){

    


<?php
session_start();
if(isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Student"){

<?php
}
else{
  header("location:home.php");
}
?>