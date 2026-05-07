<?php include("../attachment/session.php"); ?>
<?php


 echo	$que2="select * from student_admission_info where  session_value='2022_23'";
    $run2=mysqli_query($conn73,$que2);
    while($row2=mysqli_fetch_assoc($run2)){

 echo   $student_roll_no=$row2['student_roll_no'];

	
	$student_image=$row2['student_image_name'];
	$student_father_image=$row2['student_father_image_name'];
	$student_mother_image=$row2['student_mother_image_name'];
	$student_guardian_image=$row2['student_guardian_image_name'];
	$student_tc_image=$row2['student_tc_image_name'];
	$student_last_marksheet_image=$row2['student_last_marksheet_image_name'];
	$student_income_certificate_image=$row2['student_income_certificate_image_name'];
	$student_cast_certificate_image=$row2['student_cast_certificate_image_name'];
	$student_dob_image=$row2['student_dob_image_name'];
	$student_adhar_card_image=$row2['student_adhar_card_image_name'];
	$student_sssmid_image=$row2['student_sssmid_image_name'];
	$student_other_document1_image=$row2['student_other_document1_image_name'];
	$student_other_document2_image=$row2['student_other_document2_image_name'];

	
echo $que1="update student_admission_info set 	
	student_image_name='$student_image',student_father_image_name='$student_father_image',student_mother_image_name='$student_mother_image',student_guardian_image_name='$student_guardian_image',student_tc_image_name='$student_tc_image',student_last_marksheet_image_name='$student_last_marksheet_image',student_income_certificate_image_name='$student_income_certificate_image',student_cast_certificate_image_name='$student_cast_certificate_image',student_dob_image_name='$student_dob_image',student_adhar_card_image_name='$student_adhar_card_image' where student_roll_no='$student_roll_no' and session_value='2023_24'";
 mysqli_query($conn73,$que1);
 }
 
 
echo "|?|success|?|".$already_inserted_student."|?|";
?>