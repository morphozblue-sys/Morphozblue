<?php 
include("../attachment/session.php");
$sql=mysqli_query($conn73,"SELECT * FROM student_admission_info WHERE session_value='2018_19'");
while($res=mysqli_fetch_assoc($sql)){
	$student_roll_no=$res['student_roll_no'];
	$student_identity_category=$res['student_identity_category'];
	$update=mysqli_query($conn73,"update student_admission_info set student_identity_category='$student_identity_category' where student_roll_no='$student_roll_no' and session_value='2019_20'");
}
   if($update){
       echo "<script>alert('Success');</script>";
   }else{
       echo "<script>alert('Error');</script>";
   }
?>