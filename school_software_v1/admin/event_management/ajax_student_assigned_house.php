<?php include("../attachment/session.php");
?>
<table id="example1" class="table table-bordered table-striped">
	<thead class="my_background_color">
	<tr>
	<th>All<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	<th>Name</th>
	<th>Current Class</th>
	<th>Father's Name</th>
	<th>House Name</th>
	</tr>
	</thead>
	<tbody>
<?php
$student_class=$_GET['student_class'];
if($student_class!=''){  
$condition1=" and student_class='$student_class'";
}else{
$condition1="";
}
$student_class_section=$_GET['student_class_section'];
if($student_class_section!=''){
$condition2=" and student_class_section='$student_class_section'";
}else{
$condition2="";
}

$student_limit=$_GET['student_limit'];

$query1="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition1$condition2 ORDER BY student_name LIMIT $student_limit, 20";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
$s_no=$row['s_no'];
$student_name = $row['student_name'];
$student_father_name = $row['student_father_name'];
$student_class = $row['student_class'];
$student_class_section = $row['student_class_section'];
$student_roll_no = $row['student_roll_no'];
$house_name = $row['house_name'];
$serial_no++;
?>
  <tr align='center'>
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no11; ?>" name="student_index[]"></td>
	<td><?php echo $student_name; ?><input type="hidden" name="student_roll_no[]" class="" value="<?php echo $student_roll_no; ?>"></td>
	<td><?php echo $student_class.'('.$student_class_section.')'; ?></td>
	<td><?php echo $student_father_name; ?></td>
	<td>
	<select name="house_name[]" class="form-control">
	<?php if($house_name==''){ ?>
	<option value="">Select</option>
	<?php
	$query5="select * from event_house";
	$run5=mysqli_query($conn73,$query5) or die(mysqli_error($conn73));
	while($row5=mysqli_fetch_assoc($run5)){
	$house=$row5['house'];
	?>
	<option value="<?php echo $house; ?>"><?php echo $house; ?></option>
	<?php } }else{  ?>
	<option value="<?php echo $house_name; ?>"><?php echo $house_name; ?></option>
	<?php
	$query5="select * from event_house";
	$run5=mysqli_query($conn73,$query5) or die(mysqli_error($conn73));
	while($row5=mysqli_fetch_assoc($run5)){
	$house=$row5['house'];
	?>
	<option value="<?php echo $house; ?>"><?php echo $house; ?></option>
	<?php } } ?>
	</select>	
	</td>
  </tr>
	<?php  $serial_no11++; }  ?>
     </tbody>
     </table>
	 <div class="col-md-12">
		<center><input type="submit" name="finish" value="Submit" onclick="return validation();" class="btn  btn-success"/></center> 
	 </div>
	 
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })

$(function () {
$('#example1').DataTable()
})

</script>