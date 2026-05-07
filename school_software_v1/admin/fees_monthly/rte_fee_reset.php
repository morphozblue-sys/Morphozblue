<?php
include("../attachment/session.php");

$query="select * from student_admission_info where session_value='2019_20' and student_status='Active' and student_admission_scheme='RTE'";
$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($res)){
$student_roll_no=$row['student_roll_no'];

$query1="update common_fees_student_fee set fee_status='Deactive' where student_roll_no='$student_roll_no' and session_value='2019_20' and student_status='Active'";
mysqli_query($conn73,$query1);

$query2="update common_fees_student_fee_add set fee_status='Deactive' where student_roll_no='$student_roll_no' and session_value='2019_20' and student_status='Active'";
mysqli_query($conn73,$query2);

$query3="update ledger_info set ledger_status='Deactive' where emp_id_or_student_roll_no='$student_roll_no' and session_value='2019_20' and ledger_status='Active'";
mysqli_query($conn73,$query3);

}
?>