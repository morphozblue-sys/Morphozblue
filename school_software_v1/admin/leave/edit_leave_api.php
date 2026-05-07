<?php include("../attachment/session.php");  
include("../attachment/image_compression_upload.php");

$s_no1=$_POST['s_no1'];
$student_name=$_POST['student_name'];
$student_class=$_POST['student_class'];
$student_section=$_POST['student_section'];
$student_roll_no=$_POST['student_roll_no'];
$leave_from_date_1 = $_POST['leave_from_date'];
$leave_from_date_2 = explode("-",$leave_from_date_1);
$leave_from_date=$leave_from_date_2[2]."-".$leave_from_date_2[1]."-".$leave_from_date_2[0];
$leave_to_date_1 = $_POST['leave_to_date'];
$leave_to_date_2 = explode("-",$leave_to_date_1);
$leave_to_date=$leave_to_date_2[2]."-".$leave_to_date_2[1]."-".$leave_to_date_2[0];
$leave_approved_by=$_POST['leave_approved_by'];
$leave_total_day=$_POST['leave_total_day'];


    $leave_application=$_FILES['leave_application']['name'];        
	if($leave_application!=''){
	$imagename = $_FILES['leave_application']['name'];
	$size = $_FILES['leave_application']['size'];
    $uploadedfile = $_FILES['leave_application']['tmp_name'];
	camera_code($size,$imagename,$uploadedfile,$s_no1,"leave_application","leave_document","s_no");
			}
$query="update student_leave_management set student_name='$student_name',student_class='$student_class',student_section='$student_section',student_roll_no='$student_roll_no',leave_from_date='$leave_from_date_1',leave_to_date='$leave_to_date_1',leave_approved_by='$leave_approved_by',leave_total_day='$leave_total_day',image='$image1',$update_by_update_sql  where s_no='$s_no1'";
if(mysqli_query($conn73,$query))
{
 echo "|?|success|?|";
}
?>