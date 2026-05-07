<?php
include("../attachment/session.php");
$attendance_date1=$_POST['attendance_date'];
$attendance_date2=explode('-',$attendance_date1);
$current_year=$attendance_date2[0];
$current_month=$attendance_date2[1];
$current_date=$attendance_date2[2];

date_default_timezone_set('Asia/Calcutta');
$in_time=date($attendance_date1.' H:i:s');
$col_name11='intime_'.$current_date;

$student_attendance1=$_POST['student_attendance'];
$count1=count($student_attendance1);
for($z=0;$z<$count1;$z++){
$student_attendance2=explode('|?|',$student_attendance1[$z]);
$student_roll_no=$student_attendance2[0];
$student_attendance=$student_attendance2[1];


$query8="select attendance_roll_no from student_attendance where month='$current_month' and year='$current_year' and session_value='$session1' and attendance_roll_no='$student_roll_no'";
$result8=mysqli_query($conn73,$query8)or die(mysqli_error($conn73));
if(mysqli_num_rows($result8)>0){

$query9="update student_attendance set `$col_name11`='$in_time', `$current_date`='$student_attendance',$update_by_update_sql where month='$current_month' and year='$current_year' and attendance_roll_no='$student_roll_no' and session_value='$session1'";
$result9=mysqli_query($conn73,$query9);

}else{

$query9="select student_name,student_class,student_class_section,student_rf_id_number from  student_admission_info  where student_roll_no='$student_roll_no' and session_value='$session1'";
$result9=mysqli_query($conn73,$query9)or die(mysqli_error($conn73));
while($row9=mysqli_fetch_assoc($result9)){
$student_name=$row9['student_name'];
$student_class=$row9['student_class'];
$student_class_section=$row9['student_class_section'];
$student_rf_id_number=$row9['student_rf_id_number'];

$query10="insert into student_attendance(attendance_roll_no,attendance_name,attendance_class,attendance_section,attendance_rf_id_no,month,year,`$col_name11`,`$current_date`,session_value,student_medium,medium,board,school,shift,$update_by_insert_sql_column) values('$student_roll_no','$student_name','$student_class','$student_class_section','$student_rf_id_number','$current_month','$current_year','$in_time','$student_attendance','$session1','$medium_change','$medium_change','$board_change','$school_code','$shift_change',$update_by_insert_sql_value)";
mysqli_query($conn73,$query10);

}

}


}


$var="select_date=".$attendance_date1;

echo "|?|success|?|".$var."|?|";


?>