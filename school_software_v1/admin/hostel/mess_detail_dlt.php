<?php

include("../attachment/session.php");
$delete_record=$_GET['id'];
$query="update hostel_mess_daily_purchase set hostel_mess_status='Deleted' where s_no='$delete_record'";

if(mysqli_query($conn73,$query)){

	echo "|?|success|?|";
}
?>