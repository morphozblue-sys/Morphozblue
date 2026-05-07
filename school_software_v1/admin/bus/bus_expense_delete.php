<?php include("../attachment/session.php");

	$s_no = $_GET['s_no'];

$query="delete from bus_expense where s_no='$s_no'";
	
if(mysqli_query($conn73,$query)){

$query1="delete from ledger_info where blank_field_1='$s_no'";
if(mysqli_query($conn73,$query1)){
echo "|?|success|?|";
}

}
?>