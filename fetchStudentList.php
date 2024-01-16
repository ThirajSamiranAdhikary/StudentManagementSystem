<?php
$conn = mysqli_connect('localhost','root','','studentregistration');

$sql = "SELECT FirstName, LastName, UserName, Tel, Email FROM user WHERE UserType='Student';";

$result = mysqli_query($conn, $sql);
//$name ="HHHHH";
$students = array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $temp = [
		            "FirstName"=>$row["FirstName"],
		            "LastName"=>$row["LastName"],
		            "UserName"=>$row["UserName"],
		            "Tel"=>$row["Tel"],
		            "Email"=>$row["Email"],
		            ];
	array_push($students,$temp);
    }
} else {
    echo "0 results";
}



?>
