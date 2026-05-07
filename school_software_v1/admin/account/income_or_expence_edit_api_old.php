<?php include("../attachment/session.php");
	$s_no1 = $_POST['s_no1'];
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
	
			$bill_upload=$_FILES['bill_upload']['name'];
	include("../attachment/image_compression_upload.php");
						if($bill_upload!=''){
	$imagename = $_FILES['bill_upload']['name'];
	$size = $_FILES['bill_upload']['size'];
    $uploadedfile = $_FILES['bill_upload']['tmp_name'];
		camera_code($size,$imagename,$uploadedfile,$s_no1,"bill_upload","account_document","account_id");

	}

	
	$quer="update account_expence_info set account_customer_name='$account_customer_name',account_customer_address='$account_customer_address',account_customer_contact_no='$account_customer_contact_no',account_customer_designation='$account_customer_designation',account_customer_total_amount='$account_customer_total_amount',account_customer_date='$account_customer_date',account_customer_remark='$account_customer_remark',account_amount_type='$account_amount_type',account_party_type='$account_party_type',account_payment_mode='$account_payment_mode',account_cheque_bank_name='$account_cheque_bank_name',account_cheque_no='$account_cheque_no',account_cheque_date='$account_cheque_date',account_neft_bank_name='$account_neft_bank_name',account_neft_bank_account_no='$account_neft_bank_account_no',account_student_or_emp_id='$account_student_or_emp_id',office_account_sno='$office_account_info',$update_by_update_sql where s_no='$s_no1'";
	
	$query="update ledger_info set emp_id_or_student_roll_no='$account_student_or_emp_id',emp_or_student_name='$account_customer_name',date='$account_customer_date',amount_type='$account_amount_type',payment_mode='$account_payment_mode',total_amount='$account_customer_total_amount',credit_or_debit_from='account',office_account_sno='$office_account_info',$update_by_update_sql where account_serial_no='$s_no1'";
    mysqli_query($conn73,$query);

    if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
    }
?>