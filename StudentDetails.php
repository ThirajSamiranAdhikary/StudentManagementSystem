<?php 

//To get the student personal details
$conn = mysqlI_connect('localhost','root','','studentregistration');
$uName = 'MIT-2022-001';

$sql_1 = "SELECT FirstName, LastName, Address, Tel, DOB, Email, CourseName FROM `user`INNER JOIN course 
	ON user.CourseID = course.CourseID WHERE UserName = '$uName' ";

$result_1 = mysqli_query($conn, $sql_1);

if($result_1 == false){
	echo mysqli_error($conn);
	exit;
}else{
	$studentDetails = mysqli_fetch_row($result_1);
	$fName = $studentDetails[0];
	$lName = $studentDetails[1];
	$address = $studentDetails[2];
	$tel = $studentDetails[3];
	$dob = $studentDetails[4];
	$email = $studentDetails[5];
	$courseName = $studentDetails[6];

	echo $email;
}


//To get student marks

$sql_2 = "SELECT Mark, SubjectName, Credits FROM `student_subject` INNER JOIN subject 
	ON student_subject.SubjectID = subject.SubjectID WHERE StudentID = '$uName' "; 


$result_2 = mysqli_query($conn, $sql_2);
$marks = array();

if($result_2 == false){
	echo mysqli_error($conn);
	exit;
}else{
	if (mysqli_num_rows($result_2) > 0) {
	
    	while($row = mysqli_fetch_assoc($result_2)) {
        $temp = [
		   "Subject"=>$row["SubjectName"],
		   "Mark"=>$row["Mark"],
		   "Credits"=>$row["Credits"],
		];
	array_push($marks,$temp);
	
    }
} else {
    echo "0 results";
}

}

echo json_encode($marks);





?>