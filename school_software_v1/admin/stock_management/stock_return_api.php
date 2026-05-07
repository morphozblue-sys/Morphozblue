<?php include("../attachment/session.php");

	$return_type = 'Vendor';
	$vendor_id = $_POST['vendor_id'];
	$invoice_date = $_POST['invoice_date'];
	$invoice_no = $_POST['invoice_no'];
	
	
	$item_class = $_POST['item_class'];
	$item_category = $_POST['item_category'];
	$item_name = $_POST['item_name'];
	$item_quantity = $_POST['item_quantity'];
	$item_rate = $_POST['item_rate'];
	$item_total = $_POST['item_total'];
	//$available_stock = $_POST['available_stock'];
	
	
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

$quer="insert into return_detail(return_type,vendor_id,invoice_number,invoice_date,item_class,item_category,item_s_no,quantity,rate,total_amount,total_quantity,grand_total,discount_remark,discount_amount,payable_amount,payment_mode,cheque_bank_name,cheque_date,cheque_number,neft_bank_name,neft_bank_acount_number,return_status,session_value,$update_by_insert_sql_column) values('$return_type','$vendor_id','$invoice_no','$invoice_date','$item_class[$i]','$item_category[$i]','$item_name[$i]','$item_quantity[$i]','$item_rate[$i]','$item_total[$i]','$grand_total_quantity','$item_grand_total','$total_discount_remark','$total_discount_amount','$total_payable_amount','$payment_mode','$cheque_bank_name','$cheque_date','$cheque_no','$neft_bank_name','$neft_bank_account_no','Active','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$quer)){
    
    $query01="select available_stock from new_stock where item_s_no='$item_name[$i]' and new_stock_status='Active'";
    $res01=mysqli_query($conn73,$query01) or die(mysqli_error($conn73));
    $available_stock=0;
    while($row01=mysqli_fetch_assoc($res01)){
    $available_stock=$row01['available_stock'];
    }
    
    $new_available_stock=$available_stock-$item_quantity[$i];
    $query1="update new_stock set available_stock='$new_available_stock',$update_by_update_sql where item_s_no='$item_name[$i]' and new_stock_status='Active'";
    if(mysqli_query($conn73,$query1)){
    $result++;
    }
}
}
if($result>0){

 $quer1="insert into new_stock_ledger(ledger_account_type,ledger_type,ledger_invoice_no,ledger_student_customer_id,ledger_invoice_date,ledger_item_class,ledger_item_category,ledger_item_s_no,ledger_payable_amount,ledger_payment_mode,ledger_cheque_bank_name,ledger_cheque_date,ledger_cheque_number,ledger_neft_bank_name,ledger_neft_bank_acount_number,ledger_status,session_value,$update_by_insert_sql_column) values('Credit','$return_type','$invoice_no','$vendor_id','$invoice_date','$ledger_item_class','$ledger_item_category','$ledger_item_s_no','$total_payable_amount','$payment_mode','$cheque_bank_name','$cheque_date','$cheque_no','$neft_bank_name','$neft_bank_account_no','Active','$session1',$update_by_insert_sql_value)";
 mysqli_query($conn73,$quer1);

 $update_invoice_no=$invoice_no+1;
 $query="update login set sale_invoice_$session1='$update_invoice_no'";
 mysqli_query($conn73,$query);
 echo "|?|success|?|";
}
?>