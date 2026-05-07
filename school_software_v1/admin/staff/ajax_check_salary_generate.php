<?php include("../attachment/session.php"); ?>
<?php
$staff_id=$_GET['staff_id'];
if($staff_id!=''){
$staff_condition=" and emp_id='$staff_id'";
}else{
$staff_condition="";
}

$salary_from=$_GET['salary_from'];
if($salary_from!=''){
$particular_month = explode('-',$salary_from);
$particular_month1 = '-'.$particular_month[1].'-';
$particular_month_condition=" and employee_salary_date_from LIKE '%$particular_month1%'";
}else{
$particular_month_condition='';
}

$query="select s_no from employee_salary_generate where employee_salary_status='Active' and session_value='$session1'$staff_condition$particular_month_condition";
$result=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
$num=mysqli_num_rows($result);

echo '|?|'.$num.'|?|';
?>