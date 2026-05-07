<?php include("../attachment/session.php");

$student_class=$_POST['student_class'];
$student_class_section=$_POST['student_class_section'];

$student_name=$_POST['student_name'];
$student_roll_no=$_POST['student_roll_no'];
$student_marks=$_POST['student_marks'];
$exam_student_class=$_POST['exam_student_class'];
$exam_type=$_POST['exam_type'];
$subject_name=$_POST['subject_name'];
$student_class_group=$_POST['student_class_group'];
$student_class_stream=$_POST['student_class_stream'];

$student_maximum_marks=$_POST['student_maximum_marks'];
$student_minimum_marks=$_POST['student_minimum_marks'];
$student_mark_add=$_POST['student_mark_add'];

$total_attendance=$_POST['total_attendance'];
$total_present=$_POST['total_present'];
$attendance_remark=$_POST['attendance_remark'];

$total_attendance11=$exam_type.'_total_attendance';
$total_present11=$exam_type.'_total_present';
$attendance_remark11=$exam_type.'_attendance_remark';


 $exam_marks1=$exam_type."_".$subject_name."_marks";
 $exam_marks_maximum1=$exam_type."_maximum_mark";
 $exam_marks_minimum1=$exam_type."_minimum_mark";
 $exam_marks_add1=$exam_type."_mark_add";
 
 $count=count($student_name);
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
 for($i=0; $i<$count; $i++){
 $quer="update $exam_table set $exam_marks1='$student_marks[$i]',$total_attendance11='$total_attendance[$i]',$total_present11='$total_present[$i]',$attendance_remark11='$attendance_remark[$i]',$update_by_update_sql  where student_roll_no='$student_roll_no[$i]' and session_value='$session1'";
 mysqli_query($conn73,$quer) or die(mysqli_error($conn73));

}
 $quer6="update school_info_subject_info set $exam_marks_maximum1='$student_maximum_marks',$exam_marks_minimum1='$student_minimum_marks',$exam_marks_add1='$student_mark_add',$update_by_update_sql  where class='$exam_student_class' and subject_code='$subject_name'and group_name='$student_class_group' and stream_name='$student_class_stream' and (session_value='$session1' || session_value='') $filter37";
 mysqli_query($conn73,$quer6) or die(mysqli_error($conn73));
$for_get='student_class='.$student_class.'&student_class_stream='.$student_class_stream.'&student_class_group='.$student_class_group.'&student_class_section='.$student_class_section.'&subject_name='.$subject_name.'&exam_type='.$exam_type;
echo "|?|success|?|".$for_get."|?|";
?>
