<?php
include("../../con73/con37.php");

$delete_record=$_GET['id'];

$query="delete from event_result where s_no='$delete_record'";

if(mysqli_query($conn73,$query)){

	echo "<script>window.open('event_result_list.php','_self')</script>";
}
?>