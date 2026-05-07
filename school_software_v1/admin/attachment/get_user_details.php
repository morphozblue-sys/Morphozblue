<?php include("../../con73/con37.php"); 
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$session=mysqli_real_escape_string($conn73,$_POST['session']);
	$user_email=mysqli_real_escape_string($conn73,$_POST['username']);
	$user_pass=mysqli_real_escape_string($conn73,$_POST['password']);
	$_SESSION['session37']=$session;
	$_SESSION['lang']="English";
	$_SESSION['hindi_typing']="English";
$_SESSION['panel_fees_monthly']='yes';
$_SESSION['panel_fees_yearly']='yes';
$_SESSION['panel_fees_installmentwise']='yes';
$_SESSION['panel_pdf_format']='yes';
$_SESSION['designation']='';
$captcha_show=0;
$_SESSION['login_count']=$_SESSION['login_count']+1; 
if($_SESSION['login_count']>5){
    $captcha_show=1;
}
$software_link=$_SESSION['software_link'];

$status="Active";
if($status=='Active' || $status=='' ){
$query23="select * from user_rights where user_email='$user_email' && user_password='$user_pass'";
$run23=mysqli_query($conn73,$query23) or die(mysqli_error($conn73));
if(mysqli_num_rows($run23)>0){


$row23=mysqli_fetch_array($run23);
$_SESSION['class_name37']=$row23['class'];
$_SESSION['section37']=$row23['section'];
$stream_name_get=$row23['stream_name'];

$stream_name_get1=explode('|?|',$stream_name_get);
if(count($stream_name_get1)>1){
$_SESSION['stream_name_array_11TH']=$stream_name_get1[0];
$_SESSION['stream_name_array_12TH']=$stream_name_get1[1];


}else{
     $que121="select * from school_info_stream_info";
                               $run111=mysqli_query($conn73,$que121);
                               $stream_detail="";
                               $stream_count=0;
                               while($row121=mysqli_fetch_assoc($run111)){
                               $stream_name121=$row121['stream_name'];
if($stream_name121!=''){
    if($stream_count==0){
							 $stream_detail=$stream_name121;
    }else{
       	 $stream_detail=$stream_detail."_".$stream_name121; 
    }
							 $stream_count++;
							 
				}
}
$_SESSION['stream_name_array_11TH']=$stream_detail;
$_SESSION['stream_name_array_12TH']=$stream_detail;
}




$_SESSION['password_change']=$row23['subject'];

$_SESSION['school_info_username5'] = $row23['user_email'];
$_SESSION['school_info_school_contact_no5'] = $row23['user_mobile'];
$_SESSION['school_info_principal_name5'] = $row23['user_name'];
	

$class_name238984390=explode('|?|',$_SESSION['class_name37']);
$section_name238984390=explode('|?|',$_SESSION['section37']);
$count23422=count($class_name238984390);
$_SESSION['class_total37']=$count23422;
for($hjk223=0;$hjk223<$count23422;$hjk223++){
$streuy_name=$class_name238984390[$hjk223].'_section37';
$_SESSION[$streuy_name]=$section_name238984390[$hjk223];
}
$_SESSION['panel_attachment']='yes';
$_SESSION['panel_pdf']='yes';
$panel_smartclass=$row23['panel_smartclass'];
if($panel_smartclass=='yes' || $panel_smartclass==''){
$_SESSION['panel_smartclass']='yes';
}
$panel_call_management=$row23['panel_call_management'];
if($panel_call_management=='yes' || $panel_call_management==''){
$_SESSION['panel_call_management']='yes';
}

$panel_classtest=$row23['panel_classtest'];
if($panel_classtest=='yes' || $panel_classtest==''){
$_SESSION['panel_classtest']='yes';
}


$panel_account=$row23['panel_account'];
if($panel_account=='yes'){
$_SESSION['panel_account']='yes';
}
$panel_attendance=$row23['panel_attendance'];
if($panel_attendance=='yes'){
$_SESSION['panel_attendance']='yes';
}
$panel_bus=$row23['panel_bus'];
if($panel_bus=='yes'){
$_SESSION['panel_bus']='yes';
}
$panel_certificate=$row23['panel_certificate'];
if($panel_certificate=='yes'){
$_SESSION['panel_certificate']='yes';
}
$panel_complaint=$row23['panel_complaint'];
if($panel_complaint=='yes'){
$_SESSION['panel_complaint']='yes';
}
$panel_downloads=$row23['panel_downloads'];
if($panel_downloads=='yes'){
$_SESSION['panel_downloads']='yes';
}
$panel_dues=$row23['panel_dues'];
if($panel_dues=='yes'){
$_SESSION['panel_dues']='yes';
}
$panel_event_management=$row23['panel_event_management'];
if($panel_event_management=='yes'){
$_SESSION['panel_event_management']='yes';
}
$panel_exam_paper_setter=$row23['panel_exam_paper_setter'];
if($panel_exam_paper_setter=='yes'){
$_SESSION['panel_exam_paper_setter']='yes';
}
$panel_examination=$row23['panel_examination'];
if($panel_examination=='yes'){
$_SESSION['panel_examination']='yes';
}
$panel_fees=$row23['panel_fees'];
if($panel_fees=='yes'){
$_SESSION['panel_fees']='yes';
}
$panel_new_fees=$row23['panel_new_fees'];
if($panel_new_fees=='yes'){
$_SESSION['panel_new_fees']='yes';
}
$panel_pdf=$row23['panel_pdf'];
if($panel_pdf=='yes'){
$_SESSION['panel_pdf']='yes';
}
$panel_govt_requirement=$row23['panel_govt_requirement'];
if($panel_govt_requirement=='yes'){
$_SESSION['panel_govt_requirement']='yes';
}
$panel_homework=$row23['panel_homework'];
if($panel_homework=='yes'){
$_SESSION['panel_homework']='yes';
}
$panel_hostel=$row23['panel_hostel'];
if($panel_hostel=='yes'){
$_SESSION['panel_hostel']='yes';
}
$panel_library=$row23['panel_library'];
if($panel_library=='yes'){
$_SESSION['panel_library']='yes';
}
$panel_leave=$row23['panel_leave'];
if($panel_leave=='yes'){
$_SESSION['panel_leave']='yes';
}
$panel_penalty=$row23['panel_penalty'];
if($panel_penalty=='yes'){
$_SESSION['panel_penalty']='yes';
}
$panel_recycle_bin=$row23['panel_recycle_bin'];
if($panel_recycle_bin=='yes'){
$_SESSION['panel_recycle_bin']='yes';
}
$panel_reminder=$row23['panel_reminder'];
if($panel_reminder=='yes'){
$_SESSION['panel_reminder']='yes';
}
$panel_school_info=$row23['panel_school_info'];
if($panel_school_info=='yes'){
$_SESSION['panel_school_info']='yes';
}
$panel_sms=$row23['panel_sms'];
if($panel_sms=='yes'){
$_SESSION['panel_sms']='yes';
}
$panel_staff=$row23['panel_staff'];
if($panel_staff=='yes'){
$_SESSION['panel_staff']='yes';
}
$panel_staff_new=$row23['panel_staff_new'];
if($panel_staff_new=='yes'){
$_SESSION['panel_staff_new']='yes';
}
$panel_stock=$row23['panel_stock'];
if($panel_stock=='yes'){
$_SESSION['panel_stock']='yes';
}
$panel_student=$row23['panel_student'];
if($panel_student=='yes'){
$_SESSION['panel_student']='yes';
}
$panel_time_table=$row23['panel_time_table'];
if($panel_time_table=='yes'){
$_SESSION['panel_time_table']='yes';
}
$panel_enquiry=$row23['panel_enquiry'];
if($panel_enquiry=='yes'){
$_SESSION['panel_enquiry']='yes';
}
$panel_gallery=$row23['panel_gallery'];
if($panel_gallery=='yes'){
$_SESSION['panel_gallery']='yes';
}
$panel_holiday=$row23['panel_holiday'];
if($panel_holiday=='yes'){
$_SESSION['panel_holiday']='yes';
}
$panel_sports=$row23['panel_sports'];
if($panel_sports=='yes'){
$_SESSION['panel_sports']='yes';
}
$panel_utility=$row23['panel_utility'];
if($panel_utility=='yes'){
$_SESSION['panel_utility']='yes';
}
$panel_session=$row23['panel_session'];
if($panel_session=='yes'){
$_SESSION['panel_session']='yes';
}
$panel_user_right=$row23['panel_user_right'];
if($panel_user_right=='yes'){
$_SESSION['panel_user_right']='yes';
}
$panel_live_bus=$row23['panel_live_bus'];
if($panel_live_bus=='yes'){
$_SESSION['panel_live_bus']='yes';
}
$panel_android_app=$row23['panel_android_app'];
if($panel_android_app=='yes'){
$_SESSION['panel_android_app']='yes';
}
$panel_software_complaint=$row23['panel_software_complaint'];
if($panel_software_complaint=='yes'){
$_SESSION['panel_software_complaint']='yes';
}
$panel_important=$row23['panel_important'];
if($panel_important=='yes'){
$_SESSION['panel_important']='yes';
}
$designation=$row23['designation'];
$user_id=$row23['user_id'];

$_SESSION['designation']=$designation;
$_SESSION['user_id']=$user_id;

if($row23['sub_panel_smartclass_video_lecture']!='yes'){
$_SESSION['sub_panel_smartclass_video_lecture']='yes';
}
if($row23['sub_panel_smartclass_homework']!='yes'){
$_SESSION['sub_panel_smartclass_homework']='yes';
}
if($row23['sub_panel_smartclass_notification']!='yes'){
$_SESSION['sub_panel_smartclass_notification']='yes';
}
if($row23['sub_panel_smartclass_study_material']!='yes'){
$_SESSION['sub_panel_smartclass_study_material']='yes';
}
if($row23['sub_panel_smartclass_online_exam']!='yes'){
$_SESSION['sub_panel_smartclass_online_exam']='yes';
}
if($row23['sub_panel_smartclass_smartclass_app_rights']!='yes'){
$_SESSION['sub_panel_smartclass_smartclass_app_rights']='yes';
}
if($row23['sub_panel_smartclass_student_user_password_change']!='yes'){
$_SESSION['sub_panel_smartclass_student_user_password_change']='yes';
}
if($row23['sub_panel_smartclass_student_login_details']!='yes'){
$_SESSION['sub_panel_smartclass_student_login_details']='yes';
}
if($row23['sub_panel_smartclass_result']!='yes'){
$_SESSION['sub_panel_smartclass_result']='yes';
}
if($row23['sub_panel_smartclass_liveclass']!='yes'){
$_SESSION['sub_panel_smartclass_liveclass']='yes';
}

$sub_panel_student_attendance_select=$row23['sub_panel_student_attendance_select'];
if($sub_panel_student_attendance_select!='yes'){
$_SESSION['sub_panel_student_attendance_select']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_rfid_attendance=$row23['sub_panel_student_rfid_attendance'];
if($sub_panel_student_rfid_attendance!='yes' and $sub_panel_student_rfid_attendance!=''){
$_SESSION['sub_panel_student_rfid_attendance']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_emp_attendance_select=$row23['sub_panel_emp_attendance_select'];
if($sub_panel_emp_attendance_select!='yes' and $sub_panel_emp_attendance_select!=''){
$_SESSION['sub_panel_emp_attendance_select']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_emp_rfid_attendance=$row23['sub_panel_emp_rfid_attendance'];
if($sub_panel_emp_rfid_attendance!='yes' and $sub_panel_emp_rfid_attendance!=''){
$_SESSION['sub_panel_emp_rfid_attendance']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_enquiry=$row23['sub_panel_add_enquiry'];
if($sub_panel_add_enquiry!='yes' and $sub_panel_add_enquiry!=''){
$_SESSION['sub_panel_add_enquiry']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_enquiry_list=$row23['sub_panel_enquiry_list'];
if($sub_panel_enquiry_list!='yes' and $sub_panel_enquiry_list!=''){
$_SESSION['sub_panel_enquiry_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_emp_salary_list=$row23['sub_panel_emp_salary_list'];
if($sub_panel_emp_salary_list!='yes' and $sub_panel_emp_salary_list!=''){
$_SESSION['sub_panel_emp_salary_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_attendance_employee_add=$row23['sub_panel_attendance_employee_add'];
if($sub_panel_attendance_employee_add!='yes' and $sub_panel_attendance_employee_add!=''){
$_SESSION['sub_panel_attendance_employee_add']='yes';
}

$sub_panel_staff_id_card=$row23['sub_panel_staff_id_card'];
if($sub_panel_staff_id_card!='yes' and $sub_panel_staff_id_card!=''){
$_SESSION['sub_panel_staff_id_card']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_attendance_employee_list=$row23['sub_panel_attendance_employee_list'];
if($sub_panel_attendance_employee_list!='yes' and $sub_panel_attendance_employee_list!=''){
$_SESSION['sub_panel_attendance_employee_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_registration=$row23['sub_panel_student_registration'];
if($sub_panel_student_registration!='yes' and $sub_panel_student_registration!=''){
$_SESSION['sub_panel_student_registration']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_registration_list=$row23['sub_panel_student_registration_list'];
if($sub_panel_student_registration_list!='yes' and $sub_panel_student_registration_list!=''){
$_SESSION['sub_panel_student_registration_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_admission_list=$row23['sub_panel_student_admission_list'];
if($sub_panel_student_admission_list!='yes' and $sub_panel_student_admission_list!='yes'){
$_SESSION['sub_panel_student_admission_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_admission_fee_list=$row23['sub_panel_student_admission_fee_list'];
if($sub_panel_student_admission_fee_list!='yes' and $sub_panel_student_admission_fee_list!=''){
$_SESSION['sub_panel_student_admission_fee_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_rfid_card_generate=$row23['sub_panel_rfid_card_generate'];
if($sub_panel_rfid_card_generate!='yes' and $sub_panel_rfid_card_generate!=''){
$_SESSION['sub_panel_rfid_card_generate']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_roll_no=$row23['sub_panel_student_roll_no'];
if($sub_panel_student_roll_no!='yes' and $sub_panel_student_roll_no!=''){
$_SESSION['sub_panel_student_roll_no']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_id_card=$row23['sub_panel_student_id_card'];
if($sub_panel_student_id_card!='yes' and $sub_panel_student_id_card!=''){
$_SESSION['sub_panel_student_id_card']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_action=$row23['sub_panel_student_action'];
if($sub_panel_student_action!='yes' and $sub_panel_student_action!=''){
$_SESSION['sub_panel_student_action']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_health_zone=$row23['sub_panel_health_zone'];
if($sub_panel_health_zone!='yes' and $sub_panel_health_zone!=''){
$_SESSION['sub_panel_health_zone']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_physical_fitness=$row23['sub_panel_physical_fitness'];
if($sub_panel_physical_fitness!='yes' and $sub_panel_physical_fitness!=''){
$_SESSION['sub_panel_physical_fitness']='yes';
}
//////////////////////////////////////////////////////////////////////

$sub_panel_add_account=$row23['sub_panel_add_account'];
if($sub_panel_add_account!='yes' and $sub_panel_add_account!=''){
$_SESSION['sub_panel_add_account']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_account_list=$row23['sub_panel_account_list'];
if($sub_panel_account_list!='yes' and $sub_panel_account_list!=''){
$_SESSION['sub_panel_account_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_income_or_expence_info=$row23['sub_panel_add_income_or_expence_info'];
if($sub_panel_add_income_or_expence_info!='yes' and $sub_panel_add_income_or_expence_info!=''){
$_SESSION['sub_panel_add_income_or_expence_info']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_income_or_expence_list=$row23['sub_panel_income_or_expence_list'];
if($sub_panel_income_or_expence_list!='yes' and $sub_panel_income_or_expence_list!=''){
$_SESSION['sub_panel_income_or_expence_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_ledger=$row23['sub_panel_ledger'];
if($sub_panel_ledger!='yes' and $sub_panel_ledger!='yes'){
$_SESSION['sub_panel_ledger']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_fee_structure_list=$row23['sub_panel_fee_structure_list'];
if($sub_panel_fee_structure_list!='yes' and $sub_panel_fee_structure_list!=''){
$_SESSION['sub_panel_fee_structure_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_discount_types_list=$row23['sub_panel_discount_types_list'];
if($sub_panel_discount_types_list!='yes' and $sub_panel_discount_types_list!=''){
$_SESSION['sub_panel_discount_types_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_fee_add_form=$row23['sub_panel_student_fee_add_form'];
if($sub_panel_student_fee_add_form!='yes' and $sub_panel_student_fee_add_form!=''){
$_SESSION['sub_panel_student_fee_add_form']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_fee_list=$row23['sub_panel_student_fee_list'];
if($sub_panel_student_fee_list!='yes' and $sub_panel_student_fee_list!=''){
$_SESSION['sub_panel_student_fee_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_penalty_form=$row23['sub_panel_penalty_form'];
if($sub_panel_penalty_form!='yes' and $sub_panel_penalty_form!=''){
$_SESSION['sub_panel_penalty_form']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_penalty_list=$row23['sub_panel_penalty_list'];
if($sub_panel_penalty_list!='yes' and $sub_panel_penalty_list!=''){
$_SESSION['sub_panel_penalty_list']='yes';
}
//////////////////////////////////////////////////////////////////////

$sub_panel_character_certificate_form=$row23['sub_panel_character_certificate_form'];
if($sub_panel_character_certificate_form!='yes' and $sub_panel_character_certificate_form!=''){
$_SESSION['sub_panel_character_certificate_form']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_character_certificate_list=$row23['sub_panel_character_certificate_list'];
if($sub_panel_character_certificate_list!='yes' and $sub_panel_character_certificate_list!=''){
$_SESSION['sub_panel_character_certificate_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_event_certificate_form=$row23['sub_panel_event_certificate_form'];
if($sub_panel_event_certificate_form!='yes' and $sub_panel_event_certificate_form!=''){
$_SESSION['sub_panel_event_certificate_form']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_event_certificate_list=$row23['sub_panel_event_certificate_list'];
if($sub_panel_event_certificate_list!='yes' and $sub_panel_event_certificate_list!=''){
$_SESSION['sub_panel_event_certificate_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_sport_certificate_form=$row23['sub_panel_sport_certificate_form'];
if($sub_panel_sport_certificate_form!='yes' and $sub_panel_sport_certificate_form!=''){
$_SESSION['sub_panel_sport_certificate_form']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_sport_certificate_list=$row23['sub_panel_sport_certificate_list'];
if($sub_panel_sport_certificate_list!='yes' and $sub_panel_sport_certificate_list!=''){
$_SESSION['sub_panel_sport_certificate_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_tc_form=$row23['sub_panel_tc_form'];
if($sub_panel_tc_form!='yes' and $sub_panel_tc_form!=''){
$_SESSION['sub_panel_tc_form']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_tc_list=$row23['sub_panel_tc_list'];
if($sub_panel_tc_list!='yes' and $sub_panel_tc_list!=''){
$_SESSION['sub_panel_tc_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_admit_card=$row23['sub_panel_admit_card'];
if($sub_panel_admit_card!='yes' and $sub_panel_admit_card!=''){
$_SESSION['sub_panel_admit_card']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_admit_card_print=$row23['sub_panel_admit_card_print'];
if($sub_panel_admit_card_print!='yes' and $sub_panel_admit_card_print!=''){
$_SESSION['sub_panel_admit_card_print']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_marksheet_fill=$row23['sub_panel_marksheet_fill'];
if($sub_panel_marksheet_fill!='yes' and $sub_panel_marksheet_fill!=''){
$_SESSION['sub_panel_marksheet_fill']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_marksheet_view=$row23['sub_panel_marksheet_view'];
if($sub_panel_marksheet_view!='yes' and $sub_panel_marksheet_view!=''){
$_SESSION['sub_panel_marksheet_view']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_marksheet_fill_monthly=$row23['sub_panel_marksheet_fill_monthly'];
if($sub_panel_marksheet_fill_monthly!='yes' and $sub_panel_marksheet_fill_monthly!=''){
$_SESSION['sub_panel_marksheet_fill_monthly']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_marksheet_view_monthly=$row23['sub_panel_marksheet_view_monthly'];
if($sub_panel_marksheet_view_monthly!='yes' and $sub_panel_marksheet_view_monthly!=''){
$_SESSION['sub_panel_marksheet_view_monthly']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_homework_add=$row23['sub_panel_homework_add'];
if($sub_panel_homework_add!='yes' and $sub_panel_homework_add!=''){
$_SESSION['sub_panel_homework_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_homework_list=$row23['sub_panel_homework_list'];
if($sub_panel_homework_list!='yes' and $sub_panel_homework_list!=''){
$_SESSION['sub_panel_homework_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_question=$row23['sub_panel_add_question'];
if($sub_panel_add_question!='yes' and $sub_panel_add_question!=''){
$_SESSION['sub_panel_add_question']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_view_question=$row23['sub_panel_view_question'];
if($sub_panel_view_question!='yes' and $sub_panel_view_question!=''){
$_SESSION['sub_panel_view_question']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_instant_go_to_paper_setter=$row23['sub_panel_instant_go_to_paper_setter'];
if($sub_panel_instant_go_to_paper_setter!='yes' and $sub_panel_instant_go_to_paper_setter!=''){
$_SESSION['sub_panel_instant_go_to_paper_setter']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_go_to_paper_setter=$row23['sub_panel_go_to_paper_setter'];
if($sub_panel_go_to_paper_setter!='yes' and $sub_panel_go_to_paper_setter!=''){
$_SESSION['sub_panel_go_to_paper_setter']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_total_paper_list=$row23['sub_panel_total_paper_list'];
if($sub_panel_total_paper_list!='yes' and $sub_panel_total_paper_list!=''){
$_SESSION['sub_panel_total_paper_list']='yes';
}
//////////////////////////////////////////////////////////////////////

$sub_panel_student_complaint=$row23['sub_panel_student_complaint'];
if($sub_panel_student_complaint!='yes' and $sub_panel_student_complaint!=''){
$_SESSION['sub_panel_student_complaint']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_staff_complaint=$row23['sub_panel_staff_complaint'];
if($sub_panel_staff_complaint!='yes' and $sub_panel_staff_complaint!=''){
$_SESSION['sub_panel_staff_complaint']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_send=$row23['sub_panel_send'];
if($sub_panel_send!='yes' and $sub_panel_send!=''){
$_SESSION['sub_panel_send']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_classwise_sms=$row23['sub_panel_classwise_sms'];
if($sub_panel_classwise_sms!='yes' and $sub_panel_classwise_sms!=''){
$_SESSION['sub_panel_classwise_sms']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_attendance_sms=$row23['sub_panel_attendance_sms'];
if($sub_panel_attendance_sms!='yes' and $sub_panel_attendance_sms!=''){
$_SESSION['sub_panel_attendance_sms']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_fee_sms=$row23['sub_panel_fee_sms'];
if($sub_panel_fee_sms!='yes' and $sub_panel_fee_sms!=''){
$_SESSION['sub_panel_fee_sms']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_birthday_sms=$row23['sub_panel_birthday_sms'];
if($sub_panel_birthday_sms!='yes' and $sub_panel_birthday_sms!=''){
$_SESSION['sub_panel_birthday_sms']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_staff_sms=$row23['sub_panel_staff_sms'];
if($sub_panel_staff_sms!='yes' and $sub_panel_staff_sms!=''){
$_SESSION['sub_panel_staff_sms']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_sms_templates_list=$row23['sub_panel_sms_templates_list'];
if($sub_panel_sms_templates_list!='yes' and $sub_panel_sms_templates_list!=''){
$_SESSION['sub_panel_sms_templates_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_delivery_report=$row23['sub_panel_delivery_report'];
if($sub_panel_delivery_report!='yes' and $sub_panel_delivery_report!=''){
$_SESSION['sub_panel_delivery_report']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_group_wise_sms=$row23['sub_panel_group_wise_sms'];
if($sub_panel_group_wise_sms!='yes' and $sub_panel_group_wise_sms!=''){
$_SESSION['sub_panel_group_wise_sms']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_group_teacher=$row23['sub_panel_group_teacher'];
if($sub_panel_group_teacher!='yes' and $sub_panel_group_teacher!=''){
$_SESSION['sub_panel_group_teacher']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_group_student=$row23['sub_panel_group_student'];
if($sub_panel_group_student!='yes' and $sub_panel_group_student!=''){
$_SESSION['sub_panel_group_student']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_group_staff=$row23['sub_panel_add_group_staff'];
if($sub_panel_add_group_staff!='yes' and $sub_panel_add_group_staff!=''){
$_SESSION['sub_panel_add_group_staff']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_group=$row23['sub_panel_add_group'];
if($sub_panel_add_group!='yes' and $sub_panel_add_group!=''){
$_SESSION['sub_panel_add_group']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_time_table_generate=$row23['sub_panel_time_table_generate'];
if($sub_panel_time_table_generate!='yes' and $sub_panel_time_table_generate!=''){
$_SESSION['sub_panel_time_table_generate']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_time_table_list=$row23['sub_panel_time_table_list'];
if($sub_panel_time_table_list!='yes' and $sub_panel_time_table_list!=''){
$_SESSION['sub_panel_time_table_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_teacher_availability=$row23['sub_panel_teacher_availability'];
if($sub_panel_teacher_availability!='yes' and $sub_panel_teacher_availability!=''){
$_SESSION['sub_panel_teacher_availability']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_event=$row23['sub_panel_add_event'];
if($sub_panel_add_event!='yes' and $sub_panel_add_event!=''){
$_SESSION['sub_panel_add_event']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_event_list=$row23['sub_panel_event_list'];
if($sub_panel_event_list!='yes' and $sub_panel_event_list!=''){
$_SESSION['sub_panel_event_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_event_add_participate=$row23['sub_panel_event_add_participate'];
if($sub_panel_event_add_participate!='yes' and $sub_panel_event_add_participate!=''){
$_SESSION['sub_panel_event_add_participate']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_event_participate_list=$row23['sub_panel_event_participate_list'];
if($sub_panel_event_participate_list!='yes' and $sub_panel_event_participate_list!=''){
$_SESSION['sub_panel_event_participate_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_event_photo=$row23['sub_panel_event_photo'];
if($sub_panel_event_photo!='yes' and $sub_panel_event_photo!=''){
$_SESSION['sub_panel_event_photo']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_holiday=$row23['sub_panel_add_holiday'];
if($sub_panel_add_holiday!='yes' and $sub_panel_add_holiday!=''){
$_SESSION['sub_panel_add_holiday']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_holiday_list=$row23['sub_panel_holiday_list'];
if($sub_panel_holiday_list!='yes' and $sub_panel_holiday_list!=''){
$_SESSION['sub_panel_holiday_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_leave_form=$row23['sub_panel_leave_form'];
if($sub_panel_leave_form!='yes' and $sub_panel_leave_form!=''){
$_SESSION['sub_panel_leave_form']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_leave_list=$row23['sub_panel_leave_list'];
if($sub_panel_leave_list!='yes' and $sub_panel_leave_list!=''){
$_SESSION['sub_panel_leave_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_sports=$row23['sub_panel_add_sports'];
if($sub_panel_add_sports!='yes' and $sub_panel_add_sports!=''){
$_SESSION['sub_panel_add_sports']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_sports_list=$row23['sub_panel_sports_list'];
if($sub_panel_sports_list!='yes' and $sub_panel_sports_list!=''){
$_SESSION['sub_panel_sports_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_sports_add_participate=$row23['sub_panel_sports_add_participate'];
if($sub_panel_sports_add_participate!='yes' and $sub_panel_sports_add_participate!=''){
$_SESSION['sub_panel_sports_add_participate']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_sports_participate_list=$row23['sub_panel_sports_participate_list'];
if($sub_panel_sports_participate_list!='yes' and $sub_panel_sports_participate_list!=''){
$_SESSION['sub_panel_sports_participate_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_sports_photo=$row23['sub_panel_sports_photo'];
if($sub_panel_sports_photo!='yes' and $sub_panel_sports_photo!=''){
$_SESSION['sub_panel_sports_photo']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_mapping_list=$row23['sub_panel_mapping_list'];
if($sub_panel_mapping_list!='yes' and $sub_panel_mapping_list!=''){
$_SESSION['sub_panel_mapping_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_student_contact_list=$row23['sub_panel_student_contact_list'];
if($sub_panel_student_contact_list!='yes' and $sub_panel_student_contact_list!=''){
$_SESSION['sub_panel_student_contact_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_reminder_add=$row23['sub_panel_reminder_add'];
if($sub_panel_reminder_add!='yes' and $sub_panel_reminder_add!=''){
$_SESSION['sub_panel_reminder_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_reminder_list=$row23['sub_panel_reminder_list'];
if($sub_panel_reminder_list!='yes' and $sub_panel_reminder_list!=''){
$_SESSION['sub_panel_reminder_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_reminder_teacher_add=$row23['sub_panel_reminder_teacher_add'];
if($sub_panel_reminder_teacher_add!='yes' and $sub_panel_reminder_teacher_add!=''){
$_SESSION['sub_panel_reminder_teacher_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_reminder_teacher_list=$row23['sub_panel_reminder_teacher_list'];
if($sub_panel_reminder_teacher_list!='yes' and $sub_panel_reminder_teacher_list!=''){
$_SESSION['sub_panel_reminder_teacher_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_school_info_general=$row23['sub_panel_school_info_general'];
if($sub_panel_school_info_general!='yes' and $sub_panel_school_info_general!=''){
$_SESSION['sub_panel_school_info_general']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_exam_type_add=$row23['sub_panel_exam_type_add'];
if($sub_panel_exam_type_add!='yes' and $sub_panel_exam_type_add!=''){
$_SESSION['sub_panel_exam_type_add']='yes';
}
$_SESSION['sub_panel_submission_date_change']=$row23['sub_panel_submission_date_change'];
$_SESSION['sub_panel_fee_list_delete']=$row23['sub_panel_fee_list_delete'];
$_SESSION['account_panel_edit_button']=$row23['account_panel_edit_button'];
$_SESSION['account_panel_delete_button']=$row23['account_panel_delete_button'];
$_SESSION['Fess_panel_edit_button']=$row23['Fess_panel_edit_button'];
//////////////////////////////////////////////////////////////////////
$sub_panel_add_class=$row23['sub_panel_add_class'];
if($sub_panel_add_class!='yes' and $sub_panel_add_class!='yes'){
$_SESSION['sub_panel_add_class']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_section=$row23['sub_panel_add_section'];
if($sub_panel_add_section!='yes' and $sub_panel_add_section!=''){
$_SESSION['sub_panel_add_section']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_class_stream=$row23['sub_panel_add_class_stream'];
if($sub_panel_add_class_stream!='yes' and $sub_panel_add_class_stream!=''){
$_SESSION['sub_panel_add_class_stream']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_stream_group=$row23['sub_panel_add_stream_group'];
if($sub_panel_add_stream_group!='yes' and $sub_panel_add_stream_group!=''){
$_SESSION['sub_panel_add_stream_group']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_subject_add=$row23['sub_panel_subject_add'];
if($sub_panel_subject_add!='yes' and $sub_panel_subject_add!=''){
$_SESSION['sub_panel_subject_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_class_wise_subject=$row23['sub_panel_class_wise_subject'];
if($sub_panel_class_wise_subject!='yes' and $sub_panel_class_wise_subject!=''){
$_SESSION['sub_panel_class_wise_subject']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_fee_types_add=$row23['sub_panel_fee_types_add'];
if($sub_panel_fee_types_add!='yes' and $sub_panel_fee_types_add!=''){
$_SESSION['sub_panel_fee_types_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_discount_types_add=$row23['sub_panel_discount_types_add'];
if($sub_panel_discount_types_add!='yes' and $sub_panel_discount_types_add!=''){
$_SESSION['sub_panel_discount_types_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_total_list=$row23['sub_panel_total_list'];
if($sub_panel_total_list!='yes' and $sub_panel_total_list!=''){
$_SESSION['sub_panel_total_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_hindi_type=$row23['sub_panel_hindi_type'];
if($sub_panel_hindi_type!='yes' and $sub_panel_hindi_type!=''){
$_SESSION['sub_panel_hindi_type']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_editor1=$row23['sub_panel_editor1'];
if($sub_panel_editor1!='yes' and $sub_panel_editor1!=''){
$_SESSION['sub_panel_editor1']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_bus=$row23['sub_panel_add_bus'];
if($sub_panel_add_bus!='yes' and $sub_panel_add_bus!=''){
$_SESSION['sub_panel_add_bus']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_bus_list=$row23['sub_panel_bus_list'];
if($sub_panel_bus_list!='yes' and $sub_panel_bus_list!=''){
$_SESSION['sub_panel_bus_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_route_add=$row23['sub_panel_route_add'];
if($sub_panel_route_add!='yes' and $sub_panel_route_add!=''){
$_SESSION['sub_panel_route_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_bus_route_add=$row23['sub_panel_bus_route_add'];
if($sub_panel_bus_route_add!='yes' and $sub_panel_bus_route_add!=''){
$_SESSION['sub_panel_bus_route_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_bus_route_list=$row23['sub_panel_bus_route_list'];
if($sub_panel_bus_route_list!='yes' and $sub_panel_bus_route_list!=''){
$_SESSION['sub_panel_bus_route_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_asigned_bus_route=$row23['sub_panel_asigned_bus_route'];
if($sub_panel_asigned_bus_route!='yes' and $sub_panel_asigned_bus_route!=''){
$_SESSION['sub_panel_asigned_bus_route']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_bus_employee_add=$row23['sub_panel_bus_employee_add'];
if($sub_panel_bus_employee_add!='yes' and $sub_panel_bus_employee_add!=''){
$_SESSION['sub_panel_bus_employee_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_bus_purchase_list=$row23['sub_panel_bus_purchase_list'];
if($sub_panel_bus_purchase_list!='yes' and $sub_panel_bus_purchase_list!=''){
$_SESSION['sub_panel_bus_purchase_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_hostel_list=$row23['sub_panel_hostel_list'];
if($sub_panel_hostel_list!='yes' and $sub_panel_hostel_list!=''){
$_SESSION['sub_panel_hostel_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_room_list=$row23['sub_panel_room_list'];
if($sub_panel_room_list!='yes' and $sub_panel_room_list!=''){
$_SESSION['sub_panel_room_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_hostel_seat_avail=$row23['sub_panel_hostel_seat_avail'];
if($sub_panel_hostel_seat_avail!='yes' and $sub_panel_hostel_seat_avail!=''){
$_SESSION['sub_panel_hostel_seat_avail']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_hostel_employee_add=$row23['sub_panel_hostel_employee_add'];
if($sub_panel_hostel_employee_add!='yes' and $sub_panel_hostel_employee_add!=''){
$_SESSION['sub_panel_hostel_employee_add']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_hostel_student_list=$row23['sub_panel_hostel_student_list'];
if($sub_panel_hostel_student_list!='yes' and $sub_panel_hostel_student_list!=''){
$_SESSION['sub_panel_hostel_student_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_hostel_mess_menu_list=$row23['sub_panel_hostel_mess_menu_list'];
if($sub_panel_hostel_mess_menu_list!='yes' and $sub_panel_hostel_mess_menu_list!=''){
$_SESSION['sub_panel_hostel_mess_menu_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_leave_student=$row23['sub_panel_leave_student'];
if($sub_panel_leave_student!='yes' and $sub_panel_leave_student!=''){
$_SESSION['sub_panel_leave_student']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_hostel_daily_entry=$row23['sub_panel_hostel_daily_entry'];
if($sub_panel_hostel_daily_entry!='yes' and $sub_panel_hostel_daily_entry!=''){
$_SESSION['sub_panel_hostel_daily_entry']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_library_add_book=$row23['sub_panel_library_add_book'];
if($sub_panel_library_add_book!='yes' and $sub_panel_library_add_book!=''){
$_SESSION['sub_panel_library_add_book']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_view_book_library=$row23['sub_panel_view_book_library'];
if($sub_panel_view_book_library!='yes' and $sub_panel_view_book_library!=''){
$_SESSION['sub_panel_view_book_library']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_view_issued_book_list=$row23['sub_panel_view_issued_book_list'];
if($sub_panel_view_issued_book_list!='yes' and $sub_panel_view_issued_book_list!=''){
$_SESSION['sub_panel_view_issued_book_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_view_return_book_list=$row23['sub_panel_view_return_book_list'];
if($sub_panel_view_return_book_list!='yes' and $sub_panel_view_return_book_list!=''){
$_SESSION['sub_panel_view_return_book_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_e_library=$row23['sub_panel_e_library'];
if($sub_panel_e_library!='yes' and $sub_panel_e_library!=''){
$_SESSION['sub_panel_e_library']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_item=$row23['sub_panel_add_item'];
if($sub_panel_add_item!='yes' and $sub_panel_add_item!=''){
$_SESSION['sub_panel_add_item']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_stock_purchase_list=$row23['sub_panel_stock_purchase_list'];
if($sub_panel_stock_purchase_list!='yes' and $sub_panel_stock_purchase_list!=''){
$_SESSION['sub_panel_stock_purchase_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_item_list=$row23['sub_panel_item_list'];
if($sub_panel_item_list!='yes' and $sub_panel_item_list!=''){
$_SESSION['sub_panel_item_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_sale_list=$row23['sub_panel_sale_list'];
if($sub_panel_sale_list!='yes' and $sub_panel_sale_list!=''){
$_SESSION['sub_panel_sale_list']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_move_student=$row23['sub_panel_move_student'];
if($sub_panel_move_student!='yes' and $sub_panel_move_student!=''){
$_SESSION['sub_panel_move_student']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_add_session=$row23['sub_panel_add_session'];
if($sub_panel_add_session!='yes' and $sub_panel_add_session!=''){
$_SESSION['sub_panel_add_session']='yes';
}
//////////////////////////////////////////////////////////////////////
$sub_panel_exam_type_add_monthly=$row23['sub_panel_exam_type_add_monthly'];
if($sub_panel_exam_type_add_monthly!='yes' and $sub_panel_exam_type_add_monthly!=''){
$_SESSION['sub_panel_exam_type_add_monthly']='yes';
}
//////////////////////////////////////////////////////////////////////
$panel_customer_support=$row23['panel_customer_support'];
if($panel_customer_support=='yes'){
$_SESSION['panel_customer_support']='yes';
}
$panel_gate_pass=$row23['panel_gate_pass'];
if($panel_gate_pass=='yes'){
$_SESSION['panel_gate_pass']='yes';
}
$panel_stock_management=$row23['panel_stock_management'];
if($panel_stock_management=='yes'){
$_SESSION['panel_stock_management']='yes';
}
//new_panel_rights


$account_sub_panel_ledger_report_daily=$row23['account_sub_panel_ledger_report_daily'];
if($account_sub_panel_ledger_report_daily!='yes' and $account_sub_panel_ledger_report_daily!=''){
$_SESSION['account_sub_panel_ledger_report_daily']='yes';
}
$account_sub_panel_ledger_report_monthly=$row23['account_sub_panel_ledger_report_monthly'];
if($account_sub_panel_ledger_report_monthly!='yes' and $account_sub_panel_ledger_report_monthly!=''){
$_SESSION['account_sub_panel_ledger_report_monthly']='yes';
}
$account_sub_panel_income_expanece_report=$row23['account_sub_panel_income_expanece_report'];
if($account_sub_panel_income_expanece_report!='yes' and $account_sub_panel_income_expanece_report!=''){
$_SESSION['account_sub_panel_income_expanece_report']='yes';
}

$attendance_sub_panel_registerwise_staff_attendance=$row23['attendance_sub_panel_registerwise_staff_attendance'];
if($attendance_sub_panel_registerwise_staff_attendance!='yes' and $attendance_sub_panel_registerwise_staff_attendance!=''){
$_SESSION['attendance_sub_panel_registerwise_staff_attendance']='yes';
}

$attendance_sub_panel_atendance_graph=$row23['attendance_sub_panel_atendance_graph'];
if($attendance_sub_panel_atendance_graph!='yes' and $attendance_sub_panel_atendance_graph!=''){
$_SESSION['attendance_sub_panel_atendance_graph']='yes';
}

$attendance_sub_panel_student_report_daily_classwise=$row23['attendance_sub_panel_student_report_daily_classwise'];
if($attendance_sub_panel_student_report_daily_classwise!='yes' and $attendance_sub_panel_student_report_daily_classwise!=''){
$_SESSION['attendance_sub_panel_student_report_daily_classwise']='yes';
}

$attendance_sub_panel_student_report_studentwise_monthly=$row23['attendance_sub_panel_student_report_studentwise_monthly'];
if($attendance_sub_panel_student_report_studentwise_monthly!='yes' and $attendance_sub_panel_student_report_studentwise_monthly!=''){
$_SESSION['attendance_sub_panel_student_report_studentwise_monthly']='yes';
}

$attendance_sub_panel_emp_report_daily_categorywise=$row23['attendance_sub_panel_emp_report_daily_categorywise'];
if($attendance_sub_panel_emp_report_daily_categorywise!='yes' and $attendance_sub_panel_emp_report_daily_categorywise!=''){
$_SESSION['attendance_sub_panel_emp_report_daily_categorywise']='yes';
}

$attendance_sub_panel_emp_report_employeewise=$row23['attendance_sub_panel_emp_report_employeewise'];
if($attendance_sub_panel_emp_report_employeewise!='yes' and $attendance_sub_panel_emp_report_employeewise!=''){
$_SESSION['attendance_sub_panel_emp_report_employeewise']='yes';
}
$attendance_sub_panel_student_att_report_daytime=$row23['attendance_sub_panel_student_att_report_daytime'];
if($attendance_sub_panel_student_att_report_daytime!='yes' and $attendance_sub_panel_student_att_report_daytime!=''){
$_SESSION['attendance_sub_panel_student_att_report_daytime']='yes';
}
$attendance_sub_panel_emp_att_report_daytime=$row23['attendance_sub_panel_emp_att_report_daytime'];
if($attendance_sub_panel_emp_att_report_daytime!='yes' and $attendance_sub_panel_emp_att_report_daytime!=''){
$_SESSION['attendance_sub_panel_emp_att_report_daytime']='yes';
}
$bus_sub_panel_student_list=$row23['bus_sub_panel_student_list'];
if($bus_sub_panel_student_list!='yes' and $bus_sub_panel_student_list!=''){
$_SESSION['bus_sub_panel_student_list']='yes';
}
$bus_sub_panel_add_bus_expance=$row23['bus_sub_panel_add_bus_expance'];
if($bus_sub_panel_add_bus_expance!='yes' and $bus_sub_panel_add_bus_expance!=''){
$_SESSION['bus_sub_panel_add_bus_expance']='yes';
}
$bus_sub_panel_bus_expance_report=$row23['bus_sub_panel_bus_expance_report'];
if($bus_sub_panel_bus_expance_report!='yes' and $bus_sub_panel_bus_expance_report!='yes'){
$_SESSION['bus_sub_panel_bus_expance_report']='yes';
}
$bus_sub_panel_student_list_bus_wise_rprt=$row23['bus_sub_panel_student_list_bus_wise_rprt'];
if($bus_sub_panel_student_list_bus_wise_rprt!='yes' and $bus_sub_panel_student_list_bus_wise_rprt!=''){
$_SESSION['bus_sub_panel_student_list_bus_wise_rprt']='yes';
}

$certificate_sub_panel_bonafide=$row23['certificate_sub_panel_bonafide'];
if($certificate_sub_panel_bonafide!='yes' and $certificate_sub_panel_bonafide!=''){
$_SESSION['certificate_sub_panel_bonafide']='yes';
}

$certificate_sub_panel_bonafide_list=$row23['certificate_sub_panel_bonafide_list'];
if($certificate_sub_panel_bonafide_list!='yes' and $certificate_sub_panel_bonafide_list!=''){
$_SESSION['certificate_sub_panel_bonafide_list']='yes';
}

$certificate_sub_panel_tue_fee=$row23['certificate_sub_panel_tue_fee'];
if($certificate_sub_panel_tue_fee!='yes' and $certificate_sub_panel_tue_fee!=''){
$_SESSION['certificate_sub_panel_tue_fee']='yes';
}
$certificate_sub_panel_tue_fee_list=$row23['certificate_sub_panel_tue_fee_list'];
if($certificate_sub_panel_tue_fee_list!='yes' and $certificate_sub_panel_tue_fee_list!=''){
$_SESSION['certificate_sub_panel_tue_fee_list']='yes';
}
$certificate_sub_panel_annual_fee=$row23['certificate_sub_panel_annual_fee'];
if($certificate_sub_panel_annual_fee!='yes' and $certificate_sub_panel_annual_fee!=''){
$_SESSION['certificate_sub_panel_annual_fee']='yes';
}


$certificate_sub_panel_annual_fee_list=$row23['certificate_sub_panel_annual_fee_list'];
if($certificate_sub_panel_annual_fee_list!='yes' and $certificate_sub_panel_annual_fee_list!=''){
$_SESSION['certificate_sub_panel_annual_fee_list']='yes';
}
$certificate_sub_panel_cast_certificate=$row23['certificate_sub_panel_cast_certificate'];
if($certificate_sub_panel_cast_certificate!='yes' and $certificate_sub_panel_cast_certificate!=''){
$_SESSION['certificate_sub_panel_cast_certificate']='yes';
}
$certificate_sub_panel_cast_certificate_list=$row23['certificate_sub_panel_cast_certificate_list'];
if($certificate_sub_panel_cast_certificate_list!='yes' and $certificate_sub_panel_cast_certificate_list!=''){
$_SESSION['certificate_sub_panel_cast_certificate_list']='yes';
}
$certificate_sub_panel_extra_printout=$row23['certificate_sub_panel_extra_printout'];
if($certificate_sub_panel_extra_printout!='yes' and $certificate_sub_panel_extra_printout!=''){
$_SESSION['certificate_sub_panel_extra_printout']='yes';
}  
$certificate_sub_panel_birth_certificate=$row23['certificate_sub_panel_birth_certificate'];
if($certificate_sub_panel_birth_certificate!='yes' and $certificate_sub_panel_birth_certificate!=''){
$_SESSION['certificate_sub_panel_birth_certificate']='yes';
}  
$complaint_sub_panel_employee_complaint=$row23['complaint_sub_panel_employee_complaint'];
if($complaint_sub_panel_employee_complaint!='yes' and $complaint_sub_panel_employee_complaint!=''){
$_SESSION['complaint_sub_panel_employee_complaint']='yes';
}
$download_sub_panel_attendance_list=$row23['download_sub_panel_attendance_list'];
if($download_sub_panel_attendance_list!='yes' and $download_sub_panel_attendance_list!=''){
$_SESSION['download_sub_panel_attendance_list']='yes';
}  
$download_sub_panel_userid_password=$row23['download_sub_panel_userid_password'];
if($download_sub_panel_userid_password!='yes' and $download_sub_panel_userid_password!=''){
$_SESSION['download_sub_panel_userid_password']='yes';
}  
$download_sub_panel_tc_list=$row23['download_sub_panel_tc_list'];
if($download_sub_panel_tc_list!='yes' and $download_sub_panel_tc_list!=''){
$_SESSION['download_sub_panel_tc_list']='yes';
}
$sub_panel_student_admission_list_download_class_wise=$row23['sub_panel_student_admission_list_download_class_wise'];
if($sub_panel_student_admission_list_download_class_wise!='yes' and $sub_panel_student_admission_list_download_class_wise!=''){
$_SESSION['sub_panel_student_admission_list_download_class_wise']='yes';
}
$sub_panel_employee_list_download_category_wise=$row23['sub_panel_employee_list_download_category_wise'];
if($sub_panel_employee_list_download_category_wise!='yes' and $sub_panel_employee_list_download_category_wise!=''){
$_SESSION['sub_panel_employee_list_download_category_wise']='yes';
}
$sub_panel_staff_salary_list_download_month_wise=$row23['sub_panel_staff_salary_list_download_month_wise'];
if($sub_panel_staff_salary_list_download_month_wise!='yes' and $sub_panel_staff_salary_list_download_month_wise!=''){
$_SESSION['sub_panel_staff_salary_list_download_month_wise']='yes';
}
$sub_panel_enquiry_download_date_wise=$row23['sub_panel_enquiry_download_date_wise'];
if($sub_panel_enquiry_download_date_wise!='yes' and $sub_panel_enquiry_download_date_wise!=''){
$_SESSION['sub_panel_enquiry_download_date_wise']='yes';
}
$sub_panel_student_fee_list_download_month_wise=$row23['sub_panel_student_fee_list_download_month_wise'];
if($sub_panel_student_fee_list_download_month_wise!='yes' and $sub_panel_student_fee_list_download_month_wise!=''){
$_SESSION['sub_panel_student_fee_list_download_month_wise']='yes';
}
$sub_panel_expense_list_download_month_wise=$row23['sub_panel_expense_list_download_month_wise'];
if($sub_panel_expense_list_download_month_wise!='yes' and $sub_panel_expense_list_download_month_wise!=''){
$_SESSION['sub_panel_expense_list_download_month_wise']='yes';
}
$sub_panel_income_list_download_month_wise=$row23['sub_panel_income_list_download_month_wise'];
if($sub_panel_income_list_download_month_wise!='yes' and $sub_panel_income_list_download_month_wise!=''){
$_SESSION['sub_panel_income_list_download_month_wise']='yes';
}
$sub_panel_student_admission_list_download=$row23['sub_panel_student_admission_list_download'];
if($sub_panel_student_admission_list_download!='yes' and $sub_panel_student_admission_list_download!=''){
$_SESSION['sub_panel_student_admission_list_download']='yes';
}
$enquiry_sub_panel_enquiry_sms=$row23['enquiry_sub_panel_enquiry_sms'];
if($enquiry_sub_panel_enquiry_sms!='yes' and $enquiry_sub_panel_enquiry_sms!=''){
$_SESSION['enquiry_sub_panel_enquiry_sms']='yes';
}
$event_sub_panel_add_house=$row23['event_sub_panel_add_house'];
if($event_sub_panel_add_house!='yes' and $event_sub_panel_add_house!=''){
$_SESSION['event_sub_panel_add_house']='yes';
}  
$event_sub_panel_assigned_house=$row23['event_sub_panel_assigned_house'];
if($event_sub_panel_assigned_house!='yes' and $event_sub_panel_assigned_house!=''){
$_SESSION['event_sub_panel_assigned_house']='yes';
}
$event_sub_panel_activity_plan=$row23['event_sub_panel_activity_plan'];
if($event_sub_panel_activity_plan!='yes' and $event_sub_panel_activity_plan!=''){
$_SESSION['event_sub_panel_activity_plan']='yes';
}
$event_sub_panel_activity_plan_list=$row23['event_sub_panel_activity_plan_list'];
if($event_sub_panel_activity_plan_list!='yes' and $event_sub_panel_activity_plan_list!=''){
$_SESSION['event_sub_panel_activity_plan_list']='yes';
}
$event_sub_panel_event_result=$row23['event_sub_panel_event_result'];
if($event_sub_panel_event_result!='yes' and $event_sub_panel_event_result!=''){
$_SESSION['event_sub_panel_event_result']='yes';
}
$event_sub_panel_event_result_list=$row23['event_sub_panel_event_result_list'];
if($event_sub_panel_event_result_list!='yes' and $event_sub_panel_event_result_list!=''){
$_SESSION['event_sub_panel_event_result_list']='yes';
}
$event_sub_panel_team_creation=$row23['event_sub_panel_team_creation'];
if($event_sub_panel_team_creation!='yes' and $event_sub_panel_team_creation!=''){
$_SESSION['event_sub_panel_team_creation']='yes';
}
$event_sub_panel_team_creation_list=$row23['event_sub_panel_team_creation_list'];
if($event_sub_panel_team_creation_list!='yes' and $event_sub_panel_team_creation_list!=''){
$_SESSION['event_sub_panel_team_creation_list']='yes';
}
$event_sub_panel_participant_list=$row23['event_sub_panel_participant_list'];
if($event_sub_panel_participant_list!='yes' and $event_sub_panel_participant_list!=''){
$_SESSION['event_sub_panel_participant_list']='yes';
}
$exam_sub_panel_view_resultsheet=$row23['exam_sub_panel_view_resultsheet'];
if($exam_sub_panel_view_resultsheet!='yes' and $exam_sub_panel_view_resultsheet!=''){
$_SESSION['exam_sub_panel_view_resultsheet']='yes';
}
$exam_sub_panel_download_marks=$row23['exam_sub_panel_download_marks'];
if($exam_sub_panel_download_marks!='yes' and $exam_sub_panel_download_marks!=''){
$_SESSION['exam_sub_panel_download_marks']='yes';
}
$sxam_sub_panel_send_marks=$row23['sxam_sub_panel_send_marks'];
if($sxam_sub_panel_send_marks!='yes' and $sxam_sub_panel_send_marks!=''){
$_SESSION['sxam_sub_panel_send_marks']='yes';
}
$sub_panel_class_work=$row23['sub_panel_class_work'];
if($sub_panel_class_work!='yes' and $sub_panel_class_work!=''){
$_SESSION['sub_panel_class_work']='yes';
}
$sub_panel_class_work_list=$row23['sub_panel_class_work_list'];
if($sub_panel_class_work_list!='yes' and $sub_panel_class_work_list!=''){
$_SESSION['sub_panel_class_work_list']='yes';
}
$lib_sub_panel_e_stuff=$row23['lib_sub_panel_e_stuff'];
if($lib_sub_panel_e_stuff!='yes' and $lib_sub_panel_e_stuff!=''){
$_SESSION['lib_sub_panel_e_stuff']='yes';
}
$school_info_sub_panel_add_exam_type_monthly=$row23['school_info_sub_panel_add_exam_type_monthly'];
if($school_info_sub_panel_add_exam_type_monthly!='yes' and $school_info_sub_panel_add_exam_type_monthly!=''){
$_SESSION['school_info_sub_panel_add_exam_type_monthly']='yes';
}
$school_info_sub_panel_student_password_update=$row23['school_info_sub_panel_student_password_update'];
if($school_info_sub_panel_student_password_update!='yes' and $school_info_sub_panel_student_password_update!=''){
$_SESSION['school_info_sub_panel_student_password_update']='yes';
}
$school_info_sub_panel_add_fee_category=$row23['school_info_sub_panel_add_fee_category'];
if($school_info_sub_panel_add_fee_category!='yes' and $school_info_sub_panel_add_fee_category!=''){
$_SESSION['school_info_sub_panel_add_fee_category']='yes';
}
$school_info_sub_panel_add_bus_fee_category=$row23['school_info_sub_panel_add_bus_fee_category'];
if($school_info_sub_panel_add_bus_fee_category!='yes' and $school_info_sub_panel_add_bus_fee_category!=''){
$_SESSION['school_info_sub_panel_add_bus_fee_category']='yes';
}
$school_info_sub_panel_std_identity_category=$row23['school_info_sub_panel_std_identity_category'];
if($school_info_sub_panel_std_identity_category!='yes' and $school_info_sub_panel_std_identity_category!=''){
$_SESSION['school_info_sub_panel_std_identity_category']='yes';
}
$school_info_sub_panel_syllebus_detail=$row23['school_info_sub_panel_syllebus_detail'];
if($school_info_sub_panel_syllebus_detail!='yes' and $school_info_sub_panel_syllebus_detail!=''){
$_SESSION['school_info_sub_panel_syllebus_detail']='yes';
}
$add_bus_fee_category_acadmic_calender=$row23['add_bus_fee_category_acadmic_calender'];
if($add_bus_fee_category_acadmic_calender!='yes' and $add_bus_fee_category_acadmic_calender!=''){
$_SESSION['add_bus_fee_category_acadmic_calender']='yes';
} 
$sms_sub_panel_add_group=$row23['sms_sub_panel_add_group'];
if($sms_sub_panel_add_group!='yes' and $sms_sub_panel_add_group!=''){
$_SESSION['sms_sub_panel_add_group']='yes';
}
$sms_sub_panel_add_group_staff=$row23['sms_sub_panel_add_group_staff'];
if($sms_sub_panel_add_group_staff!='yes' and $sms_sub_panel_add_group_staff!=''){
$_SESSION['sms_sub_panel_add_group_staff']='yes';
}
$sms_sub_panel_group_student=$row23['sms_sub_panel_group_student'];
if($sms_sub_panel_group_student!='yes' and $sms_sub_panel_group_student!=''){
$_SESSION['sms_sub_panel_group_student']='yes';
}
$sms_sub_panel_group_teacher=$row23['sms_sub_panel_group_teacher'];
if($sms_sub_panel_group_teacher!='yes' and $sms_sub_panel_group_teacher!=''){
$_SESSION['sms_sub_panel_group_teacher']='yes';
}
$sms_sub_panel_group_sms=$row23['sms_sub_panel_group_sms'];
if($sms_sub_panel_group_sms!='yes' and $sms_sub_panel_group_sms!=''){
$_SESSION['sms_sub_panel_group_sms']='yes';
}
$sms_sub_panel_bus_sms=$row23['sms_sub_panel_bus_sms'];
if($sms_sub_panel_bus_sms!='yes' and $sms_sub_panel_bus_sms!=''){
$_SESSION['sms_sub_panel_bus_sms']='yes';
}
$sms_sub_panel_group_other_contact=$row23['sms_sub_panel_group_other_contact'];
if($sms_sub_panel_group_other_contact!='yes' and $sms_sub_panel_group_other_contact!=''){
$_SESSION['sms_sub_panel_group_other_contact']='yes';
}
$sms_sub_panel_group_voice_call=$row23['sms_sub_panel_group_voice_call'];
if($sms_sub_panel_group_voice_call!='yes' and $sms_sub_panel_group_voice_call!=''){
$_SESSION['sms_sub_panel_group_voice_call']='yes';   
}
$sports_sub_panel_add_sports_type=$row23['sports_sub_panel_add_sports_type'];
if($sports_sub_panel_add_sports_type!='yes' and $sports_sub_panel_add_sports_type!=''){
$_SESSION['sports_sub_panel_add_sports_type']='yes';
}
$sports_sub_panel_age_category=$row23['sports_sub_panel_age_category'];
if($sports_sub_panel_age_category!='yes' and $sports_sub_panel_age_category!=''){
$_SESSION['sports_sub_panel_age_category']='yes';
}
$sports_sub_panel_team_creation=$row23['sports_sub_panel_team_creation'];
if($sports_sub_panel_team_creation!='yes' and $sports_sub_panel_team_creation!=''){
$_SESSION['sports_sub_panel_team_creation']='yes';
}
$sports_sub_panel_team_creation_list=$row23['sports_sub_panel_team_creation_list'];
if($sports_sub_panel_team_creation_list!='yes' and $sports_sub_panel_team_creation_list!=''){
$_SESSION['sports_sub_panel_team_creation_list']='yes';   
}
$staff_sub_panel_drop_list=$row23['staff_sub_panel_drop_list'];
if($staff_sub_panel_drop_list!='yes' and $staff_sub_panel_drop_list!=''){
$_SESSION['staff_sub_panel_drop_list']='yes';   
}
$staff_sub_panel_id_generate=$row23['staff_sub_panel_id_generate'];
if($staff_sub_panel_id_generate!='yes' and $staff_sub_panel_id_generate!=''){
$_SESSION['staff_sub_panel_id_generate']='yes';
}
$staff_sub_panel_assign_rfid=$row23['staff_sub_panel_assign_rfid'];
if($staff_sub_panel_assign_rfid!='yes' and $staff_sub_panel_assign_rfid!=''){
$_SESSION['staff_sub_panel_assign_rfid']='yes';
}
$staff_sub_panel_attendance_registr=$row23['staff_sub_panel_attendance_registr'];
if($staff_sub_panel_attendance_registr!='yes' and $staff_sub_panel_attendance_registr!=''){
$_SESSION['staff_sub_panel_attendance_registr']='yes';
}
$staff_sub_panel_attendance_prority=$row23['staff_sub_panel_attendance_prority'];
if($staff_sub_panel_attendance_prority!='yes' and $staff_sub_panel_attendance_prority!=''){
$_SESSION['staff_sub_panel_attendance_prority']='yes';   
}
$stock_sub_panel_add_category=$row23['stock_sub_panel_add_category'];
if($stock_sub_panel_add_category!='yes' and $stock_sub_panel_add_category!=''){
$_SESSION['stock_sub_panel_add_category']='yes';
}
$stock_sub_panel_category_list=$row23['stock_sub_panel_category_list'];
if($stock_sub_panel_category_list!='yes' and $stock_sub_panel_category_list!=''){
$_SESSION['stock_sub_panel_category_list']='yes';
}
$stock_sub_panel_buy_sale=$row23['stock_sub_panel_buy_sale'];
if($stock_sub_panel_buy_sale!='yes' and $stock_sub_panel_buy_sale!=''){
$_SESSION['stock_sub_panel_buy_sale']='yes';   
}
$student_sub_panel_profile_update=$row23['student_sub_panel_profile_update'];
if($student_sub_panel_profile_update!='yes' and $student_sub_panel_profile_update!=''){
$_SESSION['student_sub_panel_profile_update']='yes';
}
$student_sub_panel_mapping_data_update=$row23['student_sub_panel_mapping_data_update'];
if($student_sub_panel_mapping_data_update!='yes' and $student_sub_panel_mapping_data_update!=''){
$_SESSION['student_sub_panel_mapping_data_update']='yes';
}
$student_sub_panel_photo_update=$row23['student_sub_panel_photo_update'];
if($student_sub_panel_photo_update!='yes' and $student_sub_panel_photo_update!=''){
$_SESSION['student_sub_panel_photo_update']='yes';   
}
$student_sub_panel_sms_contact_update=$row23['student_sub_panel_sms_contact_update'];
if($student_sub_panel_sms_contact_update!='yes' and $student_sub_panel_sms_contact_update!=''){
$_SESSION['student_sub_panel_sms_contact_update']='yes';   
}
$student_sub_panel_web_sms=$row23['student_sub_panel_web_sms'];
if($student_sub_panel_web_sms!='yes' and $student_sub_panel_web_sms!=''){
$_SESSION['student_sub_panel_web_sms']='yes';
}
$student_sub_panel_guardian_id_card=$row23['student_sub_panel_guardian_id_card'];
if($student_sub_panel_guardian_id_card!='yes' and $student_sub_panel_guardian_id_card!=''){
$_SESSION['student_sub_panel_guardian_id_card']='yes';
}
$student_sub_panel_father_id_card=$row23['student_sub_panel_father_id_card'];
if($student_sub_panel_father_id_card!='yes' and $student_sub_panel_father_id_card!=''){
$_SESSION['student_sub_panel_father_id_card']='yes';
}
$student_sub_panel_mother_id_card=$row23['student_sub_panel_mother_id_card'];
if($student_sub_panel_mother_id_card!='yes' and $student_sub_panel_mother_id_card!=''){
$_SESSION['student_sub_panel_mother_id_card']='yes';   
}
$student_sub_panel_student_strength_castwise=$row23['student_sub_panel_student_strength_castwise'];
if($student_sub_panel_student_strength_castwise!='yes' and $student_sub_panel_student_strength_castwise!=''){
$_SESSION['student_sub_panel_student_strength_castwise']='yes';
}
$student_sub_panel_student_strength_religionwise=$row23['student_sub_panel_student_strength_religionwise'];
if($student_sub_panel_student_strength_religionwise!='yes' and $student_sub_panel_student_strength_religionwise!=''){
$_SESSION['student_sub_panel_student_strength_religionwise']='yes';
}
$student_sub_panel_generate_csv=$row23['student_sub_panel_generate_csv'];
if($student_sub_panel_generate_csv!='yes' and $student_sub_panel_generate_csv!=''){
$_SESSION['student_sub_panel_generate_csv']='yes';   
}
$student_sub_panel_upload_csv=$row23['student_sub_panel_upload_csv'];
if($student_sub_panel_upload_csv!='yes' and $student_sub_panel_upload_csv!=''){
$_SESSION['student_sub_panel_upload_csv']='yes';   
}
$time_table_sub_panel_class_periode=$row23['time_table_sub_panel_class_periode'];
if($time_table_sub_panel_class_periode!='yes' and $time_table_sub_panel_class_periode!=''){
$_SESSION['time_table_sub_panel_class_periode']='yes';
}
$time_table_sub_panel_subjectwise_teacher=$row23['time_table_sub_panel_subjectwise_teacher'];
if($time_table_sub_panel_subjectwise_teacher!='yes' and $time_table_sub_panel_subjectwise_teacher!=''){
$_SESSION['time_table_sub_panel_subjectwise_teacher']='yes';
}
$time_table_sub_panel_teacher_mgt=$row23['time_table_sub_panel_teacher_mgt'];
if($time_table_sub_panel_teacher_mgt!='yes' and $time_table_sub_panel_teacher_mgt!=''){
$_SESSION['time_table_sub_panel_teacher_mgt']='yes';   
}
$time_table_sub_panel_timetable_sheet=$row23['time_table_sub_panel_timetable_sheet'];
if($time_table_sub_panel_timetable_sheet!='yes' and $time_table_sub_panel_timetable_sheet!=''){
$_SESSION['time_table_sub_panel_timetable_sheet']='yes';
}
$time_table_sub_panel_class_periode1=$row23['time_table_sub_panel_class_periode1'];
if($time_table_sub_panel_class_periode1!='yes' and $time_table_sub_panel_class_periode1!=''){
$_SESSION['time_table_sub_panel_class_periode1']='yes';
}
$time_table_sub_panel_time_table1=$row23['time_table_sub_panel_time_table1'];
if($time_table_sub_panel_time_table1!='yes' and $time_table_sub_panel_time_table1!=''){
$_SESSION['time_table_sub_panel_time_table1']='yes';   
}
$time_table_sub_panel_time_table_list1=$row23['time_table_sub_panel_time_table_list1'];
if($time_table_sub_panel_time_table_list1!='yes' and $time_table_sub_panel_time_table_list1!=''){
$_SESSION['time_table_sub_panel_time_table_list1']='yes';   
}
$sub_panel_login_details=$row23['sub_panel_login_details'];
if($sub_panel_login_details!='yes' and $sub_panel_login_details!=''){
$_SESSION['sub_panel_login_details']='yes';
}
$sub_panel_student_login=$row23['sub_panel_student_login'];
if($sub_panel_student_login!='yes' and $sub_panel_student_login!=''){
$_SESSION['sub_panel_student_login']='yes';   
}
$sub_panel_teacher_login=$row23['sub_panel_teacher_login'];
if($sub_panel_teacher_login!='yes' and $sub_panel_teacher_login!=''){
$_SESSION['sub_panel_teacher_login']='yes';   
}
$android_app_sub_panel_notification_add=$row23['android_app_sub_panel_notification_add'];
if($android_app_sub_panel_notification_add!='yes' and $android_app_sub_panel_notification_add!=''){
$_SESSION['android_app_sub_panel_notification_add']='yes';
}
$android_app_sub_panel_notification_list=$row23['android_app_sub_panel_notification_list'];
if($android_app_sub_panel_notification_list!='yes' and $android_app_sub_panel_notification_list!=''){
$_SESSION['android_app_sub_panel_notification_list']='yes';   
}
$android_app_sub_panel_password_reset=$row23['android_app_sub_panel_password_reset'];
if($android_app_sub_panel_password_reset!='yes' and $android_app_sub_panel_password_reset!=''){
$_SESSION['android_app_sub_panel_password_reset']='yes';   
}
$panel_notifiction=$row23['panel_notifiction'];
if($panel_notifiction!='yes'){
$_SESSION['panel_notifiction']='yes';   
}
$panel_website_management=$row23['panel_website_management'];
if($panel_website_management=='yes'){
$_SESSION['panel_website_management']='yes';   
}
$sub_panel_website_management_notification=$row23['sub_panel_website_management_notification'];
if($sub_panel_website_management_notification!='yes' and $sub_panel_website_management_notification!=''){
$_SESSION['sub_panel_website_management_notification']='yes';   
}
$sub_panel_website_management_busroute=$row23['sub_panel_website_management_busroute'];
if($sub_panel_website_management_busroute!='yes' and $sub_panel_website_management_busroute!=''){
$_SESSION['sub_panel_website_management_busroute']='yes';
}
$sub_panel_website_management_reqirectment=$row23['sub_panel_website_management_reqirectment'];
if($sub_panel_website_management_reqirectment!='yes' and $sub_panel_website_management_reqirectment!=''){
$_SESSION['sub_panel_website_management_reqirectment']='yes';
}
$sub_panel_website_management_commety=$row23['sub_panel_website_management_commety'];
if($sub_panel_website_management_commety!='yes' and $sub_panel_website_management_commety!=''){
$_SESSION['sub_panel_website_management_commety']='yes';   
}
$sub_panel_website_management_slider=$row23['sub_panel_website_management_slider'];
if($sub_panel_website_management_slider!='yes' and $sub_panel_website_management_slider!=''){
$_SESSION['sub_panel_website_management_slider']='yes';   
}
$sub_panel_website_management_time_table=$row23['sub_panel_website_management_time_table'];
if($sub_panel_website_management_time_table!='yes' and $sub_panel_website_management_time_table!=''){
$_SESSION['sub_panel_website_management_time_table']='yes';
}
$sub_panel_website_management_tc_upload=$row23['sub_panel_website_management_tc_upload'];
if($sub_panel_website_management_tc_upload!='yes' and $sub_panel_website_management_tc_upload!=''){
$_SESSION['sub_panel_website_management_tc_upload']='yes';   
}
$sub_panel_website_management_kiosk_reg=$row23['sub_panel_website_management_kiosk_reg'];
if($sub_panel_website_management_kiosk_reg!='yes' and $sub_panel_website_management_kiosk_reg!=''){
$_SESSION['sub_panel_website_management_kiosk_reg']='yes';   
}
$sub_panel_website_management_kiosk_list=$row23['sub_panel_website_management_kiosk_list'];
if($sub_panel_website_management_kiosk_list!='yes' and $sub_panel_website_management_kiosk_list!=''){
$_SESSION['sub_panel_website_management_kiosk_list']='yes';
}
$sub_panel_website_management_syllebus=$row23['sub_panel_website_management_syllebus'];
if($sub_panel_website_management_syllebus!='yes' and $sub_panel_website_management_syllebus!=''){
$_SESSION['sub_panel_website_management_syllebus']='yes';   
}
$sub_panel_website_management_dashboard_marquee=$row23['sub_panel_website_management_dashboard_marquee'];
if($sub_panel_website_management_dashboard_marquee!='yes' and $sub_panel_website_management_dashboard_marquee!=''){
$_SESSION['sub_panel_website_management_dashboard_marquee']='yes';   
}
$stock_mgt_sub_panel_add_vandor=$row23['stock_mgt_sub_panel_add_vandor'];
if($stock_mgt_sub_panel_add_vandor!='yes' and $stock_mgt_sub_panel_add_vandor!=''){
$_SESSION['stock_mgt_sub_panel_add_vandor']='yes';
}
$stock_mgt_sub_panel_vandor_list=$row23['stock_mgt_sub_panel_vandor_list'];
if($stock_mgt_sub_panel_vandor_list!='yes' and $stock_mgt_sub_panel_vandor_list!=''){
$_SESSION['stock_mgt_sub_panel_vandor_list']='yes';   
}
$stock_mgt_sub_panel_vandor_list_edit=$row23['stock_mgt_sub_panel_vandor_list_edit'];
if($stock_mgt_sub_panel_vandor_list_edit=='yes' and $stock_mgt_sub_panel_vandor_list_edit==''){
$_SESSION['stock_mgt_sub_panel_vandor_list_edit']='yes';   
}
$stock_mgt_sub_panel_vandor_list_delete=$row23['stock_mgt_sub_panel_vandor_list_delete'];
if($stock_mgt_sub_panel_vandor_list_delete=='yes' and $stock_mgt_sub_panel_vandor_list_delete==''){
$_SESSION['stock_mgt_sub_panel_vandor_list_delete']='yes';
}
$stock_mgt_sub_panel_category_list_edit_button=$row23['stock_mgt_sub_panel_category_list_edit_button'];
if($stock_mgt_sub_panel_category_list_edit_button=='yes' and $stock_mgt_sub_panel_category_list_edit_button==''){
$_SESSION['stock_mgt_sub_panel_category_list_edit_button']='yes';   
}
$stock_mgt_sub_panel_category_list_delete_button=$row23['stock_mgt_sub_panel_category_list_delete_button'];
if($stock_mgt_sub_panel_category_list_delete_button=='yes' and $stock_mgt_sub_panel_category_list_delete_button==''){
$_SESSION['stock_mgt_sub_panel_category_list_delete_button']='yes';
}
$stock_mgt_sub_panel_add_category=$row23['stock_mgt_sub_panel_add_category'];
if($stock_mgt_sub_panel_add_category!='yes' and $stock_mgt_sub_panel_add_category!=''){
$_SESSION['stock_mgt_sub_panel_add_category']='yes';   
}
$stock_mgt_sub_panel_category_list=$row23['stock_mgt_sub_panel_category_list'];
if($stock_mgt_sub_panel_category_list!='yes' and $stock_mgt_sub_panel_category_list!=''){
$_SESSION['stock_mgt_sub_panel_category_list']='yes';   
}
$stock_mgt_sub_panel_add_book_item=$row23['stock_mgt_sub_panel_add_book_item'];
if($stock_mgt_sub_panel_add_book_item!='yes' and $stock_mgt_sub_panel_add_book_item!=''){
$_SESSION['stock_mgt_sub_panel_add_book_item']='yes';   
}
$stock_mgt_sub_panel_list_book_item=$row23['stock_mgt_sub_panel_list_book_item'];
if($stock_mgt_sub_panel_list_book_item!='yes' and $stock_mgt_sub_panel_list_book_item!=''){
$_SESSION['stock_mgt_sub_panel_list_book_item']='yes';
}
$stock_mgt_sub_panel_list_book_item_edit=$row23['stock_mgt_sub_panel_list_book_item_edit'];
if($stock_mgt_sub_panel_list_book_item_edit=='yes' and $stock_mgt_sub_panel_list_book_item_edit==''){
$_SESSION['stock_mgt_sub_panel_list_book_item_edit']='yes';   
}
$stock_mgt_sub_panel_list_book_item_delete=$row23['stock_mgt_sub_panel_list_book_item_delete'];
if($stock_mgt_sub_panel_list_book_item_delete=='yes' and $stock_mgt_sub_panel_list_book_item_delete==''){
$_SESSION['stock_mgt_sub_panel_list_book_item_delete']='yes';   
}
$stock_mgt_sub_panel_list_book_item_edit_rates=$row23['stock_mgt_sub_panel_list_book_item_edit_rates'];
if($stock_mgt_sub_panel_list_book_item_edit_rates=='yes' and $stock_mgt_sub_panel_list_book_item_edit_rates==''){
$_SESSION['stock_mgt_sub_panel_list_book_item_edit_rates']='yes';
}
$stock_mgt_sub_panel_buy_book_item=$row23['stock_mgt_sub_panel_buy_book_item'];
if($stock_mgt_sub_panel_buy_book_item!='yes' and $stock_mgt_sub_panel_buy_book_item!=''){
$_SESSION['stock_mgt_sub_panel_buy_book_item']='yes';   
}
$stock_mgt_sub_panel_category_list_delete_button=$row23['stock_mgt_sub_panel_category_list_delete_button'];
if($stock_mgt_sub_panel_category_list_delete_button=='yes' and $stock_mgt_sub_panel_category_list_delete_button==''){
$_SESSION['stock_mgt_sub_panel_category_list_delete_button']='yes';
}
$stock_mgt_sub_panel_buy_book_item_list=$row23['stock_mgt_sub_panel_buy_book_item_list'];
if($stock_mgt_sub_panel_buy_book_item_list!='yes' and $stock_mgt_sub_panel_buy_book_item_list!=''){
$_SESSION['stock_mgt_sub_panel_buy_book_item_list']='yes';   
}
$stock_mgt_sub_panel_buy_book_item_list_edit=$row23['stock_mgt_sub_panel_buy_book_item_list_edit'];
if($stock_mgt_sub_panel_buy_book_item_list_edit=='yes' and $stock_mgt_sub_panel_buy_book_item_list_edit==''){
$_SESSION['stock_mgt_sub_panel_buy_book_item_list_edit']='yes';   
}
$stock_mgt_sub_panel_buy_book_item_list_delete=$row23['stock_mgt_sub_panel_buy_book_item_list_delete'];
if($stock_mgt_sub_panel_buy_book_item_list_delete=='yes' and $stock_mgt_sub_panel_buy_book_item_list_delete==''){
$_SESSION['stock_mgt_sub_panel_buy_book_item_list_delete']='yes';   
}
$stock_mgt_sub_panel_book_add_in_stock=$row23['stock_mgt_sub_panel_book_add_in_stock'];
if($stock_mgt_sub_panel_book_add_in_stock!='yes' and $stock_mgt_sub_panel_book_add_in_stock!=''){
$_SESSION['stock_mgt_sub_panel_book_add_in_stock']='yes';   
}
$stock_mgt_sub_panel_book_add_in_stock_button=$row23['stock_mgt_sub_panel_book_add_in_stock_button'];
if($stock_mgt_sub_panel_book_add_in_stock_button=='yes' and $stock_mgt_sub_panel_book_add_in_stock_button==''){
$_SESSION['stock_mgt_sub_panel_book_add_in_stock_button']='yes';   
}
$stock_mgt_sub_panel_book_sale_item=$row23['stock_mgt_sub_panel_book_sale_item'];
if($stock_mgt_sub_panel_book_sale_item!='yes' and $stock_mgt_sub_panel_book_sale_item!=''){
$_SESSION['stock_mgt_sub_panel_book_sale_item']='yes';
}
$stock_mgt_sub_panel_book_sale_item_list=$row23['stock_mgt_sub_panel_book_sale_item_list'];
if($stock_mgt_sub_panel_book_sale_item_list!='yes' and $stock_mgt_sub_panel_book_sale_item_list!=''){
$_SESSION['stock_mgt_sub_panel_book_sale_item_list']='yes';   
}
$stock_mgt_sub_panel_book_sale_item_list_cancle_button=$row23['stock_mgt_sub_panel_book_sale_item_list_cancle_button'];
if($stock_mgt_sub_panel_book_sale_item_list_cancle_button=='yes' and $stock_mgt_sub_panel_book_sale_item_list_cancle_button==''){
$_SESSION['stock_mgt_sub_panel_book_sale_item_list_cancle_button']='yes';
}
$stock_mgt_sub_panel_book_sale_cancle_list=$row23['stock_mgt_sub_panel_book_sale_cancle_list'];
if($stock_mgt_sub_panel_book_sale_cancle_list!='yes' and $stock_mgt_sub_panel_book_sale_cancle_list!=''){
$_SESSION['stock_mgt_sub_panel_book_sale_cancle_list']='yes';   
}
$stock_mgt_sub_panel_book_sale_cancle_list=$row23['stock_mgt_sub_panel_book_sale_cancle_list'];
if($stock_mgt_sub_panel_book_sale_cancle_list!='yes' and $stock_mgt_sub_panel_book_sale_cancle_list!=''){
$_SESSION['stock_mgt_sub_panel_book_sale_cancle_list']='yes';   
}
$stock_mgt_sub_panel_book_stock_return_list=$row23['stock_mgt_sub_panel_book_stock_return_list'];
if($stock_mgt_sub_panel_book_stock_return_list!='yes' and $stock_mgt_sub_panel_book_stock_return_list!=''){
$_SESSION['stock_mgt_sub_panel_book_stock_return_list']='yes';   
}
$stock_mgt_sub_panel_add_item_uniform=$row23['stock_mgt_sub_panel_add_item_uniform'];
if($stock_mgt_sub_panel_add_item_uniform!='yes' and $stock_mgt_sub_panel_add_item_uniform!=''){
$_SESSION['stock_mgt_sub_panel_add_item_uniform']='yes';   
}
$stock_mgt_sub_panel_list_item_uniform=$row23['stock_mgt_sub_panel_list_item_uniform'];
if($stock_mgt_sub_panel_list_item_uniform!='yes' and $stock_mgt_sub_panel_list_item_uniform!=''){
$_SESSION['stock_mgt_sub_panel_list_item_uniform']='yes';   
}
$stock_mgt_sub_panel_uniform_item_edit_button=$row23['stock_mgt_sub_panel_uniform_item_edit_button'];
if($stock_mgt_sub_panel_uniform_item_edit_button!='yes' and $stock_mgt_sub_panel_uniform_item_edit_button!=''){
$_SESSION['stock_mgt_sub_panel_uniform_item_edit_button']='yes';
}
$stock_mgt_sub_panel_uniform_item_delete_button=$row23['stock_mgt_sub_panel_uniform_item_delete_button'];
if($stock_mgt_sub_panel_uniform_item_delete_button!='yes' and $stock_mgt_sub_panel_uniform_item_delete_button!=''){
$_SESSION['stock_mgt_sub_panel_uniform_item_delete_button']='yes';   
}
$stock_mgt_sub_panel_uniform_item_addeditrates_button=$row23['stock_mgt_sub_panel_uniform_item_addeditrates_button'];
if($stock_mgt_sub_panel_uniform_item_addeditrates_button=='yes' and $stock_mgt_sub_panel_uniform_item_addeditrates_button==''){
$_SESSION['stock_mgt_sub_panel_uniform_item_addeditrates_button']='yes';
}
$stock_mgt_sub_panel_uniform_buy_item=$row23['stock_mgt_sub_panel_uniform_buy_item'];
if($stock_mgt_sub_panel_uniform_buy_item!='yes' and $stock_mgt_sub_panel_uniform_buy_item!=''){
$_SESSION['stock_mgt_sub_panel_uniform_buy_item']='yes';   
}
$stock_mgt_sub_panel_uniform_buy_item_list=$row23['stock_mgt_sub_panel_uniform_buy_item_list'];
if($stock_mgt_sub_panel_uniform_buy_item_list!='yes' and $stock_mgt_sub_panel_uniform_buy_item_list!=''){
$_SESSION['stock_mgt_sub_panel_uniform_buy_item_list']='yes';   
}
$stock_mgt_sub_panel_uniform_buy_item_list_cancel=$row23['stock_mgt_sub_panel_uniform_buy_item_list_cancel'];
if($stock_mgt_sub_panel_uniform_buy_item_list_cancel!='yes' and $stock_mgt_sub_panel_uniform_buy_item_list_cancel!=''){
$_SESSION['stock_mgt_sub_panel_uniform_buy_item_list_cancel']='yes';   
}
$fees_sub_panel_reset_months_or_installment=$row23['fees_sub_panel_reset_months_or_installment'];
if($fees_sub_panel_reset_months_or_installment!='yes' and $fees_sub_panel_reset_months_or_installment!=''){
$_SESSION['fees_sub_panel_reset_months_or_installment']='yes';   
}
$fees_sub_panel_set_dues_detail=$row23['fees_sub_panel_set_dues_detail'];
if($fees_sub_panel_set_dues_detail!='yes' and $fees_sub_panel_set_dues_detail!=''){
$_SESSION['fees_sub_panel_set_dues_detail']='yes';
}
$fees_sub_panel_set_fee=$row23['fees_sub_panel_set_fee'];
if($fees_sub_panel_set_fee!='yes' and $fees_sub_panel_set_fee!=''){
$_SESSION['fees_sub_panel_set_fee']='yes';   
}
$fees_sub_panel_set_fees_classwise=$row23['fees_sub_panel_set_fees_classwise'];
if($fees_sub_panel_set_fees_classwise!='yes' and $fees_sub_panel_set_fees_classwise!=''){
$_SESSION['fees_sub_panel_set_fees_classwise']='yes';   
}
$fees_sub_panel_set_transport_fee_classwise=$row23['fees_sub_panel_set_transport_fee_classwise'];
if($fees_sub_panel_set_transport_fee_classwise!='yes' and $fees_sub_panel_set_transport_fee_classwise!=''){
$_SESSION['fees_sub_panel_set_transport_fee_classwise']='yes';   
}
$fees_sub_panel_previous_dues=$row23['fees_sub_panel_previous_dues'];
if($fees_sub_panel_previous_dues!='yes' and $fees_sub_panel_previous_dues!=''){
$_SESSION['fees_sub_panel_previous_dues']='yes';   
}
$fees_sub_panel_add_classwise_transport=$row23['fees_sub_panel_add_classwise_transport'];
if($fees_sub_panel_add_classwise_transport!='yes' and $fees_sub_panel_add_classwise_transport!=''){
$_SESSION['fees_sub_panel_add_classwise_transport']='yes';   
}
$fees_sub_panel_print_chalan=$row23['fees_sub_panel_print_chalan'];
if($fees_sub_panel_print_chalan!='yes' and $fees_sub_panel_print_chalan!=''){
$_SESSION['fees_sub_panel_print_chalan']='yes';
}
$fees_sub_panel_fees_detail_by_rfid=$row23['fees_sub_panel_fees_detail_by_rfid'];
if($fees_sub_panel_fees_detail_by_rfid!='yes' and $fees_sub_panel_fees_detail_by_rfid!=''){
$_SESSION['fees_sub_panel_fees_detail_by_rfid']='yes';   
}
$fees_sub_panel_dues_list_sms_print=$row23['fees_sub_panel_dues_list_sms_print'];
if($fees_sub_panel_dues_list_sms_print!='yes' and $fees_sub_panel_dues_list_sms_print!=''){
$_SESSION['fees_sub_panel_dues_list_sms_print']='yes';
}
$fees_sub_panel_demand_bill=$row23['fees_sub_panel_demand_bill'];
if($fees_sub_panel_demand_bill!='yes' and $fees_sub_panel_demand_bill!=''){
$_SESSION['fees_sub_panel_demand_bill']='yes';   
}
$fees_sub_panel_student_income_tax=$row23['fees_sub_panel_student_income_tax'];
if($fees_sub_panel_student_income_tax!='yes' and $fees_sub_panel_student_income_tax!=''){
$_SESSION['fees_sub_panel_student_income_tax']='yes';   
}
$fees_sub_panel_transport_reset_month=$row23['fees_sub_panel_transport_reset_month'];
if($fees_sub_panel_transport_reset_month!='yes' and $fees_sub_panel_transport_reset_month!=''){
$_SESSION['fees_sub_panel_transport_reset_month']='yes';   
}
$fees_sub_panel_transport_fees_structure=$row23['fees_sub_panel_transport_fees_structure'];
if($fees_sub_panel_transport_fees_structure!='yes' and $fees_sub_panel_transport_fees_structure!=''){
$_SESSION['fees_sub_panel_transport_fees_structure']='yes';   
}
$fees_sub_panel_transport_set_fee_classwise=$row23['fees_sub_panel_transport_set_fee_classwise'];
if($fees_sub_panel_transport_set_fee_classwise!='yes' and $fees_sub_panel_transport_set_fee_classwise!=''){
$_SESSION['fees_sub_panel_transport_set_fee_classwise']='yes';   
}
$fees_sub_panel_transport_pay_fee=$row23['fees_sub_panel_transport_pay_fee'];
if($fees_sub_panel_transport_pay_fee!='yes' and $fees_sub_panel_transport_pay_fee!=''){
$_SESSION['fees_sub_panel_transport_pay_fee']='yes';
}
$fees_sub_panel_transport_fee_details=$row23['fees_sub_panel_transport_fee_details'];
if($fees_sub_panel_transport_fee_details!='yes' and $fees_sub_panel_transport_fee_details!=''){
$_SESSION['fees_sub_panel_transport_fee_details']='yes';   
}
$fees_sub_panel_report_panel=$row23['fees_sub_panel_report_panel'];
if($fees_sub_panel_report_panel!='yes' and $fees_sub_panel_report_panel!=''){
$_SESSION['fees_sub_panel_report_panel']='yes';
}
$fees_sub_panel_transport_reports_panel=$row23['fees_sub_panel_transport_reports_panel'];
if($fees_sub_panel_transport_reports_panel!='yes' and $fees_sub_panel_transport_reports_panel!=''){
$_SESSION['fees_sub_panel_transport_reports_panel']='yes';   
}
$fees_sub_panel_bus_id_card=$row23['fees_sub_panel_bus_id_card'];
if($fees_sub_panel_bus_id_card!='yes' and $fees_sub_panel_bus_id_card!=''){
$_SESSION['fees_sub_panel_bus_id_card']='yes'; 
}
$fees_panel_delete_button=$row23['fees_panel_delete_button'];
if($fees_panel_delete_button=='yes' and $fees_panel_delete_button!=''){
$_SESSION['fees_sub_panel_report_panel']='yes';
}
$fees_panel_edit_button=$row23['fees_panel_edit_button'];
if($fees_panel_edit_button=='yes' and $fees_panel_edit_button!=''){
$_SESSION['fees_panel_edit_button']='yes';   
}
$fees_panel_details_button=$row23['fees_panel_details_button'];
if($fees_panel_details_button=='yes' and $fees_panel_details_button==''){
$_SESSION['fees_panel_details_button']='yes';
}
$stock_mgt_sub_panel_buy_cancel_list=$row23['stock_mgt_sub_panel_buy_cancel_list'];
if($stock_mgt_sub_panel_buy_cancel_list!='yes' and $stock_mgt_sub_panel_buy_cancel_list!=''){
$_SESSION['stock_mgt_sub_panel_buy_cancel_list']='yes';   
}
$stock_mgt_sub_panel_add_in_stock=$row23['stock_mgt_sub_panel_add_in_stock'];
if($stock_mgt_sub_panel_add_in_stock!='yes' and $stock_mgt_sub_panel_add_in_stock!=''){
$_SESSION['stock_mgt_sub_panel_add_in_stock']='yes';
}
$stock_mgt_sub_panel_sale_item_uniform=$row23['stock_mgt_sub_panel_sale_item_uniform'];
if($stock_mgt_sub_panel_sale_item_uniform!='yes' and $stock_mgt_sub_panel_sale_item_uniform!=''){
$_SESSION['stock_mgt_sub_panel_sale_item_uniform']='yes';   
}
$stock_mgt_sub_panel_uniform_sale_list=$row23['stock_mgt_sub_panel_uniform_sale_list'];
if($stock_mgt_sub_panel_uniform_sale_list!='yes' and $stock_mgt_sub_panel_uniform_sale_list!=''){
$_SESSION['stock_mgt_sub_panel_uniform_sale_list']='yes'; 
}
$stock_mgt_sub_panel_uniform_sale_cancel_list=$row23['stock_mgt_sub_panel_uniform_sale_cancel_list'];
if($stock_mgt_sub_panel_uniform_sale_cancel_list!='yes' and $stock_mgt_sub_panel_uniform_sale_cancel_list!=''){
$_SESSION['stock_mgt_sub_panel_uniform_sale_cancel_list']='yes';
}
$stock_mgt_sub_panel_uniform_add_opening=$row23['stock_mgt_sub_panel_uniform_add_opening'];
if($stock_mgt_sub_panel_uniform_sale_cancel_list!='yes' and $stock_mgt_sub_panel_uniform_sale_cancel_list!=''){
$_SESSION['stock_mgt_sub_panel_uniform_add_opening']='yes';   
}
$stock_mgt_reports=$row23['stock_mgt_reports'];
if($stock_mgt_reports!='yes'){
$_SESSION['stock_mgt_reports']='yes';
}
$fees_sub_panel_transport_set_dues_detail=$row23['fees_sub_panel_transport_set_dues_detail'];
if($fees_sub_panel_transport_set_dues_detail!='yes' and $fees_sub_panel_transport_set_dues_detail!=''){
$_SESSION['fees_sub_panel_transport_set_dues_detail']='yes';
}
$sub_panel_account_list_edit=$row23['sub_panel_account_list_edit'];
if($sub_panel_account_list_edit=='yes' or $sub_panel_account_list_edit==''){
$_SESSION['sub_panel_account_list_edit']='yes';
}
$sub_panel_account_list_delete=$row23['sub_panel_account_list_delete'];
if($sub_panel_account_list_delete=='yes' or $sub_panel_account_list_delete==''){
$_SESSION['sub_panel_account_list_delete']='yes';
}
$sub_panel_income_or_expence_list_edit=$row23['sub_panel_income_or_expence_list_edit'];
if($sub_panel_income_or_expence_list_edit=='yes' or $sub_panel_income_or_expence_list_edit==''){
$_SESSION['sub_panel_income_or_expence_list_edit']='yes';
}
$sub_panel_income_or_expence_list_delete=$row23['sub_panel_income_or_expence_list_delete'];
if($sub_panel_income_or_expence_list_delete=='yes' or $sub_panel_income_or_expence_list_delete==''){
$_SESSION['sub_panel_income_or_expence_list_delete']='yes';
}
$sub_panel_student_list=$row23['sub_panel_student_list'];
if($sub_panel_student_list!='yes' and $sub_panel_student_list!=''){
$_SESSION['sub_panel_student_list']='yes';
}
$recycle_bin_sub_panel_student_list=$row23['recycle_bin_sub_panel_student_list'];
if($recycle_bin_sub_panel_student_list!='yes' and $recycle_bin_sub_panel_student_list!=''){
$_SESSION['recycle_bin_sub_panel_student_list']='yes';
}
$recycle_bin_sub_panel_emp_list=$row23['recycle_bin_sub_panel_emp_list'];
if($recycle_bin_sub_panel_emp_list!='yes' and $recycle_bin_sub_panel_emp_list!=''){
$_SESSION['recycle_bin_sub_panel_emp_list']='yes';
}
$recycle_bin_sub_panel_expance_list=$row23['recycle_bin_sub_panel_expance_list'];
if($recycle_bin_sub_panel_expance_list!='yes' and $recycle_bin_sub_panel_expance_list!=''){
$_SESSION['recycle_bin_sub_panel_expance_list']='yes';
}
$recycle_bin_sub_panel_hostal_student_list=$row23['recycle_bin_sub_panel_hostal_student_list'];
if($recycle_bin_sub_panel_hostal_student_list!='yes' and $recycle_bin_sub_panel_hostal_student_list!=''){
$_SESSION['recycle_bin_sub_panel_hostal_student_list']='yes';
}
$recycle_bin_sub_panel_hostal_account_list=$row23['recycle_bin_sub_panel_hostal_account_list'];
if($recycle_bin_sub_panel_hostal_account_list!='yes' and $recycle_bin_sub_panel_hostal_account_list!=''){
$_SESSION['recycle_bin_sub_panel_hostal_account_list']='yes';
}
$recycle_bin_sub_panel_registration_list=$row23['recycle_bin_sub_panel_registration_list'];
if($recycle_bin_sub_panel_registration_list!='yes' and $recycle_bin_sub_panel_registration_list!=''){
$_SESSION['recycle_bin_sub_panel_registration_list']='yes';
}
$_SESSION['recycle_sub_panel_reset_delete_button']=$row23['recycle_sub_panel_reset_delete_button'];
$recycle_sub_panel_reset_delete_button=$row23['recycle_sub_panel_reset_delete_button'];
if($recycle_sub_panel_reset_delete_button!='yes' and $recycle_sub_panel_reset_delete_button!=''){
$_SESSION['recycle_sub_panel_reset_delete_button']='yes';
}
$student_panel_edit_button=$row23['student_panel_edit_button'];
if($student_panel_edit_button!='yes' and $student_panel_edit_button!=''){
$_SESSION['student_panel_edit_button']='yes';
}
$student_panel_delete_button=$row23['student_panel_delete_button'];
if($student_panel_delete_button=='yes' and $student_panel_delete_button==''){
$_SESSION['student_panel_delete_button']='yes';
}
$support_sub_panel_add_query=$row23['support_sub_panel_add_query'];
if($support_sub_panel_add_query!='yes' and $support_sub_panel_add_query!=''){
$_SESSION['support_sub_panel_add_query']='yes';
}
$support_sub_panel_query_list=$row23['support_sub_panel_query_list'];
if($support_sub_panel_query_list!='yes' and $support_sub_panel_query_list!=''){
$_SESSION['support_sub_panel_query_list']='yes';
}
$gatepass_sub_panel_add_new=$row23['gatepass_sub_panel_add_new'];
if($gatepass_sub_panel_add_new!='yes' and $gatepass_sub_panel_add_new!=''){
$_SESSION['gatepass_sub_panel_add_new']='yes';
}
$gatepass_sub_panel_gatepass_list=$row23['gatepass_sub_panel_gatepass_list'];
if($gatepass_sub_panel_gatepass_list!='yes' and $gatepass_sub_panel_gatepass_list!=''){
$_SESSION['gatepass_sub_panel_gatepass_list']='yes';
}
$stock_mgt_sub_panel_buy_book_cancle_list=$row23['stock_mgt_sub_panel_buy_book_cancle_list'];
if($stock_mgt_sub_panel_buy_book_cancle_list!='yes' and $stock_mgt_sub_panel_buy_book_cancle_list!=''){
$_SESSION['stock_mgt_sub_panel_buy_book_cancle_list']='yes';
}
$stock_mgt_sub_panel_book_stock_return=$row23['stock_mgt_sub_panel_book_stock_return'];
if($stock_mgt_sub_panel_book_stock_return!='yes' and $stock_mgt_sub_panel_book_stock_return!=''){
$_SESSION['stock_mgt_sub_panel_book_stock_return']='yes';
}
$_SESSION['examination_fill_marks_total_day_field']=$row23['examination_fill_marks_total_day_field'];
$_SESSION['examination_fill_marks_prasent_day_field']=$row23['examination_fill_marks_prasent_day_field'];
$_SESSION['examination_fill_marks_remarks_field']=$row23['examination_fill_marks_remarks_field'];
$_SESSION['bus_panel_edit_button']=$row23['bus_panel_edit_button'];
$_SESSION['bus_panel_delete_button']=$row23['bus_panel_delete_button'];
$_SESSION['hostal_panel_edit_delete_button']=$row23['hostal_panel_edit_delete_button'];
$_SESSION['student_panel_edit_button']=$row23['student_panel_edit_button'];
$_SESSION['student_panel_delete_button']=$row23['student_panel_delete_button'];

//new_user_rights_end
//////////////////////////////////////////////////////////////////////



$que="select * from school_info_general";
$run=mysqli_query($conn73,$que);
while($row7=mysqli_fetch_array($run)){

	$_SESSION['school_info_school_board'] = $row7['school_info_school_board'];
	if($_SESSION['school_info_school_board']!='Both'){
                      if($_SESSION['school_info_school_board']!='CBSE Board'){
                     $_SESSION['board_change']='State Board';
                      }else{
                           $_SESSION['board_change']='CBSE Board';
                      }
                 }else{
                     if(!isset($_SESSION['board_change']) or ($_SESSION['board_change']=='Both')){
                         $_SESSION['board_change']='State Board';
                     }
                 }
	$_SESSION['shift'] = $row7['shift'];
	if($_SESSION['shift']=='yes'){
	    $_SESSION['shift_change']='Shift1';
	}else{
	    $_SESSION['shift_change']='';
	}
	$_SESSION['school_info_medium'] = $row7['school_info_medium'];
	if($_SESSION['school_info_medium']=='Both'){
	$_SESSION['medium_change']='English';
	}else{
	 $_SESSION['medium_change']=$row7['school_info_medium'];
	}

    $_SESSION['school_code']='All';

	$_SESSION['school_info_school_name5']= $row7['school_info_school_name'];
	$school_info_school_latitude= $row7['school_info_school_latitude'];
	$school_info_school_longitude= $row7['school_info_school_longitude'];
	$_SESSION['school_location']= $school_info_school_latitude.','.$school_info_school_longitude;
    $_SESSION['fees_category']=$row7['fees_category'];
    $_SESSION['website_management']=$row7['website_management'];
    $_SESSION['stock_type']=$row7['filter1'];
    
    
        $multiple_school=$row7['multiple_school'];
        $school_info_school_name5=$row7['school_info_school_name'];
           $_SESSION['school_name_short']=$multiple_school;
    if($multiple_school==""){
        if(strlen($school_info_school_name5)<=28){
        $multiple_school=$school_info_school_name5;
        }else{
           $school_info_school_name51=explode(" ",$school_info_school_name5);
           for($ssa=0;$ssa<count($school_info_school_name51);$ssa++){
             $multiple_school=$multiple_school.$school_info_school_name51[$ssa][0];  
           }
        }
    $_SESSION['school_name_short']=$multiple_school;
    $quer11112="update school_info_general set multiple_school='$multiple_school'";
    mysqli_query($conn73,$quer11112);
}
    
    
}
$sms_database=$_SESSION['sms_database_name'] ?? '';
$software_link=$_SESSION['software_link'] ?? '';
/*$que_bal="select * from $sms_database.school_detail where software_link='$software_link'";
$run_bal=mysqli_query($conn731,$que_bal) or die(mysqli_error($conn731));
while($row_bal=mysqli_fetch_array($run_bal)){
$_SESSION['sms_balance']=$row_bal['sms_balance'];
}*/

$ip_address = $_SERVER['REMOTE_ADDR'];
$login_ip=$ip_address;
$login_user=$user_email;
$login_time=date("Y-m-d H:i:s");
$session_id=uniqid();
$_SESSION['session_id']=$session_id;
$que234="insert into login_details(login_ip,login_user,login_time,session_id)values('$login_ip','$login_user','$login_time','$session_id')";
mysqli_query($conn73,$que234);

 echo "|?|success|?|Login SuccessFully|?|";

}else{
    echo "|?|Failed|?|Password or User name is incorrect!!|?|".$captcha_show;
}


}else{	echo "|?|Failed|?|Access Denied!!! Please contact bluemorphoz|?|";
}
}else{
 echo "|?|Failed|?|Access Denied contact bluemorphoz|?|";   
}
  mysqli_close($conn73);
?>