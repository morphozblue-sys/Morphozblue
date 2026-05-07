<?php include("../attachment/session.php"); 
$hidden_id=$_POST['hidden_id'];
$attendance_date=$_POST['staff_attendance_date'];
$staff_attendance=$_POST['staff_attendance'];
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
 $query="update staff_attendance set $col_name11='$touch_time', `$attendance_day`='$staff_attendance[$i]',$update_by_update_sql where  s_no='$hidden_id[$i]'";
if(mysqli_query($conn73,$query)){
$result1=$result1+1;
}
}
if($result1>0){
	echo "|?|success|?|";
}
?>