<?php 
include("../attachment/session.php");

$count=1;
$query0 = "select student_roll_no from student_admission_info where session_value='2020_21' and student_status='Active'";
$run0=mysqli_query($conn73,$query0) or die(mysqli_error($conn73));
$ser_nom=1;
while($row0 = mysqli_fetch_assoc($run0)){
$student_roll_no=$row0['student_roll_no'];

echo $query = "select * from common_fees_student_fee where session_value='2020_21' and fee_status='Active' and student_roll_no='$student_roll_no'";
$run1=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
while($row1 = mysqli_fetch_assoc($run1)){
    $s_no = $row1['s_no'];
    $student_roll_no = $row1['student_roll_no'];
	$student_name    = $row1['student_name'];
    $grand_total     = $row1['grand_total'];
    $balance_total   = $row1['balance_total'];
    $paid_total = $row1['paid_total'];
    $student_fee6_total_amount_after_discount_month12 = $row1['student_fee6_total_amount_after_discount_month12'];
	$student_fee6_balance_month12 = $row1['student_fee6_balance_month12'];
	$student_fee6_paid_total_month12 = $row1['student_fee6_paid_total_month12'];
	
	$grand_total1=$grand_total-$student_fee6_total_amount_after_discount_month12;	
	$balance_total1=$balance_total-$student_fee6_total_amount_after_discount_month12; 
    //$paid_total1 = $paid_total - $student_transport_fee_paid_total;
	
echo $query1 = "update common_fees_student_fee set grand_total='$grand_total1',balance_total='$balance_total1',student_fee6_total_amount_after_discount_month12='0',student_fee6_balance_month12='0' where session_value='2020_21' and s_no='$s_no' and fee_status='Active'";
 mysqli_query($conn73,$query1);
/*
$query2 = "select * from common_fees_student_fee_add where session_value='2020_21' and fee_status='Active' and student_roll_no='$student_roll_no'";
$run2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
while($row2 = mysqli_fetch_assoc($run2)){
    $s_no22 = $row2['s_no'];
    $grand_total22     = $row2['grand_total'];
    $balance_total22   = $row2['balance_total'];
    $paid_total22 = $row2['paid_total'];

$grand_total33=$grand_total22-$student_fee6_total_amount_after_discount_month12;	
$balance_total33=$balance_total22-$student_fee6_total_amount_after_discount_month12; 

$query3 = "update common_fees_student_fee_add set grand_total='$grand_total33',balance_total='$balance_total33',student_fee6_total_amount_after_discount_month12='',student_fee6_balance_month12='' where session_value='2020_21' and s_no='$s_no22' and fee_status='Active'";
mysqli_query($conn73,$query3);
*/
}
}

// if(mysqli_query($conn73,$query1)){
//   echo $count." success fully change name ".$student_name.'  Roll No '.$student_roll_no.'<br><br>';  
//   $count++;
//   $grand_total1 = '';
//   $balance_total1 ='';    
//   $paid_total1  = '';
// }
//echo $ser_nom.'/'.$student_roll_no.'<br/>';
//$ser_nom++;
//}
?>