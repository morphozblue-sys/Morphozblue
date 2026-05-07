<?php include("../attachment/session.php");

	$customer_s_no = $_POST['customer_s_no'];
	$customer_name = $_POST['customer_name'];
	$customer_contact = $_POST['customer_contact'];
	$customer_email = $_POST['customer_email'];
	$customer_address = $_POST['customer_address'];
	
$quer="update customer_detail set customer_name='$customer_name',customer_contact='$customer_contact',customer_email='$customer_email',customer_address='$customer_address',$update_by_update_sql where s_no='$customer_s_no'";
if(mysqli_query($conn73,$quer)){
 echo "|?|success|?|";
}
?>