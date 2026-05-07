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
<table id="example1" class="table table-bordered table-striped">
	<thead class="my_background_color">
		<tr>
	    <th>S No.</th>
        <th>Name</th>
        <th>Class</th>
        <th>Adm/Sch No</th>
        <th>Father Name</th>
        <th>Mother Name</th>
        <th>D.O.B</th>
        <th>Aadhar/Uid No</th>
        <th>Delete</th>
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



$query1="select * from event_team_creation where s_no!=''$condition1 ORDER BY student_name";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
	$event_name = $row['event_name'];
	$participate_type = $row['participate_type'];
	$house_name = $row['house_name'];
	$school_name = $row['school_name'];
	$student_name = $row['student_name'];
	$student_class = $row['student_class'];
	$student_admission_number = $row['student_admission_number'];
	$student_scholar_number = $row['student_scholar_number'];
	$dateofbirth = $row['dateofbirth'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$student_adhar_number = $row['student_adhar_number'];
	$serial_no++;
	?>
  <tr align='center'>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $student_name; ?></td>
	<td><?php echo $student_class; ?></td>
    <td><?php echo $student_admission_number; ?>/<?php echo $student_scholar_number; ?></td>
	<td><?php echo $student_father_name; ?></td>
	<td><?php echo $student_mother_name; ?></td>
	<td><?php echo $dateofbirth; ?></td>
	<td><?php echo $student_adhar_number; ?></td>
    <td><button type="button"  class="btn btn-default" onclick="return valid('<?php echo $s_no; ?>');" >Delete</button></td>
  </tr>
	<?php  $serial_no11++; } ?>
     </tbody>
</table>
</div>
<div id="staff_company">
<table id="example3" class="table table-bordered table-striped">
	<thead class="my_background_color">
		<tr>
	    <th>S No.</th>
        <th>Name Of Staff</th>
        <th>Designation</th>
        <th>Contact No</th>
        <th>Remarks</th>
        <th>Events Name</th>
        <th>Delete</th>
        </tr>
	</thead>
	<tbody>
<?php
$query11="select * from event_team_creation_staff where s_no!=''$condition1 ORDER BY emp_name";
$run1=mysqli_query($conn73,$query11) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row1=mysqli_fetch_assoc($run1)){
    $s_no1=$row1['s_no'];
    $emp_name=$row1['emp_name'];
    $emp_designation=$row1['emp_designation'];
    $emp_mobile=$row1['emp_mobile'];
    $remark_staff=$row1['remark_staff'];
    $event_name=$row1['event_name'];
 
	$serial_no++;
	?>
  <tr align='center'>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $emp_name; ?></td>
	<td><?php echo $emp_designation; ?></td>
	<td><?php echo $emp_mobile; ?></td>
	<td><?php echo $remark_staff; ?></td>
	<td><?php echo $event_name; ?></td>
	<td><button type="button"  class="btn btn-default" onclick="return valid1('<?php echo $s_no1; ?>');" >Delete</button></td>
</tr>
	<?php  $serial_no11++; } ?>
     </tbody>
</table>
</div>
	<div class="col-md-12">
	    <center><button type="button" class="btn btn-success" target="_blank" onclick="post_content('event_management/download_team_creation','<?php echo 'event_name='.$event_name; ?>');">Print</button></center>
	</div>
	 
	 
<script>
$(function(){
$('#example3').DataTable()
})
$(function(){
$('#example1').DataTable()
})

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>