<?php include("../../admin/attachment/session.php"); ?>
<?php
include("../sms/sms.php");

$enquiry_info = $_POST['enquiry_info'];
$message_content = $_POST['message_content'];

$result=0;
$count1=count($enquiry_info);
for($i=0;$i<$count1;$i++){
sendDNDSMS($enquiry_info[$i], $message_content);
$result++;
}

if($result>0){
echo "|?|success";
}
?>