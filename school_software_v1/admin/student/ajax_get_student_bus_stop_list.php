<?php include("../attachment/session.php"); ?>
<option value="">Select</option>
<?php
$query19="select * from bus_fee_category where bus_fee_category_name!=''";
$run19=mysqli_query($conn73,$query19) or die(mysqli_error($conn73));
while($row19=mysqli_fetch_assoc($run19)){
$bus_fee_category_name=$row19['bus_fee_category_name'];
$bus_fee_category_code=$row19['bus_fee_category_code'];
?>
<option value="<?php echo $bus_fee_category_name.'|?|'.$bus_fee_category_code; ?>"><?php echo $bus_fee_category_name; ?></option>
<?php } ?>