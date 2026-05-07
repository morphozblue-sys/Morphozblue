<?php include("../attachment/session.php");
 $caste_student_name=$_POST['caste_student_name'];
 $caste_student_father_name=$_POST['caste_student_father_name'];
 $caste_student_roll_no=$_POST['caste_student_roll_no'];
 $caste_school_name=$_POST['caste_school_name'];
 $caste_type=$_POST['caste_type'];
 $caste_category=$_POST['caste_category'];

$query="insert into caste_certificate(caste_student_name,caste_student_father_name,caste_school_name,caste_type,caste_category,caste_student_roll_no,session_value,$update_by_insert_sql_column) values('$caste_student_name','$caste_student_father_name','$caste_school_name','$caste_type','$caste_category','$caste_student_roll_no','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
 
