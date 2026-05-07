<?php include("../attachment/session.php");
 
	$edit_s_no = $_POST['edit_s_no'];
	$hostel_name = $_POST['hostel_name'];
	$room_number = $_POST['room_number'];
	$room_bed_type = $_POST['room_bed_type'];
	$room_facility = $_POST['room_facility'];
	$room_attach_washroom = $_POST['room_attach_washroom'];
	$room_charge_per_student = $_POST['room_charge_per_student'];

 $quer="UPDATE hostel_add_room set hostel_name='$hostel_name',room_number='$room_number',room_bed_type='$room_bed_type',room_facility='$room_facility',room_attach_washroom='$room_attach_washroom',room_charge_per_student='$room_charge_per_student',fill='$room_bed_type',$update_by_update_sql where s_no='$edit_s_no'";

if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>