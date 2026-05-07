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
	    <th>S No.</th>
        <th>Name</th>
        <th>Class</th>
        <th>Adm/Sch No</th>
        <th>Father Name</th>
        <th>Mother Name</th>
        <th>D.O.B</th>
        <th>Delete</th>
        </tr>
	</thead>
	<tbody>
<?php
$sports_name1=$_GET['sports_name'];
if($sports_name1!=''){
if($sports_name1!='All'){
$condition1=" and sports_name='$sports_name1'";
}else{
$condition1="";
}
}else{
$condition1="";
}

$age_category1=$_GET['age_category'];
if($age_category1!=''){
if($age_category1!='All'){
$condition2=" and age_category='$age_category1'";
}else{
$condition2="";
}
}else{
$condition2="";
}

$query1="select * from sports_team_creation where s_no!=''$condition1$condition2 ORDER BY student_name";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
	$sports_name = $row['sports_name'];
	$student_name = $row['student_name'];
	$student_class = $row['student_class'];
	$student_admission_number = $row['student_admission_number'];
	$dateofbirth = $row['dateofbirth'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$serial_no++;
	?>
  <tr align='center'>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $student_name; ?></td>
	<td><?php echo $student_class; ?></td>
    <td><?php echo $student_admission_number; ?></td>
	<td><?php echo $student_father_name; ?></td>
	<td><?php echo $student_mother_name; ?></td>
	<td><?php echo $dateofbirth; ?></td>
	<td><button type="button"  class="btn btn-default" onclick="return valid('<?php echo $s_no; ?>');" >Delete</button></td>
  </tr>
	<?php  $serial_no11++; } ?>
     </tbody>
</table>
</div>
<div id="staff_company">
<table id="example1" class="table table-bordered table-striped">
	<thead >
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
$query11="select * from sports_team_creation_staff where s_no!=''$condition1 ORDER BY emp_name";
$run1=mysqli_query($conn73,$query11) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row1=mysqli_fetch_assoc($run1)){
    $s_no1=$row1['s_no'];
    $emp_name=$row1['emp_name'];
    $emp_designation=$row1['emp_designation'];
    $emp_mobile=$row1['emp_mobile'];
    $remark_staff=$row1['remark_staff'];
    $sports_name=$row1['sports_name'];
 
	$serial_no++;
	?>
  <tr align='center'>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $emp_name; ?></td>
	<td><?php echo $emp_designation; ?></td>
	<td><?php echo $emp_mobile; ?></td>
	<td><?php echo $remark_staff; ?></td>
	<td><?php echo $sports_name; ?></td>
	<td><button type="button"  class="btn btn-default" onclick="return valid1('<?php echo $s_no1; ?>');" >Delete</button></td>
</tr>
	<?php  $serial_no11++; } ?>
     </tbody>
</table>
</div>
	<div class="col-md-12">
	    <center><button type="button" class="btn btn-success" target="_blank" onclick="post_content('sports/download_team_creation','<?php echo 'sports_name='.$sports_name1; ?>');">Print</button></center>
	</div>
	
<script>
$(function(){
$('#example2').DataTable()
$('#example1').DataTable()
})

$(function(){
$('.select2').select2()
})
</script>