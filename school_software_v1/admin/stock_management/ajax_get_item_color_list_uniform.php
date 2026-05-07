<?php include("../attachment/session.php"); ?>
<option value="">Select Color</option>
<?php
$search_item_name=$_GET['search_item_name'];
if($search_item_name!=''){
    $condition1=" and item_name='$search_item_name'";
}else{
    $condition1="";
}
$que00="select item_description from new_stock_item_uniform where stock_item_status='Active'$condition1 GROUP BY item_description ORDER BY item_description ASC";
$run00=mysqli_query($conn73,$que00) or die(mysqli_error($conn73));
while($row00=mysqli_fetch_assoc($run00)){
$item_description=$row00['item_description'];
?>
<option value="<?php echo $item_description; ?>"><?php echo $item_description; ?></option>
<?php } ?>