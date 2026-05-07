<?php include("../attachment/session.php");

	$customer_name = $_POST['customer_name'];
	$customer_contact = $_POST['customer_contact'];
	$customer_email = $_POST['customer_email'];
	$customer_address = $_POST['customer_address'];
	
$quer="insert into customer_detail(customer_name,customer_contact,customer_email,customer_address,customer_status,$update_by_insert_sql_column) values('$customer_name','$customer_contact','$customer_email','$customer_address','Active',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$quer)){
 echo "|?|success|?|";
}
?>