<?php include("../attachment/session.php");

?>
<table id="example2" class="table table-bordered table-striped">
	<thead >
	<tr>
	<th>All<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	<th>Admission No.</th>
	<th>Name</th>
	<th>Father Name</th>
	<th>Mother Name</th>
	<th>Student Adhar No.</th>
	<th>Father Adhar No.</th>
	<th>SSSMID</th>
	<th>Family Id</th>
	<th>Child Id</th>
	<th>Bank Name Father</th>
	<th>Account No. Father</th>
	<th>Ifsc Father</th>
	<th>Bank Name Student</th>
	<th>Account No. Student</th>
	<th>Ifsc Student</th>
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
if($student_class_section!='All'){
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
	$student_mother_name = $row['student_mother_name'];
	$student_roll_no = $row['student_roll_no'];
	$student_adhar_number = $row['student_adhar_number'];
	$student_father_adhar_card_number = $row['student_father_adhar_card_number'];
	$student_sssmid_number = $row['student_sssmid_number'];
	$student_family_id = $row['student_family_id'];
	$student_child_id = $row['student_child_id'];
	$student_father_bank_name = $row['student_father_bank_name'];
	$student_father_bank_account_number = $row['student_father_bank_account_number'];
	$student_father_bank_ifsc_code = $row['student_father_bank_ifsc_code'];
	$student_bank_name = $row['student_bank_name'];
	$student_account_number = $row['student_account_number'];
	$student_bank_ifsc_code = $row['student_bank_ifsc_code'];
	$student_admission_number=$row['student_admission_number'];
	$serial_no++;
	?>
  <tr align='center'>
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no11; ?>" name="student_index[]"></td>
    <th><?php echo $student_admission_number; ?></th>
	<td><input type="text" name="student_name[]" class="" value="<?php echo $student_name; ?>"><input type="hidden" name="student_roll_no[]" class="" value="<?php echo $student_roll_no; ?>"></td>
	<td><input type="text" name="student_father_name[]" class="" value="<?php echo $student_father_name; ?>"></td>
	<td><input type="text" name="student_mother_name[]" class="" value="<?php echo $student_mother_name; ?>"></td>
	<td><input type="text" name="student_adhar_number[]" class="" value="<?php echo $student_adhar_number; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_father_adhar_card_number[]" class="" value="<?php echo $student_father_adhar_card_number; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_sssmid_number[]" class="" value="<?php echo $student_sssmid_number; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_family_id[]" class="" value="<?php echo $student_family_id; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_child_id[]" class="" value="<?php echo $student_child_id; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_father_bank_name[]" class="" value="<?php echo $student_father_bank_name; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_father_bank_account_number[]" class="" value="<?php echo $student_father_bank_account_number; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_father_bank_ifsc_code[]" class="" value="<?php echo $student_father_bank_ifsc_code; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_bank_name[]" class="" value="<?php echo $student_bank_name; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_account_number[]" class="" value="<?php echo $student_account_number; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_bank_ifsc_code[]" class="" value="<?php echo $student_bank_ifsc_code; ?>" style="width:100px;"></td>
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