<?php include("../attachment/session.php"); ?>

    <?php
	include("../attachment/image_compression_upload.php");
	include("../sms/sms.php");
    $s_no=$_POST['s_no'];
    $student_roll_no=$_POST['student_roll_no'];
    $student_name=$_POST['student_name'];
	$student_father_name=$_POST['student_father_name'];
	$student_mother_name=$_POST['student_mother_name'];
	$student_class=$_POST['student_class'];
	$student_date_of_birth=$_POST['student_date_of_birth'];
	$student_gender=$_POST['student_gender'];
	$student_handicapped=$_POST['student_handicapped'];
	$student_religion=$_POST['student_religion'];
	$student_category=$_POST['student_category'];
	$student_rf_id_number=$_POST['student_rf_id_number'];
	$student_adhar_number=$_POST['student_adhar_number'];
	$student_father_adhar_card_number=$_POST['student_father_adhar_card_number'];
	$student_sssmid_number=$_POST['student_sssmid_number'];
	$student_family_id=$_POST['student_family_id'];
	$student_child_id=$_POST['student_child_id'];
	$student_registration_number=$_POST['student_registration_number'];
	$student_enrollment_number=$_POST['student_enrollment_number'];
	$student_father_bank_name=$_POST['student_father_bank_name'];
	$student_father_bank_account_number=$_POST['student_father_bank_account_number'];
	$student_father_bank_ifsc_code=$_POST['student_father_bank_ifsc_code'];
	$student_bank_name=$_POST['student_bank_name'];
	$student_account_number=$_POST['student_account_number'];
	$student_bank_ifsc_code=$_POST['student_bank_ifsc_code'];
	$student_admission_type=$_POST['student_admission_type'];
	$student_admission_scheme=$_POST['student_admission_scheme'];
	$stuent_old_or_new=$_POST['stuent_old_or_new'];
	$student_medium=$_POST['student_medium'];
	$student_date_of_admission=$_POST['student_date_of_admission'];
	$student_date_of_birth_in_word=$_POST['student_date_of_birth_in_word'];
	$student_previous_class=$_POST['student_previous_class'];
	$student_previous_school_name=$_POST['student_previous_school_name'];
	$student_admission_scheme=$_POST['student_admission_scheme'];
	$student_sibling_name_1=$_POST['student_sibling_name_1'];
	$student_sibling_unique_id_1=$_POST['student_sibling_unique_id_1'];
	$student_sibling_name_2=$_POST['student_sibling_name_2'];
	$student_caste = $_POST['student_caste'];
	$father_qualification = $_POST['father_qualification'];
	$mother_qualification = $_POST['mother_qualification'];
	$student_admission_class=$_POST['student_admission_class'];
	$previous_school_tc_no=$_POST['previous_school_tc_no'];
	$previous_school_tc_date=$_POST['previous_school_tc_date'];
	$house_name=$_POST['house_name'];
	$student_fatehr_annual_income=$_POST['annual_income'];
	$caste_certificate_no=$_POST['cast_certifictae_no'];
	$student_blood_group=$_POST['student_blood_group'];
	
    $student_bus_route=$_POST['student_bus_route'];
    $student_bus_no=$_POST['student_bus_no'];
	
	if(isset($_POST['student_fee_category'])){
	$student_fee_category=$_POST['student_fee_category'];
	$student_fee_category1=explode('|?|',$student_fee_category);
	$student_fee_category_name=$student_fee_category1[0];
	$student_fee_category_code=$student_fee_category1[1];
	}else{
	$student_fee_category_name='';
	$student_fee_category_code='';
	}
	
	$bus_fee_category_name=$_POST['bus_fee_category_name'];
	if(	$bus_fee_category_name!=''){
	
	$bus_fee_category1=explode('|?|',$bus_fee_category_name);
    $student_bus_fee_category=$bus_fee_category1[0];
    $student_bus_fee_category_code=$bus_fee_category1[1];
	}else{
	$student_bus_fee_category='';
	$student_bus_fee_category_code='';
	}
	
	$student_sibling_unique_id_2=$_POST['student_sibling_unique_id_2'];
	$student_admission_number=$_POST['student_admission_number'];
	$student_scholar_number=$_POST['student_scholar_number'];
	$student_father_contact_number=$_POST['student_father_contact_number'];
	$student_father_contact_number2=$_POST['student_father_contact_number2'];
	$student_father_email_id=$_POST['student_father_email_id'];
	$student_mother_contact_number=$_POST['student_mother_contact_number'];
	$student_mother_email_id=$_POST['student_mother_email_id'];
	$student_father_occupation=$_POST['student_father_occupation'];
	$student_mother_occupation=$_POST['student_mother_occupation'];
	$student_contact_number=$_POST['student_contact_number'];
	$student_email_id=$_POST['student_email_id'];
	$student_class_section=$_POST['student_class_section'];
	$student_adress=$_POST['student_adress'];
	$student_city=$_POST['student_city'];
	$student_block=$_POST['student_block'];
	$student_district=$_POST['student_district'];
	$class_change_hidden=$_POST['class_change_hidden'];
	$student_state=$_POST['student_state'];
	$student_landmark=$_POST['student_landmark'];
	$student_pincode=$_POST['student_pincode'];
	$student_bus=$_POST['student_bus'];	
	$student_hostel=$_POST['student_hostel'];	
	$student_library=$_POST['student_library'];
	
	$query012345="select class_code_no from school_info_class_info where class_name='$student_class'";
    $run012345=mysqli_query($conn73,$query012345) or die(mysqli_error($conn73));
    $class_code_no=0;
    while($row012345=mysqli_fetch_assoc($run012345)){
    $class_code_no=$row012345['class_code_no']; 
    }
	
	if($student_class=="11TH" || $student_class=="12TH"){
		$student_class_stream = $_POST['student_class_stream'];
	$student_class_group = $_POST['student_class_group'];
	}else{
	$student_class_stream = "";
	$student_class_group = "";
	}
	$student_class_group_subject = $_POST['student_class_group_subject'];
	$student_admission_remark = $_POST['student_admission_remark'];
	$student_cwsn=$_POST['student_cwsn'];	
	$student_cwsn_description=$_POST['student_cwsn_description'];	
	$student_guardian_name=$_POST['student_guardian_name'];	
	$student_guardian_contact_number=$_POST['student_guardian_contact_number'];	
	$student_guardian_relation=$_POST['student_guardian_relation'];	
	$student_guardian_email_id=$_POST['student_guardian_email_id'];		
	$student_guardian_occupation=$_POST['student_guardian_occupation'];	
	$student_sms_contact_number=$_POST['student_sms_contact_number'];	
	$student_web_sms=$_POST['student_web_sms'];	
	$student_walk_through=$_POST['student_walk_through'];	
	$student_walk_with=$_POST['student_walk_with'];

	$student_remark_1=$_POST['student_remark_1'];
	$student_remark_2=$_POST['student_remark_2'];
	$student_remark_3=$_POST['student_remark_3'];
	$student_remark_4=$_POST['student_remark_4'];
	
		$student_address_permanent=$_POST['student_address_permanent'];
	$student_city_permanent=$_POST['student_city_permanent'];
	$student_block_permanent=$_POST['student_block_permanent'];
	$student_district_permanent=$_POST['student_district_permanent'];
	$student_pincode_permanent=$_POST['student_pincode_permanent'];
	$student_state_permanent=$_POST['student_state_permanent'];
	
		$student_image=$_FILES['student_image']['name'];
	 $student_father_image=$_FILES['student_father_image']['name'];
	$student_mother_image=$_FILES['student_mother_image']['name'];
	$student_guardian_image=$_FILES['student_guardian_image']['name'];
	$student_tc_image=$_FILES['student_tc_image']['name'];
	$student_last_marksheet_image=$_FILES['student_last_marksheet_image']['name'];
	$student_income_certificate_image=$_FILES['student_income_certificate_image']['name'];
	$student_cast_certificate_image=$_FILES['student_cast_certificate_image']['name'];
	$student_dob_image=$_FILES['student_dob_image']['name'];
	$student_adhar_card_image=$_FILES['student_adhar_card_image']['name'];

	
		if($student_image!=''){
	$imagename = $_FILES['student_image']['name'];
	$size = $_FILES['student_image']['size'];
    $uploadedfile = $_FILES['student_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_image","student_documents","student_roll_no");
	}
			if($student_father_image!=''){
	$imagename = $_FILES['student_father_image']['name'];
	$size = $_FILES['student_father_image']['size'];
    $uploadedfile = $_FILES['student_father_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_father_image","student_documents","student_roll_no");
	}
			if($student_mother_image!=''){
	$imagename = $_FILES['student_mother_image']['name'];
	$size = $_FILES['student_mother_image']['size'];
    $uploadedfile = $_FILES['student_mother_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_mother_image","student_documents","student_roll_no");
	}
			if($student_guardian_image!=''){
	$imagename = $_FILES['student_guardian_image']['name'];
	$size = $_FILES['student_guardian_image']['size'];
    $uploadedfile = $_FILES['student_guardian_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_guardian_image","student_documents","student_roll_no");
	}
			if($student_tc_image!=''){
	$imagename = $_FILES['student_tc_image']['name'];
	$size = $_FILES['student_tc_image']['size'];
    $uploadedfile = $_FILES['student_tc_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_tc_image","student_documents","student_roll_no");
	}
			if($student_last_marksheet_image!=''){
	$imagename = $_FILES['student_last_marksheet_image']['name'];
	$size = $_FILES['student_last_marksheet_image']['size'];
    $uploadedfile = $_FILES['student_last_marksheet_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_last_marksheet_image","student_documents","student_roll_no");
	}
			if($student_income_certificate_image!=''){
	$imagename = $_FILES['student_income_certificate_image']['name'];
	$size = $_FILES['student_income_certificate_image']['size'];
    $uploadedfile = $_FILES['student_income_certificate_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_income_certificate_image","student_documents","student_roll_no");
	}
			if($student_cast_certificate_image!=''){
	$imagename = $_FILES['student_cast_certificate_image']['name'];
	$size = $_FILES['student_cast_certificate_image']['size'];
    $uploadedfile = $_FILES['student_cast_certificate_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_cast_certificate_image","student_documents","student_roll_no");
	}
			if($student_dob_image!=''){
	$imagename = $_FILES['student_dob_image']['name'];
	$size = $_FILES['student_dob_image']['size'];
    $uploadedfile = $_FILES['student_dob_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_dob_image","student_documents","student_roll_no");
	}
			if($student_adhar_card_image!=''){
	$imagename = $_FILES['student_adhar_card_image']['name'];
	$size = $_FILES['student_adhar_card_image']['size'];
    $uploadedfile = $_FILES['student_adhar_card_image']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_adhar_card_image","student_documents","student_roll_no");
	}
			
	
	
	
	
	/*****************************compress camera code End****************/
	
	$student_date_of_birth2=explode('-',$student_date_of_birth);
    $student_date_of_birth_month=$student_date_of_birth2[1];
    $student_date_of_birth_date=$student_date_of_birth2[2];
	
	
	
		if($_SESSION['shift']=='yes'){ 
		$shift=$_POST['student_shift'];
		}else{
		$shift='';
		}
		if($_SESSION['school_info_school_board']=='Both'){ 
		$board=$_POST['student_board'];
		}else{
		$board='';
		}
		if($_SESSION['school_info_medium']=='Both'){ 
		$medium=$_POST['student_medium'];
		}else{
		$medium='';
		}
	
   $quer="update student_admission_info set student_date_of_birth_month='$student_date_of_birth_month',student_date_of_birth_date='$student_date_of_birth_date',student_name='$student_name',student_father_name='$student_father_name',student_mother_name='$student_mother_name',student_class='$student_class',student_date_of_birth='$student_date_of_birth',student_gender='$student_gender',student_handicapped='$student_handicapped',student_religion='$student_religion',student_category='$student_category',student_rf_id_number='$student_rf_id_number',student_adhar_number='$student_adhar_number',student_father_adhar_card_number='$student_father_adhar_card_number',student_sssmid_number='$student_sssmid_number',student_family_id='$student_family_id',student_child_id='$student_child_id',student_registration_number='$student_registration_number',student_enrollment_number='$student_enrollment_number',student_father_bank_name='$student_father_bank_name',student_father_bank_account_number='$student_father_bank_account_number',student_father_bank_ifsc_code='$student_father_bank_ifsc_code',student_bank_name='$student_bank_name',student_account_number='$student_account_number',student_bank_ifsc_code='$student_bank_ifsc_code',student_admission_type='$student_admission_type',student_admission_scheme='$student_admission_scheme',stuent_old_or_new='$stuent_old_or_new',student_medium='$student_medium',student_date_of_admission='$student_date_of_admission',student_date_of_birth_in_word='$student_date_of_birth_in_word',student_previous_class='$student_previous_class',student_previous_school_name='$student_previous_school_name',student_admission_scheme='$student_admission_scheme',student_sibling_name_1='$student_sibling_name_1',student_sibling_unique_id_1='$student_sibling_unique_id_1',student_sibling_name_2='$student_sibling_name_2',student_sibling_unique_id_2='$student_sibling_unique_id_2',student_admission_number='$student_admission_number',student_scholar_number='$student_scholar_number',student_father_contact_number='$student_father_contact_number',student_father_contact_number2='$student_father_contact_number2',student_father_email_id='$student_father_email_id',student_mother_contact_number='$student_mother_contact_number',student_mother_email_id='$student_mother_email_id',student_father_occupation='$student_father_occupation',student_mother_occupation='$student_mother_occupation',student_contact_number='$student_contact_number',student_email_id='$student_email_id',student_class_section='$student_class_section',student_adress='$student_adress',student_city='$student_city',student_block='$student_block',student_district='$student_district',student_state='$student_state',student_landmark='$student_landmark',student_pincode='$student_pincode',student_class_stream='$student_class_stream',student_class_subject='$student_class_group_subject',student_class_group='$student_class_group',student_admission_remark='$student_admission_remark',student_cwsn='$student_cwsn',student_cwsn_description='$student_cwsn_description',student_guardian_name='$student_guardian_name',student_guardian_contact_number='$student_guardian_contact_number',student_guardian_relation='$student_guardian_relation',student_guardian_email_id='$student_guardian_email_id',student_guardian_occupation='$student_guardian_occupation',student_sms_contact_number='$student_sms_contact_number',student_web_sms='$student_web_sms',student_walk_through='$student_walk_through',student_walk_with='$student_walk_with',student_bus='$student_bus',student_bus_no='$student_bus_no',student_bus_route='$student_bus_route',student_hostel='$student_hostel',student_library='$student_library',student_remark_1='$student_remark_1',student_remark_2='$student_remark_2',student_remark_3='$student_remark_3',student_remark_4='$student_remark_4',shift='$shift',medium='$medium',board='$board',student_fee_category='$student_fee_category_name',student_fee_category_code='$student_fee_category_code',student_bus_fee_category='$student_bus_fee_category',student_bus_fee_category_code='$student_bus_fee_category_code',registration_final='yes',student_address_permanent='$student_address_permanent',student_city_permanent='$student_city_permanent',student_block_permanent='$student_block_permanent',student_district_permanent='$student_district_permanent',student_pincode_permanent='$student_pincode_permanent',student_state_permanent='$student_state_permanent',father_qualification='$father_qualification',mother_qualification='$mother_qualification',student_status='Active',student_caste='$student_caste',student_admission_class='$student_admission_class',previous_school_tc_no='$previous_school_tc_no',previous_school_tc_date='$previous_school_tc_date',house_name='$house_name',student_identity_category='$house_name',student_fatehr_annual_income='$student_fatehr_annual_income',caste_certificate_no='$caste_certificate_no',student_blood_group='$student_blood_group',class_code_no='$class_code_no',$update_by_update_sql  where student_roll_no='$student_roll_no' and session_value='$session1'";
   
    //if($fees_type=='fees'){
    $quer1232="update fees_student_fee set student_name='$student_name',student_class='$student_class',student_medium='$student_medium',medium='$medium',$update_by_update_sql  where student_roll_no='$student_roll_no'";
    mysqli_query($conn73,$quer1232);
	
    if($class_change_hidden=="Active"){
    $quer1="update fees_student_fee set fee_status='Deactive',$update_by_update_sql  where student_roll_no='$student_roll_no'";
    mysqli_query($conn73,$quer1);
    }
   // }
    if(mysqli_query($conn73,$quer)){
    if(isset($_POST['myCheck'])){
    $sms_content = $_POST['sms_content'];
    sendDNDSMS($student_sms_contact_number,$sms_content);
    }
	echo "|?|success|?|student_roll_no=".$student_roll_no."|?|";
	}
    
