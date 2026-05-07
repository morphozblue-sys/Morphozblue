<?php include("../attachment/session.php"); ?>
<table class="table table-responsive">
<?php
$transport_fee_head=$_GET['transport_fee_head'];
$student_class=$_GET['class_name'];
if($student_class!=''){
    $condition1=" and student_class='$student_class'";
}else{
    $condition1="";
}
$student_class_stream=$_GET['student_class_stream'];
if($student_class_stream!='All'){
    $condition2=" and student_class_stream='$student_class_stream'";
}else{
    $condition2="";
}
$student_class_section=$_GET['student_class_section'];
if($student_class_section!='All'){
    $condition3=" and student_class_section='$student_class_section'";
}else{
    $condition3="";
}

$que125="select * from school_info_class_info where class_name='$student_class'";
$run125=mysqli_query($conn73,$que125) or die(mysqli_error($conn73));
while($row125=mysqli_fetch_assoc($run125)){
$class_code=$row125['class_code'];
}
?>
<div class="col-md-1"><span style="color:red;"><input type="checkbox" id="info" value="" onclick="for_check(this.id);" checked /> <b>All</b></span></div>
<div class="col-md-11"><h4 style="color:#d9534f;">Transport Fees Details:</h4></div>
<?php
$que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$fees_type_name[] = $row1['fees_type_name'];	
$fees_code[] = $row1['fees_code'];
$fees_count = $row1['fees_count'];
}
?>
<thead class="my_background_color">
<tr>
<th>#</th>
<th>Students_Detail</th>
<?php
for($av=0;$av<$fees_count;$av++){
?>
<th><?php echo $fees_type_name[$av]; ?><input type="hidden" name="transport_fees_code[]" value="<?php echo $fees_code[$av]; ?>" /></th>
<?php } ?>
<th>Total_Amount</th>
</tr>
</thead>
<tbody>
<?php
$que2="select * from student_admission_info where student_status='Active' and registration_final='yes' and student_bus='Yes' and student_bus_fee_category_code!='' and session_value='$session1'$condition1$condition2$condition3$filter37";
$run2=mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
$student_serial_no=0;
while($row2=mysqli_fetch_assoc($run2)){
$student_name = $row2['student_name'];
$student_father_name = $row2['student_father_name'];
$student_class = $row2['student_class'];
$student_roll_no = $row2['student_roll_no'];
$student_bus_fee_category_code = $row2['student_bus_fee_category_code'];

$query11="select * from common_fees_student_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
$result11=mysqli_query($conn73,$query11) or die(mysqli_error($conn73));
if(mysqli_num_rows($result11)>0){
 
while($row11=mysqli_fetch_assoc($result11)){
    $school_fee_grand_total=$row11['grand_total'];
    $school_fee_balance_total=$row11['balance_total'];
    $set_transport=$row11['set_transport'];

//if($school_fee_grand_total==$school_fee_balance_total){


$que3="select * from bus_fee_category where bus_fee_category_code='$student_bus_fee_category_code'";
$run3=mysqli_query($conn73,$que3) or die(mysqli_error($conn73));
//$installmentwise_amount='';
$total_amount = 0;
while($row3=mysqli_fetch_assoc($run3)){
for($ab=0;$ab<$fees_count;$ab++){
$installmentwise_amount[$ab] = $row3[$class_code.'_amount_month'.$fees_code[$ab]];
$total_amount = $total_amount+$installmentwise_amount[$ab];
}
}
if($set_transport!='Yes'){
?>
<tr>
<td>
<input type="checkbox" name="student_info[]" class="info" value="<?php echo $student_roll_no.'|?|'.$student_name.'|?|'.$student_class.'|?|'.$school_fee_grand_total.'|?|'.$school_fee_balance_total; ?>" <?php if($set_transport!='Yes'){ echo 'checked'; } ?> />

</td>
<td>
<?php echo $student_name.' / '.$student_father_name.' ('.$student_class.')'; ?>
<?php if($set_transport=='Yes'){ ?>
<center><span style="font-weight:bold;color:blue;">Set</span></center>
<?php }else{ ?>
<center><span style="font-weight:bold;color:red;">Not Set</span></center>
<?php } ?>
</td>
<?php
for($av=0;$av<$fees_count;$av++){
?>
<td>
<input type="text" name="<?php echo $student_roll_no.'_'.$fees_code[$av]; ?>" id="<?php echo 'installmentwise_amount_'.$student_serial_no; ?>" oninput="for_total('<?php echo $student_serial_no; ?>');" value="<?php echo $installmentwise_amount[$av]; ?>" title="<?php echo $student_name; ?>" class="form-control <?php echo 'fee1_'.$student_serial_no; ?>" />
</td>
<?php } ?>
<td>
<input type="text" name="total_amount[]" id="<?php echo 'total_amount_'.$student_serial_no; ?>" title="<?php echo $student_name; ?>" value="<?php echo $total_amount; ?>" class="form-control" readonly />
</td>
</tr>
<?php  }else{ 
    $total_amount=0;
for($ab=0;$ab<$fees_count;$ab++){
 $installmentwise_amount[$ab] = $row11["student_".$transport_fee_head.'_total_amount_after_discount_month'.$fees_code[$ab]];
$total_amount = $total_amount+$installmentwise_amount[$ab];
}
?>


<tr>
<td>

</td>
<td>
<?php echo $student_name.' / '.$student_father_name.' ('.$student_class.')'; ?>
<?php if($set_transport=='Yes'){ ?>
<center><span style="font-weight:bold;color:blue;">Set</span></center>
<?php }else{ ?>
<center><span style="font-weight:bold;color:red;">Not Set</span></center>
<?php } ?>
</td>
<?php
for($av=0;$av<$fees_count;$av++){
?>
<td>
<input type="text"  value="<?php echo $installmentwise_amount[$av]; ?>" title="<?php echo $student_name; ?>" class="form-control " readonly />
</td>
<?php } ?>
<td>
<input type="text"  value="<?php echo $total_amount; ?>" class="form-control" readonly />
</td>
</tr>
<?php $student_serial_no++; } } } }

?>
</tbody>
</table>