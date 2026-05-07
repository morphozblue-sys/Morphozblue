<?php include("../attachment/session.php")?>
<script>
function check_all_class1(){
  if($('#id_class_check').prop('checked')) {
  		$('.check_all_class').each(function() {
		 $(this).prop('checked',true);
		});
}else{
  		$('.check_all_class').each(function() {
		 $(this).prop('checked',false);
		});
}
}

function class_wise_check(id){
  if($('#id_check_all_classwise'+id).prop('checked')) {
  		$('.check_all_classwise'+id).each(function() {
		 $(this).prop('checked',true);
		});
}else{
  		$('.check_all_classwise'+id).each(function() {
		 $(this).prop('checked',false);
		});
}
}
function class_wise_check_reverse(id){

$('#id_check_all_classwise'+id).prop('checked',true);
var x1='0';
$('.check_all_classwise'+id).each(function() {
if($(this).prop('checked')){
x1='1';
}
});
if(x1=='0'){
$('#id_check_all_classwise'+id).prop('checked',false);
}
}

function myFunction(){
var x1='0';
$('.check_all_class').each(function() {
if($(this).prop('checked')){
x1='1';
}
});
if(x1=='0'){

alert_new('Please Select Atleast One Class','red');
return false;
}
var x2='0';
$('.check_all_panel').each(function() {
if($(this).prop('checked')){
x2='1';
}
});
if(x2=='0'){

alert_new('Please Select Atleast One Panel','red');
return false;
}
return true;
}






function check_all_panel_wise(id){
  if($('#panel_'+id).prop('checked')) {
  		$('.check_'+id).each(function() {
		 $(this).prop('checked',true);
		});
}else{
  		$('.check_'+id).each(function() {
		 $(this).prop('checked',false);
		});
}
}
function check_all_panel_wise_all(id){
$('#panel_'+id).prop('checked',true);

}
function check_edit_delete(id){
  if($('#edit_delete_'+id).prop('checked')) {
$('#delete_'+id).prop('checked',true);
$('#edit_'+id).prop('checked',true);
}else{
$('#delete_'+id).prop('checked',false);
$('#edit_'+id).prop('checked',false);
}
}
function check_edit_delete_reverse(id1,id){
$('#edit_delete_'+id).prop('checked',true);
$('#panel_'+id1).prop('checked',true);
}

function check_all_panel1(){
  if($('#id_panel_check').prop('checked')) {
  		$('.check_all_panel').each(function() {
		 $(this).prop('checked',true);
		});
}else{
  		$('.check_all_panel').each(function() {
		 $(this).prop('checked',false);
		});
}
}
    function get_emp_detail(id){ 
post_content('user_right/add_user','user_email='+id);
            }
			
			
 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"user_right/add_user_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
			   alert_new('Successfully Complete','green');
			   get_content('user_right/user_list');
            }
			}
         });
      });			
			
</script>

    <section class="content-header">
      <h1>
        User Right
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('user_right/user_right')"><i class="fa fa-photo"></i> User Rights</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Add User</li>
      </ol>
    </section>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Add User</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			<form role="form" method="post"  onsubmit=" return myFunction()" id="my_form">
            <div class="box-body "  >
			
			
				 <div class="col-md-12 ">
				 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Select User</label>
						   <select   name="user_id"   placeholder=""   class="form-control select2" onchange='get_emp_detail(this.value);' >
						   <option value=''>select</option>
						   <?php
						   $que12="select * from employee_info where emp_status='Active'";
