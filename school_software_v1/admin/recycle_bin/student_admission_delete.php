<?php include("../attachment/session.php"); ?> 

<?php 

$delete_record=$_GET['id'];

$query="delete from student_admission_info where student_roll_no='$delete_record' and session_value='$session1'";

if(mysqli_query($conn73,$query)){

     echo "|?|success|?|";
}
?>