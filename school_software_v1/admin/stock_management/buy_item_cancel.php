<?php
include("../attachment/session.php");
$delete_record=$_GET['id'];

 $query0="select * from purchase_detail where invoice_number='$delete_record' and session_value='$session1' and purchase_status='Active'";
$res0=mysqli_query($conn73,$query0) or die(mysqli_error($conn73));
while($row0=mysqli_fetch_assoc($res0)){
    $item_s_no=$row0['item_s_no'];
    $quantity=$row0['quantity'];
    $add_in_stock=$row0['add_in_stock'];
    if($add_in_stock=='Yes'){
        $query1="select available_stock from new_stock where item_s_no='$item_s_no' and new_stock_status='Active'";
        $res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
        $available_stock=0;
        while($row1=mysqli_fetch_assoc($res1)){
            $available_stock=$row1['available_stock'];
        }
        $new_available_stock=$available_stock-$quantity;
        $query2="update new_stock set available_stock='$new_available_stock',$update_by_update_sql where item_s_no='$item_s_no' and new_stock_status='Active'";
        mysqli_query($conn73,$query2);
    }
}

$query="update purchase_detail set purchase_status='Cancelled',$update_by_update_sql where invoice_number='$delete_record' and session_value='$session1' and purchase_status='Active'";
if(mysqli_query($conn73,$query)){

$quer1="update new_stock_ledger set ledger_status='Cancelled',$update_by_update_sql where ledger_invoice_no='$delete_record' and ledger_status='Active' and session_value='$session1' and ledger_account_type='Debit' and ledger_type='Vendor'";
mysqli_query($conn73,$quer1);

        echo "|?|success|?|";
}
?>