<?php include("../attachment/session.php");
error_reporting(E_ALL & ~E_NOTICE);
include("../../con73/con37.php");
?>
<option value="All">All Student</option>
<?php
$student_class=$_GET['student_class'];
if($student_class!='All'){
$student_class1=explode("|?|",$student_class);
$class_code=$student_class1[0];
$student_class=$student_class1[1];
$condition1=" and student_class='$student_class'";
}else{
$condition1="";
}
$student_category=$_GET['student_category'];
if($student_category!='All'){
$student_category1=explode("|?|",$student_category);
$category_code=$student_category1[0];
$category_name=$student_category1[1];
$condition2=" and student_fee_category_code='$category_code'";
}else{
$condition2="";
}

$query1="select * from student_admission_info where student_status='Active' and registration_final='yes' and student_hostel='Yes' and session_value='$session1'$condition1$condition2";
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$student_name=$row1['student_name'];
$student_roll_no=$row1['student_roll_no'];
$student_class11=$row1['student_class'];
$student_class_section11=$row1['student_class_section'];
$student_admission_number11=$row1['student_admission_number'];
?>
<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name.'['.$student_class11.' '.$student_class_section11.']['.$student_admission_number11.']'; ?></option>
<?php } ?>