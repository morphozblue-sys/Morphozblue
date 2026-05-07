<?php include("../attachment/session.php"); ?>
<div class="col-md-12" id="printTable">
<table class="table table-bordered table-striped" cellpadding="2px;" cellspacing="0" width="100%">
<?php
$student_class=$_POST['student_class'];
if($student_class!=''){
	$condition=" and student_class='$student_class'";
}else{
	$condition="";
}
$student_class_section=$_POST['student_class_section'];
if($student_class_section!='All'){
	$condition1=" and student_class_section='$student_class_section'";
}else{
	$condition1="";
}
$student_status=$_POST['student_status'];
if($student_status!='All'){
	$condition2=" and student_status='$student_status'";
	if($student_status=='Active'){
	$condition02=" and fee_status='Active'";
	}else{
	$condition02="";
	}
}else{
	$condition2="";
	$condition02="";
}
$selected_month=$_POST['selected_month'];
$sel_month_count=count($selected_month);

// $head_value=$_POST['head_value'];
// if($head_value!='yearly_head'){
//     $head_condition=" and fee_code!='$head_value'";
// }else{
//     $head_condition="";
// }

// $que01="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$head_condition$filter37";
// $run01=mysqli_query($conn73,$que01);
// $count=0;
// while($row01=mysqli_fetch_assoc($run01)){
// $fee_code = $row01['fee_code'];
// $fee_balance[$count]="student_".$fee_code."_balance_month";
// $count++;
// }

$que="select student_name,student_father_name,student_roll_no,school_roll_no,student_sms_contact_number from student_admission_info where session_value='$session1'$condition$condition1$condition2$filter37";
$run=mysqli_query($conn73,$que);
$serial_no=0;
$serial_updown=0;
while($row=mysqli_fetch_assoc($run)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_roll_no=$row['student_roll_no'];
$school_roll_no=$row['school_roll_no'];
$student_sms_contact_number=$row['student_sms_contact_number'];

	
$query00="select * from common_fees_student_transport_fee where student_roll_no='$student_roll_no' and session_value='$session1'$condition02";
$result00=mysqli_query($conn73,$query00);
$installment_amount=0;
$transport_fee00=0;
while($row00=mysqli_fetch_assoc($result00)){
// if($head_value=='yearly_head'){
//     $student_transport_fee_balance=$row00['student_transport_fee_balance'];
//     $transport_fee00=$transport_fee00+$student_transport_fee_balance;
// }else{
//     for($c=0;$c<$sel_month_count;$c++){
//     $trans_monthly=$row00['student_'.$head_value.'_balance_month'.$selected_month[$c]];
//     $transport_fee00=$transport_fee00+$trans_monthly;
//     }
// }
$student_previous_year_fee_balance=$row00['student_previous_year_fee_balance'];
$installment_amount=$installment_amount+$student_previous_year_fee_balance;

for($a=0;$a<$sel_month_count;$a++){
    //for($b=0;$b<$count;$b++){
        $installment_amount=$installment_amount+$row00["transport_fee_balance_month".$selected_month[$a]];
    //}
}

if($installment_amount>0 || $transport_fee00>0){
$serial_no++;
$serial_updown++;
if($serial_updown==1){
?>
<tr>
<?php } ?>
<?php if($_SESSION['software_link']=='kidzworldschoolrewa') { ?>
<td><span style="font-weight:bold;"><?php echo $serial_no.'.'; ?></span></td>
<td><span><?php echo $student_name.' / '.$student_father_name; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;color:red;"><?php echo $installment_amount; ?></span></td>
<td><span><input type="checkbox" name="student_sms_info[]" class="my_no" value="<?php echo $student_name.'|?|'.$student_sms_contact_number.'|?|'.$installment_amount; ?>" checked /></span></td>
<td>&nbsp;</td>
<?php } ?>

<?php if($_SESSION['database_name']!='simpthqt_kidzworldschoolrewa') { ?>
<td><span style="font-weight:bold;"><?php echo $serial_no.'.'; ?></span></td>
<td><span><?php echo $student_name.' / '.$student_father_name; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;color:red;"><?php echo $installment_amount; ?>/-</span></td>
<td><span><input type="checkbox" name="student_sms_info[]" class="my_no" value="<?php echo $student_name.'|?|'.$student_sms_contact_number.'|?|'.$installment_amount; ?>" checked /></span></td>
<td>&nbsp;</td>
<?php } ?>

<?php  if($serial_updown==2){ $serial_updown=0; ?>
</tr>
<?php } } } } ?>
</table>
</div>