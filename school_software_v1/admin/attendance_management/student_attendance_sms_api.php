<?php include("../attachment/session.php]"); 
include("../sms/sms.php"); 

$message_content=$_POST['message_content'];
$result1=0;
if(isset($_POST['parents_message'])){
$parents_message=$_POST['parents_message'];
$count1=count($parents_message);
for($j=0;$j<$count1;$j++){
$parents_message_explode=explode('|?|',$parents_message[$j]);
$student_name=$parents_message_explode[0];
$student_contact=$parents_message_explode[1];
$student_attendance=$parents_message_explode[2];
$message=str_replace("student_name",$student_name,$message_content);
//sendDNDSMS($student_contact, $message);
$result1++;
}
}
if($result1>0){
	echo "|?|success|?|";
}
?>