<?php include("../attachment/session.php");

$search_item_name = $_GET['search_item_name'];
if($search_item_name!=''){
    $condition1=" and new_stock_item_uniform.item_name='$search_item_name'";
}else{
    $condition1="";
}
$search_item_color = $_GET['search_item_color'];
if($search_item_color!=''){
    $condition2=" and new_stock_item_uniform.item_description='$search_item_color'";
}else{
    $condition2="";
}
$search_item_size = $_GET['search_item_size'];
if($search_item_size!=''){
    $condition3=" and new_stock_item_uniform.item_size='$search_item_size'";
}else{
    $condition3="";
}

$que00="select new_stock_item_uniform.s_no, new_stock_uniform.purchase_rate from new_stock_item_uniform JOIN new_stock_uniform ON new_stock_item_uniform.s_no=new_stock_uniform.item_s_no where new_stock_item_uniform.stock_item_status='Active' and new_stock_uniform.new_stock_status='Active'$condition1$condition2$condition3";
$run00=mysqli_query($conn73,$que00) or die(mysqli_error($conn73));
$s_no='';
while($row00=mysqli_fetch_assoc($run00)){
$s_no=$row00['s_no'];
$purchase_rate=$row00['purchase_rate'];
}
if($s_no!=''){
    echo "|?|success|?|".$s_no."|?|".$purchase_rate."|?|";
}else{
    echo "|?|error|?|".$s_no."|?|".$purchase_rate."|?|";
}
?>