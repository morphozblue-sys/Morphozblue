<?php include("../attachment/session.php"); ?>
<div id="printTable">
<table class="table" cellpadding="5px;" cellspacing="0" style="width:100%">
<?php

$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
while($schl_row=mysqli_fetch_assoc($schl_result)){
$school_info_school_name=$schl_row['school_info_school_name'];
$school_info_dise_code=$schl_row['school_info_dise_code'];
$school_info_school_code=$schl_row['school_info_school_code'];
}

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
$student_due_month=$_POST['student_due_month'];

$querr1="select fees_type_name from school_info_monthly_fees where fees_code='$student_due_month' and session_value='$session1'$filter37";
$runn1=mysqli_query($conn73,$querr1);
while($roww1=mysqli_fetch_assoc($runn1)){
    $fees_type_name=$roww1['fees_type_name'];
}

$range_value=$_POST['range_value'];
$student_note=$_POST['student_note'];
$student_roll_no1=$_POST['student_roll_no'];
$count_roll=count($student_roll_no1);
$count_condition="";
for($ad=0;$ad<$count_roll;$ad++){
if($ad==0){
    $count_condition=" where session_value='$session1' and student_roll_no='$student_roll_no1[$ad]'$condition$condition1";
}else{
    $count_condition=$count_condition." or session_value='$session1' and student_roll_no='$student_roll_no1[$ad]'$condition$condition1";
}
}

$que="select student_name,student_father_name,student_roll_no,school_roll_no,student_sms_contact_number,student_class,student_class_section,student_bus from student_admission_info$count_condition";
$run=mysqli_query($conn73,$que);
$serial_no=0;
$left_right=0;
while($row=mysqli_fetch_assoc($run)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_roll_no=$row['student_roll_no'];
$school_roll_no=$row['school_roll_no'];
$student_sms_contact_number=$row['student_sms_contact_number'];
$student_class=$row['student_class'];
$student_class_section=$row['student_class_section'];
$student_bus=$row['student_bus'];

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
	
$query00="select ($fee_sum) AS Total,student_transport_fee_balance,student_transport_fee_paid_total from common_fees_student_fee$fee_balance_condition";
$result00=mysqli_query($conn73,$query00);
while($row00=mysqli_fetch_assoc($result00)){
$total=$row00['Total'];
$student_transport_fee_balance=$row00['student_transport_fee_balance'];	
$student_transport_fee_paid_total=$row00['student_transport_fee_paid_total'];
}
$student_transport_fee_balance1=0;
if($range_value==0){
$serial_no++;
$left_right++;
?>
<tr>
<td><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
</tr>
<tr>
<td><span style="font-size:18px;">Name :-  <?php echo $student_name.' / '.$student_father_name; ?></span><span style="font-size:18px;float:right;">Class :-  <?php echo $student_class.' ('.$student_class_section.')'; ?></span></td>
</tr>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Dues Amount :-  <?php echo $total; ?> /-</span><span style="font-size:18px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo $fees_type_name; ?> )</span></td>
</tr>
<?php if($student_bus='Yes') ?>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Transport Amount :-  <?php echo $student_transport_fee_balance; ?></span><td>    
</tr>    
<?php  $student_transport_fee_balance1 = $student_transport_fee_balance;  } ?>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Total Amount :-  <?php echo $total+$student_transport_fee_balance1; ?></span><td>    
</tr> 
<?php if($student_note!=''){ ?>
<tr>
<td><span style="font-size:18px;font-weight:bold;">Dues Note :  </span><?php echo $student_note; ?></td>
</tr>
<?php } ?>
<tr>
<td><hr/></td>
</tr>
<?php }elseif($range_value==1){ $serial_no++; ?>
<tr>
<td><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
</tr>
<tr>
<td><span style="font-size:18px;">Name :-  <?php echo $student_name.' / '.$student_father_name; ?></span><span style="font-size:18px;float:right;">Class :-  <?php echo $student_class.' ('.$student_class_section.')'; ?></span></td>
</tr>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Paid Amount :-  <?php echo $total; ?> /-</span><span style="font-size:18px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo $fees_type_name; ?> )</span><span style="font-size:18px;font-weight:bold;color:red;float:right;">Transport Amount :-  <?php echo $student_transport_fee_paid_total; ?></span></td>
</tr>
<?php if($student_note!=''){ ?>
<tr>
<td><span style="font-size:18px;font-weight:bold;">Paid Note :  </span><?php echo $student_note; ?></td>
</tr>
<?php } ?>
<tr>
<td><hr/></td>
</tr>
<?php } } } ?>
</table>
</div>