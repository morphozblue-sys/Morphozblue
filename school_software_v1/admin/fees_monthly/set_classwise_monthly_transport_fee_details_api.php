<?php include("../attachment/session.php");

    $student_info = $_POST['student_info'];
    $total_amount = $_POST['total_amount'];
    $student_count=count($student_info);
    
    $transport_fee_head=$_POST['transport_fee_head'];
    $transport_fees_code=$_POST['transport_fees_code'];
    $month_count=count($transport_fees_code);
    $final_rest=0;
    for($j=0;$j<$student_count;$j++){
    
	$student_info1=explode('|?|',$student_info[$j]);
	$student_roll_no=$student_info1[0];
	$student_name=$student_info1[1];
	$student_class=$student_info1[2];
	$school_fee_grand_total=$student_info1[3];
	$school_fee_balance_total=$student_info1[4];
	
	$query12="select * from common_fees_student_fee where fee_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1'";
	$result12=mysqli_query($conn73,$query12) or die(mysqli_error($conn73));
	while($row12=mysqli_fetch_assoc($result12)){
	    $back_total=0;
	    $back_balance=0;
        for($k=0;$k<$month_count;$k++){
        $back_total=$back_total+$row12['student_'.$transport_fee_head.'_total_amount_after_discount_month'.$transport_fees_code[$k]];
        $back_balance=$back_balance+$row12['student_'.$transport_fee_head.'_balance_month'.$transport_fees_code[$k]];
        }
	}
	//$query13="update common_fees_student_fee set grand_total='$back_total',balance_total='$back_balance' where student_roll_no='$student_roll_no' and session_value='$session1'";
	//mysqli_query($conn73,$query13);
	//$grand_total=$total_amount[$j]-$back_total;
    //$balance_total=$total_amount[$j]-$back_balance;
	
	$update_var='';
    for($i=0;$i<$month_count;$i++){
    $fee_monthly=$_POST[$student_roll_no.'_'.$transport_fees_code[$i]];
    $update_var=$update_var.",student_".$transport_fee_head."_month".$transport_fees_code[$i]."='".$fee_monthly."',student_".$transport_fee_head."_discount_month".$transport_fees_code[$i]."='None',student_".$transport_fee_head."_discount_method_month".$transport_fees_code[$i]."='%',student_".$transport_fee_head."_discount_amount_month".$transport_fees_code[$i]."='0',student_".$transport_fee_head."_total_amount_after_discount_month".$transport_fees_code[$i]."='".$fee_monthly."',student_".$transport_fee_head."_balance_month".$transport_fees_code[$i]."='".$fee_monthly."',student_".$transport_fee_head."_paid_total_month".$transport_fees_code[$i]."='0'";
    }
    $grand_total=$total_amount[$j]+$school_fee_grand_total-$back_total;
    $balance_total=$total_amount[$j]+$school_fee_balance_total-$back_balance;
    $query11="update common_fees_student_fee set grand_total='$grand_total',balance_total='$balance_total',set_transport='Yes'$update_var where fee_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1'";
    if(mysqli_query($conn73,$query11)){
    $final_rest++;
    }
    }
	
	if($final_rest>0){		
		echo "|?|success|?|";
	}
	
  ?>