<?php include("../attachment/session.php")?>
<?php
$delete_record=$_GET['id'];
$roll_no=$_GET['roll_no'];
$query="delete from student_tc where s_no='$delete_record'";
if(mysqli_query($conn73,$query)){
$que1="update student_admission_info set student_status='Active',$update_by_update_sql  where student_roll_no='$roll_no' and session_value='$session1'";
mysqli_query($conn73,$que1);
echo "|?|success|?|";
}
?>
