<?php include("../attachment/session.php")?>
<?php

$from_date=$_GET['from_date'];
$to_date=$_GET['to_date'];
$query11="select * from ledger_info where date>='$from_date' and date <='$to_date' and ledger_status='Active' and amount_type='Credit' and session_value='$session1'";
$grand_total_income=0;
$res11=mysqli_query($conn73,$query11) or die(mysqli_error($conn73));
while($row11=mysqli_fetch_assoc($res11)){
$income_total_amount=$row11['total_amount'];
$grand_total_income=$income_total_amount+$grand_total_income;
}
 
$query1="select * from ledger_info where date>='$from_date' and date <='$to_date' and ledger_status='Active' and amount_type='Debit' and session_value='$session1'";
$expence_total_amount=0;
$res1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($res1)){
$total_amount=$row1['total_amount'];
$expence_total_amount=$total_amount+$expence_total_amount;
}
$grand_total=$grand_total_income-$expence_total_amount;
echo "||".$expence_total_amount."||".$grand_total."||".$grand_total_income;

?>