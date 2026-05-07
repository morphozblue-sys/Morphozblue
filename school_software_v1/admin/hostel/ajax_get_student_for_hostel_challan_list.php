<?php include("../attachment/session.php");

error_reporting(E_ALL & ~E_NOTICE);
include("../../con73/con37.php");
$student_class=$_GET['student_class'];
$student_section=$_GET['student_section'];
$category_code=$_GET['category_code'];

if($student_class=='All'){
$condition="";
}else{
$condition=" and student_class='$student_class'";
}

if($student_section=='All'){
$condition1="";
}else{
$condition1=" and student_class_section='$student_section'";
}

if($category_code=='All'){
$condition2="";
}else{
$condition2=" and student_fee_category_code='$category_code'";
}

?>
<option value="">Select Student</option>
<?php
$query1="select * from student_admission_info where student_status='Active' and registration_final='yes' and student_hostel='Yes' and session_value='$session1'$condition$condition1$condition2";
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$student_name=$row1['student_name'];
$student_roll_no=$row1['student_roll_no'];
$student_class11=$row1['student_class'];
$student_class_section11=$row1['student_class_section'];
$student_admission_number11=$row1['student_admission_number'];
?>
<option <?php if(isset($_GET['student_roll_no'])){ if($_GET['student_roll_no']==$student_roll_no){ echo 'selected'; } } ?> value="<?php echo $student_roll_no; ?>"><?php echo $student_name.'['.$student_class11.' '.$student_class_section11.']['.$student_admission_number11.']'; ?></option>
<?php } ?>