<?php include("../attachment/session.php");

	$category_name = $_POST['category_name'];
	$category_s_no = $_POST['category_s_no'];
	
$quer="update stock_category set category_name='$category_name',$update_by_update_sql where s_no='$category_s_no' and category_status='Active'";
if(mysqli_query($conn73,$quer)){
 echo "|?|success|?|";
}
?>