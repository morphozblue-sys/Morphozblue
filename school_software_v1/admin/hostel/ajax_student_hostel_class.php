<?php include("../attachment/session.php"); ?>
<?php
$student_roll_no=$_GET['student_roll_no'];
include("../../con73/con37.php");
$que15="select * from student_admission_info where student_roll_no='$student_roll_no' and student_status='Active' and registration_final='yes' and student_hostel='Yes' and session_value='$session1'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
while($row15=mysqli_fetch_assoc($run15)){
	$student_class_section=$row15['student_class_section'];
	$student_class=$row15['student_class'];
	$student_fee_category=$row15['student_fee_category'];
	$student_fee_category_code=$row15['student_fee_category_code'];
	
$que16="select * from school_info_class_info where class_name='$student_class'";
$run16=mysqli_query($conn73,$que16) or die(mysqli_error($conn73));
while($row16=mysqli_fetch_assoc($run16)){
	$class_code=$row16['class_code'];
	}
	}
	echo $class_code.'|?|'.$student_class.'|?|'.$student_fee_category.'|?|'.$student_fee_category_code;
	?>