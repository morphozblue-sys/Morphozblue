<?php include("../attachment/session.php");

	$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
	$run01=mysqli_query($conn73,$que01);
	while($row01=mysqli_fetch_assoc($run01)){
	$fees_type_name[] = $row01['fees_type_name'];	
	$fees_code[] = $row01['fees_code'];
	$fees_count = $row01['fees_count'];
	}
	$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
	$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73)) ;
	$serial_no=0;
	while($row=mysqli_fetch_assoc($run)){
	$s_no=$row['s_no'];
	$fee_type = $row['fee_type'];
	$fee_code = $row['fee_code'];
	if($fee_type!=''){
	$fee_type1[$serial_no] = $row['fee_type'];
	$fee_code1[$serial_no] = $row['fee_code'];
	$fee_type=strtolower($fee_type);
	$fee[$serial_no]="student_".$fee_code."_month";
	$fee_discount_type[$serial_no]="student_".$fee_code."_discount_month";
	$fee_discount_method[$serial_no]="student_".$fee_code."_discount_method_month";
	$fee_discount_amount[$serial_no]="student_".$fee_code."_discount_amount_month";
	$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
	$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
	$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
	$serial_no++;
	} }
	$student_roll_no = $_POST['student_roll_no'];
    $paid_total = $_POST['paid_total'];

    $grand_total = $_POST['grand_total'];
    $student_transport_fee = $_POST['student_transport_fee'];
    $student_transport_fee_paid = $_POST['student_transport_fee_paid'];
    $student_transport_fee_balance = $student_transport_fee-$student_transport_fee_paid;
    
    $student_previous_year_fee = $_POST['student_previous_year_fee'];
    $student_previous_year_fee_paid = $_POST['student_previous_year_fee_paid'];
    $student_previous_year_fee_balance = $student_previous_year_fee-$student_previous_year_fee_paid;
    
	$balance_total = $grand_total-$paid_total;
	$column_name="";
    for($i=0;$i<$serial_no;$i++){
    for($e=0;$e<$fees_count;$e++){
	
	$fee2[$e] = $_POST[$fee[$i].$fees_code[$e]];
	$fee_discount_type2[$e] = $_POST[$fee_discount_type[$i].$fees_code[$e]];
	$fee_discount_amount2[$e] = $_POST[$fee_discount_amount[$i].$fees_code[$e]];
	$fee_discount_method2[$e] = $_POST[$fee_discount_method[$i].$fees_code[$e]];
	$total_amount_after_discount2[$e] = $_POST[$total_amount_after_discount[$i].$fees_code[$e]];
	$fee_balance2[$e] = $_POST[$fee_balance[$i].$fees_code[$e]];
	$fee_paid2[$e] = $_POST[$fee_paid[$i].$fees_code[$e]];		
	$fee_balance2[$e] = $total_amount_after_discount2[$e]-$fee_paid2[$e];
	
	$column_name=$column_name.$fee[$i].$fees_code[$e]."="."'".$fee2[$e]."',".$fee_discount_type[$i].$fees_code[$e]."="."'".$fee_discount_type2[$e]."',".$fee_discount_amount[$i].$fees_code[$e]."="."'".$fee_discount_amount2[$e]."',".$fee_discount_method[$i].$fees_code[$e]."="."'".$fee_discount_method2[$e]."',".$total_amount_after_discount[$i].$fees_code[$e]."="."'".$total_amount_after_discount2[$e]."',".$fee_balance[$i].$fees_code[$e]."="."'".$fee_balance2[$e]."',".$fee_paid[$i].$fees_code[$e]."="."'".$fee_paid2[$e]."',";
	
	}
	}

    $quer1="update common_fees_student_fee set $column_name grand_total='$grand_total',balance_total='$balance_total',paid_total='$paid_total',fee_status='Active',student_transport_fee='$student_transport_fee',student_transport_fee_balance='$student_transport_fee_balance',student_transport_fee_paid_total='$student_transport_fee_paid',student_previous_year_fee='$student_previous_year_fee',student_previous_year_fee_balance='$student_previous_year_fee_balance',student_previous_year_fee_paid_total='$student_previous_year_fee_paid',set_transport='Yes',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";
	
	if(mysqli_query($conn73,$quer1)){		
		
    $que02="select * from common_fees_student_fee_add where student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active' ORDER BY s_no";
    $run02=mysqli_query($conn73,$que02);
    $paid_total22 =0;
    $student_transport_fee_paid_total22 =0;
    $student_previous_year_fee_paid_total22 =0;
    while($row02=mysqli_fetch_assoc($run02)){
    $s_no = $row02['s_no'];
    $paid_total22 = $paid_total22+$row02['paid_total'];
    $balance_total22 = $grand_total-$paid_total22;
    $student_transport_fee_paid_total22 = $student_transport_fee_paid_total22+$row02['student_transport_fee_paid_total'];
    $student_transport_fee_balance_total22 = $student_transport_fee-$student_transport_fee_paid_total22;
    $student_previous_year_fee_paid_total22 = $student_previous_year_fee_paid_total22+$row02['student_previous_year_fee_paid_total'];
    $student_previous_year_fee_balance_total22 = $student_previous_year_fee-$student_previous_year_fee_paid_total22;
    $fee_paid_months = $row02['fee_paid_months'];
    $month_strcount1=substr_count($fee_paid_months,',');
	if($month_strcount1>0){
	$month_exp=explode(',',$fee_paid_months);	
	$month_count=count($month_exp);
	}else{
	$month_exp[]=$fee_paid_months;	
	$month_count=1;
	}
	
	$column_name2="";
    for($ai=0;$ai<$serial_no;$ai++){
    for($ae=0;$ae<$month_count;$ae++){
	
	$total_amount_after_discount2[$ae] = $_POST[$total_amount_after_discount[$ai].$month_exp[$ae]];
	$total_amount_after_discount002 = $row02[$total_amount_after_discount[$ai].$month_exp[$ae]];
	$total_diffrence=$total_amount_after_discount2[$ae]-$total_amount_after_discount002;
	$fee_balance002 = $row02[$fee_balance[$ai].$month_exp[$ae]]+$total_diffrence;
	
	$column_name2=$column_name2.$total_amount_after_discount[$ai].$month_exp[$ae]."="."'".$total_amount_after_discount2[$ae]."',".$fee_balance[$ai].$month_exp[$ae]."="."'".$fee_balance002."',";
	
	}
	}
    
    $que03="update common_fees_student_fee_add set $column_name2 grand_total='$grand_total',balance_total='$balance_total22',student_transport_fee='$student_transport_fee',student_transport_fee_balance='$student_transport_fee_balance_total22',student_previous_year_fee='$student_previous_year_fee',student_previous_year_fee_balance='$student_previous_year_fee_balance_total22' where s_no='$s_no' and student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active'";
    mysqli_query($conn73,$que03);
    
    }
		
		
	echo "|?|success|?|";
	}
    
  ?>