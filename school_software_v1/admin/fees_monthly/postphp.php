<?php include("../attachment/session.php");
  if(isset($_POST['finish'])){
  $student_roll_no = $_POST['student_roll_no'];
  
  
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
				$fee[$serial_no]="student_".$fee_code."_per_year";
				$fee_balance[$serial_no]="student_".$fee_code."_balance";
				$fee_paid[$serial_no]="student_".$fee_code."_paid_total";
				$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount";
				$serial_no++;
	            }
				}
				
				$que11="select * from common_fees_student_fee where student_roll_no='$student_roll_no'";
				$run11=mysqli_query($conn73,$que11);
                while($row11=mysqli_fetch_assoc($run11)){
				$fee_status = $row11['fee_status'];
                $student_admission_fee = $row11['student_admission_fee'];
				$student_admission_fee_balance = $row11['student_admission_fee_balance'];
			    $student_admission_fee_paid = $row11['student_admission_fee_paid'];
				
				$student_transport_fee = $row11['student_transport_fee'];
				$student_transport_fee_balance = $row11['student_transport_fee_balance'];
				$student_transport_fee_paid_total = $row11['student_transport_fee_paid_total'];
				
				$grand_total = $row11['grand_total'];
				$balance_total = $row11['balance_total'];
				$paid_total = $row11['paid_total'];
				
				for($i=0;$i<$serial_no;$i++)
					{ 
					   
				        $fee1[$i] = $row[$fee[$i]];
				        $fee_balance1[$i] = $row[$fee_balance[$i]];
						if($fee_balance1[$i]==''){
						$fee_balance1[$i]=0;
						}
						$fee_paid1[$i] = $row[$fee_paid[$i]];
						$total_amount_after_discount1[$i] = $row[$total_amount_after_discount[$i]];
						if($total_amount_after_discount1[$i]==''){
						$total_amount_after_discount1[$i]=0;
						}
                }
				}
    
	$fee_submission_date = $_POST['fee_submission_date'];
	$student_name = $_POST['student_name'];
	$student_father_name = $_POST['student_father_name'];
	
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
	$penalty_fee_paid = $penalty_fee+$student_admission_fee_paid;	
	//---student_admission_fee using as panalty end---//
	$admission_fee_paid = $_POST['admission_fee_paid'];
	$student_admission_fee_paid = $student_admission_fee_paid+$admission_fee_paid;
	$student_admission_fee_balance = $_POST['student_admission_fee_balance'];
	$student_admission_fee_balance = $student_admission_fee_balance-$admission_fee_paid;
	$grand_total = $_POST['grand_total'];
	$total_paid = $_POST['total_paid'];
	$paid_total = $paid_total+$total_paid;
	$balance_total = $_POST['balance_total'];
	$balance_total = $balance_total-$total_paid;
	
    $fee_receipt_no = $_POST['fee_receipt_no'];
	$fee_receipt_no1 = $fee_receipt_no+1;
	
	$column_name="";
	$insert_column_name="";
	$insert_column_value="";
    for($i=0;$i<$serial_no;$i++)
	{
	$fee2[$i] = $_POST[$fee[$i]];	
	$fee_balance2[$i] = $_POST[$fee_balance[$i]];
	$fee_paid2[$i] = $_POST[$fee_paid[$i]];
    $fee_paid1[$i] = $fee_paid1[$i]+$fee_paid2[$i];	
	$fee_balance2[$i] = $fee_balance2[$i]-$fee_paid2[$i];

    $column_name=$column_name.$total_amount_after_discount[$i]."="."'".$fee2[$i]."',".$fee_balance[$i]."="."'".$fee_balance2[$i]."',".$fee_paid[$i]."="."'".$fee_paid1[$i]."',";
	
	$insert_column_name=$insert_column_name.$total_amount_after_discount[$i].",".$fee_balance[$i].",".$fee_paid[$i].",";    
	$insert_column_value=$insert_column_value."'".$fee2[$i]."','".$fee_balance2[$i]."','".$fee_paid2[$i]."',";
	
	}
  
  
    $quer22="insert into common_fees_student_fee_add($insert_column_name fee_submission_date,student_name,student_father_name,student_roll_no,student_class,student_class_section,grand_total,balance_total,paid_total,student_admission_fee,student_admission_fee_balance,student_admission_fee_paid,student_payment_mode,cheque_bank_name,cheque_no,cheque_date,neft_bank_name,neft_bank_account_no,session_value,blank_field_5)
    values($insert_column_value '$fee_submission_date','$student_name','$student_father_name','$student_roll_no','$student_class','$student_class_section','$grand_total','$balance_total','$total_paid','$penalty_fee','$student_admission_fee_balance','$penalty_fee','$student_payment_mode','$cheque_bank_name','$cheque_no','$cheque_date','$neft_bank_name','$neft_bank_account_no','$session1','$fee_receipt_no')";
  
    $quer1="update common_fees_student_fee set $column_name grand_total='$grand_total',balance_total='$balance_total',paid_total='$paid_total',student_admission_fee='$penalty_fee',student_admission_fee_balance='$student_admission_fee_balance',student_admission_fee_paid='$penalty_fee_paid',session_value='$session1' where student_roll_no='$student_roll_no'";
    mysqli_query($conn73,$quer1);
    
	$quer11="update login set blank_field_5='$fee_receipt_no1'";
    mysqli_query($conn73,$quer11);
	
	$query="insert into ledger_info (emp_id_or_student_roll_no,emp_or_student_name,date,amount_type,payment_mode,total_amount,credit_or_debit_from,session_value) values('$student_roll_no','$student_name','$fee_submission_date','Credit','$student_payment_mode','$total_paid','fee','$session1')";
    mysqli_query($conn73,$query);
    if(mysqli_query($conn73,$quer22)){
	//if($send_sms=="Yes"){
	//	include("../sms/sms.php");
	//	sendDNDSMS($student_sms_contact_number,$sms);	
	//	}
		
		echo "<script>alert('successfully Paid Fee amount $paid_total');</script>";
		echo "<script>window.open('student_fee_list.php?student_roll_no=$student_roll_no','_self')</script>";
	}
  }
    
  ?>