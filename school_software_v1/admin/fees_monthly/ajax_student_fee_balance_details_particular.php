<?php include("../attachment/session.php"); ?>
<?php
$student_roll_no=$_POST['student_roll_no'];
$month_code=$_POST['month_code'];
$month_name=$_POST['month_name'];
$month_count=count($month_name);

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
?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
  <th>#</th>
  <th><?php echo $language['Student Name']; ?></th>
  <?php for($i=0;$i<$month_count;$i++){ ?>
  <th><?php echo $month_name[$i].' Balance'; ?></th>
  <?php } ?>
  <th>Transport Balance</th>
  <th>Total Balance</th>
  <th>Action</th>
</tr>
</thead>
<tbody>
<?php
$que1="select * from common_fees_student_fee where session_value='$session1' and fee_status='Active' and student_roll_no='$student_roll_no'";
$run1=mysqli_query($conn73,$que1);
$serial_no1=0;
while($row1=mysqli_fetch_assoc($run1)){
$student_name=$row1['student_name'];
$student_roll_no=$row1['student_roll_no'];
$paid_total=$row1['paid_total'];
$balance_total=$row1['balance_total'];
$grand_total=$row1['grand_total'];
$student_transport_fee_balance=$row1['student_transport_fee_balance'];

$serial_no1++;
?>
<tr>
  <td><?php echo $serial_no1.'.'; ?></td>
  <td><?php echo $student_name; ?></td>
  <?php
  $total_balance=0;
  for($j=0;$j<$month_count;$j++){
  $monthly_balance[$j]=0;
  for($k=0;$k<$serial_no;$k++){
	  $monthly_balance[$j]=$monthly_balance[$j]+$row1[$fee_balance[$k].$month_code[$j]];
	  $total_balance=$total_balance+$row1[$fee_balance[$k].$month_code[$j]];
  }
  ?>
  <td><?php echo $monthly_balance[$j]; ?></td>
  <?php } $total_balance=$total_balance+$student_transport_fee_balance; ?>
  <td><?php echo $student_transport_fee_balance; ?></td>
  <td><?php echo $total_balance; ?></td>
  <td><button type="button" name="" id="" class="btn btn-default my_background_color" onclick="for_pay();">Pay Fee</button></td>
</tr>
<?php } ?>
</tbody>
</table>