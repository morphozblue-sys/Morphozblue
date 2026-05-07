<?php
include("../attachment/session.php");
$item_s_no=$_GET['item_s_no'];
?>
<input type="hidden" name="item_s_no" id="item_s_no" value="<?php echo $item_s_no; ?>" class="form-control" />
<table class="table table-responsive">
<thead>
    <tr>
        <th>Purchase / Sale</th>
        <th>Previous Rate</th>
        <th>Current Rate</th>
    </tr>
</thead>
<tbody>
<?php
$query1="select * from new_stock where item_s_no='$item_s_no' and new_stock_status='Active'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($res1)){
$purchase_rate=$row1['purchase_rate'];
$sale_rate=$row1['sale_rate'];
?>
    <tr>
        <td>Purchase</td>
        <td><input type="number" name="purchase_previous_rate" id="purchase_previous_rate" value="<?php echo $purchase_rate; ?>" step="0.01" class="form-control" readonly /></td>
        <td><input type="number" name="purchase_current_rate" id="purchase_current_rate" step="0.01" class="form-control" /></td>
    </tr>
    <tr>
        <td>Sale</td>
        <td><input type="number" name="sale_previous_rate" id="sale_previous_rate" value="<?php echo $sale_rate; ?>" step="0.01" class="form-control" readonly /></td>
        <td><input type="number" name="sale_current_rate" id="sale_current_rate" step="0.01" class="form-control" /></td>
    </tr>
<?php
}
?>
</tbody>
</table>