<?php include("../attachment/session.php"); ?>
<option value="">Select</option>
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
if($student_class_section!=''){
$section_condition=" and ( student_class_section='$student_class_section' || student_class_section='All')";
}
$stream_condition00="";
$stream_condition="";
if($student_class_stream!=''){
$stream_condition=" and ( student_class_stream='$student_class_stream' || student_class_stream='All')";
}
if($student_class_stream!='' && $student_class_stream!='All'){
$stream_condition00=" and stream_name='$student_class_stream'";
}
$group_condition00="";
$group_condition="";
if($student_class_group!='' && $student_class_group!='All'){
$group_condition00=" and group_name='$student_class_group'";
}
if($student_class_group!=''){
$group_condition=" and (student_class_group='$student_class_group' || student_class_group='All')";
}

$query="select s_no,test_name from weekly_test_info where test_status='Active' and session_value='$session1'$class_condition$section_condition$stream_condition$group_condition";
$serial_no=0;
$res=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($res)){
$s_no=$row['s_no'];
$test_name=$row['test_name'];
?>
<option value="<?php echo $s_no; ?>"><?php echo $test_name; ?></option>
<?php } ?>
