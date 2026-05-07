<?php include("../attachment/session.php");

    $s_no_hidden = $_POST['s_no_hidden'];
    $total_amount = $_POST['total_amount'];
    $total_balance = $_POST['total_balance'];
    $total_paid = $_POST['total_paid'];
    $fees_code = $_POST['installment'];
    $student_previous_year_fee = $_POST['student_previous_year_fee'];
    $student_previous_year_fee_balance = $_POST['student_previous_year_fee_balance'];
    $student_previous_year_fee_paid_total = $_POST['student_previous_year_fee_paid_total'];
	
       $amount = $_POST['amount'];
    $discount = $_POST['discount'];
    $after_discount = $_POST['after_discount'];
    $balance = $_POST['balance'];
    $paid = $_POST['paid'];
	
	$update_column_name='';
	for($au=0;$au<count($fees_code);$au++){
	

	
	$update_column_name=$update_column_name."transport_fee_month".$fees_code[$au]."='$amount[$au]',transport_fee_discount_amount_month".$fees_code[$au]."='$discount[$au]',transport_fee_amount_after_discount_month".$fees_code[$au]."='$after_discount[$au]',transport_fee_balance_month".$fees_code[$au]."='$balance[$au]',transport_fee_paid_month".$fees_code[$au]."='$paid[$au]',";
	}

		$query12="update common_fees_student_transport_fee set $update_column_name grand_total='$total_amount',balance_total='$total_balance',paid_total='$total_paid',student_previous_year_fee='$student_previous_year_fee',student_previous_year_fee_balance='$student_previous_year_fee_balance',student_previous_year_fee_paid_total='$student_previous_year_fee_paid_total',$update_by_update_sql where s_no='$s_no_hidden'";
		if(mysqli_query($conn73,$query12)){
		
		echo "|?|success|?|";
}
	
  ?>