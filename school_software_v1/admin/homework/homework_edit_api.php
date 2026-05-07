<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
    $edit_id = $_POST['edit_id'];
	$homework_date_1 = $_POST['homework_date'];
	$homework_date_2 = explode("-",$homework_date_1);
	$homework_date=$homework_date_2[2]."-".$homework_date_2[1]."-".$homework_date_2[0];
	$homework_class = $_POST['homework_class'];
	$medium=$_POST['medium'];
		$subject_name = $_POST['subject_name'];
	$student_class_stream = $_POST['student_class_stream'];
	$student_class_group = $_POST['student_class_group'];
	$shift=$_POST['shift'];
	$homework_section = $_POST['homework_section'];
	if($homework_section==''){
	$homework_section='ALL';
	}else{
	$homework_section=$homework_section;
	}
	$homework = $_POST['homework'];
	$homework_remark = $_POST['homework_remark'];

 $qry="update homework_student set blank_field_2='$subject_name',blank_field_3='$student_class_stream',blank_field_4='$student_class_group',homework_date='$homework_date', homework_class='$homework_class',homework='$homework',homework_remark='$homework_remark',medium='$medium',shift='$shift',homework_section='$homework_section',$update_by_update_sql where s_no='$edit_id'";
if(mysqli_query($conn73,$qry))
{				
$last_id=$edit_id;						
										$que="select * from login";
										$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
										
										while($row=mysqli_fetch_assoc($run)){

											 $server_key=$row['blank_field_4'];
											}
										


	 $img=$_FILES['upload_file']['name'];
		if($img!=''){
	$imagename = $_FILES['upload_file']['name'];
	$size = $_FILES['upload_file']['size'];
    $uploadedfile = $_FILES['upload_file']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$last_id,"homework_file","homework_document","s_no");
	}
	
	
echo "|?|success|?|";
}
?>