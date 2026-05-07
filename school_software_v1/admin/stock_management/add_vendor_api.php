<?php include("../attachment/session.php");

	$vendor_name = $_POST['vendor_name'];
	$vendor_contact = $_POST['vendor_contact'];
	$vendor_email = $_POST['vendor_email'];
	$vendor_address = $_POST['vendor_address'];
	
$quer="insert into vendor_detail(vendor_name,vendor_contact,vendor_email,vendor_address,vendor_status,$update_by_insert_sql_column) values('$vendor_name','$vendor_contact','$vendor_email','$vendor_address','Active',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$quer)){
 echo "|?|success|?|";
}
?>