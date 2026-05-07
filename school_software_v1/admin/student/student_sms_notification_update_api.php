<?php include("../attachment/session.php");
$student_index=$_POST['student_index'];
$student_roll_no=$_POST['student_roll_no'];
$student_web_sms=$_POST['student_web_sms'];
$count1=count($student_index);

for($i=0;$i<$count1;$i++){
$index11=$student_index[$i];

 $query="update student_admission_info set student_web_sms='$student_web_sms[$index11]',$update_by_update_sql  where student_roll_no='$student_roll_no[$index11]' and session_value='$session1'";
mysqli_query($conn73,$query);
}
echo "|?|success|?|";
?>
