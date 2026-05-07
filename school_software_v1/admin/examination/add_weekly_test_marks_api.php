<?php include("../attachment/session.php");
$student_class=$_POST['student_class'];
$student_class_stream = $_POST['student_class_stream'];
$student_class_group=$_POST['student_class_group'];
$student_class_section=$_POST['student_class_section'];
$test_name=$_POST['test_name'];

$student_indexes=$_POST['student_indexes'];
$student_roll_no=$_POST['student_roll_no'];
$student_name=$_POST['student_name'];

$query="select test_subjects from weekly_test_info where s_no='$test_name' and test_status='Active' and session_value='$session1'";
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
// $test_subjects_code1111=$test_subjects2[0];
// $$test_subjects_code1111=$_POST[$$test_subjects_code[$i]];
}
}else{
$test_subjects01=explode('|??|',$test_subjects);
$test_subjects_count=1;
$test_subjects_code[0]=$test_subjects01[0];
// $test_subjects_code1111=$test_subjects01[0];
// $$test_subjects_code1111=$_POST[$$test_subjects_code[0]];
}

$result=0;
$index_count=count($student_indexes);
$update_column="";
for($j=0;$j<$index_count;$j++){
$index_val=$student_indexes[$j];
for($k=0;$k<$test_subjects_count;$k++){
$test_val=$_POST[$test_subjects_code[$k]];
$update_column=$update_column.','.$test_subjects_code[$k]."='$test_val[$index_val]'";
}

$que4="update weekly_test_marks_info set student_class='$student_class',student_stream='$student_class_stream',student_group='$student_class_group',student_name='$student_name[$index_val]',student_section='$student_class_section'$update_column where student_roll_no='$student_roll_no[$index_val]' and weekly_test_s_no='$test_name' and session_value='$session1'";
if(mysqli_query($conn73,$que4)){
$result++;
}

}

if($result>0){
echo "|?|success|?|";
}
?>