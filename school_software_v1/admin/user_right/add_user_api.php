<?php include("../attachment/session.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
$user_name=$_POST['user_name'];
$user_id=$_POST['user_id'];
$user_password=$_POST['user_password'];
$user_email=$_POST['user_email'];
$user_designation=$_POST['user_designation'];
$panel_rights=$_POST['panel_rights'];
$user_mobile=$_POST['user_mobile'];
$section1=$_POST['section1'];
$serial_no=$_POST['serial_no'];
$count=count($panel_rights);
$column_name='';
$column_value='';
for($i=0;$i<$count;$i++){
if($i==0){
$column_name="$panel_rights[$i]='yes'";
}else{
$column_name=$column_name.", $panel_rights[$i]='yes'";
}
}
$class_right=$_POST['class_right'];

                              
$count12=count($class_right);
if($serial_no==$count12){
$class_all1='yes';
}else{
$class_all1='no';
}
$class_column='';
$section_column='';
$subject_column='';
$section_all='';
for($i1=0;$i1<$count12;$i1++){
       if($i1==0){
				$class_column=$class_right[$i1];
				 $class_right_x=str_replace(" ","_",$class_right[$i1]);
				$section_name23=$class_right_x.'_section';
				$section_name231=$_POST[$section_name23];
				$count123=count($section_name231);
				if($section1[$i1]==$count123){
				$section_all='yes';
				}else{
				$section_all='no';
				}
				$section75='';
						for($m=0;$m<$count123;$m++){
									if($m==0){
									    $section75=$section_name231[$m];
									}else{
									    $section75= $section75.'_'.$section_name231[$m];
									}
							}
				$section_column=$section75;

                  }
		else{
		      $class_column=$class_column.'|?|'.$class_right[$i1];
		      
				 $class_right_x=str_replace(" ","_",$class_right[$i1]);
			  $section_name23=$class_right_x.'_section';
				$section_name231=$_POST[$section_name23];
				$count123=count($section_name231);
					if($section1[$i1]==$count123){
				$section_all=$section_all.'|?|yes';
				}else{
				$section_all=$section_all.'|?|no';
				}
				$section75='';
						for($m=0;$m<$count123;$m++){
									if($m==0){
									    $section75=$section_name231[$m];
									}else{
									    $section75= $section75.'_'.$section_name231[$m];
									}
							}
				$section_column=$section_column.'|?|'.$section75;
				
		}


}
/*
//,subject='$subject_column'
$kjshjks="ALTER TABLE `user_rights` ADD `Fess_panel_edit_button` VARCHAR(10) NOT NULL";
 mysqli_query($conn73,$kjshjks);
 $kjshjks="ALTER TABLE `user_rights` ADD `account_panel_edit_button` VARCHAR(10) NOT NULL";
 mysqli_query($conn73,$kjshjks);
 $kjshjks="ALTER TABLE `user_rights` ADD `account_panel_delete_button` VARCHAR(10) NOT NULL";
 mysqli_query($conn73,$kjshjks);
 
 
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_vendor_add` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_item_category_add` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_item_add` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_item_list` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_item_sale` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_item_sale_list` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_report_item_availability` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_report_sales` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_report_sales_itemwise` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `panel_smartclass` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `panel_call_management` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `panel_classtest` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_report_sales_itemwise` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_report_sales_itemwise` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_sm_report_sales_itemwise` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);

$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_video_lecture` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_homework` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_notification` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_study_material` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_online_exam` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_smartclass_app_rights` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_student_user_password_change` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_student_login_details` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_result` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
$kjshjks="ALTER TABLE `user_rights` ADD `sub_panel_smartclass_liveclass` VARCHAR(10) NOT NULL";mysqli_query($conn73,$kjshjks);
 
 
$kjshjks="Alter user_rights Add `account_panel_edit_button`varchar(20) NOT NULL,`account_panel_delete_button`varchar(20) NOT NULL,`Fess_panel_edit_button`varchar(20) NOT NULL,`bus_panel_edit_button`varchar(20) NOT NULL,`bus_panel_delete_button`varchar(20) NOT NULL,`hostal_panel_edit_delete_button`varchar(20) NOT NULL";
 mysqli_query($conn73,$kjshjks);
*/
 $query231="UPDATE `user_rights` SET sub_panel_smartclass_video_lecture='No',sub_panel_smartclass_homework='No',sub_panel_smartclass_notification='No',sub_panel_smartclass_study_material='No',sub_panel_smartclass_online_exam='No',sub_panel_smartclass_smartclass_app_rights='No',sub_panel_smartclass_student_user_password_change='No',sub_panel_smartclass_result='No',sub_panel_smartclass_liveclass='No',panel_smartclass='No',panel_call_management='No',panel_classtest='No',sub_panel_sm_vendor_add='No',sub_panel_sm_item_category_add='No',sub_panel_sm_item_add='No',sub_panel_sm_item_list='No',sub_panel_sm_item_sale='No',sub_panel_sm_item_sale_list='No',sub_panel_sm_report_item_availability='No',sub_panel_sm_report_sales='No',sub_panel_sm_report_sales_itemwise='No',`panel_account`='no7',`panel_attendance`='no8',`panel_bus`='no9',`panel_certificate`='no10',`panel_complaint`='no11',`panel_downloads`='no12',`panel_dues`='no13',`panel_enquiry`='no14',`panel_event_management`='no15',`panel_exam_paper_setter`='no16',`panel_examination`='no17',`panel_fees`='no18',`panel_gallery`='no19',`panel_govt_requirement`='no20',`panel_holiday`='no21',`panel_homework`='no22',`panel_hostel`='no23',`panel_leave`='no24',`panel_library`='no25',`panel_penalty`='no26',`panel_recycle_bin`='no27',`panel_reminder`='no28',`panel_school_info`='no29',`panel_sms`='no30',`panel_sports`='no31',`panel_staff`='no32',`panel_stock`='no33',`panel_student`='no34',`panel_time_table`='no35',`class`='no36',`class_all`='no37',`section_all`='no38',`section`='no39',`subject`='no40',`panel_utility`='no42',`panel_session`='no43',`panel_user_right`='no44',`stream_name`='no45',`group_name`='no46',`group_wise_subject`='no47',`panel_software_complaint`='no48',`panel_android_app`='no49',`panel_live_bus`='no50',`panel_important`='no51',`sub_panel_student_attendance_select`='no52',`sub_panel_student_rfid_attendance`='no53',`sub_panel_emp_rfid_attendance`='no54',`sub_panel_add_enquiry`='no55',`sub_panel_enquiry_list`='no56',`sub_panel_attendance_employee_add`='no57',`sub_panel_attendance_employee_list`='no58',`sub_panel_emp_attendance_select`='no59',`sub_panel_emp_salary_list`='no60',`sub_panel_student_registration`='no61',`sub_panel_student_registration_list`='no62',`sub_panel_student_admission_list`='no63',`sub_panel_student_admission_fee_list`='no64',`sub_panel_rfid_card_generate`='no65',`sub_panel_student_roll_no`='no66',`sub_panel_student_id_card`='no67',`sub_panel_student_action`='no68',`sub_panel_health_zone`='no69',`sub_panel_physical_fitness`='no70',`sub_panel_add_account`='no71',`sub_panel_account_list`='no72',`sub_panel_add_income_or_expence_info`='no73',`sub_panel_income_or_expence_list`='no74',`sub_panel_ledger`='no75',`sub_panel_class_wise_dues_details`='no76',`sub_panel_fee_structure_list`='no77',`sub_panel_discount_types_list`='no78',`sub_panel_student_fee_add_form`='no79',`sub_panel_student_fee_list`='no80',`sub_panel_penalty_form`='no81',`sub_panel_penalty_list`='no82',`sub_panel_character_certificate_form`='no83',`sub_panel_character_certificate_list`='no84',`sub_panel_event_certificate_form`='no85',`sub_panel_event_certificate_list`='no86',`sub_panel_sport_certificate_form`='no87',`sub_panel_sport_certificate_list`='no88',`sub_panel_tc_form`='no89',`sub_panel_tc_list`='no90',`sub_panel_admit_card`='no91',`sub_panel_admit_card_print`='no92',`sub_panel_marksheet_fill`='no93',`sub_panel_marksheet_view`='no94',`sub_panel_homework_add`='no95',`sub_panel_homework_list`='no96',`sub_panel_add_question`='no97',`sub_panel_view_question`='no98',`sub_panel_instant_go_to_paper_setter`='no99',`sub_panel_go_to_paper_setter`='no100',`sub_panel_total_paper_list`='no101',`sub_panel_student_complaint`='no102',`sub_panel_staff_complaint`='no103',`sub_panel_gallery`='no104',`sub_panel_send`='no105',`sub_panel_classwise_sms`='no106',`sub_panel_attendance_sms`='no107',`sub_panel_fee_sms`='no108',`sub_panel_birthday_sms`='no109',`sub_panel_staff_sms`='no110',`sub_panel_sms_templates_list`='no111',`sub_panel_delivery_report`='no112',`sub_panel_time_table_generate`='no113',`sub_panel_time_table_list`='no114',`sub_panel_teacher_availability`='no115',`sub_panel_add_event`='no116',`sub_panel_event_list`='no117',`sub_panel_event_add_participate`='no118',`sub_panel_event_participate_list`='no119',`sub_panel_event_photo`='no120',`sub_panel_add_holiday`='no121',`sub_panel_holiday_list`='no122',`sub_panel_leave_form`='no123',`sub_panel_leave_list`='no124',`sub_panel_add_sports`='no125',`sub_panel_sports_list`='no126',`sub_panel_sports_add_participate`='no127',`sub_panel_sports_participate_list`='no128',`sub_panel_sports_photo`='no129',`sub_panel_student_admission_list_download`='no130',`sub_panel_employee_list_download_category_wise`='no131',`sub_panel_staff_salary_list_download_month_wise`='no132',`sub_panel_enquiry_download_date_wise`='no133',`sub_panel_student_fee_list_download_month_wise`='no134',`sub_panel_expense_list_download_month_wise`='no135',`sub_panel_income_list_download_month_wise`='no136',`sub_panel_mapping_list`='no137',`sub_panel_student_list`='no138',`sub_panel_student_contact_list`='no139',`sub_panel_reminder_add`='no140',`sub_panel_reminder_list`='no141',`sub_panel_reminder_teacher_add`='no142',`sub_panel_reminder_teacher_list`='no143',`sub_panel_school_info_general`='no144',`sub_panel_exam_type_add`='no145',`sub_panel_add_class`='no146',`sub_panel_add_section`='no147',`sub_panel_add_class_stream`='no148',`sub_panel_add_stream_group`='no149',`sub_panel_subject_add`='no150',`sub_panel_class_wise_subject`='no151',`sub_panel_fee_types_add`='no152',`sub_panel_discount_types_add`='no153',`sub_panel_total_list`='no154',`sub_panel_hindi_type`='no155',`sub_panel_editor1`='no156',`sub_panel_add_bus`='no157',`sub_panel_bus_list`='no158',`sub_panel_route_add`='no159',`sub_panel_bus_route_add`='no160',`panel_customer_support`='no245',`panel_gate_pass`='no246',`panel_stock_management`='no247',`sub_panel_bus_route_list`='no161',`sub_panel_asigned_bus_route`='no162',`sub_panel_bus_employee_add`='no163',`sub_panel_bus_employee_list`='no164',`sub_panel_bus_purchase_list`='no165',`sub_panel_hostel_list`='no166',`sub_panel_room_list`='no167',`sub_panel_hostel_seat_avail`='no168',`sub_panel_hostel_employee_add`='no169',`sub_panel_hostel_employee_list`='no170',`sub_panel_hostel_student_list`='no171',`sub_panel_hostel_mess_menu_list`='no172',`sub_panel_daily_mess_purchase_detail`='no173',`sub_panel_leave_student`='no174',`sub_panel_hostel_daily_entry`='no175',`sub_panel_buy_item`='no176',`sub_panel_hostel_purchase_list`='no177',`sub_panel_hostel_expenses`='no178',`sub_panel_account_collection`='no179',`sub_panel_library_add_book`='no180',`sub_panel_view_book_library`='no181',`sub_panel_view_issued_book_list`='no182',`sub_panel_view_return_book_list`='no183',`sub_panel_e_library`='no184',`sub_panel_add_item`='no185',`sub_panel_stock_purchase_list`='no186',`sub_panel_item_list`='no187',`sub_panel_sale_list`='no188',`sub_panel_add_session`='no189',`sub_panel_notification_add`='no190',`sub_panel_select_student`='no191',`sub_panel_empolyee_download`='no192',`sub_panel_employee_salary`='no193',`sub_panel_enquiry_download_info`='no194',`sub_panel_student_fees_download_list`='no195',`sub_panel_account_expense_info`='no196',`sub_panel_account_info_download`='no197',`sub_panel_Company_wise_download_list`='no198',`sub_panel_Attendance_download_list`='no199',`sub_panel_account_list_edit`='no200',`sub_panel_income_or_expence_list_edit`='no201',`sub_panel_account_list_delete`='no202',`sub_panel_income_or_expence_list_delete`='no203',`sub_panel_submission_date_change`='no204',`sub_panel_fee_list_delete`='no205',`account_sub_panel_ledger_report_daily`='no206',`account_sub_panel_ledger_report_monthly`='no207',`account_sub_panel_income_expanece_report`='no208',`attendance_sub_panel_registerwise_staff_attendance`='no209',`attendance_sub_panel_atendance_graph`='no210',`attendance_sub_panel_student_report_daily_classwise`='no211',`attendance_sub_panel_student_report_studentwise_monthly`='no212',`attendance_sub_panel_emp_report_daily_categorywise`='no213',`attendance_sub_panel_emp_report_employeewise`='no214',`attendance_sub_panel_student_att_report_daytime`='no215',`attendance_sub_panel_emp_att_report_daytime`='no216',`bus_sub_panel_student_list`='no217',`bus_sub_panel_add_bus_expance`='no218',`bus_sub_panel_bus_expance_report`='no219',`bus_sub_panel_student_list_bus_wise_rprt`='no220',`certificate_sub_panel_bonafide`='no221',`certificate_sub_panel_bonafide_list`='no222',`certificate_sub_panel_tue_fee`='no223',`certificate_sub_panel_tue_fee_list`='no224',`certificate_sub_panel_annual_fee`='no225',`certificate_sub_panel_annual_fee_list`='no226',`certificate_sub_panel_cast_certificate`='no227',`certificate_sub_panel_cast_certificate_list`='no228',`certificate_sub_panel_extra_printout`='no229',`certificate_sub_panel_birth_certificate`='no230',`complaint_sub_panel_employee_complaint`='no231',`download_sub_panel_attendance_list`='no232',`download_sub_panel_userid_password`='no233',`download_sub_panel_tc_list`='no374',`enquiry_sub_panel_enquiry_sms`='no234',`event_sub_panel_add_house`='no235',`event_sub_panel_assigned_house`='no236',`event_sub_panel_activity_plan`='no237',`event_sub_panel_activity_plan_list`='no238',`event_sub_panel_event_result`='no239',`event_sub_panel_event_result_list`='no240',`event_sub_panel_team_creation`='no241',`event_sub_panel_team_creation_list`='no242',`event_sub_panel_participant_list`='no243',`sub_panel_marksheet_fill_monthly`='no244',`sub_panel_marksheet_view_monthly`='no245',`exam_sub_panel_view_resultsheet`='no246',`exam_sub_panel_download_marks`='no247',`sxam_sub_panel_send_marks`='no248',`sub_panel_class_work`='no249',`sub_panel_class_work_list`='no250',`lib_sub_panel_e_stuff`='no251',`school_info_sub_panel_add_exam_type_monthly`='no252',`school_info_sub_panel_student_password_update`='no253',`school_info_sub_panel_add_fee_category`='no254',`school_info_sub_panel_add_bus_fee_category`='no255',`school_info_sub_panel_std_identity_category`='no256',`school_info_sub_panel_syllebus_detail`='no257',`add_bus_fee_category_acadmic_calender`='no258',`sms_sub_panel_add_group`='no259',`sms_sub_panel_add_group_staff`='no260',`sms_sub_panel_group_student`='no261',`sms_sub_panel_group_teacher`='no262',`sms_sub_panel_group_sms`='no263',`sms_sub_panel_bus_sms`='no264',`sms_sub_panel_group_other_contact`='no265',`sms_sub_panel_group_voice_call`='no266',`sports_sub_panel_add_sports_type`='no267',`sports_sub_panel_age_category`='no268',`sports_sub_panel_team_creation`='no269',`sports_sub_panel_team_creation_list`='no270',`staff_sub_panel_id_generate`='no271',`staff_sub_panel_assign_rfid`='no272',`staff_sub_panel_attendance_registr`='no273',`staff_sub_panel_attendance_prority`='no274',`stock_sub_panel_add_category`='no273',`stock_sub_panel_category_list`='no274',`stock_sub_panel_buy_sale`='no275',`student_sub_panel_profile_update`='no276',`student_sub_panel_mapping_data_update`='no277',`student_sub_panel_photo_update`='no278',`student_sub_panel_sms_contact_update`='no279',`student_sub_panel_web_sms`='no280',`student_sub_panel_guardian_id_card`='no281',`student_sub_panel_father_id_card`='no282',`student_sub_panel_mother_id_card`='no283',`student_sub_panel_student_strength_castwise`='no284',`student_sub_panel_student_strength_religionwise`='no285',`student_sub_panel_generate_csv`='no286',`student_sub_panel_upload_csv`='no287',`time_table_sub_panel_class_periode`='no288',`time_table_sub_panel_subjectwise_teacher`='no289',`time_table_sub_panel_teacher_mgt`='no290',`time_table_sub_panel_timetable_sheet`='no291',`time_table_sub_panel_class_periode1`='no292',`time_table_sub_panel_time_table1`='no293',`time_table_sub_panel_time_table_list1`='no294',`sub_panel_login_details`='no295',`sub_panel_student_login`='no296',`sub_panel_teacher_login`='no297',`sub_panel_move_student`='no298',`android_app_sub_panel_notification_add`='no299',`android_app_sub_panel_notification_list`='no300',`android_app_sub_panel_password_reset`='no301',`panel_notifiction`='no302',`sub_panel_website_management_notification`='no303',`sub_panel_website_management_busroute`='no304',`sub_panel_website_management_reqirectment`='no305',`sub_panel_website_management_commety`='no306',`sub_panel_website_management_slider`='no307',`sub_panel_website_management_time_table`='no308',`sub_panel_website_management_tc_upload`='no309',`sub_panel_website_management_kiosk_reg`='no310',`sub_panel_website_management_kiosk_list`='no311',`sub_panel_website_management_syllebus`='no312',`sub_panel_website_management_dashboard_marquee`='no313',`support_sub_panel_add_query`='no314',`support_sub_panel_query_list`='no315',`gatepass_sub_panel_add_new`='no316',`gatepass_sub_panel_gatepass_list`='no317',`stock_mgt_sub_panel_add_vandor`='no318',`stock_mgt_sub_panel_vandor_list`='no319',`stock_mgt_sub_panel_vandor_list_edit`='no320',`stock_mgt_sub_panel_vandor_list_delete`='no321',`stock_mgt_sub_panel_add_category`='no322',`stock_mgt_sub_panel_category_list`='no323',`stock_mgt_sub_panel_category_list_edit_button`='no324',`stock_mgt_sub_panel_category_list_delete_button`='no325',`stock_mgt_sub_panel_add_book_item`='no326',`stock_mgt_sub_panel_list_book_item`='no327',`stock_mgt_sub_panel_list_book_item_edit`='no328',`stock_mgt_sub_panel_list_book_item_delete`='no329',`stock_mgt_sub_panel_list_book_item_edit_rates`='no330',`stock_mgt_sub_panel_buy_book_item`='no331',`stock_mgt_sub_panel_buy_book_item_list`='no332',`stock_mgt_sub_panel_buy_book_item_list_edit`='no332',`stock_mgt_sub_panel_buy_book_item_list_delete`='no334',`stock_mgt_sub_panel_book_add_in_stock`='no325',`stock_mgt_sub_panel_book_add_in_stock_button`='no326',`stock_mgt_sub_panel_book_sale_item`='no327',`stock_mgt_sub_panel_book_sale_item_list`='no328',`stock_mgt_sub_panel_book_sale_item_list_cancle_button`='no329',`stock_mgt_sub_panel_book_sale_cancle_list`='no330',`stock_mgt_sub_panel_book_stock_return`='no331',`stock_mgt_sub_panel_book_stock_return_list`='no332',`stock_mgt_sub_panel_buy_book_cancle_list`='no333',`stock_mgt_sub_panel_add_item_uniform`='no334',`stock_mgt_sub_panel_list_item_uniform`='no335',`stock_mgt_sub_panel_uniform_item_edit_button`='no336',`stock_mgt_sub_panel_uniform_item_delete_button`='no337',`stock_mgt_sub_panel_uniform_item_addeditrates_button`='no338',`stock_mgt_sub_panel_uniform_buy_item`='no339',`stock_mgt_sub_panel_uniform_buy_item_list`='no340',`stock_mgt_sub_panel_uniform_buy_item_list_cancel`='no341',`fees_sub_panel_reset_months_or_installment`='no342',`fees_sub_panel_set_dues_detail`='no343',`fees_sub_panel_set_fee`='no345',`fees_sub_panel_set_fees_classwise`='no346',`fees_sub_panel_set_transport_fee_classwise`='no347',`fees_sub_panel_previous_dues`='no348',`fees_sub_panel_add_classwise_transport`='no349',`fees_sub_panel_print_chalan`='no350',`fees_sub_panel_fees_detail_by_rfid`='no351',`fees_sub_panel_dues_list_sms_print`='no352',`fees_sub_panel_demand_bill`='no353',`fees_sub_panel_student_income_tax`='no354',`fees_sub_panel_transport_reset_month`='no355',`fees_sub_panel_transport_set_dues_detail`='no356',`fees_sub_panel_transport_fees_structure`='no357',`fees_sub_panel_transport_set_fee_classwise`='no358',`fees_sub_panel_transport_pay_fee`='no359',`fees_sub_panel_transport_fee_details`='no360',`fees_sub_panel_report_panel`='no361',`fees_sub_panel_transport_reports_panel`='no362',`fees_sub_panel_bus_id_card`='no363',`fees_panel_delete_button`='no364',`fees_panel_edit_button`='no365',`fees_panel_details_button`='no366' ,`stock_mgt_sub_panel_buy_cancel_list`='no367',`stock_mgt_sub_panel_add_in_stock`='no368',`stock_mgt_sub_panel_sale_item_uniform`='no369',`stock_mgt_sub_panel_uniform_sale_list`='no370',`stock_mgt_sub_panel_uniform_sale_cancel_list`='no371',`stock_mgt_sub_panel_uniform_add_opening`='no372',`stock_mgt_reports`='no373',`sub_panel_student_admission_list_download_class_wise`='no374',`recycle_bin_sub_panel_student_list`='no375',`recycle_bin_sub_panel_emp_list`='no376',`recycle_bin_sub_panel_expance_list`='no377',`recycle_bin_sub_panel_hostal_student_list`='no378',`recycle_bin_sub_panel_hostal_account_list`='no379',`recycle_bin_sub_panel_registration_list`='no379',`student_panel_edit_button`='no380',`student_panel_delete_button`='no381',`panel_website_management`='no382',`examination_fill_marks_total_day_field`='no383',`examination_fill_marks_prasent_day_field`='no384',`examination_fill_marks_remarks_field`='no385'
 ,`account_panel_edit_button`='no386',`account_panel_delete_button`='no387',`Fess_panel_edit_button`='no388',`bus_panel_edit_button`='no389',`bus_panel_delete_button`='no390',hostal_panel_edit_delete_button='no392' WHERE user_email='$user_email'";
 mysqli_query($conn73,$query231) or die(mysqli_error($conn73));
  $query="update user_rights set $column_name,class='$class_column',section='$section_column',user_name='$user_name',user_id='$user_name',user_password='$user_password',user_email='$user_email',designation='$user_designation',user_mobile='$user_mobile',class_all='$class_all1',section_all='$section_all',$update_by_update_sql  where user_email='$user_email'";
 
 mysqli_query($conn73,$query)or die (mysqli_error($conn73));
 echo "|?|success|?|user_email=".$user_email."|?|";


?>
