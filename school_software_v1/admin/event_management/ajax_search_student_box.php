<?php
include("../attachment/session.php");
$roll=$_GET['id'];

$que="select `school_info_school_name` from school_info_general";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
$school_info_school_name = $row['school_info_school_name'];
}

$que15="select * from student_admission_info where student_roll_no='$roll' and session_value='$session1'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row15=mysqli_fetch_assoc($run15)){
	   $student_name=$row15['student_name'];
	   $student_class_section=$row15['student_class_section'];
	   $student_class=$row15['student_class']."(".$student_class_section.")";
	   $student_father_name=$row15['student_father_name'];
	   $student_father_contact_number=$row15['student_father_contact_number'];
	   $student_gender=$row15['student_gender'];
	   $student_date_of_birth=$row15['student_date_of_birth'];
	   $student_category=$row15['student_category'];
	   $student_roll_no=$row15['student_roll_no'];
	   $session_value=$row15['session_value'];
	   $student_adhar_number=$row15['student_adhar_number'];
	   $student_scholar_number=$row15['student_scholar_number'];
	   $student_admission_number=$row15['student_admission_number'];
	   $company_name=$row15['company_name'];
	   $student_mother_name=$row15['student_mother_name'];
	   $house_name=$row15['house_name'];
	}

    if(mysqli_num_rows($run15)>0){
    $num=1;	
	echo $student_name."|?|".$student_class."|?|".$student_class_section."|?|".$student_father_name."|?|".$student_father_contact_number."|?|".$student_gender."|?|".$student_date_of_birth."|?|".$student_category."|?|".$student_roll_no."|?|".$session_value."|?|".$student_adhar_number."|?|".$student_admission_number."|?|".$student_scholar_number."|?|".$company_name."|?|".$student_mother_name."|?|".$house_name."|?|".$school_info_school_name."|?|".$num;
	}
?>