<?php include("../attachment/session.php");
 $delete_record=$_GET['id'];
 $student_admission_date=$_GET['date'];
 $student_registration_fee=$_GET['amount'];
$query2="update student_admission_info set student_status='Deleted',$update_by_update_sql  where student_roll_no='$delete_record' and session_value='$session1'";
if(mysqli_query($conn73,$query2)){
$query1="update ledger_info set ledger_status='Deleted',$update_by_update_sql  where emp_id_or_student_roll_no='$delete_record' and date='$student_admission_date' and total_amount='$student_registration_fee'and session_value='$session1'";
mysqli_query($conn73,$query1);
echo "|?|success|?|";
}
?>