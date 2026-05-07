<?php include("../attachment/session.php");
$item_s_no = $_GET['item_s_no'];
$invoice_no = $_GET['invoice_no'];
$qry1="select * from sale_detail where invoice_number='$invoice_no' and item_s_no='$item_s_no' and sale_status='Active' and session_value='$session1'";
$rest1=mysqli_query($conn73,$qry1) or die(mysqli_error($conn73));
if(mysqli_num_rows($rest1)>0){
while($row1=mysqli_fetch_assoc($rest1)){
    $quantity=$row1['quantity'];
    $rate=$row1['rate'];
}
}else{
    $quantity=0;
    $rate='';
}

$qry="select * from new_stock where item_s_no='$item_s_no' and new_stock_status='Active'";
$rest=mysqli_query($conn73,$qry);
while($row22=mysqli_fetch_assoc($rest)){
$available_stock=$row22['available_stock']+$quantity;
$sale_rate=$row22['sale_rate'];
if($rate!=''){
echo '|?|'.$available_stock.'|?|'.$rate.'|?|';
}else{
echo '|?|'.$available_stock.'|?|'.$sale_rate.'|?|';
}
}
?>