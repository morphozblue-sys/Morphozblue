<?php
include("../attachment/session.php");
//include("../sms_management/sms.php");
$emp_info=$_GET['emp_info'];
$emp_info_explode=explode("|?|",$emp_info);
$emp_id=$emp_info_explode[0];
$emp_name=$emp_info_explode[1];
$emp_department=$emp_info_explode[2];
$emp_department_section=$emp_info_explode[3];
$emp_rfid=$emp_info_explode[4];
$contact_number=$emp_info_explode[5];
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
	$que1="select * from staff_attendance where staff_id='$emp_id' and month='$current_month' and year='$current_year' order by s_no DESC";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)<1){
$que223="insert into staff_attendance (staff_id,staff_name,staff_type,staff_designation,emp_rf_id_no,month,year,session_value,$update_by_insert_sql_column) values('$emp_id','$emp_name','$emp_department','$emp_department_section','$emp_rfid','$current_month','$current_year','$session1',$update_by_insert_sql_value);";
mysqli_query($conn73,$que223) or die(mysqli_error($conn73));
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
}
while($row1=mysqli_fetch_assoc($run1)){
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
                    $sms_content=str_replace("emp_name",$emp_name,$sms_content);
		       // sendDNDSMS($contact_number,$sms_content);
				}
echo "|???|success|???|$emp_name|???|";
		}
}
?>