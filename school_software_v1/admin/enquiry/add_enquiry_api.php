<?php include("../attachment/session.php");
include("../sms/sms.php");

	$enquiry_type = $_POST['enquiry_type'];
	$enquiry_type_ohter = $_POST['enquiry_type_ohter'];
	$enquiry_date = $_POST['enquiry_date'];
	$enquiry_name = $_POST['enquiry_name'];
	$enquiry_father_name = $_POST['enquiry_father_name'];
	$enquiry_contact_no_1 = $_POST['enquiry_contact_no_1'];
	$enquiry_contact_no_2 = $_POST['enquiry_contact_no_2'];
	$enquiry_address = $_POST['enquiry_address'];
	$student_medium = $_POST['student_medium'];
	$enquiry_next_follow_up_date_1 = $_POST['enquiry_next_follow_up_date'];
	$enquiry_next_follow_up_date_2 = explode("-",$enquiry_next_follow_up_date_1);
	if($enquiry_next_follow_up_date_1!=''){
	$enquiry_next_follow_up_date=$enquiry_next_follow_up_date_2[2]."-".$enquiry_next_follow_up_date_2[1]."-".$enquiry_next_follow_up_date_2[0];
	}else{
		$enquiry_next_follow_up_date='';
	}
	$enquiry_remark_1 = $_POST['enquiry_remark_1'];
	$enquiry_remark_2 = $_POST['enquiry_remark_2'];

    $quer="insert into enquiry_info(enquiry_type,enquiry_date,enquiry_name,enquiry_father_name,enquiry_contact_no_1,enquiry_contact_no_2,enquiry_address,enquiry_next_follow_up_date,enquiry_remark_1,enquiry_remark_2,session_value,student_medium,$update_by_insert_sql_column)
    values('$enquiry_type_ohter','$enquiry_date','$enquiry_name','$enquiry_father_name','$enquiry_contact_no_1','$enquiry_contact_no_2','$enquiry_address','$enquiry_next_follow_up_date','$enquiry_remark_1','$enquiry_remark_2','$session1','$student_medium',$update_by_insert_sql_value)";
 
if(mysqli_query($conn73,$quer)){
if(isset($_POST['myCheck'])){
$sms_content = $_POST['sms_content'];
//sendDNDSMS($enquiry_contact_no_1,$sms_content);
}
echo "|?|success|?|";
}
?>