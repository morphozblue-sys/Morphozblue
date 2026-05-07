<?php include("../attachment/session.php");
 $student_roll_no=$_GET['student_roll_no'];
 $student_status=$_GET['student_status'];
 
echo $query="update student_admission_info set student_status='$student_status',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";

if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>