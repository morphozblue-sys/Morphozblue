<?php include("../attachment/session.php"); 
$student_class=$_POST['student_class'];
$student_class_section=$_POST['student_class_section'];

$que0001="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
$run0001=mysqli_query($conn73,$que0001);
$sno0001=0;
while($row0001=mysqli_fetch_assoc($run0001)){
$fees_code = $row0001['fees_code'];

$penalty_day_monthly[$fees_code] = $row0001['penalty_day_monthly'];

$dues_last_date[$fees_code] = $row0001['dues_last_date'];
$penalty_percent_rupees_amount[$fees_code] = $row0001['penalty_percent_rupees_amount'];
$penalty_method[$fees_code] = $row0001['penalty_method'];
$sno0001++;
}
?>
<div class="col-md-12" id="printTable">
<table class="table table-bordered table-striped" cellpadding="2px;" cellspacing="0" width="100%">
<tr><td colspan="8"><center><b style="color:red;font-size:20px;">Class : <?php echo $student_class.'  ,  '; ?>Section : <?php echo $student_class_section; ?></b></center></td></tr>    
<?php

if($student_class!=''){
	$condition=" and student_class='$student_class'";
}else{
	$condition="";
}

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

$head_value=$_POST['head_value'];
if($head_value!='yearly_head'){
    $head_condition=" and fee_code!='$head_value'";
}else{
    $head_condition="";
}

$late_fee=$_POST['late_fee'];

$que01="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$head_condition$filter37";
$run01=mysqli_query($conn73,$que01);
$count=0;
while($row01=mysqli_fetch_assoc($run01)){
$fee_code = $row01['fee_code'];
$fee_balance[$count]="student_".$fee_code."_balance_month";
$count++;
}

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

	
$query00="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1'$condition02";
$result00=mysqli_query($conn73,$query00);
$installment_amount=0;
$transport_fee00=0;
$late_fee00=0;
while($row00=mysqli_fetch_assoc($result00)){
if($head_value=='yearly_head'){
    $student_transport_fee_balance=$row00['student_transport_fee_balance'];
    $transport_fee00=$transport_fee00+$student_transport_fee_balance;
}else{
    for($c=0;$c<$sel_month_count;$c++){
    $trans_monthly=$row00['student_'.$head_value.'_balance_month'.$selected_month[$c]];
    $transport_fee00=$transport_fee00+$trans_monthly;
    }
}
$student_previous_year_fee_balance=$row00['student_previous_year_fee_balance'];
$installment_amount=$installment_amount+$student_previous_year_fee_balance;

for($a=0;$a<$sel_month_count;$a++){
    for($b=0;$b<$count;$b++){
        $installment_amount=$installment_amount+$row00[$fee_balance[$b].$selected_month[$a]];
    }
    
if(date('Y-m-d') > $dues_last_date[$selected_month[$a]] && $dues_last_date[$selected_month[$a]]!='0000-00-00' && $late_fee=='Yes'){
if($penalty_day_monthly[$selected_month[$a]]=='Day'){

$current_date=date_create(date('Y-m-d'));
$dues_last_date11=date_create($dues_last_date[$selected_month[$a]]);
$diff=date_diff($current_date,$dues_last_date11);
$clear_difference=$diff->format("%a");

if($penalty_method[$selected_month[$a]]=='%'){
$late_fee00=$late_fee00+(($installment_amount*$clear_difference*$penalty_percent_rupees_amount[$selected_month[$a]])/100);
}elseif($penalty_method[$selected_month[$a]]=='Rs'){
$late_fee00=$late_fee00+($penalty_percent_rupees_amount[$selected_month[$a]]*$clear_difference);
}
}else{
if($penalty_method[$selected_month[$a]]=='%'){
$late_fee00=$late_fee00+(($installment_amount*$penalty_percent_rupees_amount[$selected_month[$a]])/100);
}elseif($penalty_method[$selected_month[$a]]=='Rs'){
$late_fee00=$late_fee00+$penalty_percent_rupees_amount[$selected_month[$a]];
}
}
}else{
$late_fee00=$late_fee00;
}
    
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
<td><span><input type="checkbox" name="student_sms_info[]" class="my_no" value="<?php echo $student_name.'|?|'.$student_sms_contact_number.'|?|'.$installment_amount.'|?|'.$transport_fee00.'|?|'.$late_fee00; ?>" checked /></span></td>
<td>&nbsp;</td>
<?php } ?>

<?php if($_SESSION['database_name']!='simpthqt_kidzworldschoolrewa') { ?>
<td><span style="font-weight:bold;"><?php echo $serial_no.'.'; ?></span></td>
<td><span><?php echo $student_name.' / '.$student_father_name; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;color:red;"><?php echo $installment_amount; ?><br/>Transport Amount  -  <?php echo $transport_fee00; ?>/- <?php if($late_fee=='Yes'){ echo "<br/>Late Fee Amount  -  ".$late_fee00; } ?></span></td>
<td><span><input type="checkbox" name="student_sms_info[]" class="my_no" value="<?php echo $student_name.'|?|'.$student_sms_contact_number.'|?|'.$installment_amount.'|?|'.$transport_fee00.'|?|'.$late_fee00; ?>" checked /></span></td>
<td>&nbsp;</td>
<?php } ?>

<?php  if($serial_updown==2){ $serial_updown=0; ?>
</tr>
<?php } } } } ?>
</table>
</div>