$run12=mysqli_query($conn73,$que12);
while($row12=mysqli_fetch_assoc($run12)){
	$emp_name = $row12['emp_name'];
	$emp_id = $row12['emp_id'];
	$emp_email = $row12['emp_email'];
	$emp_mobile = $row12['emp_mobile'];
	?>
	<option <?php if(isset($_GET['user_email'])){ if($_GET['user_email']==$emp_email){  echo 'selected';}} ?> value='<?php echo $emp_email ?>' ><?php echo $emp_name.'['.$emp_mobile.']' ?></option>
		<?php } ?>
		<?php 
		
		if(isset($_GET['user_email'])){
		$user_email=$_GET['user_email'];
		$que121="select * from user_rights where user_email='$user_email'";
$run121=mysqli_query($conn73,$que121);

if(mysqli_num_rows($run121)<1){
$que122="select * from employee_info where emp_email='$user_email'";
$run122=mysqli_query($conn73,$que122) or die(mysqli_error($conn73));
while($row122=mysqli_fetch_assoc($run122)){
    
	$emp_name = $row122['emp_name'];
	$emp_designation = $row122['emp_designation'];
	$emp_email = $row122['emp_email'];
	$emp_mobile = $row122['emp_mobile'];

 $query="insert into user_rights (user_name,user_email,designation ,user_mobile,$update_by_insert_sql_column) values ('$emp_name','$user_email','$emp_designation','$emp_mobile',$update_by_insert_sql_value)";
  mysqli_query($conn73,$query)or die (mysqli_error($conn73));
  		$que121="select * from user_rights where user_email='$emp_email'";
$run121=mysqli_query($conn73,$que121);
}
}
while($row23=mysqli_fetch_assoc($run121)){	
		$user_name=$row23['user_name'];
$user_id=$row23['user_id'];
$user_password=$row23['user_password'];
$user_email=$row23['user_email'];

//$panel_rights=$row23['panel_rights'];
$user_mobile=$row23['user_mobile'];
		$user_password = $row23['user_password'];
		$panel_account = $row23['panel_account'];
		$panel_attendance = $row23['panel_attendance'];
		$panel_bus = $row23['panel_bus'];
		$panel_certificate = $row23['panel_certificate'];
		$panel_complaint = $row23['panel_complaint'];
		$panel_downloads = $row23['panel_downloads'];
		$panel_dues = $row23['panel_dues'];
		$panel_enquiry = $row23['panel_enquiry'];
		$panel_event_management = $row23['panel_event_management'];
		$panel_exam_paper_setter = $row23['panel_exam_paper_setter'];
		$panel_examination = $row23['panel_examination'];
		$panel_fees = $row23['panel_fees'];
		$panel_govt_requirement = $row23['panel_govt_requirement'];
		$panel_holiday = $row23['panel_holiday'];
		$panel_homework = $row23['panel_homework'];
		$panel_hostel = $row23['panel_hostel'];
		$panel_leave = $row23['panel_leave'];
		$panel_library = $row23['panel_library'];
		$panel_recycle_bin = $row23['panel_recycle_bin'];
		$panel_reminder = $row23['panel_reminder'];
		$panel_school_info = $row23['panel_school_info'];
		$panel_sms = $row23['panel_sms'];
		$panel_sports = $row23['panel_sports'];
		$panel_student = $row23['panel_student'];
		$panel_smartclass = $row23['panel_smartclass'];
		$panel_call_management = $row23['panel_call_management'];
		$panel_classtest = $row23['panel_classtest'];
		$panel_time_table = $row23['panel_time_table'];
		$class = $row23['class'];
		$sub_panel_smartclass_video_lecture = $row23['sub_panel_smartclass_video_lecture'];
		$sub_panel_smartclass_homework = $row23['sub_panel_smartclass_homework'];
		$sub_panel_smartclass_notification = $row23['sub_panel_smartclass_notification'];
		$sub_panel_smartclass_study_material = $row23['sub_panel_smartclass_study_material'];
		$sub_panel_smartclass_online_exam = $row23['sub_panel_smartclass_online_exam'];
		$sub_panel_smartclass_smartclass_app_rights = $row23['sub_panel_smartclass_smartclass_app_rights'];
		$sub_panel_smartclass_student_user_password_change = $row23['sub_panel_smartclass_student_user_password_change'];
		$sub_panel_smartclass_result = $row23['sub_panel_smartclass_result'];
		$sub_panel_smartclass_liveclass = $row23['sub_panel_smartclass_liveclass'];
		
		if($panel_smartclass==""){
		    $panel_smartclass="yes";
		}
			if($panel_call_management==""){
		    $panel_call_management="yes";
		}
			if($panel_classtest==""){
		    $panel_classtest="yes";
		}
		

		
		
		
		
		
		
		
		
		
		
		$section = $row23['section'];
		$subject = $row23['subject'];
		$user_designation = $row23['designation'];
		$panel_utility = $row23['panel_utility'];
		$panel_user_right = $row23['panel_user_right'];
		$stream_name = $row23['stream_name'];
		$group_name = $row23['group_name'];
		$group_wise_subject = $row23['group_wise_subject'];
		$panel_gallery= $row23['panel_gallery'];
		$panel_penalty= $row23['panel_penalty'];
		$panel_staff= $row23['panel_staff'];
		$panel_stock= $row23['panel_stock'];
		$panel_session= $row23['panel_session'];
		$panel_live_bus= $row23['panel_live_bus'];
		$panel_android_app= $row23['panel_android_app'];
		$panel_software_complaint= $row23['panel_software_complaint'];
		$sub_panel_add_account= $row23['sub_panel_add_account'];
		$sub_panel_account_list= $row23['sub_panel_account_list'];
		$sub_panel_add_income_or_expence_info= $row23['sub_panel_add_income_or_expence_info'];
		$sub_panel_income_or_expence_list= $row23['sub_panel_income_or_expence_list'];
		$sub_panel_ledger= $row23['sub_panel_ledger'];
		$sub_panel_student_attendance_select= $row23['sub_panel_student_attendance_select'];
		$sub_panel_student_rfid_attendance= $row23['sub_panel_student_rfid_attendance'];
		$sub_panel_emp_rfid_attendance= $row23['sub_panel_emp_rfid_attendance'];
		$sub_panel_add_bus= $row23['sub_panel_add_bus'];
		$sub_panel_bus_list= $row23['sub_panel_bus_list'];
		$sub_panel_route_add= $row23['sub_panel_route_add'];
		$sub_panel_bus_route_add= $row23['sub_panel_bus_route_add'];
		$sub_panel_bus_route_list= $row23['sub_panel_bus_route_list'];
		$sub_panel_asigned_bus_route= $row23['sub_panel_asigned_bus_route'];
		$sub_panel_bus_employee_add= $row23['sub_panel_bus_employee_add'];
		$sub_panel_bus_employee_list= $row23['sub_panel_bus_employee_list'];
		$sub_panel_bus_purchase_list= $row23['sub_panel_bus_purchase_list'];
		$sub_panel_character_certificate_form= $row23['sub_panel_character_certificate_form'];
		$sub_panel_character_certificate_list= $row23['sub_panel_character_certificate_list'];
		$sub_panel_event_certificate_form= $row23['sub_panel_event_certificate_form'];
		$sub_panel_event_certificate_list= $row23['sub_panel_event_certificate_list'];
		$sub_panel_sport_certificate_form= $row23['sub_panel_sport_certificate_form'];
		$sub_panel_sport_certificate_list= $row23['sub_panel_sport_certificate_list'];
		$sub_panel_tc_form= $row23['sub_panel_tc_form'];
		$sub_panel_tc_list= $row23['sub_panel_tc_list'];
		$sub_panel_student_complaint= $row23['sub_panel_student_complaint'];
		$sub_panel_staff_complaint= $row23['sub_panel_staff_complaint'];
		$sub_panel_student_admission_list_download= $row23['sub_panel_student_admission_list_download'];
		$sub_panel_employee_list_download_category_wise= $row23['sub_panel_employee_list_download_category_wise'];
		$sub_panel_student_admission_list_download_class_wise=$row23['sub_panel_student_admission_list_download_class_wise'];
		$sub_panel_staff_salary_list_download_month_wise= $row23['sub_panel_staff_salary_list_download_month_wise'];
		$sub_panel_enquiry_download_date_wise= $row23['sub_panel_enquiry_download_date_wise'];
		$sub_panel_student_fee_list_download_month_wise= $row23['sub_panel_student_fee_list_download_month_wise'];
		$sub_panel_expense_list_download_month_wise= $row23['sub_panel_expense_list_download_month_wise'];
		$sub_panel_income_list_download_month_wise= $row23['sub_panel_income_list_download_month_wise'];
		$sub_panel_class_wise_dues_details= $row23['sub_panel_class_wise_dues_details'];
		$sub_panel_add_enquiry= $row23['sub_panel_add_enquiry'];
		$sub_panel_enquiry_list= $row23['sub_panel_enquiry_list'];
		$sub_panel_add_event= $row23['sub_panel_add_event'];
		$sub_panel_event_list= $row23['sub_panel_event_list'];
		$sub_panel_event_add_participate= $row23['sub_panel_event_add_participate'];
		$sub_panel_event_participate_list= $row23['sub_panel_event_participate_list'];
		$sub_panel_add_question= $row23['sub_panel_add_question'];
		$sub_panel_view_question= $row23['sub_panel_view_question'];
		$sub_panel_instant_go_to_paper_setter= $row23['sub_panel_instant_go_to_paper_setter'];
		$sub_panel_go_to_paper_setter= $row23['sub_panel_go_to_paper_setter'];
		$sub_panel_total_paper_list= $row23['sub_panel_total_paper_list'];
		$sub_panel_admit_card= $row23['sub_panel_admit_card'];
		$sub_panel_admit_card_print= $row23['sub_panel_admit_card_print'];
		$sub_panel_marksheet_fill= $row23['sub_panel_marksheet_fill'];
		$sub_panel_marksheet_view= $row23['sub_panel_marksheet_view'];
		$sub_panel_fee_structure_list= $row23['sub_panel_fee_structure_list'];
		$sub_panel_discount_types_list= $row23['sub_panel_discount_types_list'];
		$sub_panel_student_fee_add_form= $row23['sub_panel_student_fee_add_form'];
		$sub_panel_student_fee_list= $row23['sub_panel_student_fee_list'];
		$sub_panel_gallery= $row23['sub_panel_gallery'];
		$sub_panel_mapping_list= $row23['sub_panel_mapping_list'];
		$sub_panel_student_list= $row23['sub_panel_student_list'];
		$sub_panel_student_contact_list= $row23['sub_panel_student_contact_list'];
		$sub_panel_add_holiday= $row23['sub_panel_add_holiday'];
		$sub_panel_holiday_list= $row23['sub_panel_holiday_list'];
		$sub_panel_homework_add= $row23['sub_panel_homework_add'];
		$sub_panel_homework_list= $row23['sub_panel_homework_list'];
		$sub_panel_hostel_list= $row23['sub_panel_hostel_list'];
		$sub_panel_room_list= $row23['sub_panel_room_list'];
		$sub_panel_hostel_seat_avail= $row23['sub_panel_hostel_seat_avail'];
		$sub_panel_hostel_employee_add= $row23['sub_panel_hostel_employee_add'];
		$sub_panel_hostel_employee_list= $row23['sub_panel_hostel_employee_list'];
		$sub_panel_hostel_student_list= $row23['sub_panel_hostel_student_list'];
		$sub_panel_hostel_mess_menu_list= $row23['sub_panel_hostel_mess_menu_list'];
		$sub_panel_daily_mess_purchase_detail= $row23['sub_panel_daily_mess_purchase_detail'];
		$sub_panel_leave_student= $row23['sub_panel_leave_student'];
		$sub_panel_hostel_daily_entry= $row23['sub_panel_hostel_daily_entry'];
		$sub_panel_buy_item= $row23['sub_panel_buy_item'];
		$sub_panel_hostel_purchase_list= $row23['sub_panel_hostel_purchase_list'];
		$sub_panel_hostel_expenses= $row23['sub_panel_hostel_expenses'];
		$sub_panel_account_collection=$row23['sub_panel_account_collection'];
		$sub_panel_leave_form= $row23['sub_panel_leave_form'];
		$sub_panel_leave_list= $row23['sub_panel_leave_list'];
		$sub_panel_library_add_book= $row23['sub_panel_library_add_book'];
		$sub_panel_view_book_library= $row23['sub_panel_view_book_library'];
		$sub_panel_view_issued_book_list= $row23['sub_panel_view_issued_book_list'];
		$sub_panel_view_return_book_list= $row23['sub_panel_view_return_book_list'];
		$sub_panel_e_library= $row23['sub_panel_e_library'];
		$sub_panel_penalty_form= $row23['sub_panel_penalty_form'];
		$sub_panel_penalty_list= $row23['sub_panel_penalty_list'];
		$sub_panel_reminder_add= $row23['sub_panel_reminder_add'];
		$sub_panel_reminder_list= $row23['sub_panel_reminder_list'];
		$sub_panel_reminder_teacher_add= $row23['sub_panel_reminder_teacher_add'];
		$sub_panel_reminder_teacher_list= $row23['sub_panel_reminder_teacher_list'];
		$sub_panel_school_info_general= $row23['sub_panel_school_info_general'];
		$sub_panel_exam_type_add= $row23['sub_panel_exam_type_add'];
		$sub_panel_add_class= $row23['sub_panel_add_class'];
		$sub_panel_add_section= $row23['sub_panel_add_section'];
		$sub_panel_add_class_stream= $row23['sub_panel_add_class_stream'];
		$sub_panel_add_stream_group= $row23['sub_panel_add_stream_group'];
		$sub_panel_subject_add= $row23['sub_panel_subject_add'];
		$sub_panel_class_wise_subject= $row23['sub_panel_class_wise_subject'];
		$sub_panel_fee_types_add= $row23['sub_panel_fee_types_add'];
		$sub_panel_discount_types_add= $row23['sub_panel_discount_types_add'];
		$sub_panel_total_list= $row23['sub_panel_total_list'];
		$sub_panel_send= $row23['sub_panel_send'];
		$sub_panel_classwise_sms= $row23['sub_panel_classwise_sms'];
		$sub_panel_attendance_sms= $row23['sub_panel_attendance_sms'];
		$sub_panel_fee_sms= $row23['sub_panel_fee_sms'];
		$sub_panel_birthday_sms= $row23['sub_panel_birthday_sms'];
		$sub_panel_staff_sms= $row23['sub_panel_staff_sms'];
		$sub_panel_sms_templates_list= $row23['sub_panel_sms_templates_list'];
		$sub_panel_delivery_report= $row23['sub_panel_delivery_report'];
		$sub_panel_add_sports= $row23['sub_panel_add_sports'];
		$sub_panel_sports_list= $row23['sub_panel_sports_list'];
		$sub_panel_sports_add_participate= $row23['sub_panel_sports_add_participate'];
		$sub_panel_sports_participate_list= $row23['sub_panel_sports_participate_list'];
		$sub_panel_sports_photo= $row23['sub_panel_sports_photo'];
		$sub_panel_attendance_employee_add= $row23['sub_panel_attendance_employee_add'];
		$sub_panel_attendance_employee_list= $row23['sub_panel_attendance_employee_list'];
		$sub_panel_emp_attendance_select= $row23['sub_panel_emp_attendance_select'];
		$sub_panel_emp_salary_list= $row23['sub_panel_emp_salary_list'];
		$sub_panel_add_item= $row23['sub_panel_add_item'];
		$sub_panel_stock_purchase_list= $row23['sub_panel_stock_purchase_list'];
		$sub_panel_item_list= $row23['sub_panel_item_list'];
		$sub_panel_sale_list= $row23['sub_panel_sale_list'];
		$sub_panel_time_table_generate= $row23['sub_panel_time_table_generate'];
		$sub_panel_time_table_list= $row23['sub_panel_time_table_list'];
		$sub_panel_teacher_availability= $row23['sub_panel_teacher_availability'];
		$sub_panel_student_registration= $row23['sub_panel_student_registration'];
		$sub_panel_student_registration_list= $row23['sub_panel_student_registration_list'];
		$sub_panel_student_admission_list= $row23['sub_panel_student_admission_list'];
		$sub_panel_student_admission_fee_list= $row23['sub_panel_student_admission_fee_list'];
		$sub_panel_rfid_card_generate= $row23['sub_panel_rfid_card_generate'];
		$sub_panel_student_roll_no= $row23['sub_panel_student_roll_no'];
		$sub_panel_student_id_card= $row23['sub_panel_student_id_card'];
		$sub_panel_student_action= $row23['sub_panel_student_action'];
		$sub_panel_health_zone= $row23['sub_panel_health_zone'];
		$sub_panel_physical_fitness= $row23['sub_panel_physical_fitness'];
		$sub_panel_hindi_type= $row23['sub_panel_hindi_type'];
		$sub_panel_editor1= $row23['sub_panel_editor1'];
		$panel_customer_support= $row23['panel_customer_support'];
		$panel_gate_pass=$row23['panel_gate_pass'];
		$panel_stock_management=$row23['panel_stock_management'];
		$account_sub_panel_ledger_report_daily=$row23['account_sub_panel_ledger_report_daily']; 
		$account_sub_panel_ledger_report_monthly=$row23['account_sub_panel_ledger_report_monthly'];
		$account_sub_panel_income_expanece_report=$row23['account_sub_panel_income_expanece_report'];
		$attendance_sub_panel_registerwise_staff_attendance=$row23['attendance_sub_panel_registerwise_staff_attendance'];
		$attendance_sub_panel_atendance_graph=$row23['attendance_sub_panel_atendance_graph'];
		$attendance_sub_panel_student_report_daily_classwise=$row23['attendance_sub_panel_student_report_daily_classwise'];
		$attendance_sub_panel_student_report_studentwise_monthly=$row23['attendance_sub_panel_student_report_studentwise_monthly'];
		$attendance_sub_panel_emp_report_daily_categorywise=$row23['attendance_sub_panel_emp_report_daily_categorywise'];
		$attendance_sub_panel_emp_report_employeewise=$row23['attendance_sub_panel_emp_report_employeewise'];
		$attendance_sub_panel_student_att_report_daytime=$row23['attendance_sub_panel_student_att_report_daytime'];
		$attendance_sub_panel_emp_att_report_daytime=$row23['attendance_sub_panel_emp_att_report_daytime'];
		$bus_sub_panel_student_list=$row23['bus_sub_panel_student_list'];
		$bus_sub_panel_add_bus_expance=$row23['bus_sub_panel_add_bus_expance'];
		$bus_sub_panel_bus_expance_report=$row23['bus_sub_panel_bus_expance_report'];
		$bus_sub_panel_student_list_bus_wise_rprt=$row23['bus_sub_panel_student_list_bus_wise_rprt'];
		$certificate_sub_panel_bonafide=$row23['certificate_sub_panel_bonafide'];
		$certificate_sub_panel_bonafide_list=$row23['certificate_sub_panel_bonafide_list'];
		$certificate_sub_panel_tue_fee=$row23['certificate_sub_panel_tue_fee'];
		$certificate_sub_panel_tue_fee_list=$row23['certificate_sub_panel_tue_fee_list'];
		$certificate_sub_panel_annual_fee=$row23['certificate_sub_panel_annual_fee'];
		$certificate_sub_panel_annual_fee_list=$row23['certificate_sub_panel_annual_fee_list'];
		$certificate_sub_panel_cast_certificate=$row23['certificate_sub_panel_cast_certificate'];
		$certificate_sub_panel_cast_certificate_list=$row23['certificate_sub_panel_cast_certificate_list']; 
		$certificate_sub_panel_extra_printout=$row23['certificate_sub_panel_extra_printout']; 
	    $complaint_sub_panel_employee_complaint=$row23['complaint_sub_panel_employee_complaint']; 
	    $enquiry_sub_panel_enquiry_sms=$row23['enquiry_sub_panel_enquiry_sms']; 
        $download_sub_panel_attendance_list=$row23['download_sub_panel_attendance_list'];
		$download_sub_panel_userid_password=$row23['download_sub_panel_userid_password']; 
	    $event_sub_panel_add_house=$row23['event_sub_panel_add_house'];
		$event_sub_panel_assigned_house=$row23['event_sub_panel_assigned_house'];
		$event_sub_panel_activity_plan=$row23['event_sub_panel_activity_plan'];
		$event_sub_panel_activity_plan_list=$row23['event_sub_panel_activity_plan_list'];
		$event_sub_panel_event_result=$row23['event_sub_panel_event_result'];
		$event_sub_panel_event_result_list=$row23['event_sub_panel_event_result_list']; 
		$event_sub_panel_team_creation=$row23['event_sub_panel_team_creation']; 
	    $event_sub_panel_team_creation_list=$row23['event_sub_panel_team_creation_list']; 
	    $event_sub_panel_participant_list=$row23['event_sub_panel_participant_list']; 
	    $sub_panel_marksheet_fill_monthly=$row23['sub_panel_marksheet_fill_monthly']; 
	    $sub_panel_marksheet_view_monthly=$row23['sub_panel_marksheet_view_monthly'];
	    $exam_sub_panel_view_resultsheet=$row23['exam_sub_panel_view_resultsheet']; 
	    $exam_sub_panel_download_marks=$row23['exam_sub_panel_download_marks']; 
	    $sxam_sub_panel_send_marks=$row23['sxam_sub_panel_send_marks']; 
	    $sub_panel_class_work=$row23['sub_panel_class_work']; 
	    $sub_panel_class_work_list=$row23['sub_panel_class_work_list']; 
	    $lib_sub_panel_e_stuff=$row23['lib_sub_panel_e_stuff']; 
		$recycle_bin_sub_panel_student_list=$row23['recycle_bin_sub_panel_student_list']; 
	    $recycle_bin_sub_panel_emp_list=$row23['recycle_bin_sub_panel_emp_list']; 
	    $recycle_bin_sub_panel_expance_list=$row23['recycle_bin_sub_panel_expance_list']; 
	    $recycle_bin_sub_panel_hostal_student_list=$row23['recycle_bin_sub_panel_hostal_student_list']; 
	    $recycle_bin_sub_panel_hostal_account_list=$row23['recycle_bin_sub_panel_hostal_account_list']; 
	    $recycle_bin_sub_panel_registration_list=$row23['recycle_bin_sub_panel_registration_list']; 
		$school_info_sub_panel_add_exam_type_monthly=$row23['school_info_sub_panel_add_exam_type_monthly']; 
		$school_info_sub_panel_student_password_update=$row23['school_info_sub_panel_student_password_update']; 
	    $school_info_sub_panel_add_fee_category=$row23['school_info_sub_panel_add_fee_category']; 
	    $school_info_sub_panel_std_identity_category=$row23['school_info_sub_panel_add_bus_fee_category']; 
	    $school_info_sub_panel_syllebus_detail=$row23['school_info_sub_panel_syllebus_detail']; 
	    $add_bus_fee_category_acadmic_calender=$row23['add_bus_fee_category_acadmic_calender']; 
	    $school_info_sub_panel_add_bus_fee_category=$row23['school_info_sub_panel_add_bus_fee_category'];
	    $sms_sub_panel_add_group=$row23['sms_sub_panel_add_group']; 
		$sms_sub_panel_add_group_staff=$row23['sms_sub_panel_add_group_staff']; 
	    $sms_sub_panel_group_student=$row23['sms_sub_panel_group_student']; 
	    $sms_sub_panel_group_teacher=$row23['sms_sub_panel_group_teacher']; 
	    $sms_sub_panel_group_sms=$row23['sms_sub_panel_group_sms']; 
	    $sms_sub_panel_bus_sms=$row23['sms_sub_panel_bus_sms']; 
	    $sms_sub_panel_group_other_contact=$row23['sms_sub_panel_group_other_contact'];
	    $sms_sub_panel_group_voice_call=$row23['sms_sub_panel_group_voice_call'];
	    $sports_sub_panel_add_sports_type=$row23['sports_sub_panel_add_sports_type']; 
	    $sports_sub_panel_age_category=$row23['sports_sub_panel_age_category']; 
	    $sports_sub_panel_team_creation=$row23['sports_sub_panel_team_creation'];
	    $sports_sub_panel_team_creation_list=$row23['sports_sub_panel_team_creation_list'];
		$staff_sub_panel_drop_list=$row23['staff_sub_panel_drop_list'];
	    $staff_sub_panel_id_generate=$row23['staff_sub_panel_id_generate']; 
	    $staff_sub_panel_assign_rfid=$row23['staff_sub_panel_assign_rfid']; 
	    $staff_sub_panel_attendance_registr=$row23['staff_sub_panel_attendance_registr'];
	    $staff_sub_panel_attendance_prority=$row23['staff_sub_panel_attendance_prority'];
	    $stock_sub_panel_add_category=$row23['stock_sub_panel_add_category']; 
	    $stock_sub_panel_category_list=$row23['stock_sub_panel_category_list'];
	    $stock_sub_panel_buy_sale=$row23['stock_sub_panel_buy_sale'];
	    $student_sub_panel_profile_update=$row23['student_sub_panel_profile_update'];
	    $student_sub_panel_mapping_data_update=$row23['student_sub_panel_mapping_data_update'];
	    $student_sub_panel_photo_update=$row23['student_sub_panel_photo_update'];
	    $student_sub_panel_sms_contact_update=$row23['student_sub_panel_sms_contact_update'];
	    $student_sub_panel_web_sms=$row23['student_sub_panel_web_sms'];
	    $student_sub_panel_guardian_id_card=$row23['student_sub_panel_guardian_id_card'];
	    $student_sub_panel_father_id_card=$row23['student_sub_panel_father_id_card'];
	    $student_sub_panel_mother_id_card=$row23['student_sub_panel_mother_id_card'];
	    $student_sub_panel_student_strength_castwise=$row23['student_sub_panel_student_strength_castwise'];
	    $student_sub_panel_student_strength_religionwise=$row23['student_sub_panel_student_strength_religionwise'];
	    $student_sub_panel_generate_csv=$row23['student_sub_panel_generate_csv'];
	    $student_sub_panel_upload_csv=$row23['student_sub_panel_upload_csv'];
	    $student_panel_edit_button=$row23['student_panel_edit_button'];
	    $student_panel_delete_button=$row23['student_panel_delete_button'];
	    $time_table_sub_panel_class_periode=$row23['time_table_sub_panel_class_periode'];
	    $time_table_sub_panel_subjectwise_teacher=$row23['time_table_sub_panel_subjectwise_teacher'];
	    $time_table_sub_panel_teacher_mgt=$row23['time_table_sub_panel_teacher_mgt'];
	    $time_table_sub_panel_timetable_sheet=$row23['time_table_sub_panel_timetable_sheet'];
	    $time_table_sub_panel_class_periode1=$row23['time_table_sub_panel_class_periode1'];
	    $time_table_sub_panel_time_table1=$row23['time_table_sub_panel_time_table1'];
	    $time_table_sub_panel_time_table_list1=$row23['time_table_sub_panel_time_table_list1'];
	    $sub_panel_login_details=$row23['sub_panel_login_details'];
	    $sub_panel_student_login=$row23['sub_panel_student_login'];
	    $sub_panel_teacher_login=$row23['sub_panel_teacher_login'];
	    $sub_panel_add_session=$row23['sub_panel_add_session'];
	    $sub_panel_move_student=$row23['sub_panel_move_student'];
	    $android_app_sub_panel_notification_add=$row23['android_app_sub_panel_notification_add'];
	    $android_app_sub_panel_notification_list=$row23['android_app_sub_panel_notification_list'];
	    $android_app_sub_panel_password_reset=$row23['android_app_sub_panel_password_reset'];
	    $panel_notifiction=$row23['panel_notifiction'];
	    $sub_panel_website_management_notification=$row23['sub_panel_website_management_notification'];
	    $sub_panel_website_management_busroute=$row23['sub_panel_website_management_busroute'];
	    $sub_panel_website_management_reqirectment=$row23['sub_panel_website_management_reqirectment'];
	    $sub_panel_website_management_commety=$row23['sub_panel_website_management_commety'];
	    $sub_panel_website_management_slider=$row23['sub_panel_website_management_slider'];
	    $sub_panel_website_management_time_table=$row23['sub_panel_website_management_time_table'];
	    $sub_panel_website_management_tc_upload=$row23['sub_panel_website_management_tc_upload'];
	    $sub_panel_website_management_kiosk_reg=$row23['sub_panel_website_management_kiosk_reg'];
	    $sub_panel_website_management_kiosk_list=$row23['sub_panel_website_management_kiosk_list'];
	    $sub_panel_website_management_syllebus=$row23['sub_panel_website_management_syllebus'];
	    $sub_panel_website_management_dashboard_marquee=$row23['sub_panel_website_management_dashboard_marquee'];
	    $support_sub_panel_add_query=$row23['support_sub_panel_add_query'];
	    $support_sub_panel_query_list=$row23['support_sub_panel_query_list'];
	    $gatepass_sub_panel_add_new=$row23['gatepass_sub_panel_add_new'];
	    $gatepass_sub_panel_gatepass_list=$row23['gatepass_sub_panel_gatepass_list'];
	    $stock_mgt_sub_panel_add_vandor=$row23['stock_mgt_sub_panel_add_vandor'];
	    $stock_mgt_sub_panel_vandor_list=$row23['stock_mgt_sub_panel_vandor_list'];
	    $stock_mgt_sub_panel_vandor_list_edit=$row23['stock_mgt_sub_panel_vandor_list_edit'];
	    $stock_mgt_sub_panel_vandor_list_delete=$row23['stock_mgt_sub_panel_vandor_list_delete'];
	    $stock_mgt_sub_panel_add_category=$row23['stock_mgt_sub_panel_add_category'];
	    $stock_mgt_sub_panel_category_list=$row23['stock_mgt_sub_panel_category_list'];
	    $stock_mgt_sub_panel_category_list_edit_button=$row23['stock_mgt_sub_panel_category_list_edit_button'];
	    $stock_mgt_sub_panel_category_list_delete_button=$row23['stock_mgt_sub_panel_category_list_delete_button'];
	    $stock_mgt_sub_panel_add_book_item=$row23['stock_mgt_sub_panel_add_book_item'];
	    $stock_mgt_sub_panel_list_book_item=$row23['stock_mgt_sub_panel_list_book_item'];
	    $stock_mgt_sub_panel_list_book_item_edit=$row23['stock_mgt_sub_panel_list_book_item_edit'];
	    $stock_mgt_sub_panel_list_book_item_delete=$row23['stock_mgt_sub_panel_list_book_item_delete'];
	    $stock_mgt_sub_panel_list_book_item_edit_rates=$row23['stock_mgt_sub_panel_list_book_item_edit_rates'];
	    $stock_mgt_sub_panel_buy_book_item=$row23['stock_mgt_sub_panel_buy_book_item'];
	    $stock_mgt_sub_panel_buy_book_item_list=$row23['stock_mgt_sub_panel_buy_book_item_list'];
	    $stock_mgt_sub_panel_buy_book_item_list_edit=$row23['stock_mgt_sub_panel_buy_book_item_list_edit'];
	    $stock_mgt_sub_panel_buy_book_item_list_delete=$row23['stock_mgt_sub_panel_buy_book_item_list_delete'];
	    $stock_mgt_sub_panel_buy_book_cancle_list=$row23['stock_mgt_sub_panel_buy_book_cancle_list'];
	    $stock_mgt_sub_panel_book_add_in_stock=$row23['stock_mgt_sub_panel_book_add_in_stock'];
	    $stock_mgt_sub_panel_book_add_in_stock_button=$row23['stock_mgt_sub_panel_book_add_in_stock_button'];
	    $stock_mgt_sub_panel_book_sale_item=$row23['stock_mgt_sub_panel_book_sale_item'];
	    $stock_mgt_sub_panel_book_sale_item_list=$row23['stock_mgt_sub_panel_book_sale_item_list'];
	    $stock_mgt_sub_panel_book_sale_item_list_cancle_button=$row23['stock_mgt_sub_panel_book_sale_item_list_cancle_button'];
	    $stock_mgt_sub_panel_book_sale_cancle_list=$row23['stock_mgt_sub_panel_book_sale_cancle_list'];
	    $stock_mgt_sub_panel_book_stock_return=$row23['stock_mgt_sub_panel_book_stock_return'];
	    $stock_mgt_sub_panel_book_stock_return_list=$row23['stock_mgt_sub_panel_book_stock_return_list'];
		$stock_mgt_sub_panel_add_item_uniform=$row23['stock_mgt_sub_panel_add_item_uniform'];
	    $stock_mgt_sub_panel_list_item_uniform=$row23['stock_mgt_sub_panel_list_item_uniform'];
	    $stock_mgt_sub_panel_uniform_item_edit_button=$row23['stock_mgt_sub_panel_uniform_item_edit_button'];
	    $stock_mgt_sub_panel_uniform_item_delete_button=$row23['stock_mgt_sub_panel_uniform_item_delete_button'];
	    $stock_mgt_sub_panel_uniform_item_addeditrates_button=$row23['stock_mgt_sub_panel_uniform_item_addeditrates_button'];
	    $stock_mgt_sub_panel_uniform_buy_item=$row23['stock_mgt_sub_panel_uniform_buy_item'];
	    $stock_mgt_sub_panel_uniform_buy_item_list=$row23['stock_mgt_sub_panel_uniform_buy_item_list'];
	    $stock_mgt_sub_panel_uniform_buy_item_list_cancel=$row23['stock_mgt_sub_panel_uniform_buy_item_list_cancel'];
	    $download_sub_panel_tc_list=$row23['download_sub_panel_tc_list'];
	    $recycle_sub_panel_reset_delete_button=$row23['recycle_sub_panel_reset_delete_button'];
	    $hostal_panel_edit_delete_button= $row23['hostal_panel_edit_delete_button'];
	    
	    
	    
	    
	    
	    $fees_sub_panel_reset_months_or_installment=$row23['fees_sub_panel_reset_months_or_installment'];
	    $fees_sub_panel_set_dues_detail=$row23['fees_sub_panel_set_dues_detail'];
	    $fees_sub_panel_set_fee=$row23['fees_sub_panel_set_fee'];
	    $fees_sub_panel_set_fees_classwise=$row23['fees_sub_panel_set_fees_classwise'];
	    $fees_sub_panel_set_transport_fee_classwise=$row23['fees_sub_panel_set_transport_fee_classwise'];
	    $fees_sub_panel_previous_dues=$row23['fees_sub_panel_previous_dues'];
	    $fees_sub_panel_add_classwise_transport=$row23['fees_sub_panel_add_classwise_transport'];
	    $fees_sub_panel_print_chalan=$row23['fees_sub_panel_print_chalan'];
	    $fees_sub_panel_fees_detail_by_rfid=$row23['fees_sub_panel_fees_detail_by_rfid'];
	    $fees_sub_panel_dues_list_sms_print=$row23['fees_sub_panel_dues_list_sms_print'];
	    $fees_sub_panel_demand_bill=$row23['fees_sub_panel_demand_bill'];
	    $fees_sub_panel_student_income_tax=$row23['fees_sub_panel_student_income_tax'];
		$fees_sub_panel_transport_reset_month=$row23['fees_sub_panel_transport_reset_month'];
	    $fees_sub_panel_transport_set=$row23['fees_sub_panel_transport_set'];
	    $fees_sub_panel_transport_fees_structure=$row23['fees_sub_panel_transport_fees_structure'];
	    $fees_sub_panel_transport_set_fee_classwise=$row23['fees_sub_panel_transport_set_fee_classwise'];
	    $fees_sub_panel_transport_pay_fee=$row23['fees_sub_panel_transport_pay_fee'];
	    $fees_sub_panel_transport_fee_details=$row23['fees_sub_panel_transport_fee_details'];
	    $fees_sub_panel_report_panel=$row23['fees_sub_panel_report_panel'];
	    $fees_sub_panel_transport_reports_panel=$row23['fees_sub_panel_transport_reports_panel'];
	    $fees_sub_panel_bus_id_card=$row23['fees_sub_panel_bus_id_card'];
	    $fees_panel_delete_button=$row23['fees_panel_delete_button'];
	    $fees_panel_edit_button=$row23['fees_panel_edit_button'];
	    $fees_panel_details_button=$row23['fees_panel_details_button'];
	    
	    
	    
	    $stock_mgt_sub_panel_buy_cancel_list=$row23['stock_mgt_sub_panel_buy_cancel_list'];
	    $stock_mgt_sub_panel_add_in_stock=$row23['stock_mgt_sub_panel_add_in_stock'];
	    $stock_mgt_sub_panel_sale_item_uniform=$row23['stock_mgt_sub_panel_sale_item_uniform'];
	    $stock_mgt_sub_panel_uniform_sale_list=$row23['stock_mgt_sub_panel_uniform_sale_list'];
	    $stock_mgt_sub_panel_uniform_sale_cancel_list=$row23['stock_mgt_sub_panel_uniform_sale_cancel_list'];
	    $stock_mgt_sub_panel_uniform_add_opening=$row23['stock_mgt_sub_panel_uniform_add_opening'];
	    $stock_mgt_reports=$row23['stock_mgt_reports'];
	    $fees_sub_panel_transport_set_dues_detail=$row23['fees_sub_panel_transport_set_dues_detail'];
	    $certificate_sub_panel_birth_certificate=$row23['certificate_sub_panel_birth_certificate'];
	    
	    $examination_fill_marks_total_day_field= $row23['examination_fill_marks_total_day_field'];
		$examination_fill_marks_prasent_day_field=$row23['examination_fill_marks_prasent_day_field'];
		$examination_fill_marks_remarks_field= $row23['examination_fill_marks_remarks_field'];
		$panel_important= $row23['panel_important'];
		
		
		$account_panel_edit_button=$row23['account_panel_edit_button'];
		$account_panel_delete_button= $row23['account_panel_delete_button'];
		$Fess_panel_edit_button= $row23['Fess_panel_edit_button'];
		
		$bus_panel_edit_button= $row23['bus_panel_edit_button'];
		$bus_panel_delete_button= $row23['bus_panel_delete_button'];
	    
$sub_panel_account_list_edit= $row23['sub_panel_account_list_edit'];
$sub_panel_income_or_expence_list_edit= $row23['sub_panel_income_or_expence_list_edit'];
$sub_panel_account_list_delete= $row23['sub_panel_account_list_delete'];
$sub_panel_income_or_expence_list_delete= $row23['sub_panel_income_or_expence_list_delete'];
$sub_panel_submission_date_change= $row23['sub_panel_submission_date_change'];
$sub_panel_fee_list_delete= $row23['sub_panel_fee_list_delete'];
		$sub_panel_sm_vendor_add=$row['sub_panel_sm_vendor_add'];
$sub_panel_sm_item_category_add=$row['sub_panel_sm_item_category_add'];
$sub_panel_sm_item_add=$row['sub_panel_sm_item_add'];
$sub_panel_sm_item_list=$row['sub_panel_sm_item_list'];
$sub_panel_sm_item_sale=$row['sub_panel_sm_item_sale'];
$sub_panel_sm_item_sale_list=$row['sub_panel_sm_item_sale_list'];
$sub_panel_sm_report_item_availability=$row['sub_panel_sm_report_item_availability'];
$sub_panel_sm_report_sales=$row['sub_panel_sm_report_sales'];
$sub_panel_sm_report_sales_itemwise=$row['sub_panel_sm_report_sales_itemwise'];
	}	
		
		?>
	</select>

						</div>
			</div>
			
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label>User Name</label>
						   <input type="text"  name="user_name"  id='user_name' placeholder="User Name"  value="<?php echo $user_name; ?>" class="form-control " required />
						</div>
			</div>
	

				 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Email</label>
						   <input type="email"  name="user_email"  id='user_email' placeholder="Email"  value="<?php echo $user_email; ?>" class="form-control " required readonly />
						</div>
			</div>
				 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Mobile</label>
						   <input type="text"  name="user_mobile"  id='user_mobile' placeholder="Mobile"  value="<?php echo $user_mobile; ?>" class="form-control " required />
						</div>
			</div>
				 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Designation</label>
						   <input type="text"  name="user_designation"  id='user_designation' placeholder="Designation"  value="<?php echo $user_designation; ?>" class="form-control " required />
						</div>
			</div>
						 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Password</label>
						   <input type="text"  name="user_password"  id='user_password' placeholder="Password"  value="<?php echo $user_password; ?>" class="form-control " required />
						</div>
			</div>
			</div>

	
	</div>
	
	     
			          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title">Panel Rights</h3>  
			  <input type="checkbox"   id="id_panel_check"   onclick="check_all_panel1()" />
				     <label>Check All</label>
            </div>
            <!-- /.box-header -->
          
                        <div class="box-body table-responsive">
              <table id="" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th style='width:50px'>S No</th>
                  <th style='width:200px' colspan="2">Main Head</th>
                  <th colspan="12">Sub Head</th>
				 </tr>
				   <tr>
                  <th style='width:50px'></th>
                  <th style='width:25px'></th>
                  <th style='width:200px'></th>
                  <th style='width:25px'></th>
                  <th style='width:200px'></th>
				  <th style='width:25px'></th>
                  <th style='width:200px'></th>
				  <th style='width:25px'></th>
                  <th style='width:200px'></th>
				  <th style='width:25px'></th>
                  <th style='width:200px'></th>
				  <th style='width:25px'></th>
                  <th style='width:200px'></th>
				  <th style='width:25px'></th>
                  <th style='width:200px'></th>
				 </tr>
                </thead>
		
		<tbody>
                	<!-- /.Account start -->	
            
              			 <tr >
						 <td  rowspan="3">1</td>
						 <td  rowspan="3">
						   <input type="checkbox"  name="panel_rights[]" id="panel_1" onclick="check_all_panel_wise('1')" <?php if($panel_account=='yes'){ echo 'checked'; } ?> class="check_all_panel"  value="panel_account"/>
			              </td>
			              <td rowspan="3">
						  <label>Account</label>
			              </td>
			              </td>
			              <td rowspan="3">
						  <input type="checkbox" <?php if($sub_panel_add_account=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1"   onclick="check_all_panel_wise_all('1')" value="sub_panel_add_account"   />
						  </td>
						  <td rowspan="3" >
						  <label>Add Account</label>
						   </td>
						
						 
							 </td>
						  <td rowspan="3"><input type="checkbox" <?php if($sub_panel_add_income_or_expence_info=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1"   onclick="check_all_panel_wise_all('1')" value="sub_panel_add_income_or_expence_info"   />
							  </td>
						  <td rowspan="3">
			                <label>Add Income Or Expence Info</label>
							 </td>
							 <td rowspan="3">
							 
							 <input type="checkbox" <?php if($sub_panel_ledger=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1"   onclick="check_all_panel_wise_all('1')" value="sub_panel_ledger"   />
			                </td>
						  <td rowspan="3"><label>Ledger</label>
						 </td>
							   <td>
							<input type="checkbox" <?php if($sub_panel_account_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1 " id="edit_delete_1"  onclick="check_all_panel_wise_all('1');check_edit_delete('1');" value="sub_panel_account_list"   /> </td>
						  <td>
			                <label>Account List</label>
						  </td>
						  <td >
							 
							 <input type="checkbox" <?php if($sub_panel_income_or_expence_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1 "  id="edit_delete_2" onclick="check_all_panel_wise_all('1');check_edit_delete('2');" value="sub_panel_income_or_expence_list"   />
			                </td>
						  <td ><label>Income Or Expence List</label>
							 </td>
							 
						<td>
						  <input type="checkbox" <?php if($account_sub_panel_ledger_report_daily=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1 "  id="edit_delete_2" onclick="check_all_panel_wise_all('1');check_edit_delete('2');" value="account_sub_panel_ledger_report_daily"   />
			            </td>
						<td >
						   <label>Ledger Report daily</label>
						</td>	 
						</tr>
							 
						  
						 
						 <tr>
						  <td><input type="checkbox" <?php if($sub_panel_account_list_edit=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1 "   onclick="check_all_panel_wise_all('1');check_edit_delete_reverse('1','1')" id="edit_1" value="sub_panel_account_list_edit" />
			                 </td>
						  <td><label style="color:orange">Edit</label>
									   </td>
									     <td>
							 
							 <input type="checkbox" <?php if($account_panel_edit_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1 "   onclick="check_all_panel_wise_all('1');check_edit_delete_reverse('1','2')"  id="edit_2" value="account_panel_edit_button"   />
			                </td>
						  <td><label  style="color:orange">Edit</label>
							 </td>
						 </tr>
						 <tr>
						 	  <td><input type="checkbox" <?php if($sub_panel_account_list_delete=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1 "   onclick="check_all_panel_wise_all('1');check_edit_delete_reverse('1','1')"  id="delete_1" value="sub_panel_account_list_delete"  />
			                 </td>
						  <td> <label style="color:red">Delete</label>
						    <td>
							 
							 <input type="checkbox" <?php if($account_panel_delete_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1 "  id="delete_2"  onclick="check_all_panel_wise_all('1');check_edit_delete_reverse('1','2')" value="account_panel_delete_button"   />
			                </td>
						  <td><label  style="color:red">Delete</label>
							 </td>
						 </tr>
						 
						 
						 <tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						
						<td>
						  <input type="checkbox" <?php if($account_sub_panel_ledger_report_monthly=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1 "  id="edit_delete_2" onclick="check_all_panel_wise_all('1');check_edit_delete('2');" value="account_sub_panel_ledger_report_monthly"   />
			            </td>
						<td >
						   <label>Ledger Report Monthly</label>
						</td>
						 
						 <td>
						  <input type="checkbox" <?php if($account_sub_panel_income_expanece_report=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_1 "  id="edit_delete_2" onclick="check_all_panel_wise_all('1');check_edit_delete('2');" value="account_sub_panel_income_expanece_report"   />
			            </td>
						<td >
						   <label>Income Expanece Report</label>
						</td>
						 
						 </tr>
					<!-- /.Account End -->	 
					<!-- /.Attedace start -->	 
						<td>2</td>
						 <td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_2" onclick="check_all_panel_wise('2')" <?php if($panel_attendance=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_attendance"   />  </td>
						  <td>
			                  <label>Attendance</label>  </td>
						  <td>
							 <input type="checkbox" <?php if($sub_panel_student_attendance_select=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="sub_panel_student_attendance_select"   />  </td>
						  <td>
			                  <label>Student Attendance Select</label>  </td>
						  <td>
			                 
						 <input type="checkbox" <?php if($sub_panel_emp_attendance_select=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="sub_panel_emp_attendance_select"   />  </td>
						  <td><label>Emp Attendance Select</label>   </td>
						  <td>
							 
			                 <input type="checkbox" <?php if($sub_panel_student_rfid_attendance=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="sub_panel_student_rfid_attendance"   />  </td>
						  <td> <label>Student Rfid Attendance</label>  </td>
						  <td>
							 
			                <input type="checkbox" <?php if($sub_panel_emp_rfid_attendance=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="sub_panel_emp_rfid_attendance"   />  </td>
						  <td><label>Emp Rfid Attendance</label>
							
							</td>
							
						 <td>
						  <input type="checkbox" <?php if($attendance_sub_panel_registerwise_staff_attendance=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="attendance_sub_panel_registerwise_staff_attendance"   /> 
						 </td> 
						<td>
						  <label>Emp Registerwise Att</label>
						</td>	
							
						<td>
						  <input type="checkbox" <?php if($attendance_sub_panel_atendance_graph=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="attendance_sub_panel_atendance_graph"   /> 
						 </td> 
						<td>
						  <label>Attendance Graph</label>
						</td>	
					     </tr>
					     <tr>
					     <td></td>     
					     <td></td>     
					     <td></td>     
					     <td>
						  <input type="checkbox" <?php if($attendance_sub_panel_student_report_daily_classwise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="attendance_sub_panel_student_report_daily_classwise"   /> 
						 </td> 
						<td>
						  <label>Std Report Classwise</label>
						</td>	
							
						<td>
						  <input type="checkbox" <?php if($attendance_sub_panel_student_report_studentwise_monthly=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="attendance_sub_panel_student_report_studentwise_monthly"   /> 
						 </td> 
						<td>
						  <label>Attendance report studentwise monthly</label>
						</td> 
					      
					    <td>
						  <input type="checkbox" <?php if($attendance_sub_panel_emp_report_daily_categorywise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="attendance_sub_panel_emp_report_daily_categorywise"   /> 
						 </td> 
						<td>
						  <label>Emp report daily categorywise</label>
						</td>    
					         
					   <td>
						  <input type="checkbox" <?php if($attendance_sub_panel_emp_report_employeewise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="attendance_sub_panel_emp_report_employeewise"   /> 
						 </td> 
						<td>
						  <label>Emp report empwise</label>
						</td>    
						
						<td>
						  <input type="checkbox" <?php if($attendance_sub_panel_student_att_report_daytime=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="attendance_sub_panel_student_att_report_daytime"   /> 
						 </td> 
						<td>
						  <label>Std report day with Time</label>
						</td>
						
						<td>
						  <input type="checkbox" <?php if($attendance_sub_panel_emp_att_report_daytime=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_2"   onclick="check_all_panel_wise_all('2')" value="attendance_sub_panel_emp_att_report_daytime"   /> 
						 </td> 
						<td>
						  <label>Emp report day with Time</label>
						</td>
						
					         
						 </tr>   
						    <tr><td rowspan="2">3</td><td rowspan="2">
					   <input type="checkbox"  name="panel_rights[]" id="panel_3" onclick="check_all_panel_wise('3')" <?php if($panel_bus=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_bus"   />
						    </td><td rowspan="2"><label>Bus</label></td>
						<td>
						
						<input type="checkbox" <?php if($sub_panel_add_bus=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="sub_panel_add_bus"   />
			                    </td><td><label>Add Bus</label></td><td>
							  
					             <input type="checkbox" <?php if($sub_panel_bus_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="sub_panel_bus_list"   />
					      </td><td><label>Bus List</label></td><td>
						
						<input type="checkbox" <?php if($sub_panel_route_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="sub_panel_route_add"   />
						     </td><td><label>Route Add</label></td><td>
						
						        <input type="checkbox" <?php if($sub_panel_bus_route_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="sub_panel_bus_route_add"   />
			                    </td><td><label>Bus Route Add</label></td><td>
							  
							  
				             <input type="checkbox" <?php if($sub_panel_bus_route_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="sub_panel_bus_route_list"   />
			                    </td><td><label>Bus Route List</label></td><td>	

						<input type="checkbox" <?php if($sub_panel_asigned_bus_route=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="sub_panel_asigned_bus_route"   />
						  </td><td><label>Asigned Bus Route</label></td>
						</tr>
						<tr>
						<td>	
						   <input type="checkbox" <?php if($sub_panel_bus_employee_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="sub_panel_bus_employee_add"   />
						  </td><td><label>Bus Employee Add</label></td><td>

						<input type="checkbox" <?php if($sub_panel_bus_employee_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="sub_panel_bus_employee_list"   />
						  </td><td><label>Bus Employee List</label></td>
						  
						  <td>
						     <input type="checkbox" <?php if($sub_panel_bus_purchase_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="sub_panel_bus_purchase_list"   />
						  </td>
						  <td><label>Bus Purchase List</label></td>
						  
						  <td>
						     <input type="checkbox" <?php if($bus_sub_panel_student_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="bus_sub_panel_student_list"   />
						  </td>
						  <td><label>Bus student List</label></td>
						  
						  <td>
						     <input type="checkbox" <?php if($bus_sub_panel_add_bus_expance=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="bus_sub_panel_add_bus_expance"   />
						  </td>
						  <td><label>Add Bus Expance</label></td>
						
						
						  <td>
						     <input type="checkbox" <?php if($bus_sub_panel_bus_expance_report=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="bus_sub_panel_bus_expance_report"   />
						  </td>
						  <td><label>student Bus Expance Report</label></td>
						</tr>
						
						<tr>
						   <td></td> 
						   <td></td> 
						   <td></td> 
						   <td>
						     <input type="checkbox" <?php if($bus_sub_panel_student_list_bus_wise_rprt=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="bus_sub_panel_student_list_bus_wise_rprt"   />
						  </td>
						  <td><label>student Bus Report buswise</label></td> 
						  
						  
						  <td>
						     <input type="checkbox" <?php if($bus_panel_edit_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="bus_panel_edit_button"   />
						  </td>
						  <td>
						     <label style="color:red;">Bus Panel Edit Button</label>
						  </td>
						  
						  <td>
						     <input type="checkbox" <?php if($bus_panel_delete_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_3"   onclick="check_all_panel_wise_all('3')" value="bus_panel_delete_button"   />
						  </td>
						  <td>
						     <label style="color:red;">Bus Panel Delete Button</label>
						  </td>
						  
						</tr>
						
						
						    <tr><td rowspan="2">4</td><td rowspan="2">
						   <input type="checkbox"  name="panel_rights[]" id="panel_4" onclick="check_all_panel_wise('4')" <?php if($panel_certificate=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_certificate"   />
			                  </td><td rowspan="2"><label>Certificate</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_character_certificate_form=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="sub_panel_character_certificate_form"   />
			                  </td><td><label>Character Certificate Form</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_character_certificate_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="sub_panel_character_certificate_list"   />
			                  </td><td><label>Character Certificate List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_event_certificate_form=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="sub_panel_event_certificate_form"   />
			                  </td><td><label>Event Certificate Form</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_event_certificate_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="sub_panel_event_certificate_list"   />
			                  </td><td><label>Event Certificate List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_sport_certificate_form=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="sub_panel_sport_certificate_form"   />
			                  </td><td><label>Sport Certificate Form</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_sport_certificate_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="sub_panel_sport_certificate_list"   />
			                  </td><td><label>Sport Certificate List</label></td>
							  </tr>
							<tr>
							  <td>
							
							<input type="checkbox" <?php if($sub_panel_tc_form=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="sub_panel_tc_form"   />
							
			                  </td><td><label>Tc Form</label></td>
							  <td>
							
							     <input type="checkbox" <?php if($sub_panel_tc_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="sub_panel_tc_list"   />
			                  </td><td><label>Tc List</label></td>
			                  
			                  <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_bonafide=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_bonafide"   />
			                  </td>
			                  <td><label>Bonafied Certificate</label></td>
			                  
			                  <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_bonafide_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_bonafide_list"   />
			                  </td>
			                  <td><label>Bonafied Certificate List</label></td>
			                  
			                  <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_tue_fee=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_tue_fee"   />
			                  </td>
			                  <td><label>Tue Fee Certificate</label></td>
			                  
			                   <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_tue_fee_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_tue_fee_list"   />
			                  </td>
			                  <td><label>Tue Fee Certificate List</label></td>
			                  </tr>
							 <tr>
							     <td></td>
							     <td></td>
							     <td></td>
							    <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_annual_fee=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_annual_fee"   />
			                  </td>
			                  <td><label>Annual Certificate</label></td> 
			                  
			                  <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_annual_fee_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_annual_fee_list"   />
			                  </td>
			                  <td><label>Annual Certificate List</label></td>
			                  
			                  <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_cast_certificate=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_cast_certificate"   />
			                  </td>
			                  <td><label>Cast Certificate</label></td>
			                  
			                  <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_cast_certificate_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_cast_certificate_list"   />
			                  </td>
			                  <td><label>Cast Certificate List</label></td>
			                  
			                  <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_birth_certificate=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_birth_certificate"   />
			                  </td>
			                  <td><label>Birth Certificate Print Out</label></td>
			                  
			                  <td>
							     <input type="checkbox" <?php if($certificate_sub_panel_extra_printout=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_4"   onclick="check_all_panel_wise_all('4')" value="certificate_sub_panel_extra_printout"   />
			                  </td>
			                  <td><label>other Print Out</label></td>
			                  
							 </tr>
							
						    <tr><td>5</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_5" onclick="check_all_panel_wise('5')" <?php if($panel_complaint=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_complaint"   />
			                  </td><td><label>Complaints</label></td>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_student_complaint=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_5"   onclick="check_all_panel_wise_all('5')" value="sub_panel_student_complaint"   />
			                  </td><td><label>Student Complaint</label></td>
			              <td>
						      <input type="checkbox" <?php if($sub_panel_staff_complaint=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_5"   onclick="check_all_panel_wise_all('5')" value="sub_panel_staff_complaint"   />
			              </td>
			              <td><label>Staff Complaint</label>
			              </td>
			              
			              <td>
						      <input type="checkbox" <?php if($complaint_sub_panel_employee_complaint=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_5"   onclick="check_all_panel_wise_all('5')" value="complaint_sub_panel_employee_complaint"   />
			              </td>
			              <td>
			                  <label>Employee Complaint</label>
			              </td>
			              
			              
			              <td>						  
						  </td></tr>
						  
						  
						  
						    <tr><td rowspan="2">6</td><td rowspan="2">
						   <input type="checkbox"  name="panel_rights[]" id="panel_6" onclick="check_all_panel_wise('6')" <?php if($panel_downloads=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_downloads"   />
			                  </td><td rowspan="2"><label>Downloads</label></td>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_student_admission_list_download_class_wise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="sub_panel_student_admission_list_download_class_wise"   />
			                  </td><td><label>Student Admission List Download Class Wise</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_employee_list_download_category_wise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="sub_panel_employee_list_download_category_wise"   />
			                  </td><td><label>Employee List Download Category Wise</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_staff_salary_list_download_month_wise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="sub_panel_staff_salary_list_download_month_wise"   />
			                  </td><td><label>Staff Salary List Download Month Wise</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_enquiry_download_date_wise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="sub_panel_enquiry_download_date_wise"   />
			                  </td><td><label>Enquiry Download Date Wise</label></td><td>
						 
						  
						  <input type="checkbox" <?php if($sub_panel_student_fee_list_download_month_wise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="sub_panel_student_fee_list_download_month_wise"   />
			                  </td><td><label>Student Fee List Download Month Wise</label></td><td>
							
						  <input type="checkbox" <?php if($sub_panel_expense_list_download_month_wise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="sub_panel_expense_list_download_month_wise"   />
			                  </td><td><label>Expense List Download Month Wise</label></td>
							</tr>
							<tr>
							<td>
							 <input type="checkbox" <?php if($sub_panel_income_list_download_month_wise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="sub_panel_income_list_download_month_wise"   />
			                  </td><td><label>Income List Download Month Wise</label></td>
			                  
			                  <td>
							 <input type="checkbox" <?php if($download_sub_panel_attendance_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="download_sub_panel_attendance_list"   />
			                  </td>
			                  <td><label>Download Attendance List</label>
			                  </td>
			                  
			                  <td>
							 <input type="checkbox" <?php if($download_sub_panel_userid_password=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="download_sub_panel_userid_password"   />
			                  </td>
			                  <td><label>Download User id and password</label>
			                  </td>
			                  
			                  <td>
							 <input type="checkbox" <?php if($download_sub_panel_tc_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_6"   onclick="check_all_panel_wise_all('6')" value="download_sub_panel_tc_list"   />
			                  </td>
			                  <td><label>Download Tc List</label>
			                  </td>
			                  
						  
						  
						  </tr>
						  
						    <tr><td>7</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_7" onclick="check_all_panel_wise('7')" <?php if($panel_dues=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_dues"   />
			                   </td><td><label>Dues</label></td>
						 <td>
						 <input type="checkbox" <?php if($sub_panel_class_wise_dues_details=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_7"   onclick="check_all_panel_wise_all('7')" value="sub_panel_class_wise_dues_details"   />
			                  </td><td><label>Class Wise Dues Details</label></td><td>
						 
						 </td></tr>
						 
						 
						    <tr><td>8</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_8" onclick="check_all_panel_wise('8')" <?php if($panel_enquiry=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_enquiry"   />
			                 </td><td><label>Enquiry</label></td>
						   <td>
						   <input type="checkbox" <?php if($sub_panel_add_enquiry=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_8"   onclick="check_all_panel_wise_all('8')" value="sub_panel_add_enquiry"   />
			                  </td><td><label>Add Enquiry</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_enquiry_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_8"   onclick="check_all_panel_wise_all('8')" value="sub_panel_enquiry_list"   />
			                  </td><td><label>Enquiry List</label></td>
			                  
			                  
			                  <td>
							
							<input type="checkbox" <?php if($enquiry_sub_panel_enquiry_sms=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_8"   onclick="check_all_panel_wise_all('8')" value="enquiry_sub_panel_enquiry_sms"   />
			                  </td><td><label>Enquiry SMS</label></td>
			                  
			                  
			                  </tr>
						   
						    <tr><td>9</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_9" onclick="check_all_panel_wise('9')" <?php if($panel_event_management=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_event_management"   />
			                    </td><td><label>Event Management</label></td>
						<td>
						
						<input type="checkbox" <?php if($sub_panel_add_event=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="sub_panel_add_event"   />
			                  </td><td><label>Add Event</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_event_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="sub_panel_event_list"   />
			                  </td><td><label>Event List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_event_add_participate=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="sub_panel_event_add_participate"   />
			                  </td><td><label>Event Add Participate</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_event_participate_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="sub_panel_event_participate_list"   />
			                  </td><td><label>Event Participate List</label></td>
			                  
			             <td>
							<input type="checkbox" <?php if($event_sub_panel_add_house=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="event_sub_panel_add_house"   />
			             </td>
			             <td>
			                 <label>Add House</label>
			             </td>     
			                  
			              <td>
							<input type="checkbox" <?php if($event_sub_panel_assigned_house=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="event_sub_panel_assigned_house"   />
			             </td>
			             <td>
			                 <label>Assigned House</label>
			             </td>     
			                  
			                  </tr>
						<tr>
						 <td></td>
						 <td></td>
						 <td></td>
						 <td>
							<input type="checkbox" <?php if($event_sub_panel_activity_plan=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="event_sub_panel_activity_plan"   />
			             </td>
			             <td>
			                 <label>Activity Plan</label>
			             </td>     
						  
						 <td>
							<input type="checkbox" <?php if($event_sub_panel_activity_plan_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="event_sub_panel_activity_plan_list"   />
			             </td>
			             <td>
			                 <label>Activity Plan List</label>
			             </td> 
			             
			             <td>
							<input type="checkbox" <?php if($event_sub_panel_event_result=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="event_sub_panel_event_result"   />
			             </td>
			             <td>
			                 <label>Event Result</label>
			             </td> 
						    
						 <td>
							<input type="checkbox" <?php if($event_sub_panel_event_result_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="event_sub_panel_event_result_list"   />
			             </td>
			             <td>
			                 <label>Event Result List</label>
			             </td>   
						    
						  <td>
							<input type="checkbox" <?php if($event_sub_panel_team_creation=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="event_sub_panel_team_creation"   />
			             </td>
			             <td>
			                 <label>Event Team Creation</label>
			             </td> 
			             
			              <td>
							<input type="checkbox" <?php if($event_sub_panel_team_creation_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="event_sub_panel_team_creation_list"   />
			             </td>
			             <td>
			                 <label>Event Team Creation List</label>
			             </td> 
						</tr>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<input type="checkbox" <?php if($event_sub_panel_participant_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_9"   onclick="check_all_panel_wise_all('9')" value="event_sub_panel_participant_list"   />
			             </td>
			             <td>
			                 <label>participant List</label>
			             </td> 
						</tr>
						
						    <tr><td>10</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_10" onclick="check_all_panel_wise('10')" <?php if($panel_exam_paper_setter=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_exam_paper_setter"   />
			                  </td><td><label>Paper Setter</label></td>
						  <td>
						  
						  <input type="checkbox" <?php if($sub_panel_add_question=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_10"   onclick="check_all_panel_wise_all('10')" value="sub_panel_add_question"   />
			                  </td><td><label>Add Question</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_view_question=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_10"   onclick="check_all_panel_wise_all('10')" value="sub_panel_view_question"   />
			                  </td><td><label>View Question</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_instant_go_to_paper_setter=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_10"   onclick="check_all_panel_wise_all('10')" value="sub_panel_instant_go_to_paper_setter"   />
			                  </td><td><label>Instant Go To Paper Setter</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_go_to_paper_setter=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_10"   onclick="check_all_panel_wise_all('10')" value="sub_panel_go_to_paper_setter"   />
			                  </td><td><label>Go To Paper Setter</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_total_paper_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_10"   onclick="check_all_panel_wise_all('10')" value="sub_panel_total_paper_list"   />
			                  </td><td><label>Total Paper List</label></td></tr>
						  
						    <tr><td>11</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_11" onclick="check_all_panel_wise('11')" <?php if($panel_examination=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_examination"   />
			                   </td><td><label>Examination</label></td>
						 <td>
						 <input type="checkbox" <?php if($sub_panel_admit_card=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="sub_panel_admit_card"   />
			                  </td><td><label>Admit Card</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_admit_card_print=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="sub_panel_admit_card_print"   />
			                  </td><td><label>Admit Card Print</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_marksheet_fill=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="sub_panel_marksheet_fill"   />
			                  </td><td><label>Marksheet Fill</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_marksheet_view=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="sub_panel_marksheet_view"   />
			                  </td><td><label>Marksheet View</label></td>
			                  
			                 <td>
							   <input type="checkbox" <?php if($sub_panel_marksheet_fill_monthly=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="sub_panel_marksheet_fill_monthly"   />
			                 </td>
			                 <td>
			                   <label>Marksheet Fill Monthly</label>
			                 </td> 
			                  
			                  <td>
							   <input type="checkbox" <?php if($sub_panel_marksheet_view_monthly=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="sub_panel_marksheet_view_monthly"   />
			                 </td>
			                 <td>
			                   <label>Marksheet View Monthly</label>
			                 </td> 
			                 <tr>
			                   <td></td>  
			                   <td></td>  
			                   <td></td>  
			                  <td>
							   <input type="checkbox" <?php if($exam_sub_panel_view_resultsheet=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="exam_sub_panel_view_resultsheet"   />
			                 </td>
			                 <td>
			                   <label>View Resultsheet</label>
			                 </td> 
			                  
			                  <td>
							   <input type="checkbox" <?php if($exam_sub_panel_download_marks=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="exam_sub_panel_download_marks"   />
			                 </td>
			                 <td>
			                   <label>Marks Downloads</label>
			                 </td> 
			                 
			                 <td>
							   <input type="checkbox" <?php if($sxam_sub_panel_send_marks=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="sxam_sub_panel_send_marks"   />
			                 </td>
			                 <td>
			                   <label>Send Marks</label>
			                 </td> 
			                 
			                 
			                 <td>
							   <input type="checkbox" <?php if($examination_fill_marks_total_day_field=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="examination_fill_marks_total_day_field"   />
			                 </td>
			                 <td>
			                   <label style="color:red;">Marksheet Fill Total Day field</label>
			                 </td>
			                 
			                 <td>
							   <input type="checkbox" <?php if($examination_fill_marks_prasent_day_field=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="examination_fill_marks_prasent_day_field"   />
			                 </td>
			                 <td>
			                   <label style="color:red;">Marksheet Fill Prasent Day field</label>
			                 </td> 
			                 
			                 <td>
							   <input type="checkbox" <?php if($examination_fill_marks_remarks_field=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_11"   onclick="check_all_panel_wise_all('11')" value="examination_fill_marks_remarks_field"   />
			                 </td>
			                 <td>
			                   <label style="color:red;">Marksheet Fill Remark field</label>
			                 </td>
			                 </tr>
			                 
			                 
			                 
			                 
			                 </tr>
						    <tr><td rowspan="2">12</td><td rowspan="2">
						   <input type="checkbox"  name="panel_rights[]" id="panel_12" onclick="check_all_panel_wise('12')" <?php if($panel_fees=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_fees"   />
			                   </td><td rowspan="2"><label>Fees</label></td>
						 
						 <td rowspan="2">
						        <input type="checkbox" <?php if($fees_sub_panel_reset_months_or_installment=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_reset_months_or_installment"   />
			             </td>
			             <td rowspan="2">
			                    <label>Reset Months and Installments</label>
			             </td>
						 
						 
						 
						 <td rowspan="2">
						 <input type="checkbox" <?php if($sub_panel_fee_structure_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="sub_panel_fee_structure_list"   />
			                  </td><td rowspan="2"><label>Fee Structure List</label></td><td rowspan="2">
							
							<input type="checkbox" <?php if($sub_panel_discount_types_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="sub_panel_discount_types_list"   />
			                  </td><td rowspan="2"><label>Discount Types List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_student_fee_add_form=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="sub_panel_student_fee_add_form"   />
			                  </td><td><label>Pay Fees</label></td>
			                  
			            <td>
						  <input type="checkbox" <?php if($sub_panel_student_fee_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="sub_panel_student_fee_list"   />
			            </td>
			            <td>
			               <label>Student Fee List</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_set_dues_detail=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_set_dues_detail"   />
			            </td>
			            <td>
			               <label>Set Dues Details</label>
			            </td>
			            </tr>
						 
						 <tr>
						     
						  <td><input type="checkbox" <?php if($sub_panel_submission_date_change=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12');" value="sub_panel_submission_date_change"  />
			                 </td>
						  <td> <label style="color:Green">Submission Date Change</label></td>
						    <td>
							 
							 <input type="checkbox" <?php if($sub_panel_fee_list_delete=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"  onclick="check_all_panel_wise_all('12');" value="sub_panel_fee_list_delete"   />
			                </td>
						  <td><label  style="color:red">Fee Delete</label>
							 </td>
						 </tr>
						 <tr>
						     <td></td>
						     <td></td>
						     <td></td>
						<td>
						  <input type="checkbox" <?php if($fees_sub_panel_set_fee=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_set_fee"   />
			            </td>
			            <td>
			               <label>Set Fees Perticuler</label>
			            </td> 
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_set_fees_classwise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_set_fees_classwise"   />
			            </td>
			            <td>
			               <label>Set Fees Classwise</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_set_transport_fee_classwise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_set_transport_fee_classwise"   />
			            </td>
			            <td>
			               <label>Set Fees Classwise Transport</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_previous_dues=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_previous_dues"   />
			            </td>
			            <td>
			               <label>Previous Dues</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_print_chalan=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_print_chalan"   />
			            </td>
			            <td>
			               <label>Print Chalan</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_fees_detail_by_rfid=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_fees_detail_by_rfid"   />
			            </td>
			            <td>
			               <label>Fee Deatils By Rfid</label>
			            </td>
						</tr>
						<tr>
						 <td></td>   
						 <td></td>   
						 <td></td>   
						  <td>
						  <input type="checkbox" <?php if($fees_sub_panel_dues_list_sms_print=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_dues_list_sms_print"   />
			            </td>
			            <td>
			               <label>Dues List and Sms</label>
			            </td> 
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_demand_bill=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_demand_bill"   />
			            </td>
			            <td>
			               <label>Demand Bill</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_student_income_tax=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_student_income_tax"   />
			            </td>
			            <td>
			               <label>Student Income Tex</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_transport_reset_month=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_transport_reset_month"   />
			            </td>
			            <td>
			               <label>Transport Reset Monts</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_transport_set_dues_detail=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_transport_set_dues_detail"   />
			            </td>
			            <td>
			               <label>Transport Set Dues Details</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_transport_fees_structure=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_transport_fees_structure"   />
			            </td>
			            <td>
			               <label>Transport Fees Structure</label>
			            </td>
			            </tr>
			            <tr>
			            <td></td>       
			            <td></td>       
			            <td></td>       
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_transport_set_fee_classwise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_transport_set_fee_classwise"   />
			            </td>
			            <td>
			               <label>Transport Set Fees Classwise </label>
			            </td>
			            
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_transport_pay_fee=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_transport_pay_fee"   />
			            </td>
			            <td>
			               <label>Transport Pay Fees</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_transport_fee_details=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_transport_fee_details"   />
			            </td>
			            <td>
			               <label>Transport Fees Details</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_report_panel=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_report_panel"   />
			            </td>
			            <td>
			               <label>All Report Panel </label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_transport_reports_panel=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_transport_reports_panel"   />
			            </td>
			            <td>
			               <label>transport Report Panel </label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_sub_panel_bus_id_card=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_sub_panel_bus_id_card"   />
			            </td>
			            <td>
			               <label>Bus Id Card</label>
			            </td>
			            
						</tr>
						<tr>
						    
					    <td></td>       
			            <td></td>       
			            <td></td>       
			            <td>
						  <input type="checkbox" <?php if($fees_panel_delete_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_panel_delete_button"   />
			            </td>
			            <td>
			               <label style="color:red;">Fees Panel Delete Button For All Panels </label>
			            </td>
			            
			            
			            <td>
						  <input type="checkbox" <?php if($fees_panel_edit_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_panel_edit_button"   />
			            </td>
			            <td>
			               <label style="color:red;">Fees Panel Edit Button For All Panels</label>
			            </td>
			            
			            <td>
						  <input type="checkbox" <?php if($fees_panel_details_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="fees_panel_details_button"   />
			            </td>
			            <td>
			               <label style="color:red;">Fees Panel Details Button</label>
			            </td>
						    
						<td>
						  <input type="checkbox" <?php if($Fess_panel_edit_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_12"   onclick="check_all_panel_wise_all('12')" value="Fess_panel_edit_button"   />
			            </td>
			            <td>
			               <label style="color:red;">Fees Panel Edit Button</label>
			            </td>    
						    
						</tr>
						 
						    <tr><td>13</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_13" onclick="check_all_panel_wise('13')" <?php if($panel_gallery=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_gallery"   />
			                  </td><td><label>Gallery</label></td>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_gallery=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_13"   onclick="check_all_panel_wise_all('13')" value="sub_panel_gallery"   />
			                  </td><td><label>Gallery</label></td></tr>
						    <tr><td>14</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_14" onclick="check_all_panel_wise('14')" <?php if($panel_govt_requirement=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_govt_requirement"   />
			                   </td><td><label>Govt. Reqr.</label></td>
						 <td>
						 <input type="checkbox" <?php if($sub_panel_mapping_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_14"   onclick="check_all_panel_wise_all('14')" value="sub_panel_mapping_list"   />
			                  </td><td><label>Mapping List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_student_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_14"   onclick="check_all_panel_wise_all('14')" value="sub_panel_student_list"   />
			                  </td><td><label>Student List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_student_contact_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_14"   onclick="check_all_panel_wise_all('14')" value="sub_panel_student_contact_list"   />
			                  </td><td><label>Student Contact List</label></td><td>
						 
						 </td></tr>
						    <tr><td>15</td><td>
						    <input type="checkbox"  name="panel_rights[]" id="panel_15" onclick="check_all_panel_wise('15')" <?php if($panel_holiday=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_holiday"   />
			                  </td><td><label>Holiday</label></td>
						 <td>
						 <input type="checkbox" <?php if($sub_panel_add_holiday=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_15"   onclick="check_all_panel_wise_all('15')" value="sub_panel_add_holiday"   />
			                  </td><td><label>Add Holiday</label></td><td>
							
							
							<input type="checkbox" <?php if($sub_panel_holiday_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_15"   onclick="check_all_panel_wise_all('15')" value="sub_panel_holiday_list"   />
			                  </td><td><label>Holiday List</label></td></tr>
						    <tr><td>16</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_16" onclick="check_all_panel_wise('16')" <?php if($panel_homework=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_homework"   />
			                   </td><td><label>Homework</label></td>
						 <td>
						 <input type="checkbox" <?php if($sub_panel_homework_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_16"   onclick="check_all_panel_wise_all('16')" value="sub_panel_homework_add"   />
			                  </td><td><label>Homework Add</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_homework_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_16"   onclick="check_all_panel_wise_all('16')" value="sub_panel_homework_list"   />
			                  </td><td><label>Homework List</label></td>
			                  
			             <td>
							<input type="checkbox" <?php if($sub_panel_class_work=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_16"   onclick="check_all_panel_wise_all('16')" value="sub_panel_class_work"   />
			             </td>
			             <td>
			                <label>Classwork</label>
			             </td>     
			             <td>
							<input type="checkbox" <?php if($sub_panel_class_work_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_16"   onclick="check_all_panel_wise_all('16')" value="sub_panel_class_work_list"   />
			             </td>
			             <td>
			                <label>Classwork List</label>
			             </td>      
			                  
			                  
			                  
			                  
						 
						 
						 </tr>
						 
						    <tr><td rowspan="3">17</td><td rowspan="3">
						   <input type="checkbox"  name="panel_rights[]" id="panel_17" onclick="check_all_panel_wise('17')" <?php if($panel_hostel=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_hostel"   />
			                  </td><td rowspan="3"><label>Hostel</label></td>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_hostel_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_hostel_list"   />
			                  </td><td><label>Hostel List</label></td><td>
							<input type="checkbox" <?php if($sub_panel_room_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_room_list"   />
							
			                  </td><td><label>Room List</label></td><td>
							<input type="checkbox" <?php if($sub_panel_hostel_seat_avail=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_hostel_seat_avail"   />
			                  </td><td><label>Hostel Seat Availibilty</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_hostel_employee_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_hostel_employee_add"   />
			                  </td><td><label>Hostel Employee Add</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_hostel_employee_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_hostel_employee_list"   />
			                  </td><td><label>Hostel Employee List</label></td>
							
							</tr>
							<tr>
							<td>
							<input type="checkbox" <?php if($sub_panel_hostel_student_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_hostel_student_list"   />
			                  </td><td><label>Hostel Student List</label></td><td>
							
							
							<input type="checkbox" <?php if($sub_panel_hostel_mess_menu_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_hostel_mess_menu_list"   />
			                  </td><td><label>Hostel Mess Menu List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_leave_student=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_leave_student"   />
			                  </td><td><label>Hostel Leave Student</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_hostel_daily_entry=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_hostel_daily_entry"   />
			                  </td><td><label>Hostel Daily Entry</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_buy_item=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_buy_item"   />
			                  </td><td><label>Buy Item</label></td><td>
						  
						  <input type="checkbox" <?php if($sub_panel_hostel_purchase_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_hostel_purchase_list"   />
			                  </td><td><label>Hostel Purchase List</label></td>
							</tr>
							<tr>
							<td>
							 <input type="checkbox" <?php if($sub_panel_hostel_expenses=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_hostel_expenses"   />
			                  </td><td><label>Hostel Expenses</label></td><td>
						  
						   <input type="checkbox" <?php if($sub_panel_account_collection=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="sub_panel_account_collection"   />
			                  </td><td><label>Account Collection</label></td>
			                  
			                <td> 
			               <input type="checkbox" <?php if($hostal_panel_edit_delete_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_17"   onclick="check_all_panel_wise_all('17')" value="hostal_panel_edit_delete_button"   />
			                  </td><td><label style="color:red;">Edit and Delete Button</label></td>  
			                  
			                  
			                  
			                  </tr>
						    <tr><td>18</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_18" onclick="check_all_panel_wise('18')" <?php if($panel_leave=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_leave"   />
			                  </td><td><label>Leave</label></td>
						  <td>
						   <input type="checkbox" <?php if($sub_panel_leave_form=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_18"   onclick="check_all_panel_wise_all('18')" value="sub_panel_leave_form"   />
			                  </td><td><label>Leave Form</label></td><td>
							
							 <input type="checkbox" <?php if($sub_panel_leave_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_18"   onclick="check_all_panel_wise_all('18')" value="sub_panel_leave_list"   />
			                  </td><td><label>Leave List</label></td></tr>
						    <tr><td>19</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_19" onclick="check_all_panel_wise('19')" <?php if($panel_library=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_library"   />
			                  </td><td><label>Library</label></td>
						  <td>
						  
						  <input type="checkbox" <?php if($sub_panel_library_add_book=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_19"   onclick="check_all_panel_wise_all('19')" value="sub_panel_library_add_book"   />
			                  </td><td><label>Library Add Book</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_view_book_library=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_19"   onclick="check_all_panel_wise_all('19')" value="sub_panel_view_book_library"   />
			                  </td><td><label>View Book Library</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_view_issued_book_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_19"   onclick="check_all_panel_wise_all('19')" value="sub_panel_view_issued_book_list"   />
			                  </td><td><label>Issued Book List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_view_return_book_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_19"   onclick="check_all_panel_wise_all('19')" value="sub_panel_view_return_book_list"   />
			                  </td><td><label>View Return Book List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_e_library=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_19"   onclick="check_all_panel_wise_all('19')" value="sub_panel_e_library"   />
			                  </td><td><label>E-library</label></td>
			                  
			                  
			                 <td>
							   <input type="checkbox" <?php if($lib_sub_panel_e_stuff=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_19"   onclick="check_all_panel_wise_all('19')" value="lib_sub_panel_e_stuff"   />
			                 </td>
			                 <td>
			                    <label>E-Stuff</label>
			                 </td> 
			                  
			                  
			                  </tr>
						    <tr><td>20</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_20" onclick="check_all_panel_wise('20')" <?php if($panel_penalty=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_penalty"   />
			                  </td><td><label>Penalty</label></td>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_penalty_form=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_20"   onclick="check_all_panel_wise_all('20')" value="sub_panel_penalty_form"   />
			                  </td><td><label>Penalty form</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_penalty_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_20"   onclick="check_all_panel_wise_all('20')" value="sub_panel_penalty_list"   />
			                  </td><td><label>Penalty list</label></td></tr>
						  
						    <tr><td>21</td><td>
						    <input type="checkbox"  name="panel_rights[]" id="panel_21" onclick="check_all_panel_wise('21')" <?php if($panel_recycle_bin=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_recycle_bin"   />
			                 </td><td><label>Recycle Bin</label></td>
			                 
			                 <td>
						        <input type="checkbox" <?php if($recycle_bin_sub_panel_student_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_21"   onclick="check_all_panel_wise_all('20')" value="recycle_bin_sub_panel_student_list"   />
			                 </td>
			                 <td>
			                    <label>Student admission List</label>
			                 </td>
			                 
			                 <td>
						        <input type="checkbox" <?php if($recycle_bin_sub_panel_emp_list=='yes'){ echo 'checked'; } ?>   name="panel_rights[]" class="check_all_panel check_21"   onclick="check_all_panel_wise_all('20')" value="recycle_bin_sub_panel_emp_list"   />
			                 </td>
			                 <td>
			                    <label>Emp List</label>
			                 </td>
			                 
			                 <td>
						        <input type="checkbox" <?php if($recycle_bin_sub_panel_expance_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_21"   onclick="check_all_panel_wise_all('20')" value="recycle_bin_sub_panel_expance_list"   />
			                 </td>
			                 <td>
			                    <label>Expance List</label>
			                 </td>
			                 
			                 <td>
						        <input type="checkbox" <?php if($recycle_bin_sub_panel_hostal_student_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_21"   onclick="check_all_panel_wise_all('20')" value="recycle_bin_sub_panel_hostal_student_list"   />
			                 </td>
			                 <td>
			                    <label>Hostal Student List</label>
			                 </td>
			                 
			                 <td>
						        <input type="checkbox" <?php if($recycle_bin_sub_panel_hostal_account_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_21"   onclick="check_all_panel_wise_all('20')" value="recycle_bin_sub_panel_hostal_account_list"   />
			                 </td>
			                 <td>
			                    <label>Hostal account List</label>
			                 </td>
			                 
			                 <td>
						        <input type="checkbox" <?php if($recycle_bin_sub_panel_registration_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_21"   onclick="check_all_panel_wise_all('20')" value="recycle_bin_sub_panel_registration_list"   />
			                 </td>
			                 <td>
			                    <label>student Registration List</label>
			                 </td>
			             </tr>
			             <tr>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td>
						 <input type="checkbox" <?php if($recycle_sub_panel_reset_delete_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_21"   onclick="check_all_panel_wise_all('20')" value="recycle_sub_panel_reset_delete_button"   />
			              </td>
			              <td>
			                    <label style="color:red;">Recycle Bin Restore and Delete Button</label>
			              </td>
						    <tr><td>22</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_22" onclick="check_all_panel_wise('22')" <?php if($panel_reminder=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_reminder"   />
			                  </td><td><label>Reminder</label></td>
						  <td>
						   <input type="checkbox" <?php if($sub_panel_reminder_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_22"   onclick="check_all_panel_wise_all('22')" value="sub_panel_reminder_add"   />
			                  </td><td><label>Reminder Add</label></td><td>
						  
						   <input type="checkbox" <?php if($sub_panel_reminder_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_22"   onclick="check_all_panel_wise_all('22')" value="sub_panel_reminder_list"   />
			                  </td><td><label>Reminder List</label></td><td>
							
							 <input type="checkbox" <?php if($sub_panel_reminder_teacher_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_22"   onclick="check_all_panel_wise_all('22')" value="sub_panel_reminder_teacher_add"   />
			                  </td><td><label>Reminder Teacher Add</label></td><td>
							
							 <input type="checkbox" <?php if($sub_panel_reminder_teacher_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_22"   onclick="check_all_panel_wise_all('22')" value="sub_panel_reminder_teacher_list"   />
			                  </td><td><label>Reminder Teacher List</label></td></tr>
						    <tr><td rowspan="2">23</td><td rowspan="2">
						   <input type="checkbox"  name="panel_rights[]" id="panel_23" onclick="check_all_panel_wise('23')" <?php if($panel_school_info=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_school_info"   />
			                  </td><td rowspan="2"><label>School Info</label></td>
						  <td>
						  
						  <input type="checkbox" <?php if($sub_panel_school_info_general=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_school_info_general"   />
			                  </td><td><label>School Info General</label></td>
			                  <td>
							     <input type="checkbox" <?php if($sub_panel_exam_type_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_exam_type_add"   />
			                  </td><td><label>Exam Type Add</label></td>
			             <td>
							<input type="checkbox" <?php if($school_info_sub_panel_add_exam_type_monthly=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="school_info_sub_panel_add_exam_type_monthly"   />
			             </td>
			             <td>
			                <label>Exam Type Add Monthly</label>
			             </td>
			             <td>
							    <input type="checkbox" <?php if($sub_panel_add_section=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_add_section"   />
			                  </td><td><label>Add Section</label></td><td>
							
							 <input type="checkbox" <?php if($sub_panel_add_class_stream=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_add_class_stream"   />
			                  </td><td><label>Add Class Stream</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_add_stream_group=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_add_stream_group"   />
			                  </td><td><label>Add Stream Group</label></td>
			                  
			                  
							</tr>
				         	<tr>
				         	 <td>
							<input type="checkbox" <?php if($sub_panel_subject_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_subject_add"   />
			                  </td><td><label>Subject Add</label></td>
							<td>
							
							<input type="checkbox" <?php if($sub_panel_class_wise_subject=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_class_wise_subject"   />
			                  </td><td><label>Class Wise Subject</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_fee_types_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_fee_types_add"   />
			                  </td><td><label>Fee Types Add</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_discount_types_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_discount_types_add"   />
			                  </td><td><label>Discount Types Add</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_total_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="sub_panel_total_list"   />
			                  </td><td><label>Total List</label></td>
			                  
			              <td>
							<input type="checkbox" <?php if($school_info_sub_panel_student_password_update=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="school_info_sub_panel_student_password_update"   />
			             </td>
			             <td>
			                <label>Std password Update</label>
			             </td> 
			             
			             
			             </tr>
			             <tr>
			                 <td></td>
			                 <td></td>
			                 <td></td>
			              
			             <td>
							<input type="checkbox" <?php if($school_info_sub_panel_add_fee_category=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="school_info_sub_panel_add_fee_category"   />
			             </td>
			             <td>
			                <label>Add Std Fee Category</label>
			             </td> 
			             <td>
							<input type="checkbox" <?php if($school_info_sub_panel_add_bus_fee_category=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="school_info_sub_panel_add_bus_fee_category"   />
			             </td>
			             <td>
			                <label>Add Bus Fee category</label>
			             </td>
			             <td>
							<input type="checkbox" <?php if($school_info_sub_panel_std_identity_category=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="school_info_sub_panel_std_identity_category"   />
			             </td>
			             <td>
			                <label>Std Identity Category</label>
			             </td> 
			             
			             <td>
							<input type="checkbox" <?php if($school_info_sub_panel_syllebus_detail=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="school_info_sub_panel_syllebus_detail"   />
			             </td>
			             <td>
			                <label>Syllebus detail</label>
			             </td> 
			             
			             <td>
							<input type="checkbox" <?php if($add_bus_fee_category_acadmic_calender=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_23"   onclick="check_all_panel_wise_all('23')" value="add_bus_fee_category_acadmic_calender"   />
			             </td>
			             <td>
			                <label>Academic Calender</label>
			             </td> 
			             
			             </tr>
			             
			             
						    <tr><td rowspan="2">24</td><td rowspan="2">
						   <input type="checkbox"  name="panel_rights[]" id="panel_24" onclick="check_all_panel_wise('24')" <?php if($panel_sms=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_sms"   />
			                  </td ><td rowspan="2"><label>SMS</label></td>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_send=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sub_panel_send"   />
			                  </td><td><label>Send</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_classwise_sms=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sub_panel_classwise_sms"   />
			                  </td><td><label>Classwise Sms</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_attendance_sms=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sub_panel_attendance_sms"   />
			                  </td><td><label>Attendance Sms</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_fee_sms=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sub_panel_fee_sms"   />
			                  </td><td><label>Fee Sms</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_birthday_sms=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sub_panel_birthday_sms"   />
			                  </td><td><label>Birthday Sms</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_staff_sms=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sub_panel_staff_sms"   />
			                  </td><td><label>Staff Sms</label></td>
						  </tr>
						  <tr>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_sms_templates_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sub_panel_sms_templates_list"   />
			                  </td><td><label>Sms Templates List</label></td>
			               
			               <td>
							 <input type="checkbox" <?php if($sms_sub_panel_add_group=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sms_sub_panel_add_group"   />
			               </td>
			               <td>
			                 <label>Add Group</label>
			               </td>
			               
			               
			               <td>
							 <input type="checkbox" <?php if($sms_sub_panel_add_group_staff=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sms_sub_panel_add_group_staff"   />
			               </td>
			               <td>
			                 <label>Add Group Staff</label>
			               </td>
			               
			               <td>
							 <input type="checkbox" <?php if($sms_sub_panel_group_student=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sms_sub_panel_group_student"   />
			               </td>
			               <td>
			                 <label>Group Student</label>
			               </td>
			               
			               <td>
							 <input type="checkbox" <?php if($sms_sub_panel_group_teacher=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sms_sub_panel_group_teacher"   />
			               </td>
			               <td>
			                 <label>Group Teacher</label>
			               </td>
			               
			               <td>
							 <input type="checkbox" <?php if($sms_sub_panel_group_sms=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sms_sub_panel_group_sms"   />
			               </td>
			               <td>
			                 <label>Group Sms</label>
			               </td>
			               </tr>
			               <tr>
			               <td></td>      
			               <td></td>      
			               <td></td> 
			               
			               <td>
							 <input type="checkbox" <?php if($sms_sub_panel_bus_sms=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sms_sub_panel_bus_sms"   />
			               </td>
			               <td>
			                 <label>Bus Sms</label>
			               </td>
			               
			               <td>
							 <input type="checkbox" <?php if($sms_sub_panel_group_other_contact=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sms_sub_panel_group_other_contact"   />
			               </td>
			               <td>
			                 <label>Group Other contact</label>
			               </td>
			               
			               <td>
							 <input type="checkbox" <?php if($sms_sub_panel_group_voice_call=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sms_sub_panel_group_voice_call"   />
			               </td>
			               <td>
			                 <label>Voice Call</label>
			               </td>
			               
			               <td>
							 <input type="checkbox" <?php if($sub_panel_delivery_report=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_24"   onclick="check_all_panel_wise_all('24')" value="sub_panel_delivery_report"   />
			               </td>
			               <td>
			                 <label>Delivery Report</label>
			               </td>
			                  
			                  
			                  </tr>
						  
						    <tr><td>25</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_25" onclick="check_all_panel_wise('25')" <?php if($panel_sports=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_sports"   />
			                   </td><td><label>Sports</label></td>
						 <td>
						 <input type="checkbox" <?php if($sub_panel_add_sports=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_25"   onclick="check_all_panel_wise_all('25')" value="sub_panel_add_sports"   />
			                  </td><td><label>Add Sports</label></td><td>
							
							
							<input type="checkbox" <?php if($sub_panel_sports_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_25"   onclick="check_all_panel_wise_all('25')" value="sub_panel_sports_list"   />
			                  </td><td><label>Sports List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_sports_add_participate=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_25"   onclick="check_all_panel_wise_all('25')" value="sub_panel_sports_add_participate"   />
			                  </td><td><label>Sports Add Participate</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_sports_participate_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_25"   onclick="check_all_panel_wise_all('25')" value="sub_panel_sports_participate_list"   />
			                  </td><td><label>Sports Participate List</label></td>
			                  
			                  <td>
						        <input type="checkbox" <?php if($sports_sub_panel_add_sports_type=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_25"   onclick="check_all_panel_wise_all('25')" value="sports_sub_panel_add_sports_type"   />
			                  </td>
			                  <td>
			                    <label> Add Sports Type</label>
			                  </td>
			                  
			                  
			                  <td>
						        <input type="checkbox" <?php if($sports_sub_panel_age_category=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_25"   onclick="check_all_panel_wise_all('25')" value="sports_sub_panel_age_category"   />
			                  </td>
			                  <td>
			                    <label> Age category</label>
			                  </td>
			                  
			                  
						 <tr>
						  <td></td>   
						  <td></td>   
						  <td></td>   
						 <td>
						   <input type="checkbox" <?php if($sports_sub_panel_team_creation=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_25"   onclick="check_all_panel_wise_all('25')" value="sports_sub_panel_team_creation"   />
			             </td>
			             <td>
			               <label>Sports Team Creation</label>
			             </td>    
						  <td>
						  <input type="checkbox" <?php if($sports_sub_panel_team_creation_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_25"   onclick="check_all_panel_wise_all('25')" value="sports_sub_panel_team_creation_list"   />
			             </td>
			             <td>
			               <label>Sports Team Creation List</label>
			             </td>   
						 </tr>
						 
						 
						 </tr>
						    <tr><td>26</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_26" onclick="check_all_panel_wise('26')" <?php if($panel_staff=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_staff"   />
			                  </td><td><label>Staff</label></td>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_attendance_employee_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_26"   onclick="check_all_panel_wise_all('26')" value="sub_panel_attendance_employee_add"   />
			                  </td><td><label>Attendance Employee Add</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_attendance_employee_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_26"   onclick="check_all_panel_wise_all('26')" value="sub_panel_attendance_employee_list"   />
			                  </td><td><label>Attendance Employee List</label></td>
							
							
			                  
			                  <td>
							   <input type="checkbox" <?php if($sub_panel_emp_salary_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_26"   onclick="check_all_panel_wise_all('26')" value="sub_panel_emp_salary_list"   />
			                  </td>
			                  <td>
			                   <label>Emp Salary List</label>
			                  </td>
			                  
			                  <td>
							   <input type="checkbox" <?php if($staff_sub_panel_drop_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_26"   onclick="check_all_panel_wise_all('26')" value="staff_sub_panel_drop_list"   />
			                  </td>
			                  <td>
			                   <label>Drop List</label>
			                  </td>
			                  
			                  <td>
							   <input type="checkbox" <?php if($staff_sub_panel_id_generate=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_26"   onclick="check_all_panel_wise_all('26')" value="staff_sub_panel_id_generate"   />
			                  </td>
			                  <td>
			                   <label>staff Id generate</label>
			                  </td>
			                  
							</tr><tr>
							<td></td>
							<td></td>
							<td></td>
							<td>
							   <input type="checkbox" <?php if($staff_sub_panel_assign_rfid=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_26"   onclick="check_all_panel_wise_all('26')" value="staff_sub_panel_assign_rfid"   />
			                  </td>
			                  <td>
			                   <label>Assign Rfid card</label>
			                  </td>
			                  <td>
							   <input type="checkbox" <?php if($staff_sub_panel_attendance_registr=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_26"   onclick="check_all_panel_wise_all('26')" value="staff_sub_panel_attendance_registr"   />
			                  </td>
			                  <td>
			                   <label>Attendance Register</label>
			                  </td>
			                  <td>
							   <input type="checkbox" <?php if($staff_sub_panel_attendance_prority=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_26"   onclick="check_all_panel_wise_all('26')" value="staff_sub_panel_attendance_prority"   />
			                  </td>
			                  <td>
			                   <label>Attendance Priority</label>
			                  </td>
							</tr>
						    <tr><td>27</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_27" onclick="check_all_panel_wise('27')" <?php if($panel_stock=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_stock"   />
			                  </td><td><label>Stock</label></td>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_add_item=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_27"   onclick="check_all_panel_wise_all('27')" value="sub_panel_add_item"   />
			                  </td><td><label>Add Item</label></td><td>
							
							
							<input type="checkbox" <?php if($sub_panel_stock_purchase_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_27"   onclick="check_all_panel_wise_all('27')" value="sub_panel_stock_purchase_list"   />
			                  </td><td><label>Stock Purchase List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_item_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_27"   onclick="check_all_panel_wise_all('27')" value="sub_panel_item_list"   />
			                  </td><td><label>Item List</label></td>
			                  
			                  
			             <td>
							<input type="checkbox" <?php if($sub_panel_sale_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_27"   onclick="check_all_panel_wise_all('27')" value="sub_panel_sale_list"   />
			             </td>
			             <td>
			                 <label>Sale List</label>
			             </td>
			             
			             
			             <td>
							<input type="checkbox" <?php if($stock_sub_panel_add_category=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_27"   onclick="check_all_panel_wise_all('27')" value="stock_sub_panel_add_category"   />
			             </td>
			             <td>
			                 <label>Add category</label>
			             </td>
			             <td>
							<input type="checkbox" <?php if($stock_sub_panel_category_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_27"   onclick="check_all_panel_wise_all('27')" value="stock_sub_panel_category_list"   />
			             </td>
			             <td>
			                 <label>Category List</label>
			             </td>
			             </tr>
			             <tr>
			             <td></td>    
			             <td></td>    
			             <td></td>
			             
			             <td>
							<input type="checkbox" <?php if($stock_sub_panel_buy_sale=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_27"   onclick="check_all_panel_wise_all('27')" value="stock_sub_panel_buy_sale"   />
			             </td>
			             <td>
			                 <label>Buy and Sale</label>
			             </td>
			             
			             </tr>
						    <tr><td rowspan="2" >28</td><td rowspan="2" >
						   <input type="checkbox"  name="panel_rights[]" id="panel_28" onclick="check_all_panel_wise('28')" <?php if($panel_student=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_student"   />
			                  </td><td rowspan="2"><label>Student</label></td>
						  <td>
						  
						  <input type="checkbox" <?php if($sub_panel_student_registration=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="sub_panel_student_registration"   />
			                  </td><td><label>Student Registration</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_student_registration_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="sub_panel_student_registration_list"   />
			                  </td><td><label>Student Registration List</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_student_admission_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="sub_panel_student_admission_list"   />
			                  </td><td><label>Student Admission List</label></td><td style="display:none;">
							
							<input type="checkbox" <?php //if($sub_panel_student_admission_fee_list=='yes'){ echo 'checked'; } ?> checked name="panel_rights[]" class="check_all_panel check_028"   onclick="check_all_panel_wise_all('28')" value="sub_panel_student_admission_fee_list"   />
			                  </td><td style="display:none;"><label>Student Admission Fee List</label></td>
			                  
			                  
			                  
			                  <td>
							    <input type="checkbox" <?php if($sub_panel_rfid_card_generate=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="sub_panel_rfid_card_generate"   />
			                  </td>
			                  <td>
			                     <label>Rfid Card Generate</label>
			                  </td>
							
							  <td>
							    <input type="checkbox" <?php if($student_sub_panel_profile_update=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_profile_update"   />
			                  </td>
			                  <td>
			                     <label>Student Profile Update</label>
			                  </td>
			                 </tr>
							<tr>
							<td>
							    <input type="checkbox" <?php if($student_sub_panel_mapping_data_update=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_mapping_data_update"   />
			                </td>
			                <td>
			                     <label>Mapping Data Update</label>
			                </td>    
							    
							    
							<td>
						<input type="checkbox" <?php if($sub_panel_student_roll_no=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="sub_panel_student_roll_no"   />
			                  </td><td><label>Student Roll No</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_student_id_card=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="sub_panel_student_id_card"   />
			                  </td><td><label>Student Id Card</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_student_action=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="sub_panel_student_action"   />
			                  </td><td><label>One Click</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_health_zone=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="sub_panel_health_zone"   />
			                  </td><td><label>Health Zone</label></td><td>
							
							<input type="checkbox" <?php if($sub_panel_physical_fitness=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="sub_panel_physical_fitness"   />
			                  </td><td><label>Physical Fitness</label></td></tr>
						  <tr>
						  <td></td>
			              <td></td>
			              <td></td>
						  <td>
							 <input type="checkbox" <?php if($student_sub_panel_sms_contact_update=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_sms_contact_update"   />
			              </td>
			              <td>
			                 <label>Sms contact Update</label>
			              </td>
			              
			              <td>
							 <input type="checkbox" <?php if($student_sub_panel_web_sms=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_web_sms"   />
			              </td>
			              <td>
			                 <label>Web Sms</label>
			              </td>
			              <td>
							 <input type="checkbox" <?php if($student_sub_panel_guardian_id_card=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_guardian_id_card"   />
			              </td>
			              <td>
			                 <label>Guardian Id Card</label>
			              </td>
			              <td>
							 <input type="checkbox" <?php if($student_sub_panel_father_id_card=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_father_id_card"   />
			              </td>
			              <td>
			                 <label>father Id Card</label>
			              </td>
			              
			              <td>
							 <input type="checkbox" <?php if($student_sub_panel_mother_id_card=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_mother_id_card"   />
			              </td>
			              <td>
			                 <label>Mother Id Card</label>
			              </td>
			              
			              <td>
							 <input type="checkbox" <?php if($student_sub_panel_student_strength_castwise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_student_strength_castwise"   />
			              </td>
			              <td>
			                 <label>Student strength Castwise</label>
			              </td>
			              </tr>
			              <tr>
						  <td></td>
			              <td></td>
			              <td></td>
			              <td>
							 <input type="checkbox" <?php if($student_sub_panel_photo_update=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_photo_update"   />
			              </td>
			              <td>
			                 <label>Photo Update</label>
			              </td>
			              <td>
							 <input type="checkbox" <?php if($student_sub_panel_student_strength_religionwise=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_student_strength_religionwise"   />
			              </td>
			              <td>
			                 <label>Student strength Religion</label>
			              </td>
			              
			              <td>
							 <input type="checkbox" <?php if($student_sub_panel_generate_csv=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_generate_csv"   />
			              </td>
			              <td>
			                 <label>Generate CSV</label>
			              </td>
						  <td>
							 <input type="checkbox" <?php if($student_sub_panel_upload_csv=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_sub_panel_upload_csv"   />
			              </td>
			              <td>
			                 <label>Upload Csv</label>
			              </td>
			              
			              <td>
							 <input type="checkbox" <?php if($student_panel_edit_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_panel_edit_button"   />
			              </td>
			              <td>
			                 <label style="color:red;">Student Panel Edit Button</label>
			              </td>
			              
			              <td>
							 <input type="checkbox" <?php if($student_panel_delete_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_28"   onclick="check_all_panel_wise_all('28')" value="student_panel_delete_button"   />
			              </td>
			              <td>
			                 <label style="color:red;">Student Panel Delete Button</label>
			              </td>
			              </tr>
						  
						  
						    <tr><td>29</td><td>
						    <input type="checkbox"  name="panel_rights[]" id="panel_29" onclick="check_all_panel_wise('29')" <?php if($panel_time_table=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_time_table"   />
			                  </td><td><label>Time Table</label></td>
						 <td>
						 
						 <input type="checkbox" <?php if($sub_panel_time_table_generate=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="sub_panel_time_table_generate"   />
			                  </td><td><label>Time Table Generate</label></td><td>
							
							
							<input type="checkbox" <?php if($sub_panel_time_table_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="sub_panel_time_table_list"   />
			                  </td><td><label>Time Table List</label></td>
			                  
			             <td>
						   <input type="checkbox" <?php if($sub_panel_teacher_availability=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="sub_panel_teacher_availability"   />
			             </td>
			             <td>
			               <label>Teacher Availability</label>
			             </td>
			             
			             
			             <td>
						   <input type="checkbox" <?php if($time_table_sub_panel_class_periode=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="time_table_sub_panel_class_periode"   />
			             </td>
			             <td>
			               <label>Class Periode</label>
			             </td>
			             
			             <td>
						   <input type="checkbox" <?php if($time_table_sub_panel_subjectwise_teacher=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="time_table_sub_panel_subjectwise_teacher"   />
			             </td>
			             <td>
			               <label>Add Subjectwise Teacher</label>
			             </td>
			             
			             
			             <td>
						   <input type="checkbox" <?php if($time_table_sub_panel_teacher_mgt=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="time_table_sub_panel_teacher_mgt"   />
			             </td>
			             <td>
			               <label>Teacher Management</label>
			             </td>
			             </tr>
			             <tr>
			             <td></td>    
			             <td></td>    
			             <td></td>
			             <td>
						   <input type="checkbox" <?php if($time_table_sub_panel_timetable_sheet=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="time_table_sub_panel_timetable_sheet"   />
			             </td>
			             <td>
			               <label>Time Table Sheet</label>
			             </td>
			           
			             <td>
						   <input type="checkbox" <?php if($time_table_sub_panel_class_periode1=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="time_table_sub_panel_class_periode1"   />
			             </td>
			             <td>
			               <label>Diffrent class periode</label>
			             </td>
			             <td>
						   <input type="checkbox" <?php if($time_table_sub_panel_time_table1=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="time_table_sub_panel_time_table1"   />
			             </td>
			             <td>
			               <label>Diffrent Time Table</label>
			             </td>
			             <td>
						   <input type="checkbox" <?php if($time_table_sub_panel_time_table_list1=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_29"   onclick="check_all_panel_wise_all('29')" value="time_table_sub_panel_time_table_list1"   />
			             </td>
			             <td>
			               <label>Diffrent Time Table List</label>
			             </td>
			             
			             </tr>
			             
			             
						    <tr><td>30</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_30" onclick="check_all_panel_wise('30')" <?php if($panel_utility=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_utility"   />
			                  </td><td><label>Utility</label></td>
						  <td>
						  <input type="checkbox" <?php if($sub_panel_hindi_type=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_30"   onclick="check_all_panel_wise_all('30')" value="sub_panel_hindi_type"   />
			                  </td><td><label>Hindi Type</label></td>
			                  
			                  
			                  <td>
							    <input type="checkbox" <?php if($sub_panel_editor1=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_30"   onclick="check_all_panel_wise_all('30')" value="sub_panel_editor1"   />
			                  </td>
			                  <td>
			                     <label>Editor</label>
			                  </td>
			                  
			                  <td>
							    <input type="checkbox" <?php if($sub_panel_login_details=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_30"   onclick="check_all_panel_wise_all('30')" value="sub_panel_login_details"   />
			                  </td>
			                  <td>
			                     <label>Login Details</label>
			                  </td>
			                  
			                  <td>
							    <input type="checkbox" <?php if($sub_panel_student_login=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_30"   onclick="check_all_panel_wise_all('30')" value="sub_panel_student_login"   />
			                  </td>
			                  <td>
			                     <label>Student Login Details</label>
			                  </td>
			                  
			                  <td>
							    <input type="checkbox" <?php if($sub_panel_teacher_login=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_30"   onclick="check_all_panel_wise_all('30')" value="sub_panel_teacher_login"   />
			                  </td>
			                  <td>
			                     <label>Teacher Login Details</label>
			                  </td>
			                  
			                  </tr>
						    <tr><td>31</td>
						    <td>
						      <input type="checkbox"  name="panel_rights[]" id="panel_31" onclick="check_all_panel_wise('31')" <?php if($panel_session=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_session"   />
			                </td>
			                <td>
			                  <label>Session</label>
			                </td>
						 
						    <td>
							  <input type="checkbox" <?php if($sub_panel_add_session=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_31"   onclick="check_all_panel_wise_all('3`')" value="sub_panel_add_session"   />
			                </td>
			                <td>
			                  <label>Add Session</label>
			                </td>
			                
			                <td>
							  <input type="checkbox" <?php if($sub_panel_move_student=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_31"   onclick="check_all_panel_wise_all('3`')" value="sub_panel_move_student"   />
			                </td>
			                <td>
			                  <label>Move Student</label>
			                </td>
						 
						 
						 </tr>
						    <tr><td>32</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_32" onclick="check_all_panel_wise('32')" <?php if($panel_user_right=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_user_right"   />
			                  </td><td><label>User Right</label></td>
						  <td></td></tr>
						    <tr><td>33</td><td>
		                     <input type="checkbox"  name="panel_rights[]" id="panel_33" onclick="check_all_panel_wise('33')" <?php if($panel_live_bus=='yes'){ echo 'checked'; } ?> class="check_all_panel"  value="panel_live_bus"   />
						    </td><td><label>Live Bus</label></td>
			              <td></td></tr>
						    <tr><td>34</td>
						    
						    <td>
						       <input type="checkbox"  name="panel_rights[]" id="panel_34" onclick="check_all_panel_wise('34')" <?php if($panel_android_app=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_android_app"   />
			                </td>
			                <td>
			                    <label>Android App</label>
			                </td>
			                
			                <td>
							  <input type="checkbox" <?php if($panel_notifiction=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_34"   onclick="check_all_panel_wise_all('34')" value="panel_notifiction"   />
			                </td>
			                <td>
			                  <label>Notification</label>
			                </td>
							
							<td>
							  <input type="checkbox" <?php if($android_app_sub_panel_notification_add=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_34"   onclick="check_all_panel_wise_all('34')" value="android_app_sub_panel_notification_add"   />
			                </td>
			                <td>
			                  <label>Add Notification</label>
			                </td>
							
							<td>
							  <input type="checkbox" <?php if($android_app_sub_panel_notification_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_34"   onclick="check_all_panel_wise_all('34')" value="android_app_sub_panel_notification_list"   />
			                </td>
			                <td>
			                  <label>Notification List</label>
			                </td>
			                
			                <td>
							  <input type="checkbox" <?php if($android_app_sub_panel_password_reset=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_34"   onclick="check_all_panel_wise_all('34')" value="android_app_sub_panel_password_reset"   />
			                </td>
			                <td>
			                  <label>Password Reset</label>
			                </td>
							
							
							</tr>
						    <tr><td>35</td>
						   <td>
						    <input type="checkbox"  name="panel_rights[]" id="panel_35" onclick="check_all_panel_wise('35')" <?php if($panel_website_management=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_website_management"   />
			               </td>
			               <td>
			                <label>Website Management</label>
			               </td>
					       <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_notification=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_notification"   />
			                </td>
			                <td>
			                  <label>Website Notification</label>
			                </td>
					       <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_busroute=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_busroute"   />
			                </td>
			                <td>
			                  <label>Bus Route</label>
			                </td>
			                <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_reqirectment=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_reqirectment"   />
			                </td>
			                <td>
			                  <label>Requiretment</label>
			                </td>
			                <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_commety=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_commety"   />
			                </td>
			                <td>
			                  <label>Commety</label>
			                </td>
					        <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_slider=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_slider"   />
			                </td>
			                <td>
			                  <label>Slider</label>
			                </td> 
					        <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_time_table=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_time_table"   />
			                </td>
			                <td>
			                  <label>Time table</label>
			                </td> 
					     </tr>
					     <tr>
					     <td></td>    
					     <td></td>    
					     <td></td>    
					         <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_tc_upload=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_tc_upload"   />
			                </td>
			                <td>
			                  <label>Tc Upload</label>
			                </td> 
			                <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_kiosk_reg=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_kiosk_reg"   />
			                </td>
			                <td>
			                  <label>Kiosk Reg</label>
			                </td> 
			                <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_kiosk_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_kiosk_list"   />
			                </td>
			                <td>
			                  <label>Kiosk Reg List</label>
			                </td> 
			                <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_syllebus=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_syllebus"   />
			                </td>
			                <td>
			                  <label>Syllebus Details</label>
			                </td>
			                <td>
							  <input type="checkbox" <?php if($sub_panel_website_management_dashboard_marquee=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_35"   onclick="check_all_panel_wise_all('35')" value="sub_panel_website_management_dashboard_marquee"   />
			                </td>
			                <td>
			                  <label>Dashboard Marquee</label>
			                </td>
					     </tr>
					     
					<tr><td>36</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_36" onclick="check_all_panel_wise('36')" <?php if($panel_customer_support=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_customer_support"   />
			                    </td><td><label>panel support</label></td>
					
					<td>
					  <input type="checkbox" <?php if($support_sub_panel_add_query=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_36"   onclick="check_all_panel_wise_all('36')" value="support_sub_panel_add_query"   />
			        </td>
			        <td>
			           <label>Add Query</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($support_sub_panel_query_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_36"   onclick="check_all_panel_wise_all('36')" value="support_sub_panel_query_list"   />
			        </td>
			        <td>
			           <label>Query List</label>
			        </td>
					
					</tr>
					<tr><td>37</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_37" onclick="check_all_panel_wise('37')" <?php if($panel_gate_pass=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_gate_pass"   />
			                    </td><td><label>Gate Pass</label></td>
					
					<td>
					  <input type="checkbox" <?php if($gatepass_sub_panel_add_new=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_37"   onclick="check_all_panel_wise_all('37')" value="gatepass_sub_panel_add_new"   />
			        </td>
			        <td>
			           <label>Add  New GatePass</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($gatepass_sub_panel_gatepass_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_37"   onclick="check_all_panel_wise_all('37')" value="gatepass_sub_panel_gatepass_list"   />
			        </td>
			        <td>
			           <label>Gate Pass List</label>
			        </td>
					
					
					
					</tr>
					
					<tr><td>38</td><td>
						   <input type="checkbox"  name="panel_rights[]" id="panel_38" onclick="check_all_panel_wise('38')" <?php if($panel_stock_management=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_stock_management"   />
			                    </td><td><label>Stock Management</label></td>
					
					<td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_add_vandor=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_add_vandor"   />
			        </td>
			        <td>
			           <label>Add Vendor</label>
			        </td>
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_vandor_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_vandor_list"   />
			        </td>
			        <td>
			           <label>Vendor List</label>
			        </td>
			        
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_category_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_category_list"   />
			        </td>
			        <td>
			           <label>Category List</label>
			        </td>
			         <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_list_book_item=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_list_book_item"   />
			        </td>
			        <td>
			           <label>Book Item List</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_buy_book_item_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_buy_book_item_list"   />
			        </td>
			        <td>
			           <label>Buy Book Item List</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_book_add_in_stock=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_book_add_in_stock"   />
			        </td>
			        <td>
			           <label>Buy Book Add stock</label>
			        </td>
					</tr>
					<tr>
					 <td></td>   
					 <td></td>   
					 <td></td>   
					 <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_add_category=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_add_category"   />
			        </td>
			        <td>
			           <label>Add Category</label>
			        </td> 
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_vandor_list_edit=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_vandor_list_edit"   />
			        </td>
			        <td>
			           <label style="color:Red;">Vendor List Edit Button</label>
			        </td> 
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_category_list_edit_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_category_list_edit_button"   />
			        </td>
			        <td>
			           <label style="color:Red;">Category List Edit Button</label>
			        </td>
			        
			         <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_list_book_item_edit=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_list_book_item_edit"   />
			        </td>
			        <td>
			           <label style="color:Red;">book Item Edit Button</label>
			        </td> 
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_buy_book_item_list_edit=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_buy_book_item_list_edit"   />
			        </td>
			        <td>
			           <label style="color:Red;">Buy book Item Edit Button</label>
			        </td>
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_book_add_in_stock_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_book_add_in_stock_button"   />
			        </td>
			        <td>
			           <label style="color:Red;">Add in stock Button</label>
			        </td>
			        
			       
			        
					</tr>
					<tr>
					 <td></td>   
					 <td></td>   
					 <td></td>   
					 <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_add_book_item=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_add_book_item"   />
			        </td>
			        <td>
			           <label>Add Book Item</label>
			        </td>
					 <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_vandor_list_delete=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_vandor_list_delete"   />
			        </td>
			        <td>
			           <label style="color:Red;">Vendor List Delete Button</label>
			        </td> 
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_category_list_delete_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_category_list_delete_button"   />
			        </td>
			        <td>
			           <label style="color:Red;">Category List Delete Button</label>
			        </td> 
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_list_book_item_delete=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_list_book_item_delete"   />
			        </td>
			        <td>
			           <label style="color:Red;">Book Item Delete Button</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_buy_book_item_list_delete=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_buy_book_item_list_delete"   />
			        </td>
			        <td>
			           <label style="color:Red;">Buy Book Item Delete Button</label>
			        </td>
			         <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_book_sale_item=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_book_sale_item"   />
			        </td>
			        <td>
			           <label>Sale item</label>
			        </td>
					</tr>
					<td></td>   
					 <td></td>   
					 <td></td>   
					 <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_buy_book_item=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_buy_book_item"   />
			        </td>
			        <td>
			           <label>Buy Book Item</label>
			        </td>
			        
			         <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_book_sale_item_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_book_sale_item_list"   />
			        </td>
			        <td>
			           <label>Book Sale Item List</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_book_stock_return=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_book_stock_return"   />
			        </td>
			        <td>
			           <label> Book Stock Return</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_book_stock_return_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_book_stock_return_list"   />
			        </td>
			        <td>
			           <label>Book Stock Return List</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_list_item_uniform=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_list_item_uniform"   />
			        </td>
			        <td>
			           <label>Add uniform item List</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_uniform_buy_item_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_uniform_buy_item_list"   />
			        </td>
			        <td>
			           <label>Buy uniform item List</label>
			        </td>
					<tr>
					</tr>
					<tr>
					 <td></td>   
					 <td></td>   
					 <td></td>   
					 <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_buy_book_cancle_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_buy_book_cancle_list"   />
			        </td>
			        <td>
			           <label>Buy Book cancle List</label>
			        </td> 
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_book_sale_item_list_cancle_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_book_sale_item_list_cancle_button"   />
			        </td>
			        <td>
			           <label style="color:red;">Sale List Cancle Button</label>
			        </td> 
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_add_item_uniform=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_add_item_uniform"   />
			        </td>
			        <td>
			           <label>Add Item Uniform</label>
			        </td>
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_uniform_buy_item=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_uniform_buy_item"   />
			        </td>
			        <td>
			           <label>Buy Item Uniform</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_uniform_item_edit_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_uniform_item_edit_button"   />
			        </td>
			        <td>
			           <label style="color:red;">Uniform List Edit Button</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_uniform_buy_item_list_cancel=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_uniform_buy_item_list_cancel"   />
			        </td>
			        <td>
			           <label style="color:red;">Buy Item cacel Button</label>
			        </td>
					    
					</tr>
					<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_uniform_item_delete_button=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_uniform_item_delete_button"   />
			        </td>
			        <td>
			           <label style="color:red;">Uniform List Delete Button</label>
			        </td>
					</tr>
					<tr>
					   <td></td> 
					   <td></td> 
					   <td></td>
					   <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_buy_cancel_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_buy_cancel_list"   />
			        </td>
			        <td>
			           <label>Buy Uniform Cancel List</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_add_in_stock=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_add_in_stock"   />
			        </td>
			        <td>
			           <label>Uniform Add in stock </label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_sale_item_uniform=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_sale_item_uniform"   />
			        </td>
			        <td>
			           <label>sale item Uniform</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_uniform_sale_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_uniform_sale_list"   />
			        </td>
			        <td>
			           <label>sale List Uniform</label>
			        </td>
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_uniform_sale_cancel_list=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_uniform_sale_cancel_list"   />
			        </td>
			        <td>
			           <label>uniform sale Cancel List </label>
			        </td>
			        
			        
			        <td>
					  <input type="checkbox" <?php if($stock_mgt_sub_panel_uniform_add_opening=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_sub_panel_uniform_add_opening"   />
			        </td>
			        <td>
			           <label>uniform Add Openning</label>
			        </td>
			        
					</tr>
					<tr>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td>
					  <input type="checkbox" <?php if($stock_mgt_reports=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_38"   onclick="check_all_panel_wise_all('38')" value="stock_mgt_reports"   />
			        </td>
			        <td>
			           <label>Reports of stock management</label>
			        </td>
					</tr>
					<tr><td>39</td>
						    
						    <td>
						       <input type="checkbox"  name="panel_rights[]" id="panel_39" onclick="check_all_panel_wise('39')" <?php if($panel_important=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_important"/>
			                </td>
			                <td>
			                    <label>Panel Important</label>
			                </td>
			         </tr> 	
			         
			         
			         <tr><td rowspan="2">40</td>
			         <td rowspan="2">
						    
						       <input type="checkbox"  name="panel_rights[]" id="panel_40" onclick="check_all_panel_wise('40')" <?php if($panel_smartclass=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_smartclass"/>
			                </td>
			                <td rowspan="2">
			                    <label>Panel SmartClass</label>
			                </td>
			                		  <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_video_lecture=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_video_lecture"   />
			                  </td><td><label>Video Lecture</label></td>
			                  <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_homework=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_homework"   />
			                  </td><td><label>Homework</label></td>
			                  <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_notification=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_notification"   />
			                  </td><td><label>Notification</label></td>
			                  <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_study_material=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_study_material"   />
			                  </td><td><label>Study Material</label></td>
			                  <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_online_exam=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_online_exam"   />
			                  </td><td><label>Online Exam</label></td>
			               <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_smartclass_app_rights=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_smartclass_app_rights"   />
			                  </td><td><label>App Rights</label></td>
			                  
			         </tr> 
			         <tr>
			              <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_student_user_password_change=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_student_user_password_change"   />
			                  </td><td><label>Student Password Change</label></td>
			                  <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_student_login_details=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_student_login_details"   />
			                  </td><td><label>Login Details</label></td>
			                  <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_result=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_result"   />
			                  </td><td><label>Result</label></td>
			                
						  <td>
						  <input type="checkbox" <?php if($sub_panel_smartclass_liveclass=='yes'){ echo 'checked'; } ?>    name="panel_rights[]" class="check_all_panel check_40"   onclick="check_all_panel_wise_all('40')" value="sub_panel_smartclass_liveclass"   />
			                  </td><td><label>Live Class</label></td>
			                 
			                  
			         </tr>
			         
			         
			         
			         
			         
			         
			         
			         <tr><td>41</td>
						    
						    <td>
						       <input type="checkbox"  name="panel_rights[]" id="panel_41" onclick="check_all_panel_wise('41')" <?php if($panel_call_management=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_call_management"/>
			                </td>
			                <td>
			                    <label>Panel Call Management</label>
			                </td>
			         </tr> 	<tr><td>42</td>
						    
						    <td>
						       <input type="checkbox"  name="panel_rights[]" id="panel_42" onclick="check_all_panel_wise('42')" <?php if($panel_classtest=='yes'){ echo 'checked'; } ?> class="check_all_panel"   value="panel_classtest"/>
			                </td>
			                <td>
			                    <label>Panel Class Test</label>
			                </td>
			         </tr>       
				  </tbody>

             </table>	
		
				
		
            <!-- /.box-body -->
          </div>


          </div>

			  <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title">Class and Section Right</h3>  
			  <input type="checkbox"   id="id_class_check"   onclick="check_all_class1()" />
				     <label>Check All</label>
            </div>
           
			
              <div class="box-body table-responsive">
              <table  class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th style="width:100px">S No</th>
                  <th style="width:200px" >Class Name</th>
                  <th  >Section</th>
                
                  
                 
                </tr>
                </thead>
		
		<tbody>
				<?php 
				include("../../con73/con37.php");
				$serial_no=0;
				$class232 = explode('|?|',$class);
				$section232 = explode('|?|',$section);
				
				$count231=count($class232);
				
		  $que="select * from school_info_class_info";
                               $run=mysqli_query($conn73,$que);
                               while($row21=mysqli_fetch_assoc($run)){
                               $class_name12=$row21['class_name']; 
                               $class_code12=$row21['class_code']; 
                               $section23=$row21['section']; 
                               
                               $class_name123=str_replace(" ","_",$class_name12);
			$chek23='';
			$np='';
	for($r=0;$r<$count231;$r++){
	if($class232[$r]==$class_name12){
	$chek23='yes';
	$np=$r;
	}
	}
	
	$section_count1='0';
	if($chek23=='yes'){
	$section2321 = explode('_',$section232[$np]);
	$section_count1=count($section2321);
	}
				$serial_no++;
				if( $class_name12=='11TH' || $class_name12=='12TH'){
				$stream_count=0;
				 $que121="select * from school_info_stream_info";
                               $run111=mysqli_query($conn73,$que121);
                               while($row121=mysqli_fetch_assoc($run111)){
                               $stream_name121=$row121['stream_name'];
if($stream_name121!=''){
							 $stream_name[$stream_count]=$stream_name121;
							 $stream_count++;
							 
        
				}
				}
				}
			
		
				
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td> <input type="checkbox"  name="class_right[]" class="check_all_class" id="<?php echo 'id_check_all_classwise'.$serial_no; ?>" onclick="class_wise_check('<?php echo $serial_no; ?>');" <?php if($chek23=='yes'){ echo 'checked'; } ?> value="<?php echo $class_name12 ?>"   />   <label><?php echo $class_name12; ?></label></td>
				  <input type="hidden" name='section1[]' value="<?php echo $section23; ?>" />
				  
				  
				  
				  
                  <td>  <?php  if($section23=='1'){?> 
				  <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  value="A"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
		<?php 	}elseif($section23=='2'){ ?>
		 <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="A" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="B" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='B'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>B</label>
				<?php 	}elseif($section23=='3'){ ?>
		 <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  value="A" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='B'){  echo 'checked'; } } ?> value="B"  onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>B</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="C" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='C'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>C</label>
							<?php 	}elseif($section23=='4'){ ?>
		 <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="A" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  value="B" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='B'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>B</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="C" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='C'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>C</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="D" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='D'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>D</label>
			<?php 	}elseif($section23=='5'){ ?>
		 <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="A" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='B'){  echo 'checked'; } } ?> value="B" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>B</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='C'){  echo 'checked'; } } ?> value="C"  onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>C</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="D" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='D'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>D</label>	
				       <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='E'){  echo 'checked'; } } ?> value="E" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>E</label>	
			<?php 	}elseif($section23=='6'){ ?>
		 <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="A" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='B'){  echo 'checked'; } } ?> value="B" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>B</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='C'){  echo 'checked'; } } ?> value="C"  onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>C</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="D" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='D'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>D</label>	
				       <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='E'){  echo 'checked'; } } ?> value="E" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>E</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='F'){  echo 'checked'; } } ?> value="F" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>F</label>
			<?php 	}elseif($section23=='7'){ ?>
		 <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="A" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='B'){  echo 'checked'; } } ?> value="B" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>B</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='C'){  echo 'checked'; } } ?> value="C"  onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>C</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="D" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='D'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>D</label>	
				       <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='E'){  echo 'checked'; } } ?> value="E" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>E</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='F'){  echo 'checked'; } } ?> value="F" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>F</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='G'){  echo 'checked'; } } ?> value="G" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>G</label>
			<?php 	}elseif($section23=='8'){ ?>
		 <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="A" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='B'){  echo 'checked'; } } ?> value="B" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>B</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='C'){  echo 'checked'; } } ?> value="C"  onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>C</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="D" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='D'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>D</label>	
				       <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='E'){  echo 'checked'; } } ?> value="E" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>E</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='F'){  echo 'checked'; } } ?> value="F" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>F</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='G'){  echo 'checked'; } } ?> value="G" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>G</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='H'){  echo 'checked'; } } ?> value="H" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>H</label>
			<?php 	}elseif($section23=='9'){ ?>
		 <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="A" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='B'){  echo 'checked'; } } ?> value="B" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>B</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='C'){  echo 'checked'; } } ?> value="C"  onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>C</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="D" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='D'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>D</label>	
				       <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='E'){  echo 'checked'; } } ?> value="E" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>E</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='F'){  echo 'checked'; } } ?> value="F" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>F</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='G'){  echo 'checked'; } } ?> value="G" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>G</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='H'){  echo 'checked'; } } ?> value="H" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>H</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='I'){  echo 'checked'; } } ?> value="I" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>I</label>
			<?php 	}elseif($section23=='10'){ ?>
		 <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="A" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='A'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>A</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='B'){  echo 'checked'; } } ?> value="B" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>B</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='C'){  echo 'checked'; } } ?> value="C"  onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>C</label>
				    <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> "  class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>" value="D" <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='D'){  echo 'checked'; } } ?> onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');" />
				     <label>D</label>	
				       <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='E'){  echo 'checked'; } } ?> value="E" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>E</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='F'){  echo 'checked'; } } ?> value="F" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>F</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='G'){  echo 'checked'; } } ?> value="G" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>G</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='H'){  echo 'checked'; } } ?> value="H" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>H</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='I'){  echo 'checked'; } } ?> value="I" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>I</label>
				     <input type="checkbox"  name="<?php echo $class_name123.'_section[]'; ?> " class="check_all_class <?php echo 'check_all_classwise'.$serial_no; ?>"  <?php 	for($h1=0;$h1<$section_count1;$h1++){ if($section2321[$h1]=='J'){  echo 'checked'; } } ?> value="J" onclick="class_wise_check_reverse('<?php echo $serial_no; ?>');"  />
				     <label>J</label>
			<?php   } ?>
			
			</td>
			
                </tr>
               <?php  }?>

                </tbody>
 <input type="hidden" value="<?php echo $serial_no; ?>" name="serial_no" >
             </table>
            </div>
         			
				
				
				 <div class="col-md-12 ">	
			 
				<center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
				</div>	
				
		
            <!-- /.box-body -->
          </div>


       
		  
		  </form>	
		   <?php  } ?>
    </div>
</section>


<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>