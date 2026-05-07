<?php include("../attachment/session.php"); ?>
<?php
$select_month=$_POST['select_month'];
$select_count=$_POST['select_count'];
$selected_student=$_POST['selected_student'];
$selected_date=$_POST['value'];

$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
$run01=mysqli_query($conn73,$que01) or die(mysqli_error($conn73));
$sno=0;
while($row01=mysqli_fetch_assoc($run01)){
$fees_code[$sno] = $row01['fees_code'];
$penalty_day_monthly[$fees_code[$sno]] = $row01['penalty_day_monthly'];
$dues_last_date[$fees_code[$sno]] = $row01['dues_last_date'];
$penalty_percent_rupees_amount[$fees_code[$sno]] = $row01['penalty_percent_rupees_amount'];
$penalty_method[$fees_code[$sno]] = $row01['penalty_method'];

$sno++;
}

$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
$s_no=$row['s_no'];
$fee_type5 = $row['fee_type'];
$fee_code = $row['fee_code'];
if($fee_type5!=''){
$fee_balance[$serial_no]="student_".$fee_code."_balance_month";

$serial_no++;
}
}

$que11="select * from common_fees_student_fee where student_roll_no='$selected_student' and session_value='$session1' and fee_status='Active'";
$run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
$calculate_penalty='';
while($row11=mysqli_fetch_assoc($run11)){
for($g=0;$g<$select_count;$g++){
$show_balance_fee=0;
for($i=0;$i<$serial_no;$i++){ 

$fee_balance1[$i] = $row11[$fee_balance[$i].$select_month[$g]];
if($fee_balance1[$i]==''){
$fee_balance1[$i]=0;
}

$show_balance_fee=$show_balance_fee+$fee_balance1[$i];
}
if($selected_date > $dues_last_date[$select_month[$g]] && $dues_last_date[$select_month[$g]]!='0000-00-00'){
if($penalty_day_monthly[$select_month[$g]]=='Day'){

$current_date=date_create($selected_date);
$dues_last_date11=date_create($dues_last_date[$select_month[$g]]);
$diff=date_diff($current_date,$dues_last_date11);
$clear_difference=$diff->format("%a");

if($penalty_method[$select_month[$g]]=='%'){
$calculate_penalty=$calculate_penalty+(($show_balance_fee*$clear_difference*$penalty_percent_rupees_amount[$select_month[$g]])/100);
}elseif($penalty_method[$select_month[$g]]=='Rs'){
$calculate_penalty=$calculate_penalty+($penalty_percent_rupees_amount[$select_month[$g]]*$clear_difference);
}
}else{
if($penalty_method[$select_month[$g]]=='%'){
$calculate_penalty=$calculate_penalty+(($show_balance_fee*$penalty_percent_rupees_amount[$select_month[$g]])/100);
}elseif($penalty_method[$select_month[$g]]=='Rs'){
$calculate_penalty=$calculate_penalty+$penalty_percent_rupees_amount[$select_month[$g]];
}
}
}else{
$calculate_penalty=$calculate_penalty;
}
}
}
echo '|?|'.$calculate_penalty.'|?|';
?>