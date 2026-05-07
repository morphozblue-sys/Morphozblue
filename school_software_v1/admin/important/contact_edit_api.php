<?php include("../attachment/session.php");
	$name = $_POST['name'];
	$contact_no = $_POST['contact_no'];
	$address = $_POST['address'];
	$remark = $_POST['remark'];
	$s_no1 = $_POST['s_no1'];

	 $quer="update govt_contact_info set name='$name',contact_no='$contact_no',address='$address',remark='$remark',$update_by_update_sql  where s_no='$s_no1'";

if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}?>