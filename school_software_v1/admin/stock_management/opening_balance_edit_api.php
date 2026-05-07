<?php include("../attachment/session.php");

	$invoice_date=date('Y-m-d');
	$opening_balance = $_POST['opening_balance'];
	$edit_record = $_POST['edit_record'];
	
$quer1="update new_stock_ledger set ledger_invoice_date='$invoice_date',ledger_payable_amount='$opening_balance',$update_by_update_sql where s_no='$edit_record' and ledger_status='Active' and session_value='$session1'";
if(mysqli_query($conn73,$quer1)){
echo "|?|success|?|";
}
?>