<?php include("../attachment/session.php");

    $roll_number = $_POST['roll_number'];
    $hostel_student_id = $_POST['hostel_student_id'];
	$hostel_student_name = $_POST['hostel_student_name'];
	$hotel_father_name = $_POST['hotel_father_name'];
	$hostel_student_dob = $_POST['hostel_student_dob'];
	$hostel_student_gender = $_POST['hostel_student_gender'];
	$hostel_student_handicapped = $_POST['hostel_student_handicapped'];
	$hostel_student_religion = $_POST['hostel_student_religion'];
	$hostel_student_category = $_POST['hostel_student_category'];
	$hostel_student_aadhar = $_POST['hostel_student_aadhar'];
	$hostel_student_class = $_POST['hostel_student_class'];
	$hostel_student_father_contact = $_POST['hostel_student_father_contact'];
	$hostel_student_father_email = $_POST['hostel_student_father_email'];
	$hostel_student_mother_name = $_POST['hostel_student_mother_name'];
	$hostel_student_mother_contact = $_POST['hostel_student_mother_contact'];
	$hostel_student_contact = $_POST['hostel_student_contact'];
	$hostel_student_email = $_POST['hostel_student_email'];
    $hostel_emergency_contact = $_POST['hostel_emergency_contact'];
	$hostel_hostel_name = $_POST['hostel_name1'];
    $hostel_room = $_POST['hostel_room'];
	$hostel_room_bed_type = $_POST['hostel_bed_type'];
	$hostel_room_facility = $_POST['hostel_room_facility'];
	$hostel_washroom = $_POST['hostel_washroom'];
	$hostel_room_charge_per_bed = $_POST['hostel_room_charge_per_bed'];
	$hostel_room_table = $_POST['hostel_room_table'];
	$hostel_room_bed = $_POST['hostel_room_bed'];
	$hostel_room_almirah = $_POST['hostel_room_almirah'];
	$hostel_mess = $_POST['hostel_mess'];
	$hostel_mess_charge = $_POST['hostel_mess_charge'];
	$hostel_join = $_POST['hostel_join'];
	$hostel_caution_money = $_POST['hostel_caution_money'];
	$hostel_laundry_charge = $_POST['hostel_laundry_charge'];
	$hostel_student_photo = $_POST['hostel_student_photo'];
	
	$edit_s_no = $_POST['edit_s_no'];

  $quer="UPDATE hostel_student_info set roll_number='$roll_number',hostel_student_id='$hostel_student_id',hostel_student_name='$hostel_student_name',hotel_father_name='$hotel_father_name',hostel_student_dob='$hostel_student_dob',hostel_student_gender='$hostel_student_gender',hostel_student_handicapped='$hostel_student_handicapped',hostel_student_religion='$hostel_student_religion',hostel_student_category='$hostel_student_category',hostel_student_aadhar='$hostel_student_aadhar',hostel_student_class='$hostel_student_class',hostel_student_father_contact='$hostel_student_father_contact',hostel_student_father_email='$hostel_student_father_email',hostel_student_mother_name='$hostel_student_mother_name',hostel_student_mother_contact='$hostel_student_mother_contact',hostel_student_contact='$hostel_student_contact',hostel_student_email='$hostel_student_email',hostel_student_photo='$hostel_student_photo',hostel_emergency_contact='$hostel_emergency_contact',hostel_hostel_name='$hostel_hostel_name',hostel_room='$hostel_room',hostel_room_bed_type='$hostel_room_bed_type',hostel_room_facility='$hostel_room_facility',hostel_washroom='$hostel_washroom',hostel_room_charge_per_bed='$hostel_room_charge_per_bed',hostel_room_table='$hostel_room_table',hostel_room_bed='$hostel_room_bed',hostel_room_almirah='$hostel_room_almirah',hostel_mess='$hostel_mess',hostel_mess_charge='$hostel_mess_charge',hostel_join='$hostel_join',hostel_caution_money='$hostel_caution_money',hostel_laundry_charge='$hostel_laundry_charge',hostel_student_status='Active',$update_by_update_sql  where s_no='$edit_s_no'";
 
  $quer13="update hostel_leave set leave_status='Active' where hostel_student_id='$hostel_student_id'";
  mysqli_query($conn73,$quer13);
  
  $quer14="update hostel_add_room set fill = fill - 1 where room_number = '$hostel_room' and hostel_name='$hostel_hostel_name'";
  mysqli_query($conn73,$quer14);
 
if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>