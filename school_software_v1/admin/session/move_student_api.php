<?php include("../attachment/session.php"); ?>
<?php
// $move_student_to=$_POST['move_student_to']; 
$move_student_from=$_POST['move_student_from']; 
//$move_student_from_name=$_POST['move_student_from_name']; 
 $from_session=$_POST['from_session']; 
 $to_session=$_POST['to_session']; 
$to_class=$_POST['to_class']; 
$to_section=$_POST['to_section']; 
$student_class_stream_to=$_POST['student_class_stream_to']; 
$student_class_group_to=$_POST['student_class_group_to']; 
$to_student_medium=$_POST['to_student_medium']; 
$to_student_board=$_POST['to_student_board']; 
$to_student_shift=$_POST['to_student_shift']; 
$count_from=count($move_student_from);
$already_inserted_student='';
for($d=0;$d<$count_from;$d++){
$que4="select * from student_admission_info where student_roll_no='$move_student_from[$d]' and session_value='$to_session'";
    $run3=mysqli_query($conn73,$que4);
	if(mysqli_num_rows($run3)>0){
	$already_inserted_student=$already_inserted_student.','.$_POST[$move_student_from[$d]];
	}else{
 	$que2="select * from student_admission_info where student_roll_no='$move_student_from[$d]' and session_value='$from_session'";
    $run2=mysqli_query($conn73,$que2);
    while($row2=mysqli_fetch_assoc($run2)){

    $student_name=$row2['student_name'];
	$student_father_name=$row2['student_father_name'];
	$student_mother_name=$row2['student_mother_name'];
	$student_class=$row2['student_class'];
	$student_class_stream=$row2['student_class_stream'];
	$student_class_group=$row2['student_class_group'];
	$student_date_of_birth=$row2['student_date_of_birth'];
	$student_gender=$row2['student_gender'];
	$student_handicapped=$row2['student_handicapped'];
	$student_religion=$row2['student_religion'];
	$student_category=$row2['student_category'];
	$student_rf_id_number=$row2['student_rf_id_number'];
	$student_adhar_number=$row2['student_adhar_number'];
	$student_father_adhar_card_number=$row2['student_father_adhar_card_number'];
	$student_sssmid_number=$row2['student_sssmid_number'];
	$student_family_id=$row2['student_family_id'];
	$student_child_id=$row2['student_child_id'];
	$student_father_bank_name=$row2['student_father_bank_name'];
	$student_father_bank_account_number=$row2['student_father_bank_account_number'];
	$student_father_bank_ifsc_code=$row2['student_father_bank_ifsc_code'];
	$student_bank_name=$row2['student_bank_name'];
	$student_account_number=$row2['student_account_number'];
	$student_bank_ifsc_code=$row2['student_bank_ifsc_code'];
	$student_admission_type=$row2['student_admission_type'];
	$student_admission_scheme=$row2['student_admission_scheme'];
	$stuent_old_or_new=$row2['stuent_old_or_new'];
	$student_medium=$row2['student_medium'];
	$student_date_of_admission=$row2['student_date_of_admission'];
	$student_date_of_birth_in_word=$row2['student_date_of_birth_in_word'];
	$student_previous_class=$row2['student_previous_class'];
	$student_previous_school_name=$row2['student_previous_school_name'];
	$student_admission_scheme=$row2['student_admission_scheme'];
	$student_sibling_name_1=$row2['student_sibling_name_1'];
	$student_sibling_unique_id_1=$row2['student_sibling_unique_id_1'];
	$student_sibling_name_2=$row2['student_sibling_name_2'];
	$student_sibling_unique_id_2=$row2['student_sibling_unique_id_2'];
	$student_admission_number=$row2['student_admission_number'];
	$student_scholar_number=$row2['student_scholar_number'];
	$student_father_contact_number=$row2['student_father_contact_number'];
	$student_father_contact_number2=$row2['student_father_contact_number2'];
	$student_father_email_id=$row2['student_father_email_id'];
	$student_mother_contact_number=$row2['student_mother_contact_number'];
	$student_mother_email_id=$row2['student_mother_email_id'];
	$student_father_occupation=$row2['student_father_occupation'];
	$student_mother_occupation=$row2['student_mother_occupation'];
	$student_contact_number=$row2['student_contact_number'];
	$student_email_id=$row2['student_email_id'];
	$student_last_passed_marksheet=$row2['student_last_passed_marksheet'];
	$student_tc=$row2['student_tc'];
	$student_income_certificate=$row2['student_income_certificate'];
	$student_caste_certificate=$row2['student_caste_certificate'];
	$student_dob_certificate=$row2['student_dob_certificate'];
	$student_photo=$row2['student_photo'];
	$student_parents_photo=$row2['student_parents_photo'];
	$student_roll_no=$row2['student_roll_no'];
	$student_adress=$row2['student_adress'];
	$student_city=$row2['student_city'];
	$student_block=$row2['student_block'];
	$student_district=$row2['student_district'];
	$student_pincode=$row2['student_pincode'];
	$student_landmark=$row2['student_landmark'];
	$student_state=$row2['student_state'];
	$student_id_generate=$row2['student_id_generate'];
	$student_class_section=$row2['student_class_section'];
	$student_facility=$row2['student_facility'];	
	$student_bus=$row2['student_bus'];	
	$student_hostel=$row2['student_hostel'];	
	$student_library=$row2['student_library'];	
	$student_admission_remark=$row2['student_admission_remark'];	
	$student_cwsn=$row2['student_cwsn'];	
	$student_cwsn_description=$row2['student_cwsn_description'];	
	$student_guardian_name=$row2['student_guardian_name'];	
	$student_guardian_contact_number=$row2['student_guardian_contact_number'];	
	$student_guardian_relation=$row2['student_guardian_relation'];	
	$student_guardian_email_id=$row2['student_guardian_email_id'];	
	$student_guardian_photo=$row2['student_guardian_photo'];	
	$student_guardian_occupation=$row2['student_guardian_occupation'];	
	$student_sms_contact_number=$row2['student_sms_contact_number'];	
	$student_web_sms=$row2['student_web_sms'];	
	$student_walk_through=$row2['student_walk_through'];	
	$student_walk_with=$row2['student_walk_with'];	
	$student_bus=$row2['student_bus'];	
	$student_bus_no=$row2['student_bus_no'];	
	$student_bus_route=$row2['student_bus_route'];	
	$student_hostel_room_no=$row2['student_hostel_room_no'];	
	$student_hostel_name=$row2['student_hostel_name'];	
	$student_hostel=$row2['student_hostel'];	
	$student_library=$row2['student_library'];	
	$student_remark_1=$row2['student_remark_1'];
	$student_remark_2=$row2['student_remark_2'];
	$student_remark_3=$row2['student_remark_3'];
	$student_remark_4=$row2['student_remark_4'];
	$student_password=$row2['student_password'];
	$student_date_of_birth_month=$row2['student_date_of_birth_month'];
	$student_date_of_birth_date=$row2['student_date_of_birth_date'];
	$student_previous_class_marks=$row2['student_previous_class_marks'];
	$student_status=$row2['student_status'];
	$registration_final=$row2['registration_final'];
//	$update_status=$row2['update_status'];
	//$company_name=$row2['company_name'];
	$school_roll_no=$row2['school_roll_no'];
	$student_enrollment_number=$row2['student_enrollment_number'];
	$student_registration_number=$row2['student_registration_number'];
	$caste_certificate_no=$row2['caste_certificate_no'];
	$student_parents_behaviour=$row2['student_parents_behaviour'];
	$income_certificate_no=$row2['income_certificate_no'];
	$bpl_card_no=$row2['bpl_card_no'];
	$student_fee_category_code=$row2['student_fee_category_code'];
	$student_fee_category=$row2['student_fee_category'];
	$student_bus_fee_category_code=$row2['student_bus_fee_category_code'];
	$student_bus_fee_category=$row2['student_bus_fee_category'];
	
	
	$student_admission_class=$row2['student_admission_class'];
	$father_qualification=$row2['father_qualification'];
	$mother_qualification=$row2['mother_qualification'];
	$previous_school_tc_no=$row2['previous_school_tc_no'];
	$previous_school_tc_date=$row2['previous_school_tc_date'];
	$boarding=$row2['boarding'];
	$student_caste=$row2['student_caste'];
	$student_whatsapp_number=$row2['student_whatsapp_number'];
	$student_blood_group=$row2['student_blood_group'];
	//$boarding=$row2['boarding'];
//	$update_change=$row2['update_change'];
	}
	
	$query012345="select * from school_info_class_info where class_name='$student_class'";
    $run012345=mysqli_query($conn73,$query012345) or die(mysqli_error($conn73));
    $class_code_no=0;
    while($row012345=mysqli_fetch_assoc($run012345)){
    $class_code_no=$row012345['class_code_no']; 
    }
	
$que1="INSERT INTO student_admission_info (`student_id_generate`, `student_name`, `student_father_name`, `student_mother_name`, `student_class`, `student_class_stream`, `student_class_group`, `student_class_section`, `student_roll_no`, `student_password`, `school_roll_no`, `student_date_of_birth`, `student_date_of_birth_month`, `student_date_of_birth_date`, `student_gender`, `student_handicapped`, `student_cwsn`, `student_cwsn_description`, `student_religion`, `student_category`, `student_rf_id_number`, `student_adhar_number`, `student_father_adhar_card_number`, `student_sssmid_number`, `student_family_id`, `student_child_id`, `student_father_bank_name`, `student_father_bank_account_number`, `student_father_bank_ifsc_code`, `student_bank_name`, `student_account_number`, `student_bank_ifsc_code`, `student_admission_type`, `stuent_old_or_new`, `student_medium`, `student_date_of_admission`, `student_date_of_birth_in_word`, `student_previous_class`, `student_previous_school_name`, `student_previous_class_marks`, `student_admission_scheme`, `student_sibling_name_1`, `student_sibling_unique_id_1`, `student_sibling_name_2`, `student_sibling_unique_id_2`, `student_admission_number`, `student_scholar_number`, `student_father_contact_number`, `student_father_contact_number2`, `student_father_email_id`, `student_mother_contact_number`, `student_mother_email_id`, `student_father_occupation`, `student_mother_occupation`, `student_guardian_name`, `student_guardian_relation`, `student_guardian_contact_number`, `student_guardian_email_id`, `student_guardian_occupation`, `student_contact_number`, `student_email_id`, `student_adress`, `student_city`, `student_district`, `student_state`, `student_pincode`, `student_landmark`, `student_block`, `student_last_passed_marksheet`, `student_tc`, `student_income_certificate`, `student_caste_certificate`, `student_dob_certificate`, `student_photo`, `student_parents_photo`, `student_guardian_photo`, `student_facility`, `student_bus`, `student_hostel`, `student_library`, `student_status`, `registration_final`, `student_admission_remark`, `student_sms_contact_number`, `student_web_sms`, `student_walk_through`, `student_walk_with`, `student_remark_1`, `student_remark_2`, `student_remark_3`, `student_remark_4`, `student_bus_no`, `student_hostel_name`, `student_hostel_room_no`, `student_bus_route`, `session_value`, `medium`, `shift`, `board`,`student_enrollment_number`,`student_registration_number`,`caste_certificate_no`,`student_parents_behaviour`,`income_certificate_no`,`bpl_card_no`,`student_fee_category_code`,`student_fee_category`,`student_bus_fee_category_code`,`student_bus_fee_category`,`student_admission_class`,`father_qualification`,`mother_qualification`,`previous_school_tc_no`,`previous_school_tc_date`,`boarding`,`student_caste`,`student_blood_group`,`student_whatsapp_number`,`class_code_no`,$update_by_insert_sql_column) values('$student_id_generate', '$student_name', '$student_father_name', '$student_mother_name', '$to_class', '$student_class_stream_to', '$student_class_group_to', '$to_section', '$student_roll_no', '$student_password', '$school_roll_no', '$student_date_of_birth', '$student_date_of_birth_month', '$student_date_of_birth_date', '$student_gender', '$student_handicapped', '$student_cwsn', '$student_cwsn_description', '$student_religion', '$student_category', '$student_rf_id_number', '$student_adhar_number', '$student_father_adhar_card_number', '$student_sssmid_number', '$student_family_id', '$student_child_id', '$student_father_bank_name', '$student_father_bank_account_number', '$student_father_bank_ifsc_code', '$student_bank_name', '$student_account_number', '$student_bank_ifsc_code', '$student_admission_type', 'Old', '$to_student_medium', '$student_date_of_admission', '$student_date_of_birth_in_word', '$student_previous_class', '$student_previous_school_name', '$student_previous_class_marks', '$student_admission_scheme', '$student_sibling_name_1', '$student_sibling_unique_id_1', '$student_sibling_name_2', '$student_sibling_unique_id_2', '$student_admission_number', '$student_scholar_number', '$student_father_contact_number', '$student_father_contact_number2', '$student_father_email_id', '$student_mother_contact_number', '$student_mother_email_id', '$student_father_occupation', '$student_mother_occupation', '$student_guardian_name', '$student_guardian_relation', '$student_guardian_contact_number', '$student_guardian_email_id', '$student_guardian_occupation', '$student_contact_number', '$student_email_id', '$student_adress', '$student_city', '$student_district', '$student_state', '$student_pincode', '$student_landmark', '$student_block', '$student_last_passed_marksheet', '$student_tc', '$student_income_certificate', '$student_caste_certificate', '$student_dob_certificate', '$student_photo', '$student_parents_photo', '$student_guardian_photo', '$student_facility', '$student_bus', '$student_hostel', '$student_library', '$student_status', '$registration_final', '$student_admission_remark', '$student_sms_contact_number', '$student_web_sms', '$student_walk_through', '$student_walk_with',  '$student_remark_1', '$student_remark_2', '$student_remark_3', '$student_remark_4', '$student_bus_no', '$student_hostel_name', '$student_hostel_room_no','$student_bus_route','$to_session' ,'$to_student_medium','$to_student_shift','$to_student_board','$student_enrollment_number','$student_registration_number','$caste_certificate_no','$student_parents_behaviour','$income_certificate_no','$bpl_card_no','$student_fee_category_code','$student_fee_category','$student_bus_fee_category_code','$student_bus_fee_category','$student_admission_class','$father_qualification','$mother_qualification','$previous_school_tc_no','$previous_school_tc_date','$boarding','$student_caste','$student_blood_group','$student_whatsapp_number','$class_code_no',$update_by_insert_sql_value)";
 mysqli_query($conn73,$que1);
 }
 }
 
echo "|?|success|?|".$already_inserted_student."|?|";
?>