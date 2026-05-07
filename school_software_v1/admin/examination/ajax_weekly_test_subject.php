<?php include("../attachment/session.php"); ?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
<th>S No</th>
<th><input type="checkbox" name="" id="subject11" onclick="for_check(this.id);" checked /> Subject Name</th>
<th>Date</th>
<th>From Time</th>
<th>To Time</th>
<th>Highest Marks</th>
</tr>
</thead>

<tbody>
<?php
$student_class=$_GET['student_class'];
$student_class_section=$_GET['student_class_section'];
$student_class_stream=$_GET['student_class_stream'];
$student_class_group=$_GET['student_class_group'];
$class_condition00="";
$class_condition="";
if($student_class!=''){
$class_condition00=" and class='$student_class'";
$class_condition=" and class='$student_class'";
}
$section_condition="";

$stream_condition00="";
$stream_condition="";

if($student_class_stream!='' && $student_class_stream!='All'){
$stream_condition=" and stream_name='$student_class_stream'";
}
$group_condition00="";
$group_condition="";
if($student_class_group!='' && $student_class_group!='All'){
$group_condition=" and group_name='$student_class_group'";
}


$query="select * from school_info_subject_info where s_no!='' and (session_value='$session1' || session_value='')$class_condition$stream_condition$group_condition$filter37";
$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no111=0;
while($row=mysqli_fetch_assoc($res)){
$subject_name=$row['subject_name'];
$subject_code=$row['subject_code'];

$serial_no++;
?>
<tr>
<td><?php echo $serial_no; ?></td>
<td><input type="checkbox" name="test_indexes[]" id="" value="<?php echo $serial_no111; ?>" class="subject11" checked /> <b><?php echo $subject_name; ?></b><input type="hidden" name="test_subjects[]" id="" value="<?php echo $subject_code; ?>" class="form-control" /></td>
<td><input type="date" name="test_dates[]" id="" class="form-control" /></td>
<td><input type="time" name="test_from_times[]" id="" class="form-control" /></td>
<td><input type="time" name="test_to_times[]" id="" class="form-control" /></td>
<td><input type="number" name="hightest_marks[]" id="" class="form-control" /></td>
</tr>
<?php $serial_no111++; } ?>
</tbody>
</table>
