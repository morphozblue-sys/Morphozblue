<?php include("../attachment/session.php");
$password = $_POST['password'];
$unique_id = $_POST['unique_id'];
$student_class = $_POST['student_class'];
$student_serial_no = $_POST['student_serial_no'];
$count1=count($student_serial_no);
for($i=0;$i<$count1;$i++) {
$quer="update student_admission_info set student_password='$password[$i]',$update_by_update_sql  where student_roll_no='$unique_id[$i]'";
mysqli_query($conn73,$quer);
}
 echo "|?|success|?|";

?>
