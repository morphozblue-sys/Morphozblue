<?php include("../attachment/session.php");
 $student_student_name=$_POST['student_student_name'];
 $student_student_father_name=$_POST['student_student_father_name'];
 $student_student_roll_no=$_POST['student_student_roll_no'];
 $student_school_name=$_POST['student_school_name'];
 $student_certificate_no=$_POST['student_certificate_no'];
 $student_certificate_date=$_POST['student_certificate_date'];
// $student_type=$_POST['student_type'];
// $student_category=$_POST['student_category'];

$query="select * from student_certificate where student_student_roll_no='$student_student_roll_no' and session_value='$session1' ";
$data=mysqli_query($conn73,$query);
if(mysqli_num_rows($data)>0)
{
    echo "|?|exist|?|"; 
}
else
{
    $query="insert into student_certificate(student_student_name,student_student_father_name,student_school_name,student_type,blank_field_1,blank_field_2,student_category,student_certificate_no,student_certificate_date,student_student_roll_no,session_value,$update_by_insert_sql_column) values('$student_student_name','$student_student_father_name','$student_school_name','$student_type','$blank_field_1','$blank_field_2','$student_category','$student_certificate_no','$student_certificate_date','$student_student_roll_no','$session1',$update_by_insert_sql_value)";
    if(mysqli_query($conn73,$query)){
    echo "|?|success|?|";
    }
} 
?>