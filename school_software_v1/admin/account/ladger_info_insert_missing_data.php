<?php 
include('../attachment/session.php');
$count=0;
$sql = "select * from ledger_info_NEW1";
$result=mysqli_query($conn73,$sql) or die();
while($row=mysqli_fetch_assoc($result)){
  $emp_or_student_name = $row['emp_or_student_name'];
  $emp_id_or_student_roll_no =$row['emp_id_or_student_roll_no'];
  $date =$row['date'];
  $session_Value =$row['session_Value'];
  $total_amount =$row['total_amount'];

$sql1 = "INSERT INTO ledger_info_final(`emp_or_student_name`,`emp_id_or_student_roll_no`,`date`,`session_Value`,`total_amount`,`amount_type`,`payment_mode`,`credit_or_debit_from`,`ledger_status`)VALUES('$emp_or_student_name','$emp_id_or_student_roll_no','$date','$session_Value','$total_amount','Credit','Cash','Registration fee','Active')";
$result1=mysqli_query($conn73,$sql1) or die(); 
$count++;
}
if($result1)
 {
 echo "success".$count;
 }
?>