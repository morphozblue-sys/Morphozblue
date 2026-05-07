<?php include("../attachment/session.php");
include("../sms/sms.php");

$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
while($schl_row=mysqli_fetch_assoc($schl_result)){
$school_info_school_name=$schl_row['school_info_school_name'];
$school_info_dise_code=$schl_row['school_info_dise_code'];
$school_info_school_code=$schl_row['school_info_school_code'];
}

$result=0;
$indexes=$_POST['indexes'];
$total_subject_string=$_POST['total_subject_string'];
$total_marks=$_POST['total_marks'];
$total_obtain=$_POST['total_obtain'];
$other_detail=$_POST['other_detail'];
$count=count($indexes);
for($i=0;$i<$count;$i++){
$other_detail1=explode('|?|',$other_detail[$indexes[$i]]);
$student_name=$other_detail1[0];
$sms_contact_no=$other_detail1[1];
$exm_detail=$other_detail1[2];
if(isset($_POST['subjectwise_sms'])){
$message="Dear Parents, Your Child ".$student_name." Got ".$total_subject_string[$indexes[$i]]." Marks ".$exm_detail.", Regards ".$school_info_school_name.".[SCHOOL]";
sendDNDSMS($sms_contact_no, $message);
}else{
$message="Dear Parents, Your Child ".$student_name." Got ".$total_obtain[$indexes[$i]]."/".$total_marks[$indexes[$i]]." Marks ".$exm_detail.", Regards ".$school_info_school_name.".[SCHOOL]";
sendDNDSMS($sms_contact_no, $message);
}

$result++;
}

if($result>0){
echo "|?|success|?|";
}
?>
