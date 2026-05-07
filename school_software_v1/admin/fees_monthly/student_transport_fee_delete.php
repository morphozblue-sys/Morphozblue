<?php include("../attachment/session.php");

	$fee_paid_months = $_GET['total_months'];
	$fee_paid_months_count=substr_count($fee_paid_months,',');
	
	if($fee_paid_months_count>0){
	$fee_paid_months_exp=explode(',',$fee_paid_months);
	}else{
	$fee_paid_months_exp[]=$fee_paid_months;
	}
	$fee_paid_months1_count = count($fee_paid_months_exp);
	
	$student_roll_no=$_GET['roll_no'];
	$que156="select * from common_fees_student_transport_fee where student_roll_no='$student_roll_no' and session_value='$session1'";
	$run156=mysqli_query($conn73,$que156);
	while($row156=mysqli_fetch_assoc($run156)){
	$balance_total = $row156['balance_total'];
	$paid_total = $row156['paid_total'];
	
	$student_previous_year_fee_balance = $row156['student_previous_year_fee_balance'];
	$student_previous_year_fee_paid_total = $row156['student_previous_year_fee_paid_total'];
	
	$penalty_amount = $row156['penalty_amount'];
	$other_fee_amount = $row156['other_fee_amount'];

	for($q=0;$q<$fee_paid_months1_count;$q++){
	
	$final_fee_balance1[$q] = $row156['transport_fee_balance_month'.$fee_paid_months_exp[$q]];
	$final_fee_paid1[$q] = $row156['transport_fee_paid_month'.$fee_paid_months_exp[$q]];
	$final_total_amount_after_discount1[$q] = $row156['transport_fee_amount_after_discount_month'.$fee_paid_months_exp[$q]];
	
	}
	}

	$s_no=$_GET['s_no'];
	$que="select * from common_fees_student_transport_fee_add where s_no='$s_no' and session_value='$session1'";
	$run=mysqli_query($conn73,$que);
	while($row=mysqli_fetch_assoc($run)){
	$balance_total1 = $row['balance_total'];
	$paid_total1 = $row['paid_total'];
	
	$student_previous_year_fee_balance1 = $row['student_previous_year_fee_balance'];
	$student_previous_year_fee_paid_total1 = $row['student_previous_year_fee_paid_total'];
	
	$fee_submission_date = $row['fee_submission_date'];
	$penalty_amount1 = $row['penalty_amount'];
	$other_fee_amount1 = $row['other_fee_amount'];
	
	$blank_field_1 = $row['blank_field_1'];
    $blank_field_2 = $row['blank_field_2'];
	
    $update='';
	for($k=0;$k<$fee_paid_months1_count;$k++){
	
	$fee_balance1[$k] = $row['transport_fee_balance_month'.$fee_paid_months_exp[$k]];
	$fee_paid1[$k] = $row['transport_fee_paid_month'.$fee_paid_months_exp[$k]];
	$total_amount_after_discount1[$k] = $row['transport_fee_amount_after_discount_month'.$fee_paid_months_exp[$k]];
	
	$update_paid_total[$k]=$final_fee_paid1[$k]-$fee_paid1[$k];
	$update_balance_total[$k]=$final_fee_balance1[$k]+$fee_paid1[$k];
	
    $update=$update."transport_fee_paid_month".$fee_paid_months_exp[$k]."="."'".$update_paid_total[$k]."',transport_fee_balance_month".$fee_paid_months_exp[$k]."="."'".$update_balance_total[$k]."',";
	
	}
	}
	$update_penalty_amount=$penalty_amount-$penalty_amount1;
	$update_other_fee_amount=$other_fee_amount-$other_fee_amount1;
	
	$update_student_previous_year_fee_balance=$student_previous_year_fee_balance+$student_previous_year_fee_paid_total1;
	$update_student_previous_year_fee_paid_total=$student_previous_year_fee_paid_total-$student_previous_year_fee_paid_total1;
	
	$update_paid_total=$paid_total-$paid_total1;
	$update_grand_balance_total=$balance_total+$blank_field_2+($paid_total1-($penalty_amount1+$other_fee_amount1));
	
    $query="update common_fees_student_transport_fee set $update penalty_amount='$update_penalty_amount',paid_total='$update_paid_total',balance_total='$update_grand_balance_total',other_fee_amount='$update_other_fee_amount',student_previous_year_fee_balance='$update_student_previous_year_fee_balance',student_previous_year_fee_paid_total='$update_student_previous_year_fee_paid_total',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";
	
	$query1="update ledger_info set ledger_status='Deactive',$update_by_update_sql where emp_id_or_student_roll_no='$student_roll_no' and date='$fee_submission_date' and total_amount='$paid_total1' and session_value='$session1'";
    mysqli_query($conn73,$query1);
	 
	$query2="update common_fees_student_transport_fee_add set fee_status='Deactive',$update_by_update_sql where s_no='$s_no' and session_value='$session1'";
    mysqli_query($conn73,$query2);
	
	if(mysqli_query($conn73,$query)){
    echo "|?|success|?|";
    }
	?>