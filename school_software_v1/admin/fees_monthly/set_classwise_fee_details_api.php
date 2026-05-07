<?php include("../attachment/session.php");

    $student_info = $_POST['student_info'];
    $transport_amount = $_POST['transport_amount'];
    $grand_total = $_POST['grand_total'];
	
	$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
	$run01=mysqli_query($conn73,$que01);
	while($row01=mysqli_fetch_assoc($run01)){
	$fees_code[] = $row01['fees_code'];
	$fees_count = $row01['fees_count'];
	}
	
	$que101="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
	$run101=mysqli_query($conn73,$que101) or die(mysqli_error($conn73)) ;
	$serial_no101=0;
	while($row101=mysqli_fetch_assoc($run101)){
	$fee_type = $row101['fee_type'];
	$fee_code = $row101['fee_code'];
	if($fee_type!=''){
	$fee_type1[$serial_no101] = $row101['fee_type'];
	$fee_code1[$serial_no101] = $row101['fee_code'];
	$fee_type=strtolower($fee_type);
	$fee[$serial_no101]="student_".$fee_code."_month";
	$fee_discount_type[$serial_no101]="student_".$fee_code."_discount_month";
	$fee_discount_method[$serial_no101]="student_".$fee_code."_discount_method_month";
	$fee_discount_amount[$serial_no101]="student_".$fee_code."_discount_amount_month";
	$total_amount_after_discount[$serial_no101]="student_".$fee_code."_total_amount_after_discount_month";
	$fee_balance[$serial_no101]="student_".$fee_code."_balance_month";
	$fee_paid[$serial_no101]="student_".$fee_code."_paid_total_month";
	$serial_no101++;
	} }
	$update_column_name="";
	$insert_column_name="";
	$insert_column_value="";
    for($i=0;$i<$serial_no101;$i++){
    for($e=0;$e<$fees_count;$e++){
	$fee2[$e] = $_POST[$fee[$i].$fees_code[$e]];
	$fee_discount_type2[$e] = $_POST[$fee_discount_type[$i].$fees_code[$e]];
	$fee_discount_amount2[$e] = $_POST[$fee_discount_amount[$i].$fees_code[$e]];
	$fee_discount_method2[$e] = $_POST[$fee_discount_method[$i].$fees_code[$e]];
	$total_amount_after_discount2[$e] = $_POST[$total_amount_after_discount[$i].$fees_code[$e]];
	
	$update_column_name=$update_column_name.$fee[$i].$fees_code[$e]."='".$fee2[$e]."',".$fee_discount_type[$i].$fees_code[$e]."='".$fee_discount_type2[$e]."',".$fee_discount_amount[$i].$fees_code[$e]."='".$fee_discount_amount2[$e]."',".$fee_discount_method[$i].$fees_code[$e]."='".$fee_discount_method2[$e]."',".$total_amount_after_discount[$i].$fees_code[$e]."='".$total_amount_after_discount2[$e]."',".$fee_balance[$i].$fees_code[$e]."='".$total_amount_after_discount2[$e]."',".$fee_paid[$i].$fees_code[$e]."='0',";
	
	$insert_column_name=$insert_column_name.$fee[$i].$fees_code[$e].','.$fee_discount_type[$i].$fees_code[$e].','.$fee_discount_amount[$i].$fees_code[$e].','.$fee_discount_method[$i].$fees_code[$e].','.$total_amount_after_discount[$i].$fees_code[$e].','.$fee_balance[$i].$fees_code[$e].','.$fee_paid[$i].$fees_code[$e].',';
	
	$insert_column_value=$insert_column_value."'".$fee2[$e]."','".$fee_discount_type2[$e]."','".$fee_discount_amount2[$e]."','".$fee_discount_method2[$e]."','".$total_amount_after_discount2[$e]."','".$total_amount_after_discount2[$e]."','0',";
	
	}
	}

	$count11=count($student_info);
	$final_rest=0;
	for($u=0;$u<$count11;$u++){
	$student_info1=explode('|?|',$student_info[$u]);
	$student_roll_no=$student_info1[0];
	$student_name=$student_info1[1];
	$student_class=$student_info1[2];
	$query11="select student_roll_no from common_fees_student_fee where fee_status='Deactive' and session_value='$session1' and student_roll_no='$student_roll_no'";
	$result11=mysqli_query($conn73,$query11) or die(mysqli_error($conn73));
	if(mysqli_num_rows($result11)>0){
		$query12="update common_fees_student_fee set $update_column_name student_name='$student_name',student_class='$student_class',grand_total='$grand_total',balance_total='$grand_total',paid_total='',student_transport_fee='$transport_amount',student_transport_fee_balance='$transport_amount',student_transport_fee_paid_total='0',student_previous_year_fee='0',student_previous_year_fee_balance='0',student_previous_year_fee_paid_total='0',fee_status='Active',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";
		if(mysqli_query($conn73,$query12)){
			$final_rest++;
		}
	}else{
		$query12="insert into common_fees_student_fee($insert_column_name student_name,student_class,student_roll_no,grand_total,balance_total,paid_total,student_transport_fee,student_transport_fee_balance,student_transport_fee_paid_total,student_previous_year_fee,student_previous_year_fee_balance,student_previous_year_fee_paid_total,fee_status,session_value,$update_by_insert_sql_column) values($insert_column_value '$student_name','$student_class','$student_roll_no','$grand_total','$grand_total','','$transport_amount','$transport_amount','0','0','0','0','Active','$session1',$update_by_insert_sql_value)";
		if(mysqli_query($conn73,$query12)){
			$final_rest++;
		}
	}
	}
	if($final_rest>0){		
		echo "|?|success|?|";
	}
	
  ?>