<?php
include("../attachment/session.php");
$drop_record=$_GET['id'];
$date = date('Y-m-d');
$query="update employee_info set emp_status='Drop',emp_drop_date='$date',$update_by_update_sql where s_no='$drop_record'";

if(mysqli_query($conn73,$query)){
	echo "|?|success|?|";
}
?>