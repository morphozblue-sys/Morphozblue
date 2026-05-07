<?php include("../attachment/session.php");

$class_name=$_GET['class_name'];
$student_class_stream=$_GET['student_class_stream'];
$student_class_group=$_GET['student_class_group'];

if($class_name=='11TH' || $class_name=='12TH'){
    $condition1=" and stream_name='$student_class_stream'";
    $condition2=" and group_name='$student_class_group'";
}else{
    $condition1="";
    $condition2="";
}

$query="select * from school_info_subject_info where class='$class_name' and (session_value='$session1' || session_value='') $condition1$condition2$filter37";
$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($res)){
$subject_name=$row['subject_name'];
$subject_code=$row['subject_code'];
?>
<div class="col-md-2">
<input type="checkbox" value="<?php echo $subject_code; ?>" onclick="for_list();" class="sel_subject1" /> <?php echo $subject_name; ?>
</div>
<?php
}
?>