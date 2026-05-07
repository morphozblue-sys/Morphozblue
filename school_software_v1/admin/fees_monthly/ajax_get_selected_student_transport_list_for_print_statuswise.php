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
$student_note=$_POST['student_note'];
$student_roll_no1=$_POST['student_roll_no'];
$count_roll=count($student_roll_no1);
$count_condition="";
for($ad=0;$ad<$count_roll;$ad++){
if($ad==0){
    $count_condition="student_roll_no='$student_roll_no1[$ad]'";
}else{
    $count_condition=$count_condition." or student_roll_no='$student_roll_no1[$ad]'";
}
}
if($count_condition!=''){
    $count_condition="and (".$count_condition.")";
}

// $que01="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$head_condition$filter37";
// $run01=mysqli_query($conn73,$que01);
// $count=0;
// while($row01=mysqli_fetch_assoc($run01)){
// $fee_code = $row01['fee_code'];
// $fee_balance[$count]="student_".$fee_code."_balance_month";
// $count++;
// }
$ins_name=array("01"=>"January", "02"=>"February", "03"=>"March", "04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");

$que="select student_name,student_father_name,student_class,student_class_section,student_roll_no,school_roll_no,student_sms_contact_number from student_admission_info where session_value='$session1'$condition$condition1$condition2$count_condition$filter37";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_class1=$row['student_class'];
$student_class_section1=$row['student_class_section'];
$student_roll_no=$row['student_roll_no'];
$school_roll_no=$row['school_roll_no'];
$student_sms_contact_number=$row['student_sms_contact_number'];

	
$query00="select * from common_fees_student_transport_fee where student_roll_no='$student_roll_no' and session_value='$session1'$condition02";
$result00=mysqli_query($conn73,$query00);
$installment_amount=0;
$transport_fee00=0;
$fees_type_name='';
$comma='';
while($row00=mysqli_fetch_assoc($result00)){
// if($head_value=='yearly_head'){
//     $student_transport_fee_balance=$row00['student_transport_fee_balance'];
//     $transport_fee00=$transport_fee00+$student_transport_fee_balance;
// }else{
//     for($c=0;$c<$sel_month_count;$c++){
//     $transport_fee00=$transport_fee00+$row00['student_'.$head_value.'_balance_month'.$selected_month[$c]];
//     }
// }
$student_previous_year_fee_balance=$row00['student_previous_year_fee_balance'];
//$installment_amount=$installment_amount+$student_previous_year_fee_balance;

for($a=0;$a<$sel_month_count;$a++){
    //for($b=0;$b<$count;$b++){
        $installment_amount=$installment_amount+$row00["transport_fee_balance_month".$selected_month[$a]];
    //}
    $fees_type_name=$fees_type_name.$comma.$ins_name[$selected_month[$a]];
    $comma=', ';
}

if($installment_amount>0 || $transport_fee00>0){
$serial_no++;
?>
<tr>
<td><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
</tr>
<tr>
<td><span style="font-size:18px;">Name :-  <?php echo $student_name.' / '.$student_father_name; ?></span><span style="font-size:18px;float:right;">Class :-  <?php echo $student_class1.' ('.$student_class_section1.')'; ?></span></td>
</tr>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Transport Dues Amount :-  <?php echo $installment_amount; ?> /-</span><span style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo $fees_type_name; ?> )</span></td>
</tr>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Previous Year Amount :-  <?php echo $student_previous_year_fee_balance; ?> /- </td>   
</tr>
<?php if($student_note!=''){ ?>
<tr>
<td><span style="font-size:18px;font-weight:bold;">Dues Note :  </span><?php echo $student_note; ?></td>
</tr>
<?php } ?>
<tr>
<td><hr/></td>
</tr>
<?php } } } ?>
</table>
</div>