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
$student_bus=$_POST['student_bus'];
if($student_bus!='All'){
	$condition_bus=" and student_bus='$student_bus'";
}else{
	$condition_bus="";
}
$student_due_month=$_POST['student_due_month'];
$count1=count($student_due_month);

$fees_type_name='';
$querr1="select fees_type_name,fees_code from school_info_monthly_fees where session_value='$session1'$filter37";
$runn1=mysqli_query($conn73,$querr1);
while($roww1=mysqli_fetch_assoc($runn1)){
    $fees_code=$roww1['fees_code'];
    $fees_type_name[$fees_code]=$roww1['fees_type_name'];
}
$student_note=$_POST['student_note'];

$for_prev_amt=$_POST['for_prev_amt'];

$student_roll_no1=$_POST['student_roll_no'];
$count_roll=count($student_roll_no1);
$count_condition="";
for($ad=0;$ad<$count_roll;$ad++){
if($ad==0){
    $count_condition=" where student_roll_no='$student_roll_no1[$ad]' and session_value='$session1'$condition$condition1$filter37";
}else{
    $count_condition=$count_condition." or student_roll_no='$student_roll_no1[$ad]' and session_value='$session1'$condition$condition1$filter37";
}
}

$que01="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37";
$run01=mysqli_query($conn73,$que01);
$fee_sum="";
$fee_balance_condition="";
$count=0;
$abcd=0;
while($row01=mysqli_fetch_assoc($run01)){
$fee_type5 = $row01['fee_type'];
$fee_code = $row01['fee_code'];
for($i=0;$i<$count1;$i++){
if($count==0){
$fees_type_name1='';
$fee_sum="SUM(student_".$fee_code."_balance_month".$student_due_month[$i].")";
$fees_type_name1=$fees_type_name[$student_due_month[$i]];
}else{
$fee_sum=$fee_sum."+SUM(student_".$fee_code."_balance_month".$student_due_month[$i].")";
if($abcd==0){
$fees_type_name1=$fees_type_name[$student_due_month[$i]];
}
}
$count++;
}
$abcd++;
}

$que="select student_name,student_father_name,student_roll_no,school_roll_no,student_admission_number,student_scholar_number,student_sms_contact_number,student_class,student_class_section from student_admission_info $count_condition$condition_bus";
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
$student_admission_number=$row['student_admission_number'];
$student_scholar_number=$row['student_scholar_number'];
if($student_admission_number==''){ $student_admission_number = $student_scholar_number;}
$query11="select student_roll_no from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1'";
$result11=mysqli_query($conn73,$query11);
if(mysqli_num_rows($result11)>0){
$student_transport_fee_balance='';
$student_previous_year_fee_balance='';
$query00="select ($fee_sum) AS Total,student_transport_fee_balance,student_previous_year_fee_balance from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1'";
$result00=mysqli_query($conn73,$query00);
while($row00=mysqli_fetch_assoc($result00)){
$total=$row00['Total'];	
$student_transport_fee_balance=$row00['student_transport_fee_balance'];	
$student_previous_year_fee_balance=$row00['student_previous_year_fee_balance'];	
}

$serial_no++;
if($student_transport_fee_balance==''){$student_transport_fee_balance=0;}
?>
<tr>
<td><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
</tr>
<tr>
<td><span style="font-size:18px;">Name :-  <?php echo $student_name.' / '.$student_father_name.' / '.$student_admission_number.' / '.$school_roll_no; ?></span><span style="font-size:18px;float:right;">Class :-  <?php echo $student_class.' ('.$student_class_section.')'; ?></span></td>
</tr>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Dues Amount :-  <?php echo $total; ?> /-</span><span style="font-size:18px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo 'Till '.$fees_type_name1; ?> )</span></td>
</tr>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Transport Amount :-  <?php echo $student_transport_fee_balance; ?> /-</td>    
</tr>

<?php
if($for_prev_amt=='Yes'){
?>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Previous Dues Amount :-  <?php echo $student_previous_year_fee_balance; ?> /-</td>
</tr>
<?php
}
?>

<?php if($student_note!=''){ ?>
<tr>
<td><span style="font-size:18px;font-weight:bold;">Dues Note :  </span><?php echo $student_note; ?></td>
</tr>
<?php } ?>
<tr>
<td><hr/></td>
</tr>
<?php } } ?>
</table>
</div>