<?php include("../attachment/session.php");
 $student_class=$_GET['class'];
 $student_class_stream=$_GET['student_class_stream'];
 $student_class_group=$_GET['student_class_group'];

 $student_section=$_GET['student_section'];
 $exam_type=$_GET['student_exam_type'];
 $exam_term=$_GET['exam_term'];


echo $query1="select * from school_info_class_info where class_name='$student_class'";

$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$class_code=$row1['class_code'];
}
echo $query="select * from school_info_subject_info where class_code='$class_code' and group_name='$student_class_group' and stream_name='$student_class_stream' and (session_value='$session1' || session_value='') $filter37";
$serial_no=0;
$res=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($res)){
$subject_code=$row['subject_code'];
$subject_name1=$row['subject_name'];
$admit_card_date1=$exam_term.'_'.$exam_type."_time_date";
$exam_time_from1=$exam_term.'_'.$exam_type."_time_from";
$exam_time_to1=$exam_term.'_'.$exam_type."_time_to";
$exam_admit_card_show1=$exam_term.'_'.$exam_type."_admit_card_show";
$exam_admit_sitting=$exam_term.'_'.$exam_type."_sitting";
$exam_admit_card_date=$row[$admit_card_date1];
$exam_admit_card_time_from=$row[$exam_time_from1];
$exam_admit_card_time_to=$row[$exam_time_to1];
$exam_admit_card_show=$row[$exam_admit_card_show1];
$sitting=$row[$exam_admit_sitting];

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
<td><input type="text" name="student_subject_name[]" value="<?php echo $subject_name1; ?>" readonly />
<input type="hidden" name="student_subject_code[]" value="<?php echo $subject_code; ?>" readonly /></td>
<input type="hidden" name="student_class_code[]" value="<?php echo $class_code; ?>" readonly /></td>
<td><input type="date" name="admit_card_date[]" required value="<?php echo $exam_admit_card_date; ?>"></td>
<td><input type="time" name="admit_card_exam_time_from[]" required value="<?php echo $exam_admit_card_time_from; ?>"></td>
<td><input type="time" name="admit_card_exam_time_to[]" required value="<?php echo $exam_admit_card_time_to; ?>"></td>
<td>
<select class="form-control" name="admit_card_sitting[]" >
<option <?php if($sitting=='1st_sitting'){ echo 'selected'; } ?> value="1st_sitting">1ST Sitting</option>
<option <?php if($sitting=='2nd_sitting'){ echo 'selected'; } ?> value="2nd_sitting">2ND Sitting</option>
<option <?php if($sitting=='3rd_sitting'){ echo 'selected'; } ?> value="3rd_sitting">3RD Sitting</option>
</select>
</td>

<td><select class="form-control" name="admit_card_show[]" >
				               <option value="<?php echo $exam_admit_card_show; ?>"><?php echo $exam_admit_card_show; ?></option>
				               <option value="Yes">Yes</option>
				               <option value="No">No</option>
				
				 </select></td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>

</tr>

<?php
} 
?>