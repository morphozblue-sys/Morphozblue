<?php include("../attachment/session.php"); ?>
<?php include("../sms/sms.php"); ?>
<?php
$student_message=$_POST['message_range'];
$student_message=$_POST['student_message'];
$student_message1=explode('?',$student_message);
$student_sms_info=$_POST['student_sms_info'];
$sms_count=count($student_sms_info);
$success=0;
for($i=0;$i<$sms_count;$i++){
$student_sms_info1=explode('|?|',$student_sms_info[$i]);
if($student_message==0){
$student_name01=$student_sms_info1[0];
$student_contact01=$student_sms_info1[1];
$total_fee=$student_sms_info1[2];
$previous_fee=$student_sms_info1[3];
$content=$student_message1[0].' '.$total_fee.' '.$student_message1[1].' '.$previous_fee.' '.$student_message1[2].' '.$student_name01.' '.$student_message1[3];
}else{
$student_name01=$student_sms_info1[0];
$student_contact01=$student_sms_info1[1];
$content=$student_message1[0].' '.$student_name01.' '.$student_message1[1];
}
sendDNDSMS($student_contact01, $content);
$success++;
}
if($success>0){
echo "|?|success|?|";
}

?>