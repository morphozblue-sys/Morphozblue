<?php include("../attachment/session.php"); ?>
<?php
$student_class=$_POST['student_class'];
if($student_class!='All'){
$condition=" and student_class='$student_class'";
}else{
$condition="";
}
$student_class_section=$_POST['section'];
if($student_class_section!='All'){
$condition1=" and student_class_section='$student_class_section'";
}else{
$condition1="";
}
$verify_or_not=$_POST['verify_or_not'];
if($verify_or_not!=''){
$condition2=" and verify='$verify_or_not'";
}else{
$condition2="";
}
$installment_no=$_POST['installment_no'];
if($installment_no!=''){
$condition3=" and installment_no='$installment_no'";
}else{
$condition3="";
}
include("../../con73/con37.php");
?>
<table id="example1" class="table table-bordered table-striped">
<thead >
<tr>
  <td>#</td>
  <td>Name</td>
  <td>Father Name</td>
  <td>Class</td>
  <td>Installment No</td>
  <td>Challan No</td>
  <td>Payment Mode</td>
  <td>Remark</td>
  <td>Verify / Unverify</td>
  <td>Challan Amount</td>
  <td>Action</td>
  <td>Details</td>
  <td>Print</td>
</tr>
</thead>
<tbody>
<?php
$quer11111="select * from student_hostel_fees_paid where session_value='$session1'$condition2$condition3";
$rest11111=mysqli_query($conn73,$quer11111)or die(mysqli_error($conn73));
$serial_no=0;
while($row11111=mysqli_fetch_assoc($rest11111)){

$student_roll_no=$row11111['student_roll_no'];
$installment_no=$row11111['installment_no'];
$challan_no=$row11111['challan_no'];
$payment_mode=$row11111['payment_mode'];
$remark=$row11111['remark'];
$verify=$row11111['verify'];
$penalty_amount=$row11111['penalty_amount'];
if($verify=='Yes'){
$verify_unverify='Verified';
}else{
$verify_unverify='Unverified';
}
$total_paid_amount=$row11111['total_amount'];

$que123="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'$condition$condition1";
$res123=mysqli_query($conn73,$que123) or die(mysqli_error($conn73));
while($row123=mysqli_fetch_assoc($res123)){
$student_name=$row123['student_name'];
$student_father_name=$row123['student_father_name'];
$student_class=$row123['student_class'];
$student_class_section=$row123['student_class_section'];
$serial_no++;
?>
<tr>
  <td><?php echo $serial_no; ?></td>
  <td><?php echo $student_name; ?></td>
  <td><?php echo $student_father_name; ?></td>
  <td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
  <td><?php echo $installment_no; ?></td>
  <td><?php echo $challan_no; ?></td>
  <td><?php echo $payment_mode; ?></td>
  <td><?php echo $remark; ?></td>
  <td><?php echo $verify_unverify; ?></td>
  <td><?php echo $total_paid_amount; ?></td>
  <td><a href="student_hostel_fee_challan_delete.php?challan_no=<?php echo $challan_no; ?>" onclick="return validation();" ><button type="button" class="btn btn-danger" <?php if($verify=='Yes'){ echo 'disabled'; } ?> >Delete</button></a></td>
  <td><a href="student_hostel_fee_challan_details.php?challan_no=<?php echo $challan_no; ?>"><button type="button" class="btn btn-info" >Details/Verify</button></a></td>
  <td><a href="../pdf/challan_hostel_fee.php?challan_no=<?php echo $challan_no; ?>&installment_no=<?php echo $installment_no; ?>&verify=<?php echo $verify; ?>"><button type="button" class="btn btn-success" >Print</button></a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
<script>
  $(function () {
    $('#example1').DataTable()
  
  });
</script>