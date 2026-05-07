<?php include("../attachment/session.php");
	$name = $_POST['name'];
	$contact_no = $_POST['contact_no'];
	$address = $_POST['address'];
	$remark = $_POST['remark'];

$quer="insert into govt_contact_info(name,contact_no,address,remark,$update_by_insert_sql_column) values('$name','$contact_no','$address','$remark',$update_by_insert_sql_value)";

if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>