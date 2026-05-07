<?php
include("../attachment/session.php");
$class_code=$_GET['class_code'];
$student_class_section=$_GET['student_class_section'];
$category_code=$_GET['category_code'];
include("../../con73/con37.php");
?>
<?php
$que1="select * from school_info_hostel_head where fee_head_type='Regular' and fee_head_name!='' ORDER BY fee_head_priority";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
$serial_no=0;
$fee_head_name1='';
$fee_head_code1='';
while($row1=mysqli_fetch_assoc($run1)){
$fee_head_name = $row1['fee_head_name'];
$fee_head_code = $row1['fee_head_code'];
$fee_head_name1[$serial_no] = $row1['fee_head_name'];
$fee_head_code1[$serial_no] = $row1['fee_head_code'];
$serial_no++;
}

$que2="select * from student_hostel_fees_structure where class_code='$class_code' and category_code='$category_code'";
$run2=mysqli_query($conn73,$que2);
$serial_no2=0;
$fee_per_year='';
while($row2=mysqli_fetch_assoc($run2)){
for($j=0;$j<$serial_no;$j++){
$fee_per_year[$serial_no2] = $row2[$fee_head_code1[$j].'_per_year'];
$serial_no2++;
}
}

$serial_no1=0;
for($i=0;$i<$serial_no;$i++){
$serial_no1++;
?>
<tr>

<td><span style="color:#C2260D;"><?php echo $serial_no1.'.'; ?></span></td>
<td colspan="6"><span style="color:#C2260D;"><?php echo $fee_head_name1[$i]; ?></span></td>
</tr>
<tr>
<td><input type="checkbox" name="fee_type_check[]" value="<?php echo $fee_head_code1[$i].'|?|'.$i; ?>" class="check_all1" checked ></td>
<td><input type="number" name="" id="<?php echo 'actual_'.$fee_head_code1[$i]; ?>" class="form-control" placeholder="Actual Amount" value="<?php echo $fee_per_year[$i]; ?>" readonly /></td>
<td><input type="number" name="" id="<?php echo "after_".$fee_head_code1[$i]; ?>" class="form-control" placeholder="After Discount Amount" readonly /></td>

<td><input type="number" name="" id="<?php echo "discount_".$fee_head_code1[$i]; ?>" class="form-control" placeholder="Discount Amount" readonly /></td>
<td><input type="number" name="fee_discount_percentage[]" id="<?php echo "discount_percentage_".$fee_head_code1[$i]; ?>" class="form-control" placeholder="Percentage" oninput="again_total(this.id,this.value);" max='100' min='0' readonly /></td>
<td>
<select name="fee_discount_type[]" class="form-control" id="<?php echo $fee_head_code1[$i]; ?>" onchange="for_discount(this.id,this.value);" >
<option value="0|?|none">None</option>
<option  value="50|?|half_fee">Half Fee</option>
<option  value="100|?|free">Free</option>
<option value="custom">Custom</option>
<option value="100|?|NA">NA</option>
</select>
</td>
<td><input type="text" name="fee_discount_remark[]" id="<?php echo "remark_".$fee_head_code1[$i]; ?>" placeholder="Remark" class="form-control" readonly /></td>
</tr>
<?php } ?>
<tr>
<td colspan="7"><center><input type="submit" name="submit" value="Save" class="btn btn-success" /></center></td>
</tr>
