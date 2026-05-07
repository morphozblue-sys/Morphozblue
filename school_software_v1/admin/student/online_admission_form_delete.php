<?php include("../attachment/session.php");
$delete_record=$_GET['s_no'];
$query="update student_admission_info_website set status='Deleted' where s_no='$delete_record'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>