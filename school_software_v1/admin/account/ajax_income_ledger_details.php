<?php include("../attachment/session.php")?>
                <div class="box-body table-responsive">
                  <table id="example4" class="table table-bordered table-striped">
                   <thead >
				    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Amount Type</th>
                        <th>Incom From</th>						
				        <th>Total Amount</th>
				        <th>Details</th>
				        
				        <th>Update By</th>
                        <th>Date</th>
				    </tr>
                    </thead>
<tbody>
<?php

$qry22="select * from school_info_general";
$rest22=mysqli_query($conn73,$qry22);
while($row22=mysqli_fetch_assoc($rest22)){
$fees_type=$row22['fees_type'];
}
if($fees_type=='installmentwise' || $fees_type=='monthly' || $fees_type=='yearly'){
$addon_var='common_';
$detail_page='fees_'.$fees_type;
}else{
$addon_var='';
$detail_page='fees';
}

$from_date=$_GET['from_date'];
$to_date=$_GET['to_date'];
 
$query1="select * from ledger_info where date>='$from_date' and date <='$to_date' and ledger_status='Active' and session_value='$session1' and amount_type='Credit' ORDER BY s_no DESC";
$serial_no=0;
$income_total_amount=0;
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$payment_mode=$row1['payment_mode'];
$date=$row1['date'];
$emp_id_or_student_roll_no=$row1['emp_id_or_student_roll_no'];
$emp_or_student_name=$row1['emp_or_student_name'];
$amount_type=$row1['amount_type'];
$credit_or_debit_from=$row1['credit_or_debit_from'];
$total_amount=$row1['total_amount'];
$income_total_amount=$total_amount+$income_total_amount;

$update_change=$row1['update_change'];
if($row1['last_updated_date']!='0000-00-00'){
$last_updated_date=date('d-m-Y',strtotime($row1['last_updated_date']));
}else{
$last_updated_date=$row1['last_updated_date'];
}

$serial_no++;
$student_date_of_admission='';
$student_registration_fee='';
$que="select * from student_admission_info where student_roll_no='$emp_id_or_student_roll_no' and session_value='$session1'";
$result=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($result)){
$student_date_of_admission=$row['student_date_of_admission'];
$student_registration_fee=$row['student_registration_fee'];
}

$que1="select s_no from ".$addon_var."fees_student_fee_add where student_roll_no='$emp_id_or_student_roll_no' and fee_status='Active' and session_value='$session1' and fee_submission_date='$date' and paid_total='$total_amount' and student_payment_mode='$payment_mode'";
$result1=mysqli_query($conn73,$que1);
while($row1=mysqli_fetch_assoc($result1)){
$s_no=$row1['s_no'];
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
<?php if($date==$student_date_of_admission && $student_registration_fee==$total_amount && $credit_or_debit_from=='fee') { ?>
<span>Registration Fee</span>
<?php } elseif($credit_or_debit_from=='fee') { ?>
<button type="button" onclick="post_content('<?php echo $detail_page; ?>/student_fee_list_particular_details','<?php echo 's_no='.$s_no; ?>')"  class="btn btn-success " >Details</button>

<?php } else { ?>

<button type="button" onclick="post_content('account/ledger_details','<?php echo 'id='.$emp_or_student_name.'&date='.$date.'&total_amount='.$total_amount.'&amount_type='.$amount_type; ?>')" class="btn btn-success " >Details</button>
<?php } ?>
</td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<script>
$(function () {
  $('#example4').DataTable()
})
</script>