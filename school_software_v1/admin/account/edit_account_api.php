<?php include("../attachment/session.php");
		
	
	$bank_account_holder_name =$_POST['bank_account_holder_name'];
	$bank_account_no=$_POST['bank_account_no'];
	$bank_name=$_POST['bank_name'];
	$bank_branch_name=$_POST['bank_branch_name'];
	$bank_ifsc_code=$_POST['bank_ifsc_code'];
	$s_no1=$_POST['s_no1'];
	
	

	 $quer="update account_office_bank_account set bank_account_holder_name='$bank_account_holder_name', bank_account_no='$bank_account_no', bank_name='$bank_name', bank_branch_name='$bank_branch_name', bank_ifsc_code='$bank_ifsc_code',$update_by_update_sql where s_no='$s_no1'";

 
 
 
 
if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
