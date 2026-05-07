<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
if(isset($_SESSION)){
	$account_customer_name = $_POST['account_customer_name'];
	$account_customer_address = $_POST['account_customer_address'];
	$account_customer_contact_no = $_POST['account_customer_contact_no'];
	$account_customer_designation = $_POST['account_customer_designation'];
	$account_customer_total_amount = $_POST['account_customer_total_amount'];
	$account_customer_date = $_POST['account_customer_date'];
	$account_customer_remark = $_POST['account_customer_remark'];
	
	$account_student_or_emp_id = $_POST['account_student_or_emp_id'];
	$account_amount_type = $_POST['account_amount_type'];
	$account_party_type = $_POST['account_party_type'];
	$account_payment_mode = $_POST['account_payment_mode'];
	$account_cheque_bank_name = $_POST['account_cheque_bank_name'];
	$account_cheque_no = $_POST['account_cheque_no'];
	$account_cheque_date = $_POST['account_cheque_date'];
	$account_neft_bank_name = $_POST['account_neft_bank_name'];
	$account_neft_bank_account_no = $_POST['account_neft_bank_account_no'];
	$office_account_info = $_POST['office_account_info'];
	
	$bill_quotation_no = $_POST['bill_quotation_no'];
	$bill_quotation_date = $_POST['bill_quotation_date'];
	
	$other_or_advance = $_POST['other_or_advance'];
	$advance_amount = $_POST['advance_amount'];
	$advance_installment = $_POST['advance_installment'];
	
// 	$qry12="select * from account_expence_info";
// 	$rest12=mysqli_query($conn73,$qry12);
// 	$account_s_no=0;
// 	while($row12=mysqli_fetch_assoc($rest12)){
// 	$account_s_no=$row12['s_no'];
// 	}
//     $account_s_no=$account_s_no+1;
	
	$quer="insert into account_expence_info(account_customer_name,account_customer_address,account_customer_contact_no,account_customer_designation,account_customer_total_amount,account_customer_date,account_customer_remark,account_amount_type,account_party_type,account_payment_mode,account_cheque_bank_name,account_cheque_no,account_cheque_date,account_neft_bank_name,account_neft_bank_account_no,account_student_or_emp_id,session_value,office_account_sno,blank_field_1,blank_field_2,blank_field_3,other_or_advance,advance_amount,advance_installment,advance_amount_balance,$update_by_insert_sql_column) 
	values('$account_customer_name','$account_customer_address','$account_customer_contact_no','$account_customer_designation','$account_customer_total_amount','$account_customer_date','$account_customer_remark','$account_amount_type','$account_party_type','$account_payment_mode','$account_cheque_bank_name','$account_cheque_no','$account_cheque_date','$account_neft_bank_name','$account_neft_bank_account_no','$account_student_or_emp_id','$session1','$office_account_info','$bill_quotation_no','$bill_quotation_date','Refund','$other_or_advance','$advance_amount','$advance_installment','$advance_amount',$update_by_insert_sql_value)";

    if(mysqli_query($conn73,$quer)){
		$last_id=mysqli_insert_id($conn73);	
		
	$query="insert into ledger_info (emp_id_or_student_roll_no,emp_or_student_name,date,amount_type,payment_mode,total_amount,credit_or_debit_from,account_serial_no,session_value,office_account_sno,blank_field_3) values('$account_student_or_emp_id','$account_customer_name','$account_customer_date','$account_amount_type','$account_payment_mode','$account_customer_total_amount','account','$last_id','$session1','$office_account_info','Refund')";
    mysqli_query($conn73,$query);
		
			$bill_upload=$_FILES['bill_upload']['name'];
	if($bill_upload!=''){
	$imagename = $_FILES['bill_upload']['name'];
	$size = $_FILES['bill_upload']['size'];
    $uploadedfile = $_FILES['bill_upload']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$last_id,"bill_upload","account_document","account_id");
	}
		
	echo "|?|success|?|";
    }
    }
else{
echo "|?|session_not_set|?|";
}
?>