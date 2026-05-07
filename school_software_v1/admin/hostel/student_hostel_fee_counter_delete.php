<?php
include("../attachment/session.php");
error_reporting(E_ALL & ~E_NOTICE);
include("../../con73/con37.php");
$s_no=$_GET['s_no'];
$quer11="delete from student_hostel_fees_counter where s_no='$s_no'";
if(mysqli_query($conn73,$quer11)){
header('location:student_hostel_fee_counter_list.php');
}
?>