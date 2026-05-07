<?php
include("../attachment/session.php");
error_reporting(E_ALL & ~E_NOTICE);
?>
<?php include("../../con73/con37.php"); ?>
<?php
$s_no=$_GET['s_no'];
$query="delete from hostel_due_date_schedule where s_no='$s_no'";
if(mysqli_query($conn73,$query)){
echo "<script>window.open('set_hostel_due_date_schedule.php','_self');</script>";
}
?>