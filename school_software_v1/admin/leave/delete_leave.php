<?php include("../attachment/session.php"); ?>
<?php
$delete_record=$_GET['id'];

$query="delete from student_leave_management where s_no='$delete_record'";

if(mysqli_query($conn73,$query)){

	echo "|?|success|?|";
}
?>
