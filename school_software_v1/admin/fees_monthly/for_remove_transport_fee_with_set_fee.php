<?php include("../attachment/session.php"); ?>
<?php
$qry="select student_name,student_father_name,student_class,student_roll_no from student_admission_info where student_status='Active' and student_bus='Yes' and session_value='$session1'";
$rest=mysqli_query($conn73,$qry);
while($row22=mysqli_fetch_assoc($rest)){
$student_name=$row22['student_name'];
$student_father_name=$row22['student_father_name'];
$student_class=$row22['student_class'];
$student_roll_no3=$row22['student_roll_no'];

$qry1="select * from common_fees_student_fee where fee_status='Active' and student_roll_no='$student_roll_no3' and session_value='$session1'";
$rest1=mysqli_query($conn73,$qry1);
while($row221=mysqli_fetch_assoc($rest1)){
$s_no1=$row221['s_no'];
$grand_total=$row221['grand_total'];
$balance_total=$row221['balance_total'];
$paid_total=$row221['paid_total'];

$student_fee6_month09=$row221['student_fee6_month09'];
$student_fee6_total_amount_after_discount_month09=$row221['student_fee6_total_amount_after_discount_month09'];
$student_fee6_balance_month09=$row221['student_fee6_balance_month09'];

$grand_total00=$grand_total-$student_fee6_total_amount_after_discount_month09;
$balance_total00=$balance_total-$student_fee6_total_amount_after_discount_month09;

$qry01="update common_fees_student_fee set student_fee6_month09='0', student_fee6_total_amount_after_discount_month09='0', student_fee6_balance_month09='0', grand_total='$grand_total00', balance_total='$balance_total00' where fee_status='Active' and student_roll_no='$student_roll_no3' and session_value='$session1' and s_no='$s_no1'";
mysqli_query($conn73,$qry01);

$qry2="select * from common_fees_student_fee_add where fee_status='Active' and student_roll_no='$student_roll_no3' and session_value='$session1'";
$rest2=mysqli_query($conn73,$qry2);
while($row222=mysqli_fetch_assoc($rest2)){
$s_no=$row222['s_no'];
$fee_submission_date=$row222['fee_submission_date'];
$grand_total1=$row222['grand_total'];
$balance_total1=$row222['balance_total'];
$paid_total1=$row222['paid_total'];
// if($fee_submission_date=='2020-07-01'){
// echo $student_name.'-'.$student_father_name.'-'.$student_class.'-'.$grand_total1.'/'.$balance_total1.'/'.$paid_total1.'<br/>';
// }

$grand_total22=$grand_total1-$student_fee6_total_amount_after_discount_month09;
$balance_total22=$balance_total1-$student_fee6_total_amount_after_discount_month09;

$qry02="update common_fees_student_fee_add set grand_total='$grand_total22', balance_total='$balance_total22' where fee_status='Active' and student_roll_no='$student_roll_no3' and session_value='$session1' and s_no='$s_no'";
mysqli_query($conn73,$qry02);

}

}

}
?>