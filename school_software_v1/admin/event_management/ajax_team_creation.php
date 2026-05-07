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
	<thead class="my_background_color">
		<tr>
	    <th>All<br/><input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	    <th>S No.</th>
        <th>Participate Type</th>
        <th>Name Of Event</th>
        <th>Name Of Participants</th>
        <th>DOB</th>
        <th>Class & Section</th>
        <th>Gender</th>
        <th>School/Institute Name</th>
        <th>Category</th>
        <th>House Name</th>
       </tr>
	</thead>
	<tbody>
<?php

$event_name=$_GET['event_name'];
if($event_name!=''){
if($event_name!='All'){
$condition1=" and event_name='$event_name'";
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

$category=$_GET['category'];
if($category!=''){
if($category!='All'){
$condition3=" and category='$category'";
}else{
$condition3="";
}
}else{
$condition3="";
}

$query1="select * from event_participate_table where s_no!=''$condition3$condition1$condition2 ORDER BY student_name";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
	$participate_type = $row['participate_type'];
	$student_name = $row['student_name'];
	$event_name = $row['event_name'];
	$house_name = $row['house_name'];
	$school_name = $row['school_name'];
	$gender = $row['gender'];
	$student_class = $row['student_class'];
	$dateofbirth = $row['dateofbirth'];
	$category = $row['category'];
	$student_adhar_number = $row['student_adhar_number'];
	$student_admission_number = $row['student_admission_number'];
	$student_scholar_number = $row['student_scholar_number'];
	$session_value = $row['session_value'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
    $serial_no++;
	?>
  <tr align='center'>
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no11; ?>" name="student_index[]"></td>
    <td><?php echo $serial_no; ?></td>
	<td><input type="text" value="<?php echo $participate_type; ?>" name="participate_type[]" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $event_name; ?>" name="event_name[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $student_name; ?>" name="student_name[]" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $dateofbirth; ?>" name="dateofbirth[]" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $student_class; ?>" name="student_class[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $gender; ?>" name="gender[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $school_name; ?>" name="school_name[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $category; ?>" name="category[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $house_name; ?>" name="house_name[]" class="form-control" style="border:none;" readonly>
	<input type="hidden" value="<?php echo $student_adhar_number; ?>" name="student_adhar_number[]" class="form-control" style="border:none;">
	<input type="hidden" value="<?php echo $student_admission_number; ?>" name="student_admission_number[]" class="form-control">
	<input type="hidden" value="<?php echo $student_scholar_number; ?>" class="form-control" name="student_scholar_number[]">
	<input type="hidden" value="<?php echo $session_value; ?>" class="form-control" name="session_value[]"><input type="hidden" value="<?php echo $student_father_name; ?>" class="form-control" name="student_father_name[]"><input type="hidden" value="<?php echo $student_mother_name; ?>" class="form-control" name="student_mother_name[]"></td>
  </tr>
	<?php  $serial_no11++; } ?>
     </tbody>
     </table>
     </div>
<!----	  <div class="col-md-12">
 <center><input type="submit" name="finish" value="Submit" onclick="return validation();" class="btn btn-success"></center>
	 </div>---->
	
<script>
$(function(){
$('#example2').DataTable()
})

$(function(){
$('.select2').select2()
})
</script>