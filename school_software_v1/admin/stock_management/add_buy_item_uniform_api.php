<?php include("../attachment/session.php");

	$vendor_s_no = $_POST['vendor_id'];
	$invoice_date = $_POST['invoice_date'];
	$invoice_no = $_POST['invoice_no'];
	
	
	$item_class = $_POST['item_class'];
	$item_category = $_POST['item_category'];
	$item_name = $_POST['item_name'];
	$item_quantity = $_POST['item_quantity'];
	$item_rate = $_POST['item_rate'];
	$item_total = $_POST['item_total'];
	
	
	$grand_total_quantity = $_POST['grand_total_quantity'];
	$item_grand_total = $_POST['item_grand_total'];
	$total_discount_remark = $_POST['total_discount_remark'];
	$total_discount_amount = $_POST['total_discount_amount'];
	$total_payable_amount = $_POST['total_payable_amount'];
	$payment_mode = $_POST['payment_mode'];
	$cheque_bank_name = $_POST['cheque_bank_name'];
	$cheque_no = $_POST['cheque_no'];
	$cheque_date = $_POST['cheque_date'];
	$neft_bank_name = $_POST['neft_bank_name'];
	$neft_bank_account_no = $_POST['neft_bank_account_no'];
	//$ = $_POST[''];
$result=0;
$ledger_item_s_no='';
$ledger_item_class='';
$ledger_item_category='';
$comma_var='';
$item_count=count($item_name);
for($i=0; $i<$item_count; $i++){

$ledger_item_s_no=$ledger_item_s_no.$comma_var.$item_name[$i];
$ledger_item_class=$ledger_item_class.$comma_var.$item_class[$i];
$ledger_item_category=$ledger_item_category.$comma_var.$item_category[$i];
$comma_var=',';

$quer="insert into purchase_detail_uniform(vendor_s_no,invoice_number,invoice_date,item_class,item_category,item_s_no,quantity,rate,total_amount,total_quantity,grand_total,discount_remark,discount_amount,payable_amount,payment_mode,cheque_bank_name,cheque_date,cheque_number,neft_bank_name,neft_bank_acount_number,purchase_status,session_value,add_in_stock,$update_by_insert_sql_column) values('$vendor_s_no','$invoice_no','$invoice_date','$item_class[$i]','$item_category[$i]','$item_name[$i]','$item_quantity[$i]','$item_rate[$i]','$item_total[$i]','$grand_total_quantity','$item_grand_total','$total_discount_remark','$total_discount_amount','$total_payable_amount','$payment_mode','$cheque_bank_name','$cheque_date','$cheque_no','$neft_bank_name','$neft_bank_account_no','Active','$session1','No',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$quer)){
    $result++;
}
}
if($result>0){

 $quer1="insert into new_stock_ledger(ledger_account_type,ledger_type,ledger_invoice_no,ledger_student_customer_id,ledger_invoice_date,ledger_item_class,ledger_item_category,ledger_item_s_no,ledger_payable_amount,ledger_payment_mode,ledger_cheque_bank_name,ledger_cheque_date,ledger_cheque_number,ledger_neft_bank_name,ledger_neft_bank_acount_number,ledger_status,session_value,ledger_info_from,$update_by_insert_sql_column) values('Debit','Vendor','$invoice_no','$vendor_s_no','$invoice_date','$ledger_item_class','$ledger_item_category','$ledger_item_s_no','$total_payable_amount','$payment_mode','$cheque_bank_name','$cheque_date','$cheque_no','$neft_bank_name','$neft_bank_account_no','Active','$session1','uniform',$update_by_insert_sql_value)";
 mysqli_query($conn73,$quer1);

 $update_invoice_no=$invoice_no+1;
 $query="update login set purchase_invoice_$session1='$update_invoice_no'";
 mysqli_query($conn73,$query);
 echo "|?|success|?|";
}
?>