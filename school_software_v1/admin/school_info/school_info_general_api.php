<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
	
	$school_info_school_name = my_validation($_POST['school_info_school_name']);
	$school_info_school_state = $_POST['school_info_school_state'];
	$school_info_school_district = $_POST['school_info_school_district'];
	$school_info_school_city = $_POST['school_info_school_city'];
	$school_info_school_pincode = $_POST['school_info_school_pincode'];
	$school_info_school_landmark = $_POST['school_info_school_landmark'];
	$school_info_school_latitude = $_POST['school_info_school_latitude'];
	$school_info_school_longitude = $_POST['school_info_school_longitude'];
	$school_info_school_address = $_POST['school_info_school_address'];
	$school_info_school_contact_no = $_POST['school_info_school_contact_no'];
	$school_info_school_email_id = $_POST['school_info_school_email_id'];
	$school_info_school_website = $_POST['school_info_school_website'];
	$school_info_principal_name = $_POST['school_info_principal_name'];
	$school_info_dise_code = $_POST['school_info_dise_code'];
	$school_info_school_code = $_POST['school_info_school_code'];
	$school_info_registration_code = $_POST['school_info_registration_code'];
	$defalut_session_value = $_POST['defalut_session_value'];

	
	$school_info_medium = $_POST['school_info_medium'];
	$school_info_school_board = $_POST['school_info_school_board'];
	$school_info_student_type = $_POST['school_info_student_type'];
	$school_info_student_category = $_POST['school_info_student_category'];
	$school_info_about = $_POST['school_info_about'];
	$database_version = isset($_POST['database_version']) ? $_POST['database_version'] : '';
	$fees_category = $_POST['fees_category'];
	$blank_field_1 = isset($_POST['blank_field_1']) ? $_POST['blank_field_1'] : '';
	$multiple_school = $_POST['multiple_school'];
	
	$school_info_principal_seal=$_FILES['school_info_principal_seal']['name'];            
	$school_info_principal_signature=$_FILES['school_info_principal_signature']['name'];            
	$school_info_logo=$_FILES['school_info_logo']['name'];            

	if($school_info_principal_seal!=''){
	$imagename = $_FILES['school_info_principal_seal']['name'];
	$size = $_FILES['school_info_principal_seal']['size'];
    $uploadedfile = $_FILES['school_info_principal_seal']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,'1',"school_info_principal_seal","school_document","1");
	}
	if($school_info_principal_signature!=''){
	$imagename = $_FILES['school_info_principal_signature']['name'];
	$size = $_FILES['school_info_principal_signature']['size'];
    $uploadedfile = $_FILES['school_info_principal_signature']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,'1',"school_info_principal_signature","school_document","1");
	}
	if($school_info_logo!=''){
	$imagename = $_FILES['school_info_logo']['name'];
	$size = $_FILES['school_info_logo']['size'];
    $uploadedfile = $_FILES['school_info_logo']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,'1',"school_info_logo","school_document","1");
	}
	$database_name=$_SESSION['database_name'];
 // file_get_contents("https://simptionschoolsoftware.com/attendance_machine/new/version_update.php?database=$database_name&database_version=$database_version");

$quer="update school_info_general set blank_field_1='$blank_field_1',multiple_school='$multiple_school',fees_type='$fees_category', fees_category='$fees_category',school_info_school_name='$school_info_school_name',school_info_school_state='$school_info_school_state',school_info_school_district='$school_info_school_district',school_info_school_city='$school_info_school_city',school_info_school_pincode='$school_info_school_pincode',school_info_school_landmark='$school_info_school_landmark',school_info_school_latitude='$school_info_school_latitude',school_info_school_longitude='$school_info_school_longitude',school_info_school_address='$school_info_school_address',school_info_school_contact_no='$school_info_school_contact_no',school_info_principal_name='$school_info_principal_name',school_info_dise_code='$school_info_dise_code',school_info_school_code='$school_info_school_code',school_info_registration_code='$school_info_registration_code',school_info_medium='$school_info_medium',school_info_school_board='$school_info_school_board',school_info_student_type='$school_info_student_type',school_info_student_category='$school_info_student_category',school_info_school_email_id='$school_info_school_email_id',school_info_school_website='$school_info_school_website',school_info_about='$school_info_about',database_version='$database_version',defalut_session_value='$defalut_session_value',$update_by_update_sql ";
 
if(mysqli_query($conn73,$quer)){
    	/* $sms_staff = $_POST['sms_staff'];
	$sms_student = $_POST['sms_student'];
		$software_link=$_SESSION['database_name1'];
$quer1="update $sms_database.school_detail set sms_staff='$sms_staff',sms_student='$sms_student' where software_link='$software_link'";
mysqli_query($conn731,$quer1); */
	echo "|?|success|?|";
}
?>	