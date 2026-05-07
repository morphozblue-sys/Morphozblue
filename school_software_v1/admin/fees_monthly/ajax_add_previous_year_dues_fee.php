<?php include("../attachment/session.php"); ?>
<div class="col-md-12">

<table class="table table-responsive" width="100%">
<thead class="my_background_color">
<tr>
<th>S.No.</th>
<th>Name</th>
<th>Father Name</th>
<th>Class (Sec.)</th>
<th>Current Year Fee</th>
<th>Previous Year Fee</th>
<th><input type="checkbox" id="my_check" onclick="for_check(this.id);" checked /></th>
</tr>
</thead>
<tbody>
<?php
$exp_session1=explode('_',$session1);
$exp_session2=$exp_session1[0]-1;
$exp_session3=$exp_session1[1]-1;
$session2=$exp_session2.'_'.$exp_session3;

$student_class=$_GET['student_class'];
if($student_class!=''){
    $condition=" and student_class='$student_class'";
}else{
    $condition="";
}
$student_section=$_GET['student_section'];
if($student_section!=''){
    $condition1=" and student_class_section='$student_section'";
}else{
    $condition1="";
}

$que="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition$condition1$filter37";
$run=mysqli_query($conn73,$que);
$serl=0;
$index=0;

while($row=mysqli_fetch_assoc($run)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_class=$row['student_class'];
$student_class_section=$row['student_class_section'];
$student_roll_no=$row['student_roll_no'];
$stuent_old_or_new=$row['stuent_old_or_new'];
$student_bus=$row['student_bus'];
$student_bus_fee_category_code=$row['student_bus_fee_category_code'];
$student_admission_number=$row['student_admission_number'];

$que1="select * from common_fees_student_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
$run1=mysqli_query($conn73,$que1);
if(mysqli_num_rows($run1)>0){  
while($row1=mysqli_fetch_assoc($run1)){  //echo '<pre>';print_r($row1);
$grand_total=$row1['grand_total'];
$balance_total=$row1['balance_total'];
$student_previous_year_fee=$row1['student_previous_year_fee'];
}

$que2="select * from common_fees_student_fee where fee_status='Active' and session_value='$session2' and student_roll_no='$student_roll_no'";
$run2=mysqli_query($conn73,$que2);
//if(mysqli_num_rows($run2)>0){
$previous_balance_total=0;
while($row2=mysqli_fetch_assoc($run2)){
$balance_total1=$row2['balance_total'];
$previous_balance_total=$balance_total1;
}

// $que3="select * from common_fees_student_fee_add where fee_status='Active' and session_value='$session2' and student_roll_no='$student_roll_no'";
// $run3=mysqli_query($conn73,$que3);
// $total_discount=0;
// while($row3=mysqli_fetch_assoc($run3)){
// $total_discount=$total_discount+$row3['blank_field_2'];
// }
// $previous_balance_total=$previous_balance_total-$total_discount;

if(($grand_total==$balance_total && $student_previous_year_fee=='') || ($grand_total==$balance_total && $student_previous_year_fee==0)){
$student_previous_year_fee=$previous_balance_total;
}

$serl++;
?>
<tr>
<td><?php echo $serl.'.'; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $student_father_name; ?></td>
<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
<td>
<input type="text" name="current_total_fee[]" value="<?php echo $grand_total; ?>" class="form-control" readonly />
<input type="hidden" name="current_total_fee_bal[]" value="<?php echo $balance_total; ?>" class="form-control" readonly />
</td>
<td>
<input type="text" name="previous_dues_fee[]" value="<?php echo $student_previous_year_fee; ?>" class="form-control"  />
</td>
<td>
<center><input type="checkbox" name="index[]" value="<?php echo $index; ?>" class="my_check" checked /></center>
<input type="hidden" name="student_roll_no[]" value="<?php echo $student_roll_no; ?>" class="form-control" readonly />
</td>
</tr>
<?php $index++; 
} } //} ?>
<tr>
<td colspan="7"><center><input type="submit" name="submit" value="Submit" onclick="return validate();" class="btn my_background_color" /></center></td>
</tr>
</tbody>
</table>

</div>