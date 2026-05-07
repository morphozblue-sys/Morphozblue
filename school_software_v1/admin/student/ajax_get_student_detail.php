<?php include("../attachment/session.php"); ?>     
<table class="table table-bordered table-striped">
<thead >
<tr>
<th>S.No.</th>
<th>Admission No.</th>
<th>Date Of Admission</th>
<th>Student Name</th>
<th>DOB</th>
<th>Student Father Name</th>
<th>Class</th>
<th>Section</th>
<th>Update By</th>
<th>Date</th>
</tr>
</thead>
<tbody>
<?php
$student_roll_no=$_GET['student_roll_no'];
if($student_roll_no!=""){
$condition=" and student_roll_no='$student_roll_no'";
}else{
$condition="";
}

$query1="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition";
$serial_no=0;
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$student_admission_number=$row1['student_admission_number'];
//$student_date_of_admission=$row1['student_date_of_admission'];
$student_name=$row1['student_name'];
//$student_date_of_birth=$row1['student_date_of_birth'];
$student_father_name=$row1['student_father_name'];
$student_scholar_number=$row1['student_scholar_number'];
$student_roll_no=$row1['student_roll_no'];
$student_class=$row1['student_class'];
$school_roll_no=$row1['school_roll_no'];
$student_class_section=$row1['student_class_section'];

if($row1['student_date_of_birth']!='0000-00-00' && $row1['student_date_of_birth']!=''){
$student_date_of_birth=date('d-m-Y',strtotime($row1['student_date_of_birth']));
}else{
$student_date_of_birth=$row1['student_date_of_birth'];
}

if($row1['student_date_of_admission']!='0000-00-00' && $row1['student_date_of_admission']!=''){
$student_date_of_admission=date('d-m-Y',strtotime($row1['student_date_of_admission']));
}else{
$student_date_of_admission=$row1['student_date_of_admission'];
}

$update_change=$row1['update_change'];
if($row1['last_updated_date']!='0000-00-00'){
$last_updated_date=date('d-m-Y',strtotime($row1['last_updated_date']));
}else{
$last_updated_date=$row1['last_updated_date'];
}

$serial_no++;
?>

<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $student_admission_number; ?></td>
<td><?php echo $student_date_of_admission; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $student_date_of_birth; ?></td>
<td><?php echo $student_father_name; ?></td>
<td><?php echo $student_class; ?></td>
<td><?php echo $student_class_section; ?></td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>
</tr>
<?php  } ?>
</tbody>
</table>
