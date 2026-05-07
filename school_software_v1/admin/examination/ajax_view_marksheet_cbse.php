<?php include("../attachment/session.php");

 $student_class=$_GET['id'];
 $student_section=$_GET['student_section'];
 $exam_type=$_GET['student_exam_type'];
  $student_class_stream=$_GET['student_class_stream'];
 $student_class_group=$_GET['student_class_group'];
 $exam_term=$_GET['exam_term'];


$que321="select * from school_info_pdf_info";
$run321=mysqli_query($conn73,$que321);
while($row321=mysqli_fetch_assoc($run321)){
$marksheet_final_cbse_pdf = $row321['marksheet_final_cbse_pdf'];
	$marksheet_exam_wise_cbse_pdf = $row321['marksheet_exam_wise_cbse_pdf'];
}	
 
$query1="select * from student_admission_info where student_class='$student_class'  and student_class_section='$student_section' and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1' order by student_name ASC" ;
$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));;
$serial_no=0;
while($row=mysqli_fetch_assoc($res)){
$student_name=$row['student_name'];
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
<td>
<input type="hidden" name="students_name[]" value="<?php echo $student_name; ?>" readonly />
<?php echo $student_name; ?>
</td>
<td>
<input type="hidden" name="roll_no[]" value="<?php echo $student_roll_no; ?>" readonly />
<?php echo $school_roll_no; ?>
</td>
<td><a target="_blank" href="<?php echo $pdf_path; ?>marksheet_page/<?php echo $marksheet_exam_wise_cbse_pdf; ?>?class=<?php echo $student_class; ?>&roll_no=<?php echo $student_roll_no; ?>&exam_type=<?php echo $exam_type; ?>&student_class_group=<?php echo $student_class_group; ?>&student_class_stream=<?php echo $student_class_stream; ?>&exam_term=<?php echo $exam_term; ?>&session1=<?php echo $session1; ?>">View Marksheet</a></td>
<td><a target="_blank" href="<?php echo $pdf_path; ?>marksheet_page/<?php echo $marksheet_final_cbse_pdf; ?>?class=<?php echo $student_class; ?>&roll_no=<?php echo $student_roll_no; ?>&student_class_group=<?php echo $student_class_group; ?>&student_class_stream=<?php echo $student_class_stream; ?>&exam_term=<?php echo $exam_term; ?>&session1=<?php echo $session1; ?>" >View FinalMarksheet</a></td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>

</tr>



<?php
}

?>