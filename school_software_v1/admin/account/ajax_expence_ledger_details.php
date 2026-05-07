<?php include("../attachment/session.php")?>         
		 <div class="box-body table-responsive" id="my_table2">
                  <table id="example7" class="table table-bordered table-striped">
                   <thead >
				    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Amount Type</th>
                        <th>Expence For</th>							
				        <th>Total Amount</th>
				        <th>Details</th>
				        
				        <th>Update By</th>
                        <th>Date</th>
				    </tr>
                    </thead>
                <tbody>

<?php
 $from_date=$_GET['from_date'];
 $to_date=$_GET['to_date'];
 
$query1="select * from ledger_info where date>='$from_date' and date <='$to_date' and ledger_status='Active' and session_value='$session1' and amount_type='Debit' ORDER BY s_no DESC";
$serial_no=0;
$expence_total_amount=0;
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$date=$row1['date'];
$credit_or_debit_from=$row1['credit_or_debit_from'];
$emp_id_or_student_roll_no=$row1['emp_id_or_student_roll_no'];
$emp_or_student_name=$row1['emp_or_student_name'];
$amount_type=$row1['amount_type'];
$total_amount=$row1['total_amount'];
$expence_total_amount=$total_amount+$expence_total_amount;

$update_change=$row1['update_change'];
if($row1['last_updated_date']!='0000-00-00'){
$last_updated_date=date('d-m-Y',strtotime($row1['last_updated_date']));
}else{
$last_updated_date=$row1['last_updated_date'];
}

$serial_no++;
?>


<tr>         
<td><?php echo $serial_no; ?></td>
<td><?php echo $date; ?></td>
<td><?php echo $emp_or_student_name; ?></td>
<td><?php echo $amount_type; ?></td>
<td><?php echo $credit_or_debit_from; ?></td>
<td><?php echo $total_amount; ?></td>
<td>			
<?php if($credit_or_debit_from=='salary') { ?>
<button type="button" onclick="post_content('account/ledger_salary_details','<?php echo 'id='.$emp_id_or_student_roll_no.'&date='.$date.'&total_amount='.$total_amount; ?>')"  class="btn btn-success" >Details</button>
<?php } else { ?>

<button type="button" onclick="post_content('account/ledger_details','<?php echo 'id='.$emp_or_student_name.'&date='.$date.'&total_amount='.$total_amount.'&amount_type='.$amount_type; ?>')" class="btn btn-success" >Details</button>
<?php } ?>
</td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>
</tr>	
<?php } 
?>
 </tbody>
 </table>
 <script>
  $(function () {
    $('#example7').DataTable()

  })
</script>