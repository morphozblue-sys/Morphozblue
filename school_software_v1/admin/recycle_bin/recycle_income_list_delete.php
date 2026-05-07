<?php
include("../../con73/con37.php");
include("../attachment/session.php");

$delete_record=$_GET['id'];

$query="delete from account_income_info where s_no='$delete_record' AND session_value='$session1'";

if(mysqli_query($conn73,$query)){

	echo "<script>window.open('recycle_income_list.php','_self')</script>";
}
?>