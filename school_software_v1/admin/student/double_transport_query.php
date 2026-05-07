<?php include('../attachment/session.php');
$sql = "select * from common_fees_student_fee where session_value='2019_20' and student_roll_no='1900042'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
  $student_name = $row['student_name'];
  $student_father_name = $row['student_father_name'];
  $student_roll_no = $row['student_roll_no'];
  $grand_total = $row['grand_total'];
  $balance_total = $row['balance_total'];
  $student_transport_fee= $row['student_transport_fee'];
  $student_transport_fee_balance = $row['student_transport_fee_balance'];
  $grand_total1= $grand_total-$student_transport_fee;
  $bal_total1= $balance_total-$student_transport_fee_balance;
$sql1="update common_fees_student_fee set grand_total='$grand_total1',balance_total='$bal_total1',student_transport_fee='',student_transport_fee_balance='' where session_value='2019_20' and student_roll_no='1900042'"; 
if(mysql_query($sql1)){
  echo $student_name;  
}
}
?>