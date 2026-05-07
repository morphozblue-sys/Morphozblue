<?php include("../attachment/session.php");
$student_class=$_GET['id'];
$student_class_group=$_GET['student_class_group'];
$student_class_stream=$_GET['student_class_stream'];
$student_section=$_GET['student_section'];
if($student_section==''){
$condition21='';
}else{
$condition21=" and student_class_section='$student_section'";
}
$exam_type=$_GET['student_exam_type'];
$order_by=$_GET['order_by'];
if($_SESSION['software_link']=="successschooljagdalpur")
$order_by1="ORDER BY student_name";
else
$order_by1="ORDER BY school_roll_no";


?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
<th>No.</th>
<th>Student Name</th>
<th>Father Name</th>
<th>Class Roll No</th>
<th>Select &nbsp;<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>

<th>Update By</th>
<th>Date</th>

</tr>
</thead>

<tbody>

<?php
 $query="select * from student_admission_info where student_class='$student_class' and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$filter37$condition21$order_by1";
$serial_no=0;
$res=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($res)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_roll_no=$row['student_roll_no'];
$school_roll_no=$row['school_roll_no'];

$update_change=$row['update_change'];
if($row['last_updated_date']!='0000-00-00'){
$last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
}else{
$last_updated_date=$row['last_updated_date'];
}

$serial_no++;
?>

<tr>
<td><?php echo $serial_no; ?></td>
<td><input type="text" name="student_name" value="<?php echo $student_name; ?>" readonly /></td>
<td><input type="text" name="student_father_name" value="<?php echo $student_father_name; ?>" readonly /></td>
<td><input type="text" name="school_roll_no" value="<?php echo $school_roll_no; ?>" readonly /></td>
<td><input type="checkbox" name="student_roll_no_info[]" class="checked1" checked value="<?php echo $student_roll_no; ?>" readonly /></td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>

</tr>
<?php
}  
?>
</tbody>
</table>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>