<?php 
include("../attachment/session.php");
$count=1;
$query = "select * from common_fees_student_fee_add where session_value='2019_20' and fee_status='Active'";
$run1=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
while($row1 = mysqli_fetch_assoc($run1)){
    $s_no = $row1['s_no'];
    $student_roll_no = $row1['student_roll_no'];
	$student_name    = $row1['student_name'];
    $grand_total     = $row1['grand_total'];
    $balance_total   = $row1['balance_total'];
    $paid_total = $row1['paid_total'];
    $student_transport_fee = $row1['student_transport_fee'];
	$student_transport_fee_balance = $row1['student_transport_fee_balance'];
	$student_transport_fee_paid_total = $row1['student_transport_fee_paid_total'];
	
	$grand_total1=$grand_total-$student_transport_fee;	
	$balance_total1=$balance_total-$student_transport_fee_balance; 
    $paid_total1 = $paid_total - $student_transport_fee_paid_total;
	
$query1 = "update common_fees_student_fee_add set grand_total='$grand_total1',balance_total='$balance_total1',student_transport_fee='',student_transport_fee_balance='',student_transport_fee_paid_total='' where session_value='2019_20' and s_no='$s_no' and fee_status='Active'";	
if(mysqli_query($conn73,$query1)){
   echo $count." success fully change name ".$student_name.'  Roll No '.$student_roll_no.'<br><br>';  
   $count++;
   $grand_total1 = '';
   $balance_total1 ='';    
   $paid_total1  = '';
} 
}
?>