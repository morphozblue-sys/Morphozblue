<?php include("../attachment/session.php");
	
	$bank_account_holder_name =$_POST['bank_account_holder_name'];
	$bank_account_no=$_POST['bank_account_no'];
	$bank_name=$_POST['bank_name'];
	$bank_branch_name=$_POST['bank_branch_name'];
	$bank_ifsc_code=$_POST['bank_ifsc_code'];
	$account_opening_balance=$_POST['account_opening_balance'];
	
	

	 $quer="insert into account_office_bank_account(bank_account_holder_name,bank_account_no,bank_name,bank_branch_name,bank_ifsc_code,account_opening_balance,session_value,$update_by_insert_sql_column)
	values('$bank_account_holder_name','$bank_account_no','$bank_name','$bank_branch_name','$bank_ifsc_code','$account_opening_balance','$session1',$update_by_insert_sql_value)";

 
if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}


	?>