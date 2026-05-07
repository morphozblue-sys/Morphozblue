<?php
$company_123=$_GET['company_123'];
$roll_no=$_GET['student_roll'];
include("../attachment/session.php");
?>
<div class="form-group">
	<label>Student Name<font size="2" style="font-weight: normal;">
		(Search by Name)</font><span style="color:red;">*</span></label>
	<select name="" style="width:100%;" class="form-control select2" onchange="fill_detail(this.value);" >
	 <option value="">Select Student</option>
		<?php
			include("../../con73/con37.php");
			$qry="select * from student_admission_info where session_value='$session1' and student_status='Active' and company_name='$company_123'";
			$rest=mysqli_query($conn73,$qry);
			while($row22=mysqli_fetch_assoc($rest)){
					$student_roll_no=$row22['student_roll_no'];
					$student_name=$row22['student_name'];
					$gender=$row22['student_gender'];
					$student_class=$row22['student_class'];
					$student_section=$row22['student_class_section'];
					$student_father_name=$row22['student_father_name'];
					$student_father_contact_number=$row22['student_father_contact_number'];
					$student_date_of_birth=$row22['student_date_of_birth'];
					$session_value=$row22['session_value'];
				?>
					<option <?php if($roll_no==$student_roll_no){ echo 'selected'; } ?> value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_roll_no."-".$gender."]-"."[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
				<?php
					}
				?>
			</select>
</div>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>