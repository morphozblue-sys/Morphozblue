<?php
include("../attachment/session.php");
		function Get_Date_Difference($start_date, $end_date)
		{
		$diff = abs(strtotime($end_date) - strtotime($start_date));
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		$inword = $years.' Years '.$months.' Month '.$days.' Days';
		return $inword;
		}
		
		function Get_Date_Difference1($start_date, $end_date)
		{
		$diff = abs(strtotime($end_date) - strtotime($start_date));
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		$inc_var=0;
		if($months>0 || $days>0){
		$inc_var=1;
		}
		$inword = $years+$inc_var;
		$inword1 = "Under ".$inword." Year";
		return $inword1;
		}




$roll=$_GET['id'];
$que15="select * from student_admission_info where student_roll_no='$roll' and session_value='$session1'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row15=mysqli_fetch_assoc($run15)){

	   $student_name=$row15['student_name'];
	   $student_class_section=$row15['student_class_section'];
	   $student_class=$row15['student_class'];
	   $student_father_name=$row15['student_father_name'];
	   $student_father_contact_number=$row15['student_father_contact_number'];
	   $student_gender=$row15['student_gender'];
	   $student_date_of_birth=$row15['student_date_of_birth'];
	   $student_category=$row15['student_category'];
	   $student_roll_no=$row15['student_roll_no'];
	   $session_value=$row15['session_value'];
	   $student_photo=$row15['student_photo'];
	   $student_adhar_number=$row15['student_adhar_number'];
	   $student_scholar_number=$row15['student_scholar_number'];
	   $student_admission_number=$row15['student_admission_number'];
	   $company_name=$row15['company_name'];
	   $student_mother_name=$row15['student_mother_name'];
	   $student_dob_certificate=$row15['student_dob_certificate'];
	} 
    if(mysqli_num_rows($run15)>0){
	$enddate=date('Y-m-d');
	$words = Get_Date_Difference($student_date_of_birth,$enddate);	
	$words1 = Get_Date_Difference1($student_date_of_birth,$enddate);	
    $num=1;	
	echo $student_name."|?|".$student_class."|?|".$student_class_section."|?|".$student_father_name."|?|".$student_father_contact_number."|?|".$student_gender."|?|".$student_date_of_birth."|?|".$student_category."|?|".$student_roll_no."|?|".$session_value."|?|".$student_photo."|?|".$student_adhar_number."|?|".$student_admission_number."|?|".$student_scholar_number."|?|".$company_name."|?|".$student_mother_name."|?|".$words."|?|".$words1."|?|".$student_dob_certificate."|?|".$num;
	}
?>