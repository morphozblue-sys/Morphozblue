<?php include("../attachment/session.php");
 
 
	$hostel_name = $_POST['hostel_name'];
	$room_number = $_POST['room_number'];
	$room_bed_type = $_POST['room_bed_type'];
	$room_facility = $_POST['room_facility'];
	$room_attach_washroom = $_POST['room_attach_washroom'];
	$room_charge_per_student = $_POST['room_charge_per_student'];

 $quer="insert into hostel_add_room(hostel_name,room_number,room_bed_type,room_facility,room_attach_washroom,room_charge_per_student,fill,room_status,$update_by_insert_sql_column)values('$hostel_name','$room_number','$room_bed_type','$room_facility','$room_attach_washroom','$room_charge_per_student','$room_bed_type','Active',$update_by_insert_sql_value)";

if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>