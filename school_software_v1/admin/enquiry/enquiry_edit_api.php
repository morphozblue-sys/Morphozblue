<?php include("../../admin/attachment/session.php"); ?>
<?php
    $s_no1 = $_POST['s_no1'];	
    $enquiry_type = $_POST['enquiry_type'];	
    $enquiry_type_ohter = $_POST['enquiry_type_ohter'];	
	$enquiry_date = $_POST['enquiry_date'];
	$enquiry_name = $_POST['enquiry_name'];
	$enquiry_father_name = $_POST['enquiry_father_name'];
	$student_medium = $_POST['student_medium'];
	$enquiry_contact_no_1 = $_POST['enquiry_contact_no_1'];
	$enquiry_contact_no_2 = $_POST['enquiry_contact_no_2'];
	$enquiry_address = $_POST['enquiry_address'];
    $enquiry_next_follow_up_date_1 = $_POST['enquiry_next_follow_up_date'];
	$enquiry_next_follow_up_date_2 = explode("-",$enquiry_next_follow_up_date_1);
	$enquiry_next_follow_up_date=$enquiry_next_follow_up_date_2[2]."-".$enquiry_next_follow_up_date_2[1]."-".$enquiry_next_follow_up_date_2[0];
	$enquiry_remark_1 = $_POST['enquiry_remark_1'];
	$enquiry_remark_2 = $_POST['enquiry_remark_2'];
	
$quer="update enquiry_info set enquiry_type='$enquiry_type_ohter',enquiry_date='$enquiry_date',enquiry_name='$enquiry_name',enquiry_father_name='$enquiry_father_name',enquiry_contact_no_1='$enquiry_contact_no_1',enquiry_contact_no_2='$enquiry_contact_no_2',enquiry_address='$enquiry_address',enquiry_next_follow_up_date='$enquiry_next_follow_up_date',enquiry_remark_1='$enquiry_remark_1',enquiry_remark_2='$enquiry_remark_2',$update_by_update_sql,student_medium='$student_medium' where s_no='$s_no1'";

if(mysqli_query($conn73,$quer)){
echo "|?|success";
}
?>