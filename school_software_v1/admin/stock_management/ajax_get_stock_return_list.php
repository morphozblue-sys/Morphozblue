<?php include("../attachment/session.php");

$item_class = $_GET['item_class'];
if($item_class!=''){
    $condition1=" and nst.item_class='$item_class'";
}else{
    $condition1="";
}
$item_category = $_GET['item_category'];
if($item_category!=''){
    $condition2=" and nst.item_category='$item_category'";
}else{
    $condition2="";
}
?>
<option value="">Select Item</option>
<?php
$query_v="select nst.*, ns.available_stock from new_stock_item as nst join new_stock as ns on ns.item_s_no=nst.s_no where nst.stock_item_status='Active' and ns.new_stock_status='Active'$condition1$condition2";
$reslt_v = mysqli_query($conn73,$query_v);
while($row_v=mysqli_fetch_assoc($reslt_v)){
$item_s_no=$row_v['s_no'];
$item_name=$row_v['item_name'];
$item_class=$row_v['item_class'];
$item_description=$row_v['item_description'];

$available_stock=$row_v['available_stock'];
?>
<option value="<?php echo $item_s_no; ?>" <?php if($available_stock<=0){ echo 'disabled'; } ?>><?php echo $item_name.' ['.$item_class.']-['.$item_description.']'; ?></option>
<?php } ?>