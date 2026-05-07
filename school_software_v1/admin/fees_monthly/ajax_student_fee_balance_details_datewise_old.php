<?php include("../attachment/session.php"); ?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
  <th>#</th>
  <th><?php echo $language['Student Name']; ?></th>
  <th><?php echo $language['Father Name']; ?></th>
  <th><?php echo $language['Class']; ?></th>
  <th><?php echo $language['Student Section']; ?></th>
  <th><?php echo $language['Total Fee']; ?></th>
  <th><?php echo $language['Total Paid']; ?></th>
  <th><?php echo $language['Remaining Fee']; ?></th>
  <!-- <th><?php echo $language['Details']; ?></th> -->
</tr>
</thead>
<tbody>

<?php
$student_class=$_GET['student_class'];
if($student_class!='All'){
	$condition=" and student_class='$student_class'";
	$condition1=" and student_class='$student_class'";
}else{
	$condition="";
	$condition1="";
}
$student_section=$_GET['student_section'];
if($student_section!='All'){
	$condition2=" and student_class_section='$student_section'";
}else{
	$condition2="";
}
$std_date=$_GET['std_date'];
if($std_date!=''){
	$condition3=" and fee_submission_date<='$std_date'";
}else{
	$condition3="";
}

$que2="select * from student_admission_info where session_value='$session1' and student_status='Active' and registration_final='yes'$condition$condition2";
$run2=mysqli_query($conn73,$que2);
$serial_no=0;
$grand_total_total=0;
$grand_paid_total=0;
$grand_balance_total=0;
while($row2=mysqli_fetch_assoc($run2)){
$student_roll_no=$row2['student_roll_no'];
$student_name=$row2['student_name'];
$student_father_name=$row2['student_father_name'];
$student_class=$row2['student_class'];
$student_class_section=$row2['student_class_section'];

$que1="select grand_total from common_fees_student_fee where session_value='$session1' and fee_status='Active' and student_roll_no='$student_roll_no'$condition1";
$run1=mysqli_query($conn73,$que1);
if(mysqli_num_rows($run1)>0){
while($row1=mysqli_fetch_assoc($run1)){
$grand_total=$row1['grand_total'];
}

$que0="select paid_total,balance_total from common_fees_student_fee_add where session_value='$session1' and fee_status='Active' and student_roll_no='$student_roll_no'$condition1$condition3";
$run0=mysqli_query($conn73,$que0);
$paid_total1=0;
$balance_total=$grand_total;
while($row0=mysqli_fetch_assoc($run0)){
$paid_total=$row0['paid_total'];
$balance_total=$row0['balance_total'];
$paid_total1=$paid_total1+$paid_total;
}

$serial_no++;
$grand_total_total=$grand_total_total+$grand_total;
$grand_paid_total=$grand_paid_total+$paid_total1;
$grand_balance_total=$grand_balance_total+$balance_total;
?>
<tr>
  <td><?php echo $serial_no; ?></td>
  <td><?php echo $student_name; ?></td>
  <td><?php echo $student_father_name; ?></td>
  <td><?php echo $student_class; ?></td>
  <td><?php echo $student_class_section; ?></td>
  <td><?php echo $grand_total; ?></td>
  <td><?php echo $paid_total1; ?></td>
  <td><?php echo $balance_total; ?></td>
  <!-- <td><button type="button"  onclick="post_content('fees_monthly/student_fee_balance_details_particular','<?php echo 'student_roll_no='.$student_roll_no; ?>')" class="btn btn-default my_background_color" >Balance Details</button></td> -->
</tr>
<?php } } ?>
</tbody>
<tfoot>
<tr>
  <td colspan="5"><center><b>Total</b></center></td>
  <td><b><?php echo $grand_total_total; ?></b></td>
  <td><b><?php echo $grand_paid_total; ?></b></td>
  <td><b><?php echo $grand_balance_total; ?></b></td>
</tr>
</tfoot>
</table>
<script>
$(function () {
$('#example1').DataTable()
})
</script>