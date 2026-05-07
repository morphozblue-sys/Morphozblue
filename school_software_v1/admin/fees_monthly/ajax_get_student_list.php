<?php include("../attachment/session.php"); ?>
<?php
$student_class=$_GET['student_class'];
if($student_class!=''){
	$condition=" and student_class='$student_class'";
}else{
	$condition="";
}
$student_class_section=$_GET['student_class_section'];
if($student_class_section!='All'){
	$condition1=" and student_class_section='$student_class_section'";
}else{
	$condition1="";
}
$student_due_month=$_GET['student_due_month'];
$range_value=$_GET['range_value'];

$que="select student_name,student_father_name,student_roll_no,school_roll_no,student_sms_contact_number from student_admission_info where session_value='$session1'$condition$condition1";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_roll_no=$row['student_roll_no'];
$school_roll_no=$row['school_roll_no'];
$student_sms_contact_number=$row['student_sms_contact_number'];

if($range_value==0){
$range_condition=">0";
}elseif($range_value==1){
$range_condition="<=0";
}
$que01="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37";
$run01=mysqli_query($conn73,$que01);
$fee_sum="";
$fee_balance_condition="";
$count=0;
while($row01=mysqli_fetch_assoc($run01)){
$fee_type5 = $row01['fee_type'];
$fee_code = $row01['fee_code'];
if($count==0){
$fee_sum="SUM(student_".$fee_code."_balance_month".$student_due_month.")";
$fee_balance_condition=" where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no' and student_".$fee_code."_balance_month".$student_due_month.$range_condition;
}else{
$fee_sum=$fee_sum."+SUM(student_".$fee_code."_balance_month".$student_due_month.")";
$fee_balance_condition=$fee_balance_condition." or fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no' and student_".$fee_code."_balance_month".$student_due_month.$range_condition;
}
$count++;
}

$query11="select student_roll_no from common_fees_student_fee$fee_balance_condition";
$result11=mysqli_query($conn73,$query11);
if(mysqli_num_rows($result11)>0){
	
$query00="select ($fee_sum) AS Total, student_previous_year_fee_balance, student_previous_year_fee_paid_total from common_fees_student_fee$fee_balance_condition";
$result00=mysqli_query($conn73,$query00);
while($row00=mysqli_fetch_assoc($result00)){
$total=$row00['Total'];	
$student_previous_year_fee_balance=$row00['student_previous_year_fee_balance'];	
$student_previous_year_fee_paid_total=$row00['student_previous_year_fee_paid_total'];	
}

if($range_value==0 && $total>0){
$serial_no++;
?>
<div class="col-md-6">
<table class="table table-responsive">
    <tr>
        <td><?php echo $serial_no.'.'; ?></td>
        <td><?php echo $student_name.' / '.$student_father_name; ?></td>
        <td><span style="font-weight:bold;color:red;"><?php echo $total; ?></span></td>
        <td><input type="checkbox" name="student_sms_info[]" class="my_no" value="<?php echo $student_name.'|?|'.$student_sms_contact_number.'|?|'.$total.'|?|'.$student_previous_year_fee_balance; ?>" checked /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Previous Dues</td>
        <td><span style="font-weight:bold;color:red;"><?php echo $student_previous_year_fee_balance; ?></span></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Total Dues = </td>
        <td><span style="font-weight:bold;color:red;"><?php echo $total+$student_previous_year_fee_balance; ?></span></td>
        <td>&nbsp;</td>
    </tr>
</table>
</div>
<?php }elseif($range_value==1){ $serial_no++; ?>
<div class="col-md-6">
<div class="col-md-1"><span style="font-weight:bold;"><?php echo $serial_no.'.'; ?></span></div>
<div class="col-md-10"><span><?php echo $student_name.' / '.$student_father_name; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;color:red;"><?php echo $total; ?></span></div>
<div class="col-md-1"><span><input type="checkbox" name="student_sms_info[]" class="my_no" value="<?php echo $student_name.'|?|'.$student_sms_contact_number; ?>" checked /></span></div>
</div>
<?php } } } ?>