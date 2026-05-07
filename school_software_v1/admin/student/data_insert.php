<?php  
include("../attachment/session.php");
$query = "select * from student_admission_info_new1 where s_no>271 ORDER BY s_no";
$student_id_generate=272;
$student_roll_no=1900272;
$res = mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($res)){
$s_no=$row['s_no'];

$query1 = "update student_admission_info_new1 set student_id_generate='$student_id_generate', student_roll_no='$student_roll_no' where s_no='$s_no'";
if(mysqli_query($conn73,$query1)){
$student_id_generate++;
$student_roll_no++;
echo "successfully updated";
}
}
?>