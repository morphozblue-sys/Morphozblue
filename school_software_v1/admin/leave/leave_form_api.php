<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");

  $student_name=$_POST['student_name'];
  $student_class=$_POST['student_class'];
  $student_section=$_POST['student_section'];
  $student_roll_no=$_POST['student_roll_no'];
  $leave_from_date_1 = $_POST['leave_from_date'];
  $leave_from_date_2 = explode("-",$leave_from_date_1);
  $leave_from_date=$leave_from_date_2[2]."-".$leave_from_date_2[1]."-".$leave_from_date_2[0];
  $leave_to_date_1 = $_POST['leave_to_date'];
  $leave_to_date_2 = explode("-",$leave_to_date_1);
  $leave_to_date=$leave_to_date_2[2]."-".$leave_to_date_2[1]."-".$leave_to_date_2[0];
  $approved_by=$_POST['approved_by'];
  $total_leave_days=$_POST['total_leave_days'];
  $s_no = $_POST['s_no'];

  $from_date=$leave_from_date_2[2];
  $from_month=$leave_from_date_2[1];
  $from_year=$leave_from_date_2[0];
  $to_date=$leave_to_date_2[2];
  $to_month=$leave_to_date_2[1];
  $to_year=$leave_to_date_2[0];
  
   $file=$_FILES['image']['name'];            
   $file_temp=$_FILES['image']['tmp_name'];
   $path="../../documents/leave/".$student_roll_no;
   mkdir($path, 0777, true);
   $file=rand(1000,9999).'_'.$student_name;
   move_uploaded_file($file_temp,$path."/$file");
  
if($from_month==$to_month){  

$date21=$from_year.'-'.$from_month.'-01';
$number = date(' t ', strtotime($date21) );
 	
$que1="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)>0){
for($x=(int)$from_date; $x<=(int)$to_date; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
		mysqli_query($conn73,$query221);
		}
}
}
else{
$que1="select * from student_admission_info where student_roll_no='$student_roll_no' and student_status='Active' and session_value='$session1' ";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$unique_id = $row1['student_roll_no'];
$student_name = $row1['student_name'];
$student_class = $row1['student_class'];
$student_class_section = $row1['student_class_section'];
$student_rf_id_number = $row1['student_rf_id_number'];
$que7="insert into student_attendance (attendance_roll_no,attendance_name,attendance_class,attendance_section,attendance_rf_id_no,month,year,session_value,$update_by_insert_sql_column) values('$unique_id','$student_name','$student_class','$student_class_section','$student_rf_id_number','$from_month','$from_year','$session1',$update_by_insert_sql_value);";
mysqli_query($conn73,$que7);
}
$que11="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
if(mysqli_num_rows($run11)>0){
for($x=(int)$from_date; $x<=(int)$to_date; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     } }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
		mysqli_query($conn73,$query221);
		}
}
}
}
}else{  

$date21=$from_year.'-'.$from_month.'-01';
$number = date(' t ', strtotime($date21) );
 	
$que1="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)>0){
for($x=(int)$from_date; $x<=(int)$number; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year' and session_value='$session1' ";
		mysqli_query($conn73,$query221);
		}
}
}
else{
$que1="select * from student_admission_info where student_roll_no='$student_roll_no' and student_status='Active'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$unique_id = $row1['student_roll_no'];
$student_name = $row1['student_name'];
$student_class = $row1['student_class'];
$student_class_section = $row1['student_class_section'];
$student_rf_id_number = $row1['student_rf_id_number'];
$que7="insert into student_attendance (attendance_roll_no,attendance_name,attendance_class,attendance_section,attendance_rf_id_no,month,year,$update_by_insert_sql_column) values('$unique_id','$student_name','$student_class','$student_class_section','$student_rf_id_number','$from_month','$from_year',$update_by_insert_sql_value);";
mysqli_query($conn73,$que7);
}
$que11="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
if(mysqli_num_rows($run11)>0){
for($x=(int)$from_date; $x<=(int)$number; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
		mysqli_query($conn73,$query221);
		}
}
}
}

$que1="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$to_month' and year='$to_year'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)>0){
for($x=1; $x<=(int)$to_date; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$to_month .'-'.$to_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$to_month' and year='$to_year'  and session_value='$session1' ";
		mysqli_query($conn73,$query221);
		}
}
}
else{
$que1="select * from student_admission_info where student_roll_no='$student_roll_no' and student_status='Active'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$unique_id = $row1['student_roll_no'];
$student_name = $row1['student_name'];
$student_class = $row1['student_class'];
$student_class_section = $row1['student_class_section'];
$student_rf_id_number = $row1['student_rf_id_number'];
$que7="insert into student_attendance (attendance_roll_no,attendance_name,attendance_class,attendance_section,attendance_rf_id_no,month,year,session_value,$update_by_insert_sql_column) values('$unique_id','$student_name','$student_class','$student_class_section','$student_rf_id_number','$to_month','$to_year','$session1',$update_by_insert_sql_value);";
mysqli_query($conn73,$que7);
}
$que11="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$from_month' and year='$from_year'";
$run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
if(mysqli_num_rows($run11)>0){
for($x=1; $x<=(int)$to_date; $x++){
if($x<10){
$current_date='0'.$x;
}else{
$current_date=$x;
}
$real_leave=0;
$date3=$x.'-'.$to_month .'-'.$to_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$real_leave=1;
     }
	 }
	 if($real_leave==0){
		$query221="update student_attendance set `$current_date`='L',$update_by_update_sql  where attendance_roll_no='$student_roll_no' and month='$to_month' and year='$to_year'";
		mysqli_query($conn73,$query221);
		}
}
}
}
}

 $query="insert into student_leave_management(student_name,student_class,student_section,student_roll_no,leave_from_date,leave_to_date,leave_approved_by,leave_total_day,$update_by_insert_sql_column) values ('$student_name','$student_class','$student_section','$student_roll_no','$leave_from_date_1','$leave_to_date_1','$approved_by','$total_leave_days',$update_by_insert_sql_value)";

if(mysqli_query($conn73,$query)){
  $s_no=mysqli_insert_id($conn73);
				
  
	$leave_application=$_FILES['leave_application']['name'];        
	if($leave_application!=''){
	$imagename = $_FILES['leave_application']['name'];
	$size = $_FILES['leave_application']['size'];
    $uploadedfile = $_FILES['leave_application']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$s_no,"leave_application","leave_document","s_no");
						}
  
  
echo "|?|success|?|";
}
	?>
	