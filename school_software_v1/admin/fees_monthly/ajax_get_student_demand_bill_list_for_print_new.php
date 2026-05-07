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
 
$student_note=$_POST['student_note'];
$for_prev_amt=$_POST['for_prev_amt'];
 
$month_array=array("01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");







	$que0="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
	$run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73)) ;
	$serial_no=0;
	while($row0=mysqli_fetch_assoc($run0)){
	$s_no=$row0['s_no'];
	$fee_type = $row0['fee_type'];
	$fee_code = $row0['fee_code'];
	if($fee_type!=''){
	$fee_type1[$serial_no] = $row0['fee_type'];
	$fee_code1[$serial_no] = $row0['fee_code'];
	$fee_type=strtolower($fee_type);
	$fee[$serial_no]="student_".$fee_code."_month";
	$fee_discount_type[$serial_no]="student_".$fee_code."_discount_month";
	$fee_discount_method[$serial_no]="student_".$fee_code."_discount_method_month";
	$fee_discount_amount[$serial_no]="student_".$fee_code."_discount_amount_month";
	$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
	$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
	$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
	$serial_no++;
	} }






$que="select student_name,student_father_name,student_roll_no,school_roll_no,student_admission_number,student_scholar_number,student_sms_contact_number,student_class,student_class_section from student_admission_info where session_value='$session1'$condition$condition1$condition_bus$filter37";
$run=mysqli_query($conn73,$que);

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
if($student_admission_number==''){ $student_admission_number = $student_scholar_number;  }



$que00="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active'";
$run00=mysqli_query($conn73,$que00) or die(mysqli_error($conn73));

while($row00=mysqli_fetch_assoc($run00)){
    $student_previous_year_fee=$row00['student_previous_year_fee'];
    $student_previous_year_fee_balance=$row00['student_previous_year_fee_balance'];
    $student_transport_fee_balance=$row00['student_transport_fee_balance'];
    for($k=0;$k<$count1;$k++){
            for($l=0;$l<$serial_no;$l++){
            if($k==0){
                $fee1[$l] = 0;
            }
            $fee1[$l] = $fee1[$l]+$row00[$fee_balance[$l].$student_due_month[$k]];
        }
    }
}





if($student_transport_fee_balance==''){ $student_transport_fee_balance=0;}
?>
<tr>
<td><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
</tr>
<tr>
<td><span style="font-size:18px;">Name :-  <?php echo $student_name.' / '.$student_father_name.' / '.$student_admission_number.' / '.$school_roll_no; ?></span><span style="font-size:18px;float:right;">Class :-  <?php echo $student_class.' ('.$student_class_section.')'; ?></span></td>
</tr>

	<?php $grand_total=0; $ser=0; 
	for($j=0;$j<$serial_no;$j++){ 
	$ser++;
	$grand_total=$grand_total+$fee1[$j]; 
	?>


<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;"><?php echo $fee_type1[$j]; ?> :-  <?php echo $fee1[$j]; ?> /-</span><span style="font-size:18px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
</tr>
<?php }?>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:red;">Tranport Amount :-  <?php echo $student_transport_fee_balance; ?> /-</td>
</tr>


<?php  
$final_amount =  $student_transport_fee_balance+$grand_total
?>


<?php
if($for_prev_amt=='Yes'){
    $final_amount=$final_amount+$student_previous_year_fee_balance;
?>
<tr>
<td><span style="font-size:18px;font-weight:bold;color:blue;">Previous Dues Amount :-  <?php echo $student_previous_year_fee_balance; ?> /-</td>
</tr>
<?php
}
?>
<tr>

<tr>
    
<td><span style="font-size:18px;font-weight:bold;color:green;">Total Amount :-  <?php echo $final_amount; ?> /-</td>

</tr>



    
  
    
<td><span>Month :- </span><span style="font-size:18px;font-weight:bold;color:black;">  <?php 
  for($k=0;$k<$count1;$k++){
if($k>0){
    echo ", ";
}
echo $month_array[$student_due_month[$k]];
}
  ?> </td>
  
  </tr>
<?php if($student_note!=''){ ?>
<tr>
<td><span style="font-size:18px;font-weight:bold;">Dues Note :  </span><?php echo $student_note; ?></td>
</tr>
<?php } ?>
<tr>
<td><hr/></td>
</tr>
<?php }  ?>
</table>
</div>