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
$category_code=$_POST['category_code'];
if($category_code!='All'){
$condition_2=" and student_fee_category_code='$category_code'";
}else{
$condition_2="";
}
$from_date=$_POST['from_date'];
if($from_date!=''){
$condition2=" and create_date>='$from_date'";
}else{
$condition2="";
}
$to_date=$_POST['to_date'];
if($to_date!=''){
$condition3=" and create_date<='$to_date'";
}else{
$condition3="";
}
$installment_no=$_POST['installment_no'];
if($installment_no!=''){
$condition4=" and installment_no='$installment_no'";
$condition5=" and add_in_installment='$installment_no'";
}else{
$condition4="";
$condition5="";
}
include("../../con73/con37.php");
?>
<table id="" class="table table-bordered table-striped">
<thead >
<tr>
  <td>#</td>
  <td>Name</td>
  <td>Father Name</td>
  <td>Class</td>
  <td>Regular Amount</td>
  <td>Expense Amount</td>
  <td><input type="checkbox" name="" id="all_expense" class="" onclick="for_check1(this.id)" checked /> All</td>
  <td>Installment Amount</td>
</tr>
</thead>
<tbody>
<?php
if($installment_no=='installment1'){
$start_month=4;
$end_month=6;
}elseif($installment_no=='installment2'){
$start_month=7;
$end_month=9;
}elseif($installment_no=='installment3'){
$start_month=10;
$end_month=12;
}elseif($installment_no=='installment4'){
$start_month=1;
$end_month=3;
}

$que122="select * from school_info_hostel_head where fee_head_name!=''";
$res122=mysqli_query($conn73,$que122) or die(mysqli_error($conn73));
$fee_head_name='';
$fee_head_code='';
$fee1_sno=0;
while($row122=mysqli_fetch_assoc($res122)){
$fee_head_name[$fee1_sno]=$row122['fee_head_name'];
$fee_head_code[$fee1_sno]=$row122['fee_head_code'];
$fee1_sno++;
}

$que123="select * from student_admission_info where student_status='Active' and registration_final='yes' and student_hostel='Yes' and session_value='$session1'$condition$condition1$condition_2";
$res123=mysqli_query($conn73,$que123) or die(mysqli_error($conn73));
$serial_no=0;
while($row123=mysqli_fetch_assoc($res123)){
$student_name=$row123['student_name'];
$student_roll_no=$row123['student_roll_no'];
$student_father_name=$row123['student_father_name'];
$student_class=$row123['student_class'];
$student_class_section=$row123['student_class_section'];
$student_fee_category_code=$row123['student_fee_category_code'];
$serial_no++;

$que0122="select * from student_hostel_fees_discount where student_roll_no='$student_roll_no' and session_value='$session1'";
$res0122=mysqli_query($conn73,$que0122) or die(mysqli_error($conn73));
$fee_discount_amount='';
if(mysqli_num_rows($res0122)>0){
while($row0122=mysqli_fetch_assoc($res0122)){
for($au=0;$au<$fee1_sno;$au++){
$fee_discount_amount[$au]=$row0122[$fee_head_code[$au]."_discount_amount"];
}
}
}else{
for($au=0;$au<$fee1_sno;$au++){
$fee_discount_amount[$au]=0;
}
}

$que124="select * from expense_monthly where student_roll_no='$student_roll_no' and add_in_challan='No'$condition2$condition3";
$res124=mysqli_query($conn73,$que124) or die(mysqli_error($conn73));
$expense_total_amount=0;
while($row124=mysqli_fetch_assoc($res124)){
$total_amount=$row124['total_amount'];
$expense_total_amount=$expense_total_amount+$total_amount;
}

$que125="select * from student_hostel_fees_structure_monthly where class_name='$student_class' and category_code='$student_fee_category_code'";
$res125=mysqli_query($conn73,$que125) or die(mysqli_error($conn73));
$total_regular_fee=0;
while($row125=mysqli_fetch_assoc($res125)){
for($i=$start_month;$i<=$end_month;$i++){
for($j=0;$j<$fee1_sno;$j++){
$regular_fee=$row125[$fee_head_code[$j].'_month'.$i];
$total_regular_fee=$total_regular_fee+(($regular_fee)-($regular_fee*$fee_discount_amount[$j])/100);
}
}
}

$que126="select * from expense_monthly where student_roll_no='$student_roll_no' and add_in_challan='Yes'$condition5";
$res126=mysqli_query($conn73,$que126) or die(mysqli_error($conn73));
$expense_total_amount11=0;
while($row126=mysqli_fetch_assoc($res126)){
$total_amount11=$row126['total_amount'];
$expense_total_amount11=$expense_total_amount11+$total_amount11;
}
?>
<tr>
  <td><?php echo $serial_no; ?></td>
  <td><?php echo $student_name; ?></td>
  <td><?php echo $student_father_name; ?></td>
  <td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
  <td><?php echo $total_regular_fee; ?></td>
  <td><?php echo $expense_total_amount; ?></td>
  <td><input type="checkbox" name="student_roll_no[]" id="" value="<?php echo $student_roll_no; ?>" class="all_expense" checked /></td>
  <td><b><?php echo $total_regular_fee+$expense_total_amount+$expense_total_amount11; ?></b></td>
</tr>
<?php
}
?>
</tbody>
</table>
<script>
  $(function () {
    $('#example1').DataTable()
  
  });
</script>