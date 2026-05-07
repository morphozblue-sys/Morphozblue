<?php
include("../attachment/session.php");

$delete_record=$_GET['id'];

$query="delete from account_expence_info where s_no='$delete_record' and session_value='$session1'";

if(mysqli_query($conn73,$query)){

	echo "|?|success|?|";
}
?>