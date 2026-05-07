<?php
include("../attachment/session.php");

$restore_record=$_GET['id'];

$query="update employee_info set emp_status='Active',$update_by_update_sql  where emp_id='$restore_record' and session_value='$session1'";

if(mysqli_query($conn73,$query)){

	echo "|?|success|?|";
}
?>
