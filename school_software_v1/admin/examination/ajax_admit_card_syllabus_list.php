<?php include("../attachment/session.php");
?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
<th><?php echo $language['S No']; ?></th>
<th><?php echo $language['Subject Name']; ?></th>
<th>Syllabus</th>
<th>Show on Admit Card</th>

<th>Update By</th>
<th>Date</th>

</tr>
</thead>

<tbody>
<?php
 $student_class=$_GET['class'];
 $student_class_stream=$_GET['student_class_stream'];
 $student_class_group=$_GET['student_class_group'];

 $student_section=$_GET['student_section'];
 $exam_type=$_GET['student_exam_type'];


$query1="select * from school_info_class_info where class_name='$student_class'";

$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$class_code=$row1['class_code'];
}
$query="select * from school_info_subject_info where class_code='$class_code' and group_name='$student_class_group' and stream_name='$student_class_stream' and session_value='$session1'$filter37";
$serial_no=0;
$res=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($res)){
$subject_code=$row['subject_code'];
$subject_name1=$row['subject_name'];
$subject_type0011=$row['subject_type'];

$syllabus_content=$row[$exam_type.'_syllabus_content'];
$syllabus_show_hide=$row[$exam_type.'_syllabus_show_hide'];

$update_change=$row['update_change'];
if($row['last_updated_date']!='0000-00-00'){
$last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
}else{
$last_updated_date=$row['last_updated_date'];
}

$sitting=$row[$exam_type.'_sitting'];

$serial_no++;
?>
<tr>
<td><?php echo $serial_no; ?></td>
<td><b><?php echo $subject_name1; ?></b>
<input type="hidden" name="student_subject_code[]" value="<?php echo $subject_code; ?>" readonly />
<input type="hidden" name="student_class_code[]" value="<?php echo $class_code; ?>" readonly /></td>
<td><textarea name="syllabus_content[]" cols="60"><?php echo $syllabus_content; ?></textarea></td>

<td><select class="form-control" name="admit_card_show[]" >
<option <?php if($syllabus_show_hide=='Yes'){ echo 'selected'; } ?> value="Yes">Yes</option>
<option <?php if($syllabus_show_hide=='No' || $syllabus_show_hide==''){ echo 'selected'; } ?> value="No">No</option>
</select></td>
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