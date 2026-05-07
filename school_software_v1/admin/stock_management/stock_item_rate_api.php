<?php
include("../attachment/session.php");
$item_s_no=$_POST['item_s_no'];
$purchase_current_rate=$_POST['purchase_current_rate'];
$sale_current_rate=$_POST['sale_current_rate'];

$query="update new_stock set purchase_rate='$purchase_current_rate',sale_rate='$sale_current_rate',$update_by_update_sql where item_s_no='$item_s_no' and new_stock_status='Active'";
if(mysqli_query($conn73,$query)){
        echo "|?|success|?|";
}
?>