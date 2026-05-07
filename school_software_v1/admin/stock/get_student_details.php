<?php
include("../attachment/session.php");
$id=$_GET['id'];


$qry="select * from student_admission_info where s_no='$id' and session_value='$session1' ";

$result=mysqli_query($conn73,$qry) or die(mysqli_error($conn73));

while($row=mysqli_fetch_assoc($result)){



$s_no=$row['s_no'];
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_class=$row['student_class'];
$student_roll_no=$row['student_roll_no'];





echo $student_father_name."|?|".$student_class."|?|".$student_roll_no;

}

?>