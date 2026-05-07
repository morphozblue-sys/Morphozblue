<?php include("../attachment/session.php");

	$vendor_s_no = $_POST['vendor_s_no'];
	$vendor_name = $_POST['vendor_name'];
	$vendor_contact = $_POST['vendor_contact'];
	$vendor_email = $_POST['vendor_email'];
	$vendor_address = $_POST['vendor_address'];
	
$quer="update vendor_detail set vendor_name='$vendor_name',vendor_contact='$vendor_contact',vendor_email='$vendor_email',vendor_address='$vendor_address',$update_by_update_sql where s_no='$vendor_s_no'";
if(mysqli_query($conn73,$quer)){
 echo "|?|success|?|";
}
?>