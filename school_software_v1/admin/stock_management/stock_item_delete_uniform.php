<?php
include("../attachment/session.php");
$delete_record=$_GET['id'];
$query="update new_stock_item_uniform set stock_item_status='Deleted',$update_by_update_sql where s_no='$delete_record'";
if(mysqli_query($conn73,$query)){
    $query1="update new_stock_uniform set new_stock_status='Deleted',$update_by_update_sql where item_s_no='$delete_record'";
    if(mysqli_query($conn73,$query1)){
        echo "|?|success|?|";
    }
}
?>