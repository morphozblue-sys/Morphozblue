<?php include("../attachment/session.php"); ?>
<?php include("../sms/sms.php"); ?>
<?php
$student_message=$_POST['student_message'];
$student_message1=explode('?',$student_message);
$student_sms_info=$_POST['student_sms_info'];
$sms_count=count($student_sms_info);
$success=0;
for($i=0;$i<$sms_count;$i++){
$student_sms_info1=explode('|?|',$student_sms_info[$i]);
$student_name01=$student_sms_info1[0];
$student_contact01=$student_sms_info1[1];
$total_fee=$student_sms_info1[2];
//$student_transport_fee_balance=$student_sms_info1[3];
$content=$student_message1[0].' '.$total_fee.' '.$student_message1[1].' '.$student_name01.' '.$student_message1[2];
sendDNDSMS($student_contact01, $content);
$success++;
}
if($success>0){
echo "|?|success|?|";
}
?>