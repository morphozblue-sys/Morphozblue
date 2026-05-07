<?php include("../attachment/session.php"); ?>
<style>
#staff_company {
    padding: 15px;
    width: 100%;
    height: 300px;
    overflow: scroll;
    border: 1px solid #ccc;
}
</style>
<div id="staff_company">
<table id="example2" class="table table-bordered table-striped">
	<thead >
		<tr>
	    <th>All<br/><input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	    <th>S No.</th>
        <th>Name</th>
        <th>Class & Section</th>
        <th>Addm No</th>
        <th>Father Name</th>
        <th>Mother Name</th>
        <th>Dob</th>
        <th>Board Reg No</th>
       </tr>
	</thead>
	<tbody>
<?php
$sports_type=$_GET['sports_type'];
$sports_name=$_GET['sports_name'];
if($sports_name!=''){
if($sports_name!='All'){
$condition1=" and sports_name='$sports_name'";
}else{
$condition1="";
}
}else{
$condition1="";
}

$gender=$_GET['gender'];
if($gender!=''){
if($gender!='All'){
$condition2=" and gender='$gender'";
}else{
$condition2="";
}
}else{
$condition2="";
}

$age_category=$_GET['age_category'];
if($age_category!=''){
if($age_category!='All'){
$condition3=" and age_category='$age_category'";
}else{
$condition3="";
}
}else{
$condition3="";
}

$query1="select * from sports_participate_table where s_no!=''$condition3$condition1$condition2 ORDER BY student_name";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
    $student_name = $row['student_name'];
	$student_class = $row['student_class'];
	$student_section = $row['student_section'];
	$gender = $row['gender'];
	$student_admission_number = $row['student_admission_number'];
	$student_scholar_number = $row['student_scholar_number'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$dateofbirth = $row['dateofbirth'];
	$student_adhar_number = $row['student_adhar_number'];
	$contact_no = $row['contact_no'];
	$sports_name = $row['sports_name'];
	$board_no = $row['board_no'];
	$age_category = $row['age_category'];
	$actual_age = $row['actual_age'];
	$session_value = $row['session_value'];
    $serial_no++;
	?>
  <tr align='center'>
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no11; ?>" name="student_index[]"></td>
    <td><?php echo $serial_no; ?></td>
	<td><input type="text" value="<?php echo $student_name; ?>" name="student_name[]" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $student_class; ?>" name="student_class[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $student_admission_number; ?>" name="student_admission_number[]" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $student_father_name; ?>" name="student_father_name[]" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $student_mother_name; ?>" name="student_mother_name[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $dateofbirth; ?>" name="dateofbirth[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $board_no; ?>" name="board_no[]" class="form-control" style="border:none;" readonly><input type="hidden" value="<?php echo $session_value; ?>" class="form-control" name="session_value[]">
	 <input type="hidden" value="<?php echo $sports_type; ?>" class="form-control" name="sports_type[]"><input type="hidden" value="<?php echo $age_category; ?>" class="form-control" name="age_category[]"></td>
  </tr>
	<?php  $serial_no11++; } ?>
</tbody>
</table>
</div>

<script>
$(function(){
$('#example2').DataTable()
})

$(function () {
$('.select2').select2()
})
</script>