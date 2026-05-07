<?php 
include("../attachment/session.php");
 include("../attachment/image_compression_upload.php");

	$emp_name = $_POST['emp_name'];
	$emp_gender = $_POST['emp_gender'];
	$emp_dob = $_POST['emp_dob'];
	$emp_father = $_POST['emp_father'];
	$emp_email = $_POST['emp_email'];
	$emp_mobile = $_POST['emp_mobile'];
	$emp_address = $_POST['emp_address'];
	
	$emp_qualification = $_POST['emp_qualification'];
	$emp_doj = $_POST['emp_doj'];
	$emp_designation = $_POST['emp_designation'];
	$emp_casual_leave = $_POST['emp_casual_leave'];
	$emp_pan_card_no = $_POST['emp_pan_card_no'];
	$emp_bank_name = $_POST['emp_bank_name'];
	$emp_account_no = $_POST['emp_account_no'];
	$emp_ifsc_code = $_POST['emp_ifsc_code'];
	$emp_basic_salary = $_POST['emp_basic_salary'];
	$emp_pf_number = $_POST['emp_pf_number'];
    $emp_uid_no = $_POST['emp_uid_no'];
	$remarks = $_POST['remarks'];
		$s_no = $_POST['s_no'];
	
$quer="insert into hostel_staff_info(emp_name,emp_gender,emp_dob,emp_father,emp_email,emp_mobile,emp_address,emp_qualification,emp_doj,emp_designation,emp_casual_leave,emp_pan_card_no,emp_bank_name,emp_account_no,emp_ifsc_code,emp_basic_salary,emp_pf_number,emp_uid_no,remarks)
 values('$emp_name','$emp_gender','$emp_dob','$emp_father','$emp_email','$emp_mobile','$emp_address','$emp_qualification','$emp_doj','$emp_designation','$emp_casual_leave','$emp_pan_card_no','$emp_bank_name','$emp_account_no','$emp_ifsc_code','$emp_basic_salary','$emp_pf_number','$emp_uid_no','$remarks')";
   
if(mysqli_query($conn73,$quer)){
    $s_no=mysql_insert_id();
				


	$emp_photo=$_FILES['emp_photo']['name'];        
	if($emp_photo!=''){
	$imagename = $_FILES['emp_photo']['name'];
	$size = $_FILES['emp_photo']['size'];
    $uploadedfile = $_FILES['emp_photo']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$s_no,"emp_photo","hostel_staff","s_no");
						}
    
echo "|?|success|?|";
}
?>