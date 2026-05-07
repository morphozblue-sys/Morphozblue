<?php
 include("../attachment/session.php");

$delete_record=$_GET['s_no'];
$query="update hostel_fee_details set fee_status='Deleted' where s_no='$delete_record'";

if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>