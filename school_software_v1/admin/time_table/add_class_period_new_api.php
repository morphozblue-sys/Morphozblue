<?php include("../attachment/session.php"); ?>
<?php

$period_name=$_POST['period_name'];
$period_start_time=$_POST['period_start_time'];
$period_end_time=$_POST['period_end_time'];
$period_code_hidden=$_POST['period_code_hidden'];

$quer12="update school_info_class_period_new set period_name='$period_name',period_start_time='$period_start_time',period_end_time='$period_end_time' where s_no='$period_code_hidden'";
if(mysqli_query($conn73,$quer12)){
echo "|?|success|?|";
}
?>