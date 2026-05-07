<?php include("../attachment/session.php"); ?>

<?php
	
	$hostel_hostel_name = $_POST['hostel_hostel_name'];
	$hostel_room = $_POST['hostel_room'];
	$attendance_student_date = $_POST['attendance_student_date'];
	$attendance_student_date_2 = explode("-",$attendance_student_date);
    $attendance_student_year=$attendance_student_date_2[0];
    $attendance_student_month=$attendance_student_date_2[1];
    $attendance_student_date1=$attendance_student_date_2[2];

$que1="select * from hostel_student_info where hostel_student_status='Active' and hostel_hostel_name='$hostel_hostel_name' and hostel_room='$hostel_room'";
$var1=0;
$var2=0;
$var3=0;
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){

$unique_id = $row1['roll_number'];
$student_name = $row1['hostel_student_name'];
$hostel_hostel_name = $row1['hostel_hostel_name'];
$hostel_room = $row1['hostel_room'];

	
$que_date_check="select * from hostel_student_attendence where hostel_name_attendance='$hostel_hostel_name' and hostel_room_attendance='$hostel_room' and month='$attendance_student_month' and year='$attendance_student_year' and attendance_roll_no='$unique_id' and `$attendance_student_date1`='P' or hostel_name_attendance='$hostel_hostel_name' and hostel_room_attendance='$hostel_room' and month='$attendance_student_month' and year='$attendance_student_year' and attendance_roll_no='$unique_id' and `$attendance_student_date1`='A' or hostel_name_attendance='$hostel_hostel_name' and hostel_room_attendance='$hostel_room' and month='$attendance_student_month' and year='$attendance_student_year' and attendance_roll_no='$unique_id' and `$attendance_student_date1`='L'";
$run_date_check=mysqli_query($conn73,$que_date_check) or die(mysqli_error($conn73));

if(mysqli_num_rows($run_date_check)>0){
$var1=1;
}else{

	$que_date_check1="select * from hostel_student_attendence where hostel_name_attendance='$hostel_hostel_name' and hostel_room_attendance='$hostel_room' and month='$attendance_student_month' and year='$attendance_student_year' and attendance_roll_no='$unique_id'";
    $run_date_check1=mysqli_query($conn73,$que_date_check1) or die(mysqli_error($conn73));
	if(mysqli_num_rows($run_date_check1)>0){
	$var2=1;
	}else{
	$que2="insert into hostel_student_attendence (attendance_roll_no,attendance_name,hostel_name_attendance,hostel_room_attendance,month,year,$update_by_insert_sql_column) values('$unique_id','$student_name','$hostel_hostel_name','$hostel_room','$attendance_student_month','$attendance_student_year',$update_by_insert_sql_value);";
	mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
	$var3=1;
	}

}
}
//if($var1==1){
//echo "<script>window.open('hostel_daily_attendence_update.php?hostel_hostel_name=$hostel_hostel_name&month=$attendance_student_month&date=$attendance_student_date&hostel_room=$hostel_room','_self');</script>";
//}if($var2==1){
//echo "<script>window.open('hostel_daily_attendence.php?hostel_hostel_name=$hostel_hostel_name&month=$attendance_student_month&date=$attendance_student_date&hostel_room=$hostel_room','_self');</script>";
//}if($var3==1){
//echo "<script>window.open('hostel_daily_attendence.php?hostel_hostel_name=$hostel_hostel_name&month=$attendance_student_month&date=$attendance_student_date&hostel_room=$hostel_room','_self');</script>";
//}

$hostel_hostel_name = $_POST['hostel_hostel_name'];
$hostel_room = $_POST['hostel_room'];
$attendance_student_date = $_POST['attendance_student_date'];
$attendance_student_date_2 = explode("-",$attendance_student_date);
$attendance_student_year=$attendance_student_date_2[0];
$attendance_student_month=$attendance_student_date_2[1];
$attendance_student_date1=$attendance_student_date_2[2];

$query11="select * from hostel_student_attendence where hostel_name_attendance='$hostel_hostel_name' and hostel_room_attendance='$hostel_room' and month='$attendance_student_month' and year='$attendance_student_year'";
$res11=mysqli_query($conn73,$query11);
if(mysqli_num_rows($res11)>0){
//echo "<script>window.open('hostel_student_attendence_list.php?class=$hostel_hostel_name&current_month=$attendance_student_month&year=$attendance_student_year&date=$attendance_student_date&section=$hostel_room','_self');</script>";
  }else{
//echo "<script>alert_new('This Month Attendence is Not Available!!')</script>";
}

?>
