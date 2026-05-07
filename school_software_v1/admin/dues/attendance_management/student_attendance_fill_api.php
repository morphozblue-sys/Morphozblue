<?php include("../attachment/session.php"); 
include("../sms/sms.php"); 
$hidden_id=$_POST['hidden_id'];
$attendance_date=$_POST['student_attendance_date'];
$student_attendance=$_POST['student_attendance'];
$attendance_date2=explode('-',$attendance_date);
$attendance_date3=$attendance_date2[2]."-".$attendance_date2[1]."-".$attendance_date2[0];
$month=$attendance_date2[1];
$year=$attendance_date2[0];
$day=$attendance_date2[2];
$attendance_time=$_POST['attendance_time'];

$result1=0;
$attendance_day=$day;
date_default_timezone_set('Asia/Calcutta');
$touch_time=date('Y-m-d H:i:s');
$count=count($hidden_id);
for($i=0;$i<$count;$i++){
if($attendance_time[$i]=='0000-00-00 00:00:00'){
$col_name11='intime_'.$day;
}else{
$col_name11='outtime_'.$day;
}
 $query="update student_attendance set $col_name11='$touch_time', `$attendance_day`='$student_attendance[$i]',$update_by_update_sql where  s_no='$hidden_id[$i]'";
if(mysqli_query($conn73,$query)){
$result1=$result1+1;
}
}
$persent_message=$_POST['persent_message'];
$absent_message=$_POST['absent_message'];
$leave_message=$_POST['leave_message'];

if(isset($_POST['parents_message'])){
$parents_message=$_POST['parents_message'];
$count1=count($parents_message);
for($j=0;$j<$count1;$j++){
$parents_message_explode=explode('|?|',$parents_message[$j]);
$student_name=$parents_message_explode[0];
$student_contact=$parents_message_explode[1];
$student_attendance=$parents_message_explode[2];
if($student_attendance=='P'){
$message=str_replace("student_name",$student_name,$persent_message);
if(isset($_POST['all_present_student'])){
//sendDNDSMS($student_contact, $message);
//sendnotification($parents_message2, $message);
}
}elseif($student_attendance=='A'){
$message=str_replace("student_name",$student_name,$absent_message);
if(isset($_POST['all_absent_student'])){
//sendDNDSMS($student_contact, $message);
//sendnotification($parents_message2, $message);
}
}elseif($student_attendance=='P/2'){
$message=str_replace("student_name",$student_name,$absent_message);
if(isset($_POST['all_halfday_student'])){
//sendDNDSMS($student_contact, $message);
//sendnotification($parents_message2, $message);
}
}elseif($student_attendance=='L'){
if(isset($_POST['all_leave_student'])){
$message=str_replace("student_name",$student_name,$leave_message);
//sendDNDSMS($student_contact, $message);
//sendnotification($parents_message2, $message);
}
}else{
$message='';
}
}
}

if($result1>0){
	echo "|?|success|?|";
}
?>