<?php
include("../attachment/session.php");
$rejoin_record=$_GET['id'];
$date = date('Y-m-d');
$query="update employee_info set emp_status='Active',emp_doj='$date',$update_by_update_sql where s_no='$rejoin_record'";

if(mysqli_query($conn73,$query)){
	echo "|?|success|?|";
}
?>