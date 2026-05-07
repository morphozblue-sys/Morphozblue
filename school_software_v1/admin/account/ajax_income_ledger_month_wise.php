<?php include("../attachment/session.php")?>
                <div class="box-body table-responsive">
                  <table id="example5" class="table table-bordered table-striped">
                   <thead >
				    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Amount Type</th>
                        <th>Incom From</th>						
				        <th>Total Amount</th>
				        <th>Details</th>
				    </tr>
                    </thead>
                    <tbody >
<?php

$current_month=$_GET['current_month'];
$to_month=$current_month+1;
$current_year=date('Y');
$from_date=$current_year.'-'.$current_month.'-01';
$to_date=$current_year.'-'.$to_month.'-01';
 
$query1="select * from ledger_info where date>='$from_date' AND date <='$to_date' AND ledger_status='Active' and amount_type='Credit' ORDER BY s_no DESC";
$serial_no=0;
$expence_total_amount=0;
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$date=$row1['date'];
$emp_id_or_student_roll_no=$row1['emp_id_or_student_roll_no'];
$credit_or_debit_from=$row1['credit_or_debit_from'];
$emp_or_student_name=$row1['emp_or_student_name'];
$amount_type=$row1['amount_type'];
$total_amount=$row1['total_amount'];
$expence_total_amount=$total_amount+$expence_total_amount;

$serial_no++;

$que="select * from student_admission_info where student_roll_no='$emp_id_or_student_roll_no' and session_value='$session1'";
$result=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($result)){
$student_date_of_admission=$row['student_date_of_admission'];
}
?>


<tr>         
<td><?php echo $serial_no; ?></td>
<td><?php echo $date; ?></td>
<td><?php echo $emp_or_student_name; ?></td>
<td><?php echo $amount_type; ?></td>
<td><?php echo $credit_or_debit_from; ?></td>
<td><?php echo $total_amount; ?></td>			
<td>
<?php if($date=='$student_date_of_admission' and $credit_or_debit_from=='fee') { ?>
<button type="button" class="btn btn-success " >abc</button>
<?php } elseif($credit_or_debit_from=='fee' and $date!='$student_date_of_admission') { ?>
<button type="button" onclick="post_content('account/ledger_student_fee_list','<?php echo 'id='.$emp_id_or_student_roll_no.'&date='.$date.'&total_amount='.$total_amount; ?>')"  class="btn btn-success" >Details</button>
<?php } else { ?>

<button type="button" onclick="post_content('account/ledger_details','<?php echo 'id='.$emp_or_student_name.'&date='.$date.'&total_amount='.$total_amount.'&amount_type='.$amount_type; ?>')" class="btn btn-success " >Details</button>
</td>
</tr>	
<?php } }

?>
 </tbody>
 </table>
 <script>
  $(function () {
    $('#example5').DataTable()

  })
</script>