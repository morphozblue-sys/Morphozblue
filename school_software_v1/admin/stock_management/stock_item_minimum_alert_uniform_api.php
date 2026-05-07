<?php
include("../attachment/session.php");
$item_s_no=$_POST['item_s_no'];
$previous_min_alert_value=$_POST['previous_min_alert_value'];
$current_min_alert_value=$_POST['current_min_alert_value'];
$rack_detail=$_POST['rack_detail'];

$query="update new_stock_uniform set minimum_alert_stock='$current_min_alert_value',$update_by_update_sql where item_s_no='$item_s_no' and new_stock_status='Active'";
if(mysqli_query($conn73,$query)){
    
    $query1="update new_stock_item_uniform set rack_detail='$rack_detail',$update_by_update_sql where s_no='$item_s_no' and stock_item_status='Active'";
    mysqli_query($conn73,$query1);
        echo "|?|success|?|";
}
?>