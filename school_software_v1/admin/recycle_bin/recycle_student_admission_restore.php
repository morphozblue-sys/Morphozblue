<?php 
include("../attachment/session.php"); 
$restore_record=$_GET['id'];
$query="update student_admission_info set student_status='Active',$update_by_update_sql  where student_roll_no='$restore_record' and session_value='$session1'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>