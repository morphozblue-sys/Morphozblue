<?php include("../attachment/session.php"); ?>
<?php
$student_class=$_GET['student_class'];
$student_class_section=$_GET['student_class_section'];
$student_class_stream=$_GET['student_class_stream'];
$student_class_group=$_GET['student_class_group'];
$class_condition00="";
$class_condition="";
if($student_class!=''){
$class_condition00=" and class='$student_class'";
$class_condition=" and student_class='$student_class'";
}
$section_condition="";
if($student_class_section!='' && $student_class_section!='All'){
$section_condition=" and ( student_class_section='$student_class_section' || student_class_section='All')";
}
$stream_condition00="";
$stream_condition="";

if($student_class_stream!='' && $student_class_stream!='All'){
$stream_condition00=" and stream_name='$student_class_stream'";
$stream_condition=" and ( student_class_stream='$student_class_stream' || student_class_stream='All')";
}
$group_condition00="";
$group_condition="";
if($student_class_group!='' && $student_class_group!='All'){
$group_condition00=" and group_name='$student_class_group'";

$group_condition=" and (student_class_group='$student_class_group' || student_class_group='All')";
}

$test_condition="";
if($test_s_no!=''){
$test_condition=" and s_no='$test_s_no'";
}


$test_name=$_GET['test_name'];
$test_condition="";
if($test_name!=''){
$test_condition=" and s_no='$test_name'";
}
$student_limit=$_GET['student_limit'];

$query00="select subject_code,subject_name from school_info_subject_info where s_no!='' and (session_value='$session1' || session_value='')$class_condition00$stream_condition00$group_condition00$filter37";
$res00=mysqli_query($conn73,$query00) or die(mysqli_error($conn73));
$subject_name='';
while($row00=mysqli_fetch_assoc($res00)){
$subject_code=$row00['subject_code'];
$subject_name[$subject_code]=$row00['subject_name'];
}

$query="select test_subjects from weekly_test_info where test_status='Active' and session_value='$session1'$class_condition$section_condition$stream_condition$group_condition$test_condition";
$res=mysqli_query($conn73,$query);
$test_subjects='';
while($row=mysqli_fetch_assoc($res)){
$test_subjects=$row['test_subjects'];
}

if(substr_count($test_subjects,"|?|")>0){
$test_subjects1=explode('|?|',$test_subjects);
$test_subjects_count=count($test_subjects1);
$test_subjects_code='';
for($i=0; $i<$test_subjects_count; $i++){
$test_subjects2=explode('|??|',$test_subjects1[$i]);
$test_subjects_code[$i]=$test_subjects2[0];
}
}else{
$test_subjects01=explode('|??|',$test_subjects);
$test_subjects_count=1;
$test_subjects_code[0]=$test_subjects01[0];
}
?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
<th>S No</th>
<th><input type="checkbox" name="" id="students11" onclick="for_check(this.id);" checked /></th>
<th>Students Name</th>
<th>Father's Name</th>
<th>Mother's Name</th>
<?php
for($j=0; $j<$test_subjects_count; $j++){
?>
<th><?php echo $subject_name[$test_subjects_code[$j]]; ?></th>
<?php } ?>
</tr>
</thead>

<tbody>
<?php
$query="select student_name,student_father_name,student_mother_name,student_roll_no from student_admission_info where student_status='Active' and session_value='$session1'$class_condition$section_condition$stream_condition$group_condition$filter37 ORDER BY student_name LIMIT $student_limit, 30";
$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no111=0;
while($row=mysqli_fetch_assoc($res)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_mother_name=$row['student_mother_name'];
$student_roll_no=$row['student_roll_no'];

$que3="select * from weekly_test_marks_info where student_roll_no='$student_roll_no' and session_value='$session1' and weekly_test_s_no='$test_name'";
$run3=mysqli_query($conn73,$que3) or die(mysqli_error($conn73));
if(mysqli_num_rows($run3)>0){
}else{
$que4="insert into weekly_test_marks_info(student_roll_no,student_class,student_stream,student_group,student_name,student_section,weekly_test_s_no,session_value,$update_by_insert_sql_column) values('$student_roll_no','$student_class','$student_class_stream','$student_class_group','$student_name','$student_class_section','$test_name','$session1',$update_by_insert_sql_value);";
mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
$que3="select * from weekly_test_marks_info where student_roll_no='$student_roll_no' and session_value='$session1' and weekly_test_s_no='$test_name'";
$run3=mysqli_query($conn73,$que3) or die(mysqli_error($conn73));
}
while($row3=mysqli_fetch_assoc($run3)){

$s_no=$row3['s_no'];

$serial_no++;
?>
<tr>
<td><?php echo $serial_no; ?></td>
<td><input type="checkbox" name="student_indexes[]" id="" value="<?php echo $serial_no111; ?>" class="students11" checked /></td>
<td><input type="hidden" name="student_roll_no[]" id="" value="<?php echo $student_roll_no; ?>" class="form-control" /><input type="text" name="student_name[]" id="" value="<?php echo $student_name; ?>" class="form-control" readonly /></td>
<td><?php echo $student_father_name; ?></td>
<td><?php echo $student_mother_name; ?></td>
<?php
for($k=0; $k<$test_subjects_count; $k++){
?>
<td><input type="text" name="<?php echo $test_subjects_code[$k].'[]'; ?>" id="" value="<?php echo $row3[$test_subjects_code[$k]]; ?>" class="form-control" /></td>
<?php } } ?>
</tr>
<?php $serial_no111++; } ?>
</tbody>
</table>
