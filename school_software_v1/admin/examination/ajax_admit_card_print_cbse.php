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
?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
<th>No.</th>
<th>Student Name</th>
<th>Father Name</th>
<th>Class Roll No</th>
<th>Select</th>
</tr>
</thead>

<tbody>

<?php
$query="select * from student_admission_info where student_class='$student_class' and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$condition21 order by student_name ASC";
$serial_no=0;
$res=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($res)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_roll_no=$row['student_roll_no'];
$school_roll_no=$row['school_roll_no'];
$serial_no++;
?>

<tr>
<td><?php echo $serial_no; ?></td>
<td><input type="text" name="student_name" value="<?php echo $student_name; ?>" readonly /></td>
<td><input type="text" name="student_father_name" value="<?php echo $student_father_name; ?>" readonly /></td>
<td><input type="text" name="school_roll_no" value="<?php echo $school_roll_no; ?>" readonly /></td>
<td><input type="checkbox" name="student_roll_no_info[]" value="<?php echo $student_roll_no; ?>" readonly /></td>
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