<?php include("../attachment/session.php");

 $student_roll_no=$_POST['student_roll_no'];
 $student_bus_no=$_POST['student_bus_no'];
 $student_bus_route=$_POST['student_bus_route'];

$count1=count($student_roll_no);
$result=0;
for($i=0;$i<$count1;$i++){
$quer="update student_admission_info set student_bus_no='$student_bus_no[$i]',student_bus_route='$student_bus_route[$i]',$update_by_update_sql  where student_roll_no='$student_roll_no[$i]' and session_value='$session1'";
if(mysqli_query($conn73,$quer)){
$result++;
}
}
if($result>0){
echo "|?|success|?|";
}
?>