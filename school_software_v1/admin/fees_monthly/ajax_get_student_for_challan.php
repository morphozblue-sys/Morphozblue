<?php include("../attachment/session.php"); ?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
<th><input type="checkbox" id="info" value="" checked onclick="for_check(this.id,'No');" /> All</th>
<th>S No</th>
<th>Admission No.</th>
<th>Name</th>
<th>Father Name</th>
<th>Class (Sec)</th>
</tr>
</thead>
<tbody>
<?php
$class_name=$_POST['class_name'];
if($class_name!='All'){
	$condition=" and student_class='$class_name'";
}else{
	$condition="";
}
$section_name=$_POST['section_name'];
if($section_name!='All'){
	$condition1=" and student_class_section='$section_name'";
}else{
	$condition1="";
}
$month_arr=$_POST['month_arr'];
$no_of_count=$_POST['no_of_count'];
// $month_val='';
// $seprator="";
// for($i=0;$i<$no_of_count;$i++){
//     if($i!=0){
//     $seprator="|?|";
//     }
//     $month_val=$month_val.$seprator.$month_arr[$i]; 
// }
$admission_scheme=$_POST['admission_scheme'];
if($admission_scheme!='All'){
	$condition11=" and student_admission_scheme='$admission_scheme'";
}else{
	$condition11="";
}

$que="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition$condition1$condition11$filter37";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
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
if(mysqli_num_rows($run1)>0){
$serl++;
?>
<tr>
<td><input type="checkbox" name="student_info[]" class="info" value="<?php echo $student_roll_no; ?>" checked /></td>
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
<tfoot>
    <tr>
    <td colspan="6">
    <!--<input type="hidden" name="total_month_count" value="<?php echo $no_of_count; ?>" class="form-control" />
    <input type="hidden" name="total_month_arr" value="<?php echo $month_val; ?>" class="form-control" />-->
    <center><input type="submit" name="" value="Print Challan" class="btn my_background_color" onclick="return check_valid();" /></center>
    </td>
    </tr>
</tfoot>
</table>