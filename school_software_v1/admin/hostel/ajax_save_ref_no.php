<?php include("../attachment/session.php"); ?>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
?>
<?php
include("../../con73/con37.php");
$result=0;
$last_ref_no=$_GET['last_ref_no'];
echo $quer11="update login set ref_no_$session1='$last_ref_no'";
if(mysqli_query($conn73,$quer11)){
$result++;
}
echo $result;
?>