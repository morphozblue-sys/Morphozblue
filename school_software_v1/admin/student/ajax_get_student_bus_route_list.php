<?php include("../attachment/session.php"); ?>
<option value="">Select</option>
<?php
$bus_fee_category_name=$_GET['bus_fee_category_name'];
$condition1='';
if($bus_fee_category_name!=''){
    $bus_fee_category_name1=explode('|?|',$bus_fee_category_name);
    $condition1=" where bus_stop_name='$bus_fee_category_name1[0]'";
}
$que12="select * from bus_route_details$condition1";
$run12=mysqli_query($conn73,$que12) or die(mysqli_error($conn73));
while($row12=mysqli_fetch_assoc($run12)){
//$s_no=$row12['s_no'];
$bus_route=$row12['bus_route'];
?>
<option value="<?php echo $bus_route; ?>"><?php echo $bus_route; ?></option>
<?php } ?>