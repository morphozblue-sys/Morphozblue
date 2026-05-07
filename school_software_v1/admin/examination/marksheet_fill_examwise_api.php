<?php include("../attachment/session.php");

$student_class=$_POST['student_class'];
$student_class_section=$_POST['student_class_section'];

$student_name=$_POST['student_name'];
$student_roll_no=$_POST['student_roll_no'];
//$student_marks=$_POST['student_marks'];
$exam_student_class=$_POST['exam_student_class'];
$exam_type=$_POST['exam_type'];
//$subject_name=$_POST['subject_name'];
$student_class_group=$_POST['student_class_group'];
$student_class_stream=$_POST['student_class_stream'];

if($student_class=='11TH' || $student_class=='12TH'){
     $condition_0011=" and group_name='$student_class_group' and stream_name='$student_class_stream'";
 }else{
     $condition_0011="";
 }
$query5="select subject_name,subject_code from school_info_subject_info where class='$student_class' and session_value='$session1'$condition_0011$filter37";
$res4=mysqli_query($conn73,$query5) or die(mysqli_error($conn73));
// $subject_name='';
// $subject_code=''; 
$total_subject=0;
while($row4=mysqli_fetch_assoc($res4)){
 $subject_name[$total_subject]=$row4['subject_name'];
 $subject_code[$total_subject]=$row4['subject_code'];
 $total_subject++;
}

$total_attendance=$_POST['total_attendance'];
$total_present=$_POST['total_present'];
$attendance_remark=$_POST['attendance_remark'];

$total_attendance11=$exam_type.'_total_attendance';
$total_present11=$exam_type.'_total_present';
$attendance_remark11=$exam_type.'_attendance_remark';

//  $exam_marks1=$exam_type."_".$subject_name."_marks";
 $exam_marks_maximum1=$exam_type."_maximum_mark";
 $exam_marks_minimum1=$exam_type."_minimum_mark";
 $exam_marks_add1=$exam_type."_mark_add";
 
 $count=count($student_name);
 for($i=0; $i<$count; $i++){

$update_column='';
for($ar1=0;$ar1<$total_subject;$ar1++){
$student_marks1=$_POST['student_marks_'.$student_roll_no[$i].'_'.$subject_code[$ar1]];
$exam_marks1=$exam_type."_".$subject_code[$ar1]."_marks";
$update_column=$update_column."$exam_marks1='$student_marks1',";
}
if($_SESSION['software_link']=='eaglemountainschool'){
    $exam_number=str_replace("exam","",$exam_type);
   if($exam_number<9){
$exam_table="examination";  
}else{
$exam_table="examination_extra";  
}
}else{
$exam_table="examination";    
}

   $quer="update $exam_table set $update_column $total_attendance11='$total_attendance[$i]',$total_present11='$total_present[$i]',$attendance_remark11='$attendance_remark[$i]',$update_by_update_sql  where student_roll_no='$student_roll_no[$i]' and session_value='$session1'";
 mysqli_query($conn73,$quer) or die(mysqli_error($conn73));

}
for($ar=0;$ar<$total_subject;$ar++){

$student_maximum_marks=$_POST['student_maximum_marks_'.$subject_code[$ar]];
$student_minimum_marks=$_POST['student_minimum_marks_'.$subject_code[$ar]];
$student_mark_add=$_POST['student_mark_add_'.$subject_code[$ar]];

 echo $quer6="update school_info_subject_info set $exam_marks_maximum1='$student_maximum_marks',$exam_marks_minimum1='$student_minimum_marks',$exam_marks_add1='$student_mark_add',$update_by_update_sql  where class='$exam_student_class' and subject_code='$subject_code[$ar]'and group_name='$student_class_group' and stream_name='$student_class_stream' and (session_value='$session1' || session_value='') $filter37";
 mysqli_query($conn73,$quer6) or die(mysqli_error($conn73));
}
$for_get='student_class='.$student_class.'&student_class_stream='.$student_class_stream.'&student_class_group='.$student_class_group.'&student_class_section='.$student_class_section.'&subject_name=&exam_type='.$exam_type;
echo "|?|success|?|".$for_get."|?|";
?>
