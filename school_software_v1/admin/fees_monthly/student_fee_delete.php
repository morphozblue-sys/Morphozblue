<?php include("../attachment/session.php");

	$fee_paid_months = $_GET['total_months'];
	$fee_paid_months_count=substr_count($fee_paid_months,',');
	
	if($fee_paid_months_count>0){
	$fee_paid_months_exp=explode(',',$fee_paid_months);
	}else{
	$fee_paid_months_exp[]=$fee_paid_months;
	}
	$fee_paid_months1_count = count($fee_paid_months_exp);
	
	$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
	$run=mysqli_query($conn73,$que);
	$serial_no=0;
	while($row=mysqli_fetch_assoc($run)){
	$fee_type5 = $row['fee_type'];
	$fee_code = $row['fee_code'];
	if($fee_type5!=''){
	$fee_type1[$serial_no] = $row['fee_type'];
	$fee[$serial_no]="student_".$fee_code."_month";
	$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
	$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
	$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
	$serial_no++;
	} }
	
	$student_roll_no=$_GET['roll_no'];
	$que156="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1'";
	$run156=mysqli_query($conn73,$que156);
	while($row156=mysqli_fetch_assoc($run156)){
	$student_admission_fee_paid = $row156['student_admission_fee_paid'];
	$balance_total = $row156['balance_total'];
	$paid_total = $row156['paid_total'];
	
	$student_previous_year_fee_balance = $row156['student_previous_year_fee_balance'];
	$student_previous_year_fee_paid_total = $row156['student_previous_year_fee_paid_total'];
	
	$student_transport_fee_balance = $row156['student_transport_fee_balance'];
	$student_transport_fee_paid_total = $row156['student_transport_fee_paid_total'];
	$penalty_amount = $row156['penalty_amount'];
	$other_fee_amount = $row156['other_fee_amount'];

	for($q=0;$q<$fee_paid_months1_count;$q++){
	for($i=0;$i<$serial_no;$i++){
	
	$final_fee_balance1[$i][$q] = $row156[$fee_balance[$i].$fee_paid_months_exp[$q]];
	$final_fee_paid1[$i][$q] = $row156[$fee_paid[$i].$fee_paid_months_exp[$q]];
	$final_total_amount_after_discount1[$i][$q] = $row156[$total_amount_after_discount[$i].$fee_paid_months_exp[$q]];
	
	}
	}
	}

	$s_no=$_GET['s_no'];
	$que="select * from common_fees_student_fee_add where s_no='$s_no' and session_value='$session1'";
	$run=mysqli_query($conn73,$que);
	while($row=mysqli_fetch_assoc($run)){
	$student_admission_fee_paid1 = $row['student_admission_fee_paid'];
	$balance_total1 = $row['balance_total'];
	$paid_total1 = $row['paid_total'];
	
	$student_previous_year_fee_balance1 = $row['student_previous_year_fee_balance'];
	$student_previous_year_fee_paid_total1 = $row['student_previous_year_fee_paid_total'];
	
	$student_transport_fee_balance1 = $row['student_transport_fee_balance'];
	$student_transport_fee_paid_total1 = $row['student_transport_fee_paid_total'];
	$fee_submission_date = $row['fee_submission_date'];
	$penalty_amount1 = $row['penalty_amount'];
	$other_fee_amount1 = $row['other_fee_amount'];
	
    $blank_field_1 = $row['blank_field_1'];
    $blank_field_2 = $row['blank_field_2'];
	
    $update='';
	for($k=0;$k<$fee_paid_months1_count;$k++){
	for($j=0;$j<$serial_no;$j++){
	
	$fee_balance1[$j][$k] = $row[$fee_balance[$j].$fee_paid_months_exp[$k]];
	$fee_paid1[$j][$k] = $row[$fee_paid[$j].$fee_paid_months_exp[$k]];
	$total_amount_after_discount1[$j][$k] = $row[$total_amount_after_discount[$j].$fee_paid_months_exp[$k]];
	
	$update_paid_total[$j][$k]=$final_fee_paid1[$j][$k]-$fee_paid1[$j][$k];
	$update_balance_total[$j][$k]=$final_fee_balance1[$j][$k]+$fee_paid1[$j][$k];
	
    $update=$update.$fee_paid[$j].$fee_paid_months_exp[$k]."="."'".$update_paid_total[$j][$k]."',".$fee_balance[$j].$fee_paid_months_exp[$k]."="."'".$update_balance_total[$j][$k]."',";
	}
	}
	}
	$update_penalty_amount=$penalty_amount-$penalty_amount1;
	$update_other_fee_amount=$other_fee_amount-$other_fee_amount1;
	
	$update_student_previous_year_fee_balance=$student_previous_year_fee_balance+$student_previous_year_fee_paid_total1;
	$update_student_previous_year_fee_paid_total=$student_previous_year_fee_paid_total-$student_previous_year_fee_paid_total1;
	
	$update_student_transport_fee_balance=$student_transport_fee_balance+$student_transport_fee_paid_total1;
	$update_student_transport_fee_paid_total=$student_transport_fee_paid_total-$student_transport_fee_paid_total1;
	
	$update_paid_total=$paid_total-$paid_total1;
	$update_grand_balance_total=$balance_total+$blank_field_2+($paid_total1-($penalty_amount1+$other_fee_amount1));
	
    $query="update common_fees_student_fee set $update penalty_amount='$update_penalty_amount',paid_total='$update_paid_total',balance_total='$update_grand_balance_total',other_fee_amount='$update_other_fee_amount',student_transport_fee_balance='$update_student_transport_fee_balance',student_transport_fee_paid_total='$update_student_transport_fee_paid_total',student_previous_year_fee_balance='$update_student_previous_year_fee_balance',student_previous_year_fee_paid_total='$update_student_previous_year_fee_paid_total',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";
	
	$query1="update ledger_info set ledger_status='Deactive',$update_by_update_sql where emp_id_or_student_roll_no='$student_roll_no' and date='$fee_submission_date' and total_amount='$paid_total1' and session_value='$session1' and credit_or_debit_from='fee'";
    mysqli_query($conn73,$query1);
	 
	$query2="update common_fees_student_fee_add set fee_status='Deactive',$update_by_update_sql where s_no='$s_no' and session_value='$session1'";
    mysqli_query($conn73,$query2);
	
	if(mysqli_query($conn73,$query)){
    echo "|?|success|?|";
    }
	?>