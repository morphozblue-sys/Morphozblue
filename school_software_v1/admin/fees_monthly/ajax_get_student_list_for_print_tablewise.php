<?php include("../attachment/session.php"); ?>
<div id="printTable">
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

$head_value=$_POST['head_value'];
if($head_value!='yearly_head'){
    $head_condition=" and fee_code!='$head_value'";
}else{
    $head_condition="";
}
$student_note=$_POST['student_note'];

$late_fee=$_POST['late_fee'];

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

$que01="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$head_condition$filter37";
$run01=mysqli_query($conn73,$que01);
$count=0;
while($row01=mysqli_fetch_assoc($run01)){
$fee_code = $row01['fee_code'];
$fee_balance[$count]="student_".$fee_code."_balance_month";
$count++;
}
//$ins_name=array("01"=>"January", "02"=>"February", "03"=>"March", "04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");
$ins_name=array("01"=>"Jan", "02"=>"Feb", "03"=>"Mar", "04"=>"Apr", "05"=>"May", "06"=>"Jun", "07"=>"Jul", "08"=>"Aug", "09"=>"Sep", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");

$que="select student_name,student_father_name,student_class,student_admission_number,student_class_section,student_roll_no,school_roll_no,student_sms_contact_number from student_admission_info where session_value='$session1'$condition$condition1$condition2$filter37";
$run=mysqli_query($conn73,$que);
$serial_no=0;
$s_count=1;
while($row=mysqli_fetch_assoc($run)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_class1=$row['student_class'];
$student_class_section1=$row['student_class_section'];
$student_roll_no=$row['student_roll_no'];
$school_roll_no=$row['school_roll_no'];
$student_sms_contact_number=$row['student_sms_contact_number'];
$student_admission_number=$row['student_admission_number'];

	
$query00="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1'$condition02";
$result00=mysqli_query($conn73,$query00);
while($row00=mysqli_fetch_assoc($result00)){

$grand_total=0;
$grand_total11=0;
$student_previous_year_fee_balance=$row00['student_previous_year_fee_balance'];

$dues_total11=0;
for($abc11=0;$abc11<$sel_month_count;$abc11++){
$installment_amount[$abc11]=0;
for($b11=0;$b11<$count;$b11++){
$installment_amount[$abc11]=$installment_amount[$abc11]+$row00[$fee_balance[$b11].$selected_month[$abc11]];
}
$dues_total11=$dues_total11+$installment_amount[$abc11];
}

$transport_total11=0;
if($head_value!='yearly_head'){
for($abc21=0;$abc21<$sel_month_count;$abc21++){
$transport_fee001[$abc21]=0;
$transport_fee001[$abc21]=$transport_fee001[$abc21]+$row00['student_'.$head_value.'_balance_month'.$selected_month[$abc21]];
$transport_total11=$transport_total11+$transport_fee001[$abc21];
} }else{
$transport_total11=$transport_total11+$row00['student_transport_fee_balance'];
}
$grand_total11=$grand_total11+$dues_total11+$transport_total11+$student_previous_year_fee_balance;
if($grand_total11>0){
$serial_no++;
?>
<table <?php if($s_count==5){ $s_count=0; ?> style="page-break-after:always;" <?php } ?> class="table table-bordered table-striped" cellpadding="2px;" cellspacing="0" width="100%">
<tr>
<td colspan="<?php echo $sel_month_count+3; ?>"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
</tr>
<tr>
<td colspan="<?php echo $sel_month_count+3; ?>"><span style="font-size:18px;">Name :-  <?php echo $student_name.' / '.$student_father_name; ?></span><span style="font-size:18px;float:right;">Class :-  <?php echo $student_class1.' ('.$student_class_section1.')'; ?></span></td>
</tr>
<tr>
<td colspan="<?php echo $sel_month_count+3; ?>"><span style="font-size:18px;">Admission No :-  <?php echo $student_admission_number; ?></span><span style="font-size:18px;float:right;">Roll No :-  <?php echo $school_roll_no; ?></span></td>
</tr>
<tr>
<!-- <table class="table" cellpadding="2px;" cellspacing="0" style="width:100%"> -->
    <tr>
        <td><b>S.No.</b></td>
        <td><b>Particular</b></td>
        <?php for($abc=0;$abc<$sel_month_count;$abc++){ ?>
        <td><b><?php echo $ins_name[$selected_month[$abc]]; ?></b></td>
        <?php } ?>
        <td><b>Total</b></td>
    </tr>
    <tr>
        <td>1.</td>
        <td>Dues Amount</td>
        <?php
        $dues_total=0;
        for($abc1=0;$abc1<$sel_month_count;$abc1++){
        $installment_amount[$abc1]=0;
        for($b1=0;$b1<$count;$b1++){
        $installment_amount[$abc1]=$installment_amount[$abc1]+$row00[$fee_balance[$b1].$selected_month[$abc1]];
        }
        $dues_total=$dues_total+$installment_amount[$abc1];
        ?>
        <td><?php echo $installment_amount[$abc1]; ?></td>
        <?php } ?>
        <td><?php echo $dues_total; ?></td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Transport Amount</td>
        <?php
        $transport_total=0;
        if($head_value!='yearly_head'){
        for($abc2=0;$abc2<$sel_month_count;$abc2++){
        $transport_fee00[$abc2]=0;
        $transport_fee00[$abc2]=$transport_fee00[$abc2]+$row00['student_'.$head_value.'_balance_month'.$selected_month[$abc2]];
        $transport_total=$transport_total+$transport_fee00[$abc2];
        ?>
        <td><?php echo $transport_fee00[$abc2]; ?></td>
        <?php
        } }else{
        $transport_total=$transport_total+$row00['student_transport_fee_balance'];
        for($abc2=0;$abc2<$sel_month_count;$abc2++){
        ?>
        <td>--</td>
        <?php } } ?>
        <td><?php echo $transport_total; ?></td>
    </tr>
    <tr>
        <td>3.</td>
        <td>Previous year Amount</td>
        <?php for($abc3=0;$abc3<$sel_month_count;$abc3++){ ?>
        <td>--</td>
        <?php } ?>
        <td><?php echo $student_previous_year_fee_balance; ?></td>
    </tr>
    
    <?php if($late_fee=='Yes'){ ?>
    <tr>
        <td>4.</td>
        <td>Late Fee Amount</td>
        <?php
        $late_fee0011=0;
        for($abc1=0;$abc1<$sel_month_count;$abc1++){
        
$late_fee00=0;
if(date('Y-m-d') > $dues_last_date[$selected_month[$abc1]] && $dues_last_date[$selected_month[$abc1]]!='0000-00-00' && $late_fee=='Yes'){
if($penalty_day_monthly[$selected_month[$abc1]]=='Day'){

$current_date=date_create(date('Y-m-d'));
$dues_last_date11=date_create($dues_last_date[$selected_month[$abc1]]);
$diff=date_diff($current_date,$dues_last_date11);
$clear_difference=$diff->format("%a");

if($penalty_method[$selected_month[$abc1]]=='%'){
$late_fee00=$late_fee00+(($installment_amount[$abc1]*$clear_difference*$penalty_percent_rupees_amount[$selected_month[$abc1]])/100);
}elseif($penalty_method[$selected_month[$abc1]]=='Rs'){
$late_fee00=$late_fee00+($penalty_percent_rupees_amount[$selected_month[$abc1]]*$clear_difference);
}
}else{
if($penalty_method[$selected_month[$abc1]]=='%'){
$late_fee00=$late_fee00+(($installment_amount[$abc1]*$penalty_percent_rupees_amount[$selected_month[$abc1]])/100);
}elseif($penalty_method[$selected_month[$abc1]]=='Rs'){
$late_fee00=$late_fee00+$penalty_percent_rupees_amount[$selected_month[$abc1]];
}
}
}else{
$late_fee00=$late_fee00;
}
$late_fee0011=$late_fee0011+$late_fee00;
$grand_total=$grand_total+$late_fee00;
        
        //$late_dues_total=$late_dues_total+$installment_amount[$abc1];
        ?>
        <td><?php echo $late_fee00; ?></td>
        <?php } ?>
        <td><?php echo $late_fee0011; ?></td>
    </tr>
    <?php } ?>
    
    <tr>
        <td>&nbsp;</td>
        <td><b>Grand Total</b></td>
        <?php
        $grand_total=$grand_total+$dues_total+$transport_total+$student_previous_year_fee_balance;
        for($abc3=0;$abc3<$sel_month_count;$abc3++){
        ?>
        <td>&nbsp;</td>
        <?php } ?>
        <td><b><?php echo $grand_total; ?></b></td>
    </tr>
<!-- </table> -->
</tr>
<?php if($student_note!=''){ ?>
<tr>
<td colspan="<?php echo $sel_month_count+3; ?>"><span style="font-size:18px;font-weight:bold;">Dues Note :  </span><?php echo $student_note; ?></td>
</tr>
<?php } ?>
<tr>
<td colspan="<?php echo $sel_month_count+3; ?>"><hr/></td>
</tr>
</table>
<?php $s_count++; } } } ?>
</div>