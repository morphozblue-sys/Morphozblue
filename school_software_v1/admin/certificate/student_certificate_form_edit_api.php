<?php include("../attachment/session.php");

$s_no=$_POST['s_no'];
$student_student_name=$_POST['student_student_name'];
$student_student_father_name=$_POST['student_student_father_name'];
$student_student_roll_no=$_POST['student_student_roll_no'];
$student_school_name=$_POST['student_school_name'];
$student_certificate_no=$_POST['student_certificate_no'];
$student_certificate_date=$_POST['student_certificate_date'];
//$caste_type=$_POST['caste_type'];
//$caste_category=$_POST['caste_category'];
 
$query="update student_certificate set student_student_name='$student_student_name',student_student_father_name='$student_student_father_name',student_certificate_no='$student_certificate_no',student_certificate_date='$student_certificate_date',student_school_name='$student_school_name',$update_by_update_sql  where s_no='$s_no'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>

	