<?php include("../attachment/session.php");

if(isset($_SESSION)){

$delete_record=$_GET['id'];

$query="update account_expence_info set account_status='Deleted',$update_by_update_sql where s_no='$delete_record'";

$query1="update ledger_info set ledger_status='Deleted',$update_by_update_sql where account_serial_no='$delete_record'";
mysqli_query($conn73,$query1);

if(mysqli_query($conn73,$query)){

echo "|?|success|?|";
}
}else{
echo "|?|session_not_set|?|";
}
?>