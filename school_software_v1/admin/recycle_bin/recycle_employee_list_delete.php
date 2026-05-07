<?php
include("../attachment/session.php"); 
$delete_record=$_GET['id'];

$query="delete from employee_info where emp_id='$delete_record' and session_value='$session1'";

if(mysqli_query($conn73,$query)){

	echo "|?|success|?|";
}
?>