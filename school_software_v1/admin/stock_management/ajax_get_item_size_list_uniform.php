<?php include("../attachment/session.php"); ?>
<option value="">Select Size</option>
<?php
$search_item_name=$_GET['search_item_name'];
if($search_item_name!=''){
    $condition1=" and item_name='$search_item_name'";
}else{
    $condition1="";
}
$search_item_color=$_GET['search_item_color'];
if($search_item_color!=''){
    $condition2=" and item_description='$search_item_color'";
}else{
    $condition2="";
}
$que000="select item_size from new_stock_item_uniform where stock_item_status='Active'$condition1$condition2 GROUP BY item_size";
$run000=mysqli_query($conn73,$que000) or die(mysqli_error($conn73));
$size_serial=0;
$item_size='';
while($row000=mysqli_fetch_assoc($run000)){
$item_size[$size_serial]=$row000['item_size'];
$size_serial++;
}
if($size_serial>0){
asort($item_size);
foreach($item_size as $item_size1){
?>
<option value="<?php echo $item_size1; ?>"><?php echo $item_size1; ?></option>
<?php } } ?>