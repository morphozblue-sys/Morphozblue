<?php include("../attachment/session.php");
$student_index=$_POST['student_index'];
$student_roll_no=$_POST['student_roll_no'];
$student_father_contact_number=$_POST['student_father_contact_number'];
$student_sms_contact_number=$_POST['student_sms_contact_number'];
$count1=count($student_index);

for($i=0;$i<$count1;$i++){
$index11=$student_index[$i];

 $query="update student_admission_info set student_father_contact_number='$student_father_contact_number[$index11]',student_sms_contact_number='$student_sms_contact_number[$index11]',$update_by_update_sql  where student_roll_no='$student_roll_no[$index11]' and session_value='$session1'";
mysqli_query($conn73,$query);
}
echo "|?|success|?|";
?>
