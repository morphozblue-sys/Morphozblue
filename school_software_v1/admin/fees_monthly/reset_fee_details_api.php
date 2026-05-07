<?php include("../attachment/session.php");
	$student_roll_no=$_GET['student_roll_no'];
	
 	$quer125="update common_fees_student_fee set fee_status='Deactive',penalty_amount='0',other_fee_amount='0',student_transport_fee='0',student_transport_fee_balance='0',student_transport_fee_paid_total='0',student_previous_year_fee='0',student_previous_year_fee_balance='0',student_previous_year_fee_paid_total='0',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";
	if(mysqli_query($conn73,$quer125)){
		$quer126="update common_fees_student_fee_add set fee_status='Deactive',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";
		if(mysqli_query($conn73,$quer126)){
		echo	$quer127="update ledger_info set ledger_status='Deactive',$update_by_update_sql where emp_id_or_student_roll_no='$student_roll_no' and session_value='$session1' and credit_or_debit_from='fee'";
			if(mysqli_query($conn73,$quer127)){
				echo "|?|success|?|";
			}
		}
	}
	
  ?>