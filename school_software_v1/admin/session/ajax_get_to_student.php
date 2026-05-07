<?php include("../attachment/session.php"); ?>
<table id="" class="table table-bordered table-striped">
<thead >
<tr>
<th>S No</th>
<th>Student Name</th>
<th>Father Name</th>
<th><input type="checkbox" id="all_check1" onclick="for_check(this.id);" checked></th>
</tr>
</thead>
<tbody>
<?php
 $to_session=$_GET['to_session'];
 $to_class=$_GET['to_class'];
 $to_section=$_GET['to_section'];
 $student_class_stream_to=$_GET['student_class_stream_to'];
 $student_class_group_to=$_GET['student_class_group_to'];
 $to_medium=$_GET['to_medium'];
 $to_board=$_GET['to_board'];
 $to_shift=$_GET['to_shift'];
 if($to_medium!=''){
 $student_medium=" and student_medium='$to_medium'";
 }else{
 $student_medium="";
 }
 if($to_board!=''){
 $board=" and board='$to_board'";
 }else{
 $board="";
 }
 if($to_shift!=''){
 $shift=" and shift='$to_shift'";
 }else{
 $shift="";
 }
$query1="select * from student_admission_info where student_class='$to_class' and session_value='$to_session' and student_class_section='$to_section' and student_class_stream='$student_class_stream_to' and student_class_group='$student_class_group_to' and student_status='Active'$student_medium$board$shift";
$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));;
$serial_no=0;
while($row=mysqli_fetch_assoc($res)){
$s_no=$row['s_no'];
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_roll_no=$row['student_roll_no'];
$serial_no++;
?>
<tr>
 <td><?php echo $serial_no; ?></td>
 <td><?php echo $student_name; ?></td>
 <td><?php echo $student_father_name; ?></td>
 <td> <input type="checkbox" checked value="<?php echo $student_roll_no; ?>" class="all_check1" name="move_student_to[]">
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