<?php include("../attachment/session.php"); ?>
<div class="col-md-12">

<table class="table table-responsive" width="100%">
<thead class="my_background_color">
<tr>
<th>S.No.</th>
<th>Name</th>
<th>Father Name</th>
<th>Class (Sec.)</th>
<th>Bus Category</th>
<th>Current Year Fee</th>
<th>Transport Fee</th>
<th><input type="checkbox" id="my_check" onclick="for_check(this.id);" checked /></th>
</tr>
</thead>
<tbody>
<?php
$exp_session1=explode('_',$session1);
$exp_session2=$exp_session1[0]-1;
$exp_session3=$exp_session1[1]-1;
$session2=$exp_session2.'_'.$exp_session3;

$que00="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
$run00=mysqli_query($conn73,$que00) or die(mysqli_error($conn73)) ;
$serial_no00=0;
while($row00=mysqli_fetch_assoc($run00)){
$s_no=$row00['s_no'];
$fee_type = $row00['fee_type'];
$fee_code = $row00['fee_code'];
if($fee_type!=''){
$fee_type1[$serial_no00] = $row00['fee_type'];
$fee_code1[$serial_no00] = $row00['fee_code'];
$serial_no00++;
} }

$student_class=$_GET['student_class'];
if($student_class!=''){
    $condition=" and student_class='$student_class'";
    $condition2="where class_name='$student_class'";
}else{
    $condition="";
    $condition2="";
}
$student_section=$_GET['student_section'];
if($student_section!=''){
    $condition1=" and student_class_section='$student_section'";
}else{
    $condition1="";
}

$que0="select class_code from school_info_class_info $condition2";
$run0=mysqli_query($conn73,$que0);
while($row0=mysqli_fetch_assoc($run0)){
$class_code=$row0['class_code'];
}

$que="select * from student_admission_info where student_status='Active' and session_value='$session1' and student_bus='Yes' and student_bus_fee_category_code!=''$condition$condition1$filter37";
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
$student_bus_fee_category=$row['student_bus_fee_category'];
$student_bus_fee_category_code=$row['student_bus_fee_category_code'];
$student_admission_number=$row['student_admission_number'];

$que1="select * from common_fees_student_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
$run1=mysqli_query($conn73,$que1);

if(mysqli_num_rows($run1)>0){
while($row1=mysqli_fetch_assoc($run1)){
$grand_total=$row1['grand_total'];
$balance_total=$row1['balance_total'];
$student_transport_fee=$row1['student_transport_fee'];
}

$select_col=$class_code.'_amount';
$que2="select $select_col from bus_fee_category where bus_fee_category_code='$student_bus_fee_category_code'";
$run2=mysqli_query($conn73,$que2);
//if(mysqli_num_rows($run2)>0){
$transport_fee=0;
while($row2=mysqli_fetch_assoc($run2)){
$transport_fee=$row2[$select_col];
}
if($update_change=='rahul@simption.com'){echo $grand_total."".$balance_total." ".!in_array('Transport Amount', $fee_type1)." ".!in_array('Transport Fee', $fee_type1).'<br>';}
if(($grand_total==$balance_total && $student_transport_fee=='' && !in_array('Transport Amount', $fee_type1) && !in_array('Transport Fee', $fee_type1) && !in_array('Bus Amount', $fee_type1) && !in_array('Bus Fee', $fee_type1)) || ($grand_total==$balance_total && $student_transport_fee==0 && !in_array('Transport Amount', $fee_type1) && !in_array('Transport Fee', $fee_type1) && !in_array('Bus Amount', $fee_type1) && !in_array('Bus Fee', $fee_type1))){
if($update_change=='rahul@simption.com'){echo $grand_total."".$balance_total.'<br>';}
$serl++;
?>
<tr>
<td><?php echo $serl.'.'; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $student_father_name; ?></td>
<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
<td><?php echo $student_bus_fee_category; ?></td>
<td>
<input type="text" name="current_total_fee[]" value="<?php echo $grand_total; ?>" class="form-control" readonly />
<input type="hidden" name="current_total_fee_bal[]" value="<?php echo $balance_total; ?>" class="form-control" readonly />
</td>
<td>
<input type="text" name="transport_fee[]" value="<?php echo $transport_fee; ?>" class="form-control" />
</td>
<td>
<center><input type="checkbox" name="index[]" value="<?php echo $index; ?>" class="my_check" checked /></center>
<input type="hidden" name="student_roll_no[]" value="<?php echo $student_roll_no; ?>" class="form-control" readonly />
</td>
</tr>
<?php $index++; } } } //} ?>
<tr>
<td colspan="7"><center><input type="submit" name="submit" value="Submit" onclick="return validate();" class="btn my_background_color" /></center></td>
</tr>
</tbody>
</table>

</div>