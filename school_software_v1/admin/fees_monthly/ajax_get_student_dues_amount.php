<?php include("../attachment/session.php")?>
<?php
$student_roll_no=$_GET['student_rollno'];

$que="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

$s_no=$row['s_no'];
$fee_type5 = $row['fee_type'];
$fee_code = $row['fee_code'];
if($fee_type5!=''){
$fee_type = preg_replace('/\s+/', '_', $fee_type5);
$fee_type1[$serial_no] = $row['fee_type'];
$fee_type=strtolower($fee_type);
//$fee[$serial_no]="student_".$fee_code."_month";
$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
//$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
//$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
$serial_no++;
}
}

$que1="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active'";
$run1=mysqli_query($conn73,$que1);
$fee_balance2='';
while($row1=mysqli_fetch_assoc($run1)){
$fee_balance2='';
for($a=1;$a<=12;$a++){
	if($a<10){
		$d='0'.$a;
	}else{
		$d=$a;
	}
	$fee_balance1=0;
for($b=0;$b<$serial_no;$b++){
	$fee_balance1 = $fee_balance1+$row1[$fee_balance[$b].$d];
}
$fee_balance2=$fee_balance2.'|?|'.$fee_balance1.'|??|'.$d;
}
}
echo $fee_balance2;
?>