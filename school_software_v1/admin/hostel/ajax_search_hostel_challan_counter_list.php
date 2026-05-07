<?php
include("../attachment/session.php");
error_reporting(E_ALL & ~E_NOTICE);
include("../../con73/con37.php");
$from_date=$_GET['from_date'];
$to_date=$_GET['to_date'];
if($from_date!='' && $to_date!=''){
$condition1=" and date>='$from_date' and date<='$to_date'";
}elseif($from_date!='' || $to_date!=''){
if($from_date!=''){
$condition1=" and date>='$from_date'";
}elseif($to_date!=''){
$condition1=" and date<='$to_date'";
}
}else{
$condition1="";
}

?>
				<table id="example2" class="table table-bordered table-striped">
				<thead >
				<tr>
				  <td>#</td>
				  <td>Date</td>
				  <td>Invoice No</td>
				  <td>admission No</td>
				  <td>Student Name</td>
				  <td>Challan No</td>
				  <td>Payment Mode</td>
				  <td>full / Partial</td>
				  <td>Total Amount</td>
				  <td>Paid Amount</td>
				  <td>Balance</td>
				  <td>Remark</td>
				  <td>Action</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$query="select * from student_hostel_fees_counter where session_value='$session1'$condition1 ORDER BY date";
				$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($res)){
				$s_no=$row['s_no'];
				$student_roll_no=$row['student_roll_no'];
				$challan_no=$row['challan_no'];
				$installment_no=$row['installment_no'];
				$payment_mode=$row['payment_mode'];
				$challan_full_partial=$row['challan_full_partial'];
				$challan_amount=$row['challan_amount'];
				$challan_paid_amount=$row['challan_paid_amount'];
				$challan_balance=$row['challan_balance'];
				$challan_remark=$row['challan_remark'];
				$date=$row['date'];
				$date1=explode('-',$date);
				$date=$date1[2].'-'.$date1[1].'-'.$date1[0];
				$serial_no++;
				
				$query2="select * from student_admission_info where session_value='$session1' and student_roll_no='$student_roll_no'";
				$res2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
				while($row2=mysqli_fetch_assoc($res2)){
				$student_name=$row2['student_name'];
				$student_admission_number=$row2['student_admission_number'];
				}
				
				$query1="select * from student_hostel_fees_paid where challan_no='$challan_no' and session_value='$session1'";
				$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
				while($row1=mysqli_fetch_assoc($res1)){
				$verify=$row1['verify'];
				}
				?>
				<tr>
				<td><?php echo $serial_no.'.'; ?></td>
				<td><?php echo $date; ?></td>
				<td><?php echo $s_no; ?></td>
				<td><?php echo $student_admission_number; ?></td>
				<td><?php echo $student_name; ?></td>
				<td><?php echo $challan_no; ?></td>
				<td><?php echo $payment_mode; ?></td>
				<td><?php echo $challan_full_partial; ?></td>
				<td><?php echo $challan_amount; ?></td>
				<td><?php echo $challan_paid_amount; ?></td>
				<td><?php echo $challan_balance; ?></td>
				<td><?php echo $challan_remark; ?></td>
				<td><a href="student_hostel_fee_counter_edit.php?challan_no=<?php echo $challan_no; ?>"><button type="button" class="btn btn-info" <?php if($verify=='Yes'){ echo 'disabled'; } ?> >Edit</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="student_hostel_fee_counter_delete.php?s_no=<?php echo $s_no; ?>" onclick="return validation();"><button type="button" class="btn btn-danger" <?php if($verify=='Yes'){ echo 'disabled'; } ?> >Delete</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../pdf/hostel_invoice.php?challan_no=<?php echo $challan_no; ?>"><button type="button" class="btn btn-success">Print</button><a></td>
				</tr>
				<?php
				}
				?>
				</tbody>
				</table>
<script>
  $(function () {
    $('#example2').DataTable()
  
  });
</script>