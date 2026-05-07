<?php
include("../attachment/session.php");
$qry="select * from student_tc where student_tc_status='Active' and session_value='$session1' order by s_no DESC";
$rest=mysqli_query($conn73,$qry);
$s=0;
while($row22=mysqli_fetch_assoc($rest)){
$tc_student_roll_no=$row22['tc_student_roll_no'];
$que1="update student_admission_info set student_status='Tc_issued',$update_by_update_sql  where student_roll_no='$tc_student_roll_no' and session_value='$session1'";
mysqli_query($conn73,$que1);
echo $s++;
}
?>