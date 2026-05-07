<?php include("../attachment/session.php"); ?>
<table id="" class="table table-bordered table-striped">
<thead >
<tr>
<th>S No</th>
<th>Admission Number</th>
<th>Student Name</th>
<th>Father Name</th>
<th><input type="checkbox" id="all_check" onclick="for_check(this.id);" checked></th>
</tr>
</thead>
<tbody>
<?php
 $from_session=$_GET['from_session'];
 $from_class=$_GET['from_class'];
 $from_section=$_GET['from_section'];
 $student_class_stream_from=$_GET['student_class_stream_from'];
 $student_class_group_from=$_GET['student_class_group_from'];
 $from_medium=$_GET['from_medium'];
 $from_board=$_GET['from_board'];
 $from_shift=$_GET['from_shift'];
 if($from_medium!=''){
 $student_medium=" and student_medium='$from_medium'";
 }else{
 $student_medium="";
 }
 if($from_board!=''){
 $board=" and board='$from_board'";
 }else{
 $board="";
 }
 if($from_shift!=''){
 $shift=" and shift='$from_shift'";
 }else{
 $shift="";
 }
$query1="select * from student_admission_info where student_class='$from_class' and session_value='$from_session' and student_class_section='$from_section' and student_class_stream='$student_class_stream_from' and student_class_group='$student_class_group_from' and student_status='Active'$student_medium$board$shift";
$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));;
$serial_no=0;
while($row=mysqli_fetch_assoc($res)){ 
$s_no=$row['s_no'];
$student_admission_number=$row['student_admission_number'];
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_roll_no=$row['student_roll_no'];
$serial_no++;
?>
<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $student_admission_number; ?></td>
<td><?php echo $student_name; ?><input type="hidden" checked value="<?php echo $student_name; ?>" name="<?php echo $student_roll_no; ?>">
</td>
<td><?php echo $student_father_name; ?></td>
<td> <input type="checkbox" checked value="<?php echo $student_roll_no; ?>" class="all_check" name="move_student_from[]">
</td>
</tr>
<?php
}
?>
</tbody>
</table>
<script>
  $(function () {
    $('#example3').DataTable()
  })
</script>