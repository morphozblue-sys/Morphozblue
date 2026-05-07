<?php
include("../attachment/session.php");
include("../../con73/con37.php");
$challan_no=$_GET['challan_no'];
$quer11111="delete from student_hostel_fees_paid where challan_no='$challan_no'";
if(mysqli_query($conn73,$quer11111)){
header('location:student_hostel_fee_challan_list.php');
}
?>