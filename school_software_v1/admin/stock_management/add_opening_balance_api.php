<?php include("../attachment/session.php");

	$invoice_date=date('Y-m-d');
	//$opening_balance_remark = $_POST['opening_balance_remark'];
	$opening_balance = $_POST['opening_balance'];
	
$quer1="insert into new_stock_ledger(ledger_account_type,ledger_invoice_date,ledger_payable_amount,ledger_payment_mode,ledger_status,session_value,$update_by_insert_sql_column) values('Credit','$invoice_date','$opening_balance','Cash','Active','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$quer1)){
echo "|?|success|?|";
}
?>