<?php include("../attachment/session.php"); ?>
<?php
$delete_record=$_GET['id'];

$query="update hostel_stock_purchase set purchase_status='Deleted' where s_no='$delete_record'";

if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>