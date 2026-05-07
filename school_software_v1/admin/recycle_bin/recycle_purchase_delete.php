<?php
include("../attachment/session.php");

$delete_record=$_GET['id'];

$query="delete from hostel_stock_purchase where s_no='$delete_record' and session_value='$session1'";

if(mysqli_query($conn73,$query)){

	echo "|?|success|?|";
}
?>