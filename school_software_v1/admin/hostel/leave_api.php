<?php include("../attachment/session.php");

 
 
	$hostel_student_id = $_POST['hostel_student_id'];
	$roll_number = $_POST['roll_number'];
	$hostel_student_name = $_POST['hostel_student_name'];
	$caution_due = $_POST['caution_due'];
	$laundry_due = $_POST['laundry_due'];
	$mess_due = $_POST['mess_due'];
	$room_due = $_POST['room_due'];
	$total_due = $_POST['total_due'];
	$leave_date = $_POST['leave_date'];
	$room_number = $_POST['room_number'];
		
	
 $quer="insert into hostel_leave(roll_number,hostel_student_id,hostel_student_name,caution_due,laundry_due,mess_due,room_due,total_due,leave_date,leave_status,room_number,$update_by_insert_sql_column)values('$roll_number','$hostel_student_id','$hostel_student_name','$caution_due','$laundry_due','$mess_due','$room_due','$total_due','$leave_date','Deactivate','$room_number',$update_by_insert_sql_value)";

 
  $quer13="UPDATE hostel_student_info SET hostel_student_status='Deactivate',$update_by_update_sql  where hostel_student_id='$hostel_student_id'";
  mysqli_query($conn73,$quer13);
  
  $quer15="UPDATE hostel_add_room SET fill = fill + 1 WHERE room_number = '$hostel_room' and hostel_name='$hostel_hostel_name'";
  mysqli_query($conn73,$quer15);
  
  $query19="update hostel_fee_details set fee_status='Deactivate' where hostel_student_id='$hostel_student_id'"; 
   mysqli_query($conn73,$query19);
   
if(mysqli_query($conn73,$quer)){
		
 echo "|?|success|?|";
	
	}
	
 
?>

