<?php include("../attachment/session.php");
 
	$edit_s_no = $_POST['s_no'];
	$hostel_name = $_POST['hostel_name'];
	$hostel_type = $_POST['hostel_type'];
	$hostel_number_of_room = $_POST['hostel_number_of_room'];
	$hostel_total_capacity = $_POST['hostel_total_capacity'];
	$hostel_facility = $_POST['hostel_facility'];
	$hostel_laundry = $_POST['hostel_laundry'];
	$hostel_mess = $_POST['hostel_mess'];
	$hostel_warden_name = $_POST['hostel_warden_name'];

  $quer="UPDATE hostel_info set hostel_name='$hostel_name',hostel_type='$hostel_type',hostel_number_of_room='$hostel_number_of_room',hostel_total_capacity='$hostel_total_capacity',hostel_facility='$hostel_facility',hostel_laundry='$hostel_laundry',hostel_mess='$hostel_mess',hostel_warden_name='$hostel_warden_name',$update_by_update_sql  where s_no='$edit_s_no'";

if(mysqli_query($conn73,$quer)){
	echo "|?|success|?|";
	}
?>