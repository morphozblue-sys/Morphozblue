<?php include("../attachment/session.php"); ?>
<h4 style="color:#d9534f;">Student Details:</h4>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
<th><input type="checkbox" id="info" value="" checked onclick="for_check(this.id);" /> All</th>
<th>S No</th>
<th>Admission No.</th>
<th>Name</th>
<th>Father Name</th>
<th>Class (Sec)</th>
</tr>
</thead>
<tbody>
<?php
$class_name=$_GET['class_name'];
if($class_name!=''){
	$condition=" and student_class='$class_name'";
}else{
	$condition="";
}
$section_name=$_GET['section_name'];
if($section_name!='All'){
	$condition1=" and student_class_section='$section_name'";
}else{
	$condition1="";
}
$student_transport=$_GET['student_transport'];
if($student_transport!='All'){
	$condition2=" and student_bus='$student_transport'";
}else{
	$condition2="";
}

$student_old_new=$_GET['student_old_new'];
if($student_old_new!='All'){
	$condition02=" and stuent_old_or_new='$student_old_new'";
}else{
	$condition02="";
}

$student_admission_scheme=$_GET['student_admission_scheme'];
if($student_admission_scheme!='All'){
	$condition03=" and student_admission_scheme='$student_admission_scheme'";
}else{
	$condition03="";
}

$bus_fee_category_code=$_GET['bus_fee_category_code'];
if($bus_fee_category_code!='All'){
	$condition04=" and student_bus_fee_category_code='$bus_fee_category_code'";
}else{
	$condition04="";
}

$student_fee_category_code=$_GET['student_fee_category_code'];
if($student_fee_category_code!=''){
	$condition05=" and student_fee_category_code='$student_fee_category_code'";
}else{
	$condition05="";
}
$student_class_stream=$_GET['student_class_stream'];
if($student_class_stream!='All'){
	$condition06=" and student_class_stream='$student_class_stream'";
}else{
	$condition06="";
}

//$student_transport=$_GET['student_transport'];
$que="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition$condition1$condition2$condition02$condition03$condition04$condition05$condition06$filter37";
$run=mysqli_query($conn73,$que);
$serl=0;
while($row=mysqli_fetch_assoc($run)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_class=$row['student_class'];
$student_class_section=$row['student_class_section'];
$student_roll_no=$row['student_roll_no'];
$stuent_old_or_new=$row['stuent_old_or_new'];
$student_bus=$row['student_bus'];
$student_bus_fee_category_code=$row['student_bus_fee_category_code'];
$student_admission_number=$row['student_admission_number'];

$que1="select student_roll_no from common_fees_student_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)<1){
$serl++;
?>
<tr>
<td><input type="checkbox" name="student_info[]" class="info" value="<?php echo $student_roll_no.'|?|'.$student_name.'|?|'.$student_class; ?>" checked /></td>
<td><?php echo $serl; ?></td>
<td><?php echo $student_admission_number; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $student_father_name; ?></td>
<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
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
})

</script>
  