<?php include("../attachment/session.php");

$qry="select * from school_info_general";
$rest=mysqli_query($conn73,$qry);
while($row22=mysqli_fetch_assoc($rest)){
$school_info_school_contact_no=$row22['school_info_school_contact_no'];
$principal_owner_sms=$row22['blank_field_1'];
}

	$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
	$run=mysqli_query($conn73,$que);
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

	//$blank_field_column_name = $_POST['blank_field_column_name'];
	$ledger_s_no = $_POST['ledger_s_no'];
	$fee_submission_date = $_POST['fee_submission_date'];
	$student_name = $_POST['student_name'];
	$student_father_name = $_POST['student_father_name'];
	$student_roll_no = $_POST['student_roll_no'];
	$student_class = $_POST['student_class'];
	$student_class_section = $_POST['student_class_section'];
	$student_payment_mode = $_POST['student_payment_mode'];
	$office_account_sno = $_POST['office_account_sno'];
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
	$transaction_no = $_POST['transaction_no'];
	
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
	
	$fee_receipt_no = $_POST['fee_receipt_no'];
	$editable_fee_receipt_no = $_POST['editable_fee_receipt_no'];
	//$fee_receipt_no1 = $fee_receipt_no+1;
	
	$column_name="";
	$update_column_name="";
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
	$update_column_name=$update_column_name.$total_amount_after_discount[$i].$month_exp[$n]."="."'".$fee2[$i]."',".$fee_balance[$i].$month_exp[$n]."="."'".$fee_balance2[$i]."',".$fee_paid[$i].$month_exp[$n]."="."'".$fee_paid2[$i]."',";
	
	$insert_column_name=$insert_column_name.$total_amount_after_discount[$i].$month_exp[$n].",".$fee_balance[$i].$month_exp[$n].",".$fee_paid[$i].$month_exp[$n].",";    
	$insert_column_value=$insert_column_value."'".$fee2[$i]."','".$fee_balance2[$i]."','".$fee_paid2[$i]."',";
	
	}
	}
	


	$quer22="update common_fees_student_fee_add set $update_column_name fee_submission_date='$fee_submission_date',student_name='$student_name',blank_field_3='$transaction_no',student_father_name='$student_father_name',student_roll_no='$student_roll_no',student_class='$student_class',student_class_section='$student_class_section',grand_total='$grand_total',balance_total='$balance_total',paid_total='$total_paid',office_account_sno='$office_account_sno',student_payment_mode='$student_payment_mode',cheque_bank_name='$cheque_bank_name',cheque_no='$cheque_no',cheque_date='$cheque_date',neft_bank_name='$neft_bank_name',neft_bank_account_no='$neft_bank_account_no',student_transport_fee='$student_transport_fee',student_transport_fee_balance='$student_transport_fee_balance',student_transport_fee_paid_total='$transport_fee_paid',penalty_amount='$penalty_fee',fee_paid_months='$month',other_fee_remark='$other_fee_remark',other_fee_amount='$other_fee_amount',blank_field_1='$discount_remark',blank_field_2='$discount_amount',student_previous_year_fee='$student_previous_year_fee',student_previous_year_fee_balance='$student_previous_year_fee_balance',student_previous_year_fee_paid_total='$student_previous_year_fee_paid',editable_receipt_no='$editable_fee_receipt_no',$update_by_update_sql where student_roll_no='$student_roll_no' and blank_field_5='$fee_receipt_no' and session_value='$session1'";
	

    if(mysqli_query($conn73,$quer22)){
        
            $quer1="update common_fees_student_fee set $column_name grand_total='$grand_total',balance_total='$balance_total',paid_total='$paid_total',student_transport_fee='$student_transport_fee',student_transport_fee_balance='$student_transport_fee_balance',student_transport_fee_paid_total='$transport_fee_paid1',penalty_amount='$penalty_fee_paid',other_fee_amount='$other_fee_amount11',student_previous_year_fee='$student_previous_year_fee',student_previous_year_fee_balance='$student_previous_year_fee_balance',student_previous_year_fee_paid_total='$previous_year_fee_paid1',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";
    mysqli_query($conn73,$quer1);
	$query="update ledger_info set emp_or_student_name='$student_name',date='$fee_submission_date',amount_type='Credit',payment_mode='$student_payment_mode',total_amount='$total_paid',credit_or_debit_from='fee',office_account_sno='$office_account_sno',$update_by_update_sql where emp_id_or_student_roll_no='$student_roll_no' and s_no='$ledger_s_no' and session_value='$session1'";
	mysqli_query($conn73,$query);
        
        
        include("../sms/sms.php");
		if($send_sms=="Yes"){
		sendDNDSMS($student_sms_contact_number,$sms);	
		}
		if($principal_owner_sms=='Yes'){
		$principal_sms="Dear Sir, Your Student ".$student_name." ".$student_class." - ".$student_class_section." Paid ".$total_paid." Rs.";
		sendDNDSMS($school_info_school_contact_no,$principal_sms);
		}
		echo "|?|success|?|".$student_roll_no;
	}
  
  ?>