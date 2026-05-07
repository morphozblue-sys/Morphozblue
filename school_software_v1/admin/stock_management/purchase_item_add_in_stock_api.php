<?php
include("../attachment/session.php");
$s_no=$_GET['s_no'];
$item_s_no=$_GET['item_s_no'];
$quantity=$_GET['quantity'];
    
        $query1="select available_stock from new_stock where item_s_no='$item_s_no' and new_stock_status='Active'";
        $res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
        $available_stock=0;
        while($row1=mysqli_fetch_assoc($res1)){
            $available_stock=$row1['available_stock'];
        }
        $new_available_stock=$available_stock+$quantity;
$query2="update new_stock set available_stock='$new_available_stock',$update_by_update_sql where item_s_no='$item_s_no' and new_stock_status='Active'";
if(mysqli_query($conn73,$query2)){
    $query3="update purchase_detail set add_in_stock='Yes',$update_by_update_sql where s_no='$s_no' and item_s_no='$item_s_no' and quantity='$quantity' and session_value='$session1' and purchase_status='Active'";
    mysqli_query($conn73,$query3);
    echo "|?|success|?|";
}
?>