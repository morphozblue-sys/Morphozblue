<?php
include("../attachment/session.php");

$restore_record=$_GET['id'];

$query="update hostel_stock_purchase set purchase_status='Active',$update_by_update_sql  where s_no='$restore_record' and session_value='$session1'";

if(mysqli_query($conn73,$query)){

	echo "|?|success|?|";
}
?>