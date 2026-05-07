<?php include("../attachment/session.php");

$qry="select * from login";
$rest=mysqli_query($conn73,$qry);
while($row22=mysqli_fetch_assoc($rest)){
$blank_field_1=$row22['blank_field_1'];
}

	$hostel_student_id = $_POST['hostel_student_id'];
	$roll_number = $_POST['roll_number'];
	$hostel_student_name = $_POST['hostel_student_name'];
	$hostel_charge_balance = $_POST['hostel_charge_balance'];
	$pay_hostel_charge = $_POST['pay_hostel_charge'];
	$hostel_charge_remarks = $_POST['hostel_charge_remarks'];
	$hostel_room_charge_balance = $_POST['hostel_room_charge_balance'];
	$pay_hostel_room_charge = $_POST['pay_hostel_room_charge'];
	$hostel_room_charge_remarks = $_POST['hostel_room_charge_remarks'];
	$mess_fee_balance = $_POST['mess_fee_balance'];
	$pay_mess_fee = $_POST['pay_mess_fee'];
	$mess_fee_remarks = $_POST['mess_fee_remarks'];
	$laundry_charge_balance = $_POST['laundry_charge_balance'];
	$pay_laundry_charge = $_POST['pay_laundry_charge'];
	$laundry_charge_remarks = $_POST['laundry_charge_remarks'];
	$caution_money_balance = $_POST['caution_money_balance'];
	$pay_caution_money = $_POST['pay_caution_money'];
	$caution_money_remarks = $_POST['caution_money_remarks'];
	
	$pay_date1 = $_POST['pay_date'];
	$pay_date2 = explode("-",$pay_date1);
	$pay_date = $pay_date2[2]."-".$pay_date2[1]."-".$pay_date2[0];
	
	$month_pay = $_POST['month_pay'];
	
	
$quer="insert into hostel_fee_details(roll_number,hostel_student_id,hostel_student_name,hostel_charge_balance,pay_hostel_charge,hostel_charge_remarks,hostel_room_charge_balance,pay_hostel_room_charge,hostel_room_charge_remarks,mess_fee_balance,pay_mess_fee,mess_fee_remarks,laundry_charge_balance,pay_laundry_charge,laundry_charge_remarks,caution_money_balance,pay_caution_money,caution_money_remarks,pay_date,month_pay,fee_status,blank_field_1,session_value,$update_by_insert_sql_column)values('$roll_number','$hostel_student_id','$hostel_student_name','$hostel_charge_balance','$pay_hostel_charge','$hostel_charge_remarks','$hostel_room_charge_balance','$pay_hostel_room_charge','$hostel_room_charge_remarks','$mess_fee_balance','$pay_mess_fee','$mess_fee_remarks','$laundry_charge_balance','$pay_laundry_charge','$laundry_charge_remarks','$caution_money_balance','$pay_caution_money','$caution_money_remarks','$pay_date','$month_pay','Active','$blank_field_1','$session1',$update_by_insert_sql_value)";

   
if(mysqli_query($conn73,$quer)){
	 
	 $blank_field_1_update=$blank_field_1+1;
	 $que1="update login set blank_field_1='$blank_field_1_update'";
	 mysqli_query($conn73,$que1);
	 
	 echo "|?|success|?|";
	
	}
	
 
?>

