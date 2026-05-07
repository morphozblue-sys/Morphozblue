<?php include("../attachment/session.php");
$student_index=$_POST['student_index'];
$donation=$_POST['donation'];
$donar_name=$_POST['donar_name'];
$student_roll_no=$_POST['student_roll_no'];
$count1=count($student_index);

for($i=0;$i<$count1;$i++){
$index11=$student_index[$i];
$query="update student_admission_info set donation='$donation[$index11]',donar_name='$donar_name[$index11]',$update_by_update_sql  where student_roll_no='$student_roll_no[$index11]' and session_value='$session1'";
mysqli_query($conn73,$query);
}
echo "|?|success|?|";
?>
