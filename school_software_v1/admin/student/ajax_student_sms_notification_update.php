<?php include("../attachment/session.php"); ?>
<table id="example2" class="table table-bordered table-striped">
	<thead >
	<tr>
	<th>All<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	<th>Admission No.</th>
	<th>Name</th>
	<th>Current Class</th>
	<th>Father Name</th>
	<th>Father Contact</th>
	<th>Web SMS</th>
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

$query1="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition1$condition2 ORDER BY student_name";
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
	$student_father_contact_number = $row['student_father_contact_number'];
	//$student_sms_contact_number = $row['student_sms_contact_number'];
	$student_web_sms = $row['student_web_sms'];
	$student_admission_number=$row['student_admission_number'];
    $serial_no++;
	?>
  <tr>
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no11; ?>" name="student_index[]"></td>
    <th><?php echo $student_admission_number; ?></th>
	<td><input type="text" name="" class="" value="<?php echo $student_name; ?>" title="<?php echo $student_name; ?>" style="background-color:#E6E6E6;" readonly><input type="hidden" name="student_roll_no[]" class="" value="<?php echo $student_roll_no; ?>"></td>
	<td><input type="text" name="" class="" value="<?php echo $student_class.'('.$student_class_section.')'; ?>" title="<?php echo $student_name; ?>" style="background-color:#E6E6E6;" readonly /></td>
	<td><input type="text" name="" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_father_name; ?>" style="background-color:#E6E6E6;" readonly></td>
	<td><input type="text" name="" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_father_contact_number; ?>" style="background-color:#E6E6E6;" readonly></td>
	<td>
	<select name="student_web_sms[]" class="" title="<?php echo $student_name; ?>">
	<option <?php if($student_web_sms=='Yes'){ echo 'selected'; } ?> value="Yes">Yes</option>
	<option <?php if($student_web_sms=='No'){ echo 'selected'; } ?> value="No">No</option>
	<select>
	</td>
  </tr>
	<?php  $serial_no11++; } ?>
     </tbody>
     </table>
	 <div class="col-md-12">
		<center><input type="submit" name="finish" value="Submit" onclick="return validation();" class="btn btn-success"/></center> 
	 </div>
	 
<script>
  $(function () {
    $('#example2').DataTable()
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
 })

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>