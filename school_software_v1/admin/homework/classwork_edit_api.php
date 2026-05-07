<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
    $edit_id = $_POST['edit_id'];
	$classwork_date_1 = $_POST['classwork_date'];
	$classwork_date_2 = explode("-",$classwork_date_1);
	$classwork_date=$classwork_date_2[2]."-".$classwork_date_2[1]."-".$classwork_date_2[0];
	$classwork_class = $_POST['classwork_class'];
	$medium=$_POST['medium'];
		$subject_name = $_POST['subject_name'];
	$student_class_stream = $_POST['student_class_stream'];
	$student_class_group = $_POST['student_class_group'];
	$shift=$_POST['shift'];
	$classwork_section = $_POST['classwork_section'];
	if($homework_section==''){
	$homework_section='ALL';
	}else{
	$classwork_section=$classwork_section;
	}
	$classwork = $_POST['classwork'];
	$classwork_remark = $_POST['classwork_remark'];
    $last_id=$edit_id;
 $qry="update classwork_student set blank_field_2='$subject_name',blank_field_3='$student_class_stream',blank_field_4='$student_class_group',classwork_date='$classwork_date', classwork_class='$classwork_class',classwork='$classwork',classwork_remark='$classwork_remark',medium='$medium',shift='$shift',classwork_section='$classwork_section',$update_by_update_sql where s_no='$edit_id'";
if(mysqli_query($conn73,$qry)) {  
echo "|?|success|?|";
}
?>