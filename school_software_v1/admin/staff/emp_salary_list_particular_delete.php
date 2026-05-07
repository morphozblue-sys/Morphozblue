<?php 
include("../attachment/session.php");

$delete_record=$_GET['id'];
$emp_id=$_GET['emp_id'];
$salary_date=$_GET['date'];
$total_pay=$_GET['amount'];

$advance_id=$_GET['advance_id'];
$advance_amount=$_GET['advance_amount'];
if($advance_id!=''){
$query00="select advance_amount_balance from account_expence_info where s_no='$advance_id' and other_or_advance='Advance' and account_status='Active' and session_value='$session1'";
$res00=mysqli_query($conn73,$query00) or die(mysqli_error($conn73));
while($row00=mysqli_fetch_assoc($res00)){
$advance_amount_balance=$row00['advance_amount_balance'];
}
$advance_amount_balance1=$advance_amount_balance+$advance_amount;
$query000="update account_expence_info set advance_amount_balance='$advance_amount_balance1' where s_no='$advance_id' and other_or_advance='Advance' and account_status='Active' and session_value='$session1'";
$res000=mysqli_query($conn73,$query000);
}

$query="update employee_salary_generate set employee_salary_status='Deleted',$update_by_update_sql  where s_no='$delete_record'";

$query1="update ledger_info set ledger_status='Deleted',$update_by_update_sql  where emp_id_or_student_roll_no='$emp_id' and date='$salary_date' and total_amount='$total_pay'";
mysqli_query($conn73,$query1);

if(mysqli_query($conn73,$query)){

    	echo "|?|success|?|emp_id=".$emp_id."|?|";
}
?>