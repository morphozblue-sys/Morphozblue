<?php include("../attachment/session.php"); ?>
<table id="example1" class="table table-bordered table-striped">
		<thead class="my_background_color">
		<tr>
	    <th>All<br/><input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	    <th>S No.</th>
        <th>Participate Type</th>
        <th>Name Of Event</th>
        <th>Name Of Participants</th>
        <th>Class & Section</th>
        <th>Gender</th>
        <th>School/Institute Name</th>
        <th>Category</th>
        <th>House Name</th>
        <th style="width:150px;">Result Remarks</th>
        </tr>
        </thead>
        <tbody>
		<?php
		$event_name=$_GET['event_name'];
		$query1="select * from event_participate_table where event_name='$event_name'";
		$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
		$serial_no=0;
		$serial_no1=0;
		while($row=mysqli_fetch_assoc($run)){
		$s_no=$row['s_no'];
		$participate_type = $row['participate_type'];
		$event_name = $row['event_name'];
		$student_name = $row['student_name'];
		$student_class = $row['student_class'];
		$gender = $row['gender'];
		$school_name = $row['school_name'];
		$house_name = $row['house_name'];
		$category = $row['category'];
		$dateofbirth = $row['dateofbirth'];
		$session_value = $row['session_value'];

		$serial_no++;
		?>
  <tr align='center'>
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no1; ?>" name="student_index[]"></td>
    <td><?php echo $serial_no; ?></td>
	<td><input type="text" value="<?php echo $participate_type; ?>" name="participate_type[]" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $event_name; ?>" name="event_name[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $student_name; ?>" name="student_name[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $student_class; ?>" name="student_class[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $gender; ?>" name="gender[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $school_name; ?>" name="school_name[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $category; ?>" name="category[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $house_name; ?>" name="house_name[]" class="form-control" style="border:none;" readonly><input type="hidden" value="<?php echo $dateofbirth; ?>" name="dateofbirth[]" class="form-control" style="border:none;" readonly><input type="hidden" value="<?php echo $session_value; ?>" name="session_value[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" name="remark[]" class="form-control type_data" oninput="data_fill(this.value);"></td>
  </tr>
	<?php  $serial_no1++; } ?>
     </tbody>
     </table>
	 <div class="col-md-12">
		<center><input type="submit" name="finish" value="Submit" onclick="return validation();" class="btn  btn-success"/></center> 
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
</script>