<?php include("../attachment/session.php");

 $student_class=$_GET['id'];
 $student_section=$_GET['student_section'];
 $subject_name=$_GET['subject_name'];

$query5="select * from school_info_syllabus_info where class='$student_class' and section='$student_section' and subject_name='$subject_name' and session_value='$session1' ORDER BY s_no";
$serial_no=0;
$res4=mysqli_query($conn73,$query5) or die(mysqli_error($conn73));
while($row4=mysqli_fetch_assoc($res4)){
 $s_no=$row4['s_no'];
 $class=$row4['class'];
 $section=$row4['section'];
 $subject_name=$row4['subject_name'];
 $syllabus_topic=$row4['syllabus_topic'];
 $syllabus_book_name=$row4['syllabus_book_name'];
 $syllabus_chapter_book_name=$row4['syllabus_chapter_book_name'];
 //$syllabus_insert_date=$row4['syllabus_insert_date'];
 //$syllabus_completion_date=$row4['syllabus_completion_date'];
 $syllabus_subject_teacher=$row4['syllabus_subject_teacher'];
 $syllabus_student_feedback=$row4['syllabus_student_feedback'];
 $syllabus_completion_status=$row4['syllabus_completion_status'];
 $syllabus_remark=$row4['syllabus_remark'];
 $syllabus_estimated_completion_date=$row4['syllabus_estimated_completion_date'];
 $syllabus_actual_completion_date=$row4['syllabus_actual_completion_date'];

if($syllabus_completion_status=='Complete'){
    $btn_var1="Incomplete";
    $btn_color="btn-default";
}elseif($syllabus_completion_status=='Incomplete'){
    $btn_var1="Complete";
    $btn_color="btn-warning";
}

if($syllabus_estimated_completion_date!='0000-00-00' && $syllabus_estimated_completion_date!=''){
$syllabus_estimated_completion_date=date('d-m-Y', strtotime($syllabus_estimated_completion_date));
}

$serial_no++;

?>

<tr>
<td><?php echo $serial_no.'.'; ?></td>
<td><?php echo $class.' ('.$section.')'; ?></td>
<td><?php echo $subject_name; ?></td>
<td><?php echo $syllabus_topic; ?></td>
<td><?php echo $syllabus_book_name; ?></td>
<td><?php echo $syllabus_chapter_book_name; ?></td>
<td><?php echo $syllabus_subject_teacher; ?></td>
<td><?php echo $syllabus_estimated_completion_date; ?></td>
<td>
<button type="button" class="btn btn-primary" onclick="for_edit('<?php echo $s_no; ?>');" name="edit">Edit</button>&nbsp;
<button type="button" class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" name="delete">Delete</button>&nbsp;
<button type="button" class="btn <?php echo $btn_color; ?>" onclick="for_complete('<?php echo $s_no; ?>','<?php echo $btn_var1; ?>');" name="complete/incomplete"><?php echo $syllabus_completion_status; ?></button>
</td>
</tr>
<?php } ?>