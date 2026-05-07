<?php

 include("../attachment/session.php");
 $other_student_name=$_POST['other_student_name'];
 $other_student_father_name=$_POST['other_student_father_name'];
 $other_student_roll_no=$_POST['other_student_roll_no'];
 $other_school_name=$_POST['other_school_name'];
 $student_position=$_POST['student_position'];
 $other_certificate_type=$_POST['other_certificate_type'];
 $other_certificate_name=$_POST['other_certificate_name'];
 
$query="insert into other_certificate(other_student_name,other_student_father_name,other_student_roll_no,other_school_name,student_position,other_certificate_name,other_certificate_type ,session_value,$update_by_insert_sql_column)values('$other_student_name','$other_student_father_name','$other_student_roll_no','$other_school_name',' $student_position','$other_certificate_name','$other_certificate_type','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";

}
 
