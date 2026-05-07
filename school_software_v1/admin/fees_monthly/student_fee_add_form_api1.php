<?php include("../attachment/session.php");

$que00="select fee_receipt_pdf from school_info_pdf_info";
$run00=mysqli_query($conn73,$que00) or die(mysqli_error($conn73));
while($row00=mysqli_fetch_assoc($run00)){
//$fee_slip_pdf = $row00['fee_slip_pdf'];
//$fee_slip_thermal_pdf = $row00['fee_slip_thermal_pdf'];
$fee_receipt_pdf =$row00['fee_receipt_pdf'];
//$fee_receipt_thermal_pdf = $row00['fee_receipt_thermal_pdf'];
}

$qry="select * from school_info_general";
$rest=mysqli_query($conn73,$qry) or die(mysqli_error($conn73));
while($row22=mysqli_fetch_assoc($rest)){
$school_info_school_contact_no=$row22['school_info_school_contact_no'];
$principal_owner_sms=$row22['blank_field_1'];
}

$qry1="select * from login";
$rest1=mysqli_query($conn73,$qry1);
while($row2=mysqli_fetch_assoc($rest1)){
$blank_field_5_change=$row2['blank_field_5_change'];
if($blank_field_5_change=='Yes'){
$blank_field_5=$row2['blank_field_5_'.$session1];
$blank_field_column_name="blank_field_5_".$session1;
}else{
$blank_field_5=$row2['blank_field_5'];
$blank_field_column_name="blank_field_5";
}
}

	$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
	$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
	$serial_no=0;
	while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$fee_type5 = $row['fee_type'];
	$fee_code = $row['fee_code'];
	if($fee_type5!=''){
	$fee_type = preg_replace('/\s+/', '_', $fee_type5);
	$fee_type1[$serial_no] = $row['fee_type'];
	$fee_type=strtolower($fee_type);
	$fee[$serial_no]="student_".$fee_code."_month";
	$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
	$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
	$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
	$serial_no++;
	}
	}
	$month_count111=$_POST['month_count111'];
	$month=$_POST['month'];
	$month_strcount1=substr_count($month,',');
	if($month_strcount1>0){
	$month_exp=explode(',',$month);
	$month_count=count($month_exp);
	}else{
	$month_exp[]=$month;
	$month_count=1;
	}

	$editable_blank_field_column_name = $_POST['editable_blank_field_column_name'];
	$fee_submission_date = $_POST['fee_submission_date'];
	$student_name = $_POST['student_name'];
	$student_father_name = $_POST['student_father_name'];
	$student_roll_no = $_POST['student_roll_no'];
	$student_class = $_POST['student_class'];
	$student_class_section = $_POST['student_class_section'];
	$student_payment_mode = $_POST['student_payment_mode'];
	$cheque_bank_name = $_POST['cheque_bank_name'];
	$send_sms = $_POST['send_sms'];
	$sms = $_POST['sms'];
	$student_sms_contact_number = $_POST['student_sms_contact_number'];
	$cheque_no = $_POST['cheque_no'];
	$cheque_date = $_POST['cheque_date'];
	$neft_bank_name = $_POST['neft_bank_name'];
	$neft_bank_account_no = $_POST['neft_bank_account_no'];
	//---student_admission_fee using as panalty start---//
	$penalty_fee = $_POST['penalty_fee'];
	$penalty_amount = $_POST['penalty_amount'];
	$penalty_fee_paid = $penalty_fee+$penalty_amount;	
	//---student_admission_fee using as panalty end---//
	
	$discount_remark = $_POST['discount_remark'];
	$discount_amount = $_POST['discount_amount'];
	
	//---Other Fee Start---//
	$other_fee_remark = $_POST['other_fee_remark'];
	$other_fee_amount = $_POST['other_fee_amount'];
	$other_fee_amount1 = $_POST['other_fee_amount1'];
	$other_fee_amount11 = $other_fee_amount1+$other_fee_amount;
	//---Other Fee End---//
	//---Previous Year Fee Start---//
	$student_previous_year_fee = $_POST['student_previous_year_fee'];
	$student_previous_year_fee_balance1 = $_POST['student_previous_year_fee_balance'];
	$student_previous_year_fee_paid = $_POST['student_previous_year_fee_paid'];
	$student_previous_year_fee_paid_total = $_POST['student_previous_year_fee_paid_total'];
	$previous_year_fee_paid1 = $student_previous_year_fee_paid+$student_previous_year_fee_paid_total;
	$student_previous_year_fee_balance=$student_previous_year_fee_balance1-$student_previous_year_fee_paid;
	//---Previous Year Fee End---//
	//---Transport Fee start---//
	$student_transport_fee = $_POST['student_transport_fee'];
	$student_transport_fee_balance1 = $_POST['student_transport_fee_balance'];
	$transport_fee_paid = $_POST['transport_fee_paid'];
	$student_transport_fee_paid_total = $_POST['student_transport_fee_paid_total'];
	$transport_fee_paid1 = $transport_fee_paid+$student_transport_fee_paid_total;
	$student_transport_fee_balance=$student_transport_fee_balance1-$transport_fee_paid;
	//---Transport Fee End---//
	$grand_total = $_POST['grand_total'];
	$total_paid = $_POST['total_paid'];
	$paid_total = $_POST['paid_total'];
	$paid_total = $paid_total+$total_paid;
	$balance_total = $_POST['balance_total'];
	$balance_total = $balance_total+$penalty_fee+$other_fee_amount-($total_paid+$discount_amount);
	
	$editable_fee_receipt_no = $_POST['editable_fee_receipt_no'];
	$editable_fee_receipt_no1 = $editable_fee_receipt_no+1;
	if($blank_field_5==''){
	$fee_receipt_no = $blank_field_5+1;
	}else{
	$fee_receipt_no = $blank_field_5;
	}
	$fee_receipt_no1 = $fee_receipt_no+1;
	
	$column_name="";
	$insert_column_name="";
	$insert_column_value="";
	
	for($n=0;$n<$month_count111;$n++){
    for($i=0;$i<$serial_no;$i++){
	
	$fee2[$i] = $_POST[$fee[$i].$month_exp[$n]];	
	$fee_balance2[$i] = $_POST[$fee_balance[$i].$month_exp[$n]];
	$fee_paid2[$i] = $_POST[$fee_paid[$i].$month_exp[$n]];
    $fee_paid1[$i][$n] = $_POST['fee_paid1_'.$i.$n];
    $fee_paid1[$i][$n] = $fee_paid1[$i][$n]+$fee_paid2[$i];	
	$fee_balance2[$i] = $fee_balance2[$i]-$fee_paid2[$i];

	$column_name=$column_name.$total_amount_after_discount[$i].$month_exp[$n]."="."'".$fee2[$i]."',".$fee_balance[$i].$month_exp[$n]."="."'".$fee_balance2[$i]."',".$fee_paid[$i].$month_exp[$n]."="."'".$fee_paid1[$i][$n]."',";
	
	$insert_column_name=$insert_column_name.$total_amount_after_discount[$i].$month_exp[$n].",".$fee_balance[$i].$month_exp[$n].",".$fee_paid[$i].$month_exp[$n].",";    
	$insert_column_value=$insert_column_value."'".$fee2[$i]."','".$fee_balance2[$i]."','".$fee_paid2[$i]."',";
	
	}
	}
	
	$path_to_fcm = "https://fcm.googleapis.com/fcm/send";
       									
	$que="select * from login";
	$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
	
	while($row=mysqli_fetch_assoc($run)){

		 $server_key=$row['blank_field_4'];
		}
											
 $que = "select fcm_token from fcm_info where roll_number='$student_roll_no'";
        $run = mysqli_query($conn73,$que);
        $row = mysqli_fetch_assoc($run);
        $fcm_token= $row['fcm_token'];
       
         $headers = array
			(
				'Authorization: key='. $server_key,
				'Content-Type: application/json'
			);
			$fields = array
			(
				'to'=> $fcm_token,
				'notification'=> array('title'=>"Fee",'body'=>$total_paid)
			);
			$payload  = json_encode($fields);
			$curl_session = curl_init();
			curl_setopt( $curl_session,CURLOPT_URL,$path_to_fcm );
		    curl_setopt( $curl_session,CURLOPT_POST, true );
			curl_setopt( $curl_session,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $curl_session,CURLOPT_RETURNTRANSFER, true );
			curl_setopt ($curl_session, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt( $curl_session,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $curl_session,CURLOPT_POSTFIELDS, $payload);
			
			$result = curl_exec($curl_session);
 
			curl_close($curl_session);

	echo $quer22="insert into common_fees_student_fee_add($insert_column_name fee_submission_date,student_name,student_father_name,student_roll_no,student_class,student_class_section,grand_total,balance_total,paid_total,student_payment_mode,cheque_bank_name,cheque_no,cheque_date,neft_bank_name,neft_bank_account_no,session_value,blank_field_5,student_transport_fee,student_transport_fee_balance,student_transport_fee_paid_total,penalty_amount,fee_paid_months,other_fee_remark,other_fee_amount,blank_field_1,blank_field_2,student_previous_year_fee,student_previous_year_fee_balance,student_previous_year_fee_paid_total,editable_receipt_no,$update_by_insert_sql_column) values($insert_column_value '$fee_submission_date','$student_name','$student_father_name','$student_roll_no','$student_class','$student_class_section','$grand_total','$balance_total','$total_paid','$student_payment_mode','$cheque_bank_name','$cheque_no','$cheque_date','$neft_bank_name','$neft_bank_account_no','$session1','$fee_receipt_no','$student_transport_fee','$student_transport_fee_balance','$transport_fee_paid','$penalty_fee','$month','$other_fee_remark','$other_fee_amount','$discount_remark','$discount_amount','$student_previous_year_fee','$student_previous_year_fee_balance','$student_previous_year_fee_paid','$editable_fee_receipt_no',$update_by_insert_sql_value)";
  
    $quer1="update common_fees_student_fee set $column_name grand_total='$grand_total',balance_total='$balance_total',paid_total='$paid_total',student_transport_fee='$student_transport_fee',student_transport_fee_balance='$student_transport_fee_balance',student_transport_fee_paid_total='$transport_fee_paid1',penalty_amount='$penalty_fee_paid',other_fee_amount='$other_fee_amount11',student_previous_year_fee='$student_previous_year_fee',student_previous_year_fee_balance='$student_previous_year_fee_balance',student_previous_year_fee_paid_total='$previous_year_fee_paid1',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";
    mysqli_query($conn73,$quer1)  or die(mysqli_error($conn73));
	
	$quer11="update login set $blank_field_column_name='$fee_receipt_no1',$editable_blank_field_column_name='$editable_fee_receipt_no1',$update_by_update_sql";
    mysqli_query($conn73,$quer11)  or die(mysqli_error($conn73));
	
	$query="insert into ledger_info (emp_id_or_student_roll_no,emp_or_student_name,date,amount_type,payment_mode,total_amount,credit_or_debit_from,session_value,$update_by_insert_sql_column) values('$student_roll_no','$student_name','$fee_submission_date','Credit','$student_payment_mode','$total_paid','fee','$session1',$update_by_insert_sql_value)";
    mysqli_query($conn73,$query)  or die(mysqli_error($conn73));
    if(mysqli_query($conn73,$quer22)){
        $last_id=mysqli_insert_id($conn73);
        include("../sms/sms.php");
		if($send_sms=="Yes"){
		//sendDNDSMS($student_sms_contact_number,$sms);	
		}
		if($principal_owner_sms=='Yes'){
		$principal_sms="Dear Sir, Your Student ".$student_name." ".$student_class." - ".$student_class_section." Paid ".$total_paid." Rs.";
	//	sendDNDSMS($school_info_school_contact_no,$principal_sms);
		}
		$medium=''; $shift=''; $board='';
		echo "|?|success|?|".$student_roll_no."|?|".$pdf_path."fee_receipt/".$fee_receipt_pdf."?s_no1=".$last_id."&medium=".$medium."&shift=".$shift."&board=".$board."&months=".$month."|?|";
	}
  
  ?>