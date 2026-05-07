<?php
include("../attachment/session.php");
die();
include("../sms/sms.php");
$student_info=$_GET['student_info'];
$student_info_explode=explode("|?|",$student_info);
$student_id=$student_info_explode[0];
$student_name=$student_info_explode[1];
$student_class=$student_info_explode[2];
$student_class_section=$student_info_explode[3];
$student_rfid=$student_info_explode[4];
$contact_number=$student_info_explode[5];
	$current_date=intval(date("d"));
	$month=date("m");
	$year=date("Y");
	$insert_date=date('Y-m-d');
    $send_sms = $_GET['send_sms'];
	$sms_content=$_GET['sms_content'];

	date_default_timezone_set('Asia/Calcutta');
	
	            $i=$current_date;
				$touch_column_in='intime_'.$i;
				$touch_column_out='outtime_'.$i;
				$attendance_column=$i;	
	$que="select s_no,$touch_column_in,$touch_column_out,`$attendance_column` from student_attendance where attendance_roll_no='$student_id' and month='$month' and year='$year'  order by s_no DESC LIMIT 1";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
if(mysqli_num_rows($run)<1){
	$que223="insert into student_attendance (attendance_roll_no,attendance_name,attendance_class,attendance_section,attendance_rf_id_no,month,year,date,$update_by_insert_sql_column) values('$student_id','$student_name','$student_class','$student_class_section','$student_rfid','$month','$year','$insert_date',$update_by_insert_sql_value);";
				mysqli_query($conn73,$que223) or die(mysqli_error($conn73));

$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
}
while($row1=mysqli_fetch_assoc($run)){
$s_no=$row1['s_no'];   
if($row1[$touch_column_in]!='0000-00-00 00:00:00'){
$col_name11='intime_'.$day;
}else{
$col_name11='outtime_'.$day;
}
date_default_timezone_set('Asia/Calcutta');
$touch_time=date('Y-m-d H:i:s');
  
$query="update student_attendance set $col_name11='$touch_time', $attendance_column='P',$update_by_update_sql where s_no='$s_no'";
		if(mysqli_query($conn73,$query)){
                if($send_sms=="Yes" && $contact_number!=''){
                    $sms_content=str_replace("student_name",$student_name,$sms_content);
		        sendDNDSMS($contact_number,$sms_content);
				}
echo "|???|success|???|$student_name|???|";
		}
}
?>