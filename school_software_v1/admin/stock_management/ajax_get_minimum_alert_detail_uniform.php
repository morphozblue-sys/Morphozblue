<?php
include("../attachment/session.php");
$item_s_no=$_GET['item_s_no'];
?>
<input type="hidden" name="item_s_no" id="item_s_no" value="<?php echo $item_s_no; ?>" class="form-control" />
<table class="table table-responsive">
<thead>
    <tr>
        <th>Previous Alert Value</th>
        <th>Current Alert Value</th>
    </tr>
</thead>
<tbody>
<?php
$query1="select * from new_stock_uniform where item_s_no='$item_s_no' and new_stock_status='Active'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($res1)){
$minimum_alert_stock=$row1['minimum_alert_stock'];
?>
    <tr>
        <td><input type="number" name="previous_min_alert_value" id="previous_min_alert_value" value="<?php echo $minimum_alert_stock; ?>" step="1" class="form-control" readonly /></td>
        <td><input type="number" name="current_min_alert_value" id="current_min_alert_value" value="<?php echo $minimum_alert_stock; ?>" step="1" class="form-control" /></td>
    </tr>
<?php
}
?>
<?php
$query01="select * from new_stock_item_uniform where s_no='$item_s_no' and stock_item_status='Active'";
$res01=mysqli_query($conn73,$query01) or die(mysqli_error($conn73));
while($row01=mysqli_fetch_assoc($res01)){
$rack_detail=$row01['rack_detail'];
?>
    <tr>
        <td colspan="2"><input type="text" name="rack_detail" id="rack_detail" value="<?php echo $rack_detail; ?>" class="form-control" /></td>
    </tr>
<?php
}
?>
</tbody>
</table>