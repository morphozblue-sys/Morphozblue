<?php include("../attachment/session.php");

$item_class = $_GET['item_class'];
if($item_class!=''){
    $condition1=" and item_class='$item_class'";
}else{
    $condition1="";
}
$item_category = $_GET['item_category'];
if($item_category!=''){
    $condition2=" and item_category='$item_category'";
}else{
    $condition2="";
}
?>
<option value="">Select Item</option>
<?php
$query_v = "select * from new_stock_item_uniform where stock_item_status='Active'$condition1$condition2";
$reslt_v = mysqli_query($conn73,$query_v);
while($row_v=mysqli_fetch_assoc($reslt_v)){
$item_s_no=$row_v['s_no'];
$item_name=$row_v['item_name'];
$item_size=$row_v['item_size'];
$item_description=$row_v['item_description'];
$item_class=$row_v['item_class'];
?>
<option value="<?php echo $item_s_no; ?>"><?php echo $item_name.' ['.$item_size.']-['.$item_description.']'; ?></option>
<?php } ?>