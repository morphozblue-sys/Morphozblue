<?php include("../attachment/session.php");

	$hostel_name = $_POST['hostel_name'];
	$hostel_type = $_POST['hostel_type'];
	$hostel_number_of_room = $_POST['hostel_number_of_room'];
	$hostel_total_capacity = $_POST['hostel_total_capacity'];
	$hostel_facility = $_POST['hostel_facility'];
	$hostel_laundry = $_POST['hostel_laundry'];
	$hostel_mess = $_POST['hostel_mess'];
	$hostel_warden_name = $_POST['hostel_warden_name'];

$quer="insert into hostel_info(hostel_name,hostel_type,hostel_number_of_room,hostel_total_capacity,hostel_facility,hostel_laundry,hostel_mess,hostel_warden_name,hostel_status,$update_by_insert_sql_column)values('$hostel_name','$hostel_type','$hostel_number_of_room','$hostel_total_capacity','$hostel_facility','$hostel_laundry','$hostel_mess','$hostel_warden_name','Active',$update_by_insert_sql_value)";

if(mysqli_query($conn73,$quer)){
	echo "|?|success|?|";
}
?>