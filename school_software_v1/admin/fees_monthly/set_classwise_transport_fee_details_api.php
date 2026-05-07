<?php include("../attachment/session.php");

    $student_info = $_POST['student_info'];
    $total_amount = $_POST['total_amount'];
    //$installmentwise_amount=$_POST['installmentwise_amount'];
	
    $que1="select * from school_info_monthly_transport_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
    $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
    while($row1=mysqli_fetch_assoc($run1)){
    $fees_type_name[] = $row1['fees_type_name'];	
    $fees_code[] = $row1['fees_code'];
    $fees_count = $row1['fees_count'];
    }
	
	$count11=count($student_info);
	$final_rest=0;
	for($u=0;$u<$count11;$u++){
	$student_info1=explode('|?|',$student_info[$u]);
	$student_roll_no=$student_info1[0];
	$student_name=$student_info1[1];
	$student_class=$student_info1[2];
	
	$update_column_name='';
	$insert_column_name='';
	$insert_column_value='';
	for($au=0;$au<$fees_count;$au++){
	
	//if($u==0){
	//$installment_name="installment".$au;
	$installment_name=$_POST['installment'.$au];
	//}
	//print_r($installment_name);
	
	$update_column_name=$update_column_name."transport_fee_month".$fees_code[$au]."='$installment_name[$u]',transport_fee_discount_month".$fees_code[$au]."='',transport_fee_discount_method_month".$fees_code[$au]."='',transport_fee_discount_amount_month".$fees_code[$au]."='',transport_fee_amount_after_discount_month".$fees_code[$au]."='$installment_name[$u]',transport_fee_balance_month".$fees_code[$au]."='$installment_name[$u]',transport_fee_paid_month".$fees_code[$au]."='',";
	$insert_column_name=$insert_column_name."transport_fee_month".$fees_code[$au].",transport_fee_discount_month".$fees_code[$au].",transport_fee_discount_method_month".$fees_code[$au].",transport_fee_discount_amount_month".$fees_code[$au].",transport_fee_amount_after_discount_month".$fees_code[$au].",transport_fee_balance_month".$fees_code[$au].",transport_fee_paid_month".$fees_code[$au].",";
	$insert_column_value=$insert_column_value."'$installment_name[$u]','','','','$installment_name[$u]','$installment_name[$u]','',";
	}
	//print_r($update_column_name);
	
	$query11="select student_roll_no from common_fees_student_transport_fee where fee_status='Deactive' and session_value='$session1' and student_roll_no='$student_roll_no'";
	$result11=mysqli_query($conn73,$query11) or die(mysqli_error($conn73));
	if(mysqli_num_rows($result11)>0){
		$query12="update common_fees_student_transport_fee set $update_column_name student_name='$student_name',student_class='$student_class',grand_total='$total_amount[$u]',balance_total='$total_amount[$u]',paid_total='0',student_previous_year_fee='0',student_previous_year_fee_balance='0',student_previous_year_fee_paid_total='0',fee_status='Active',$update_by_update_sql where student_roll_no='$student_roll_no' and session_value='$session1'";
		if(mysqli_query($conn73,$query12)){
			$final_rest++;
		}
	}else{
		$query12="insert into common_fees_student_transport_fee($insert_column_name student_name,student_class,student_roll_no,grand_total,balance_total,paid_total,student_previous_year_fee,student_previous_year_fee_balance,student_previous_year_fee_paid_total,fee_status,session_value,$update_by_insert_sql_column) values($insert_column_value '$student_name','$student_class','$student_roll_no','$total_amount[$u]','$total_amount[$u]','0','0','0','0','Active','$session1',$update_by_insert_sql_value)";
		if(mysqli_query($conn73,$query12)){
			$final_rest++;
		}
	}
	}
	if($final_rest>0){		
		echo "|?|success|?|";
	}
	
  ?>