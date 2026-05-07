<?php include("../attachment/session.php");


$period_start_time1=$_POST['period_start_time1'];
$period_end_time1=$_POST['period_end_time1'];

$student_section=$_POST['student_section'];
$period_name2=$_POST['period_name1'];
$period_code1=$_POST['period_code1'];
$student_class2=$_POST['student_class1'];
$class_code_hidden=$_POST['class_code_hidden'];
$student_class_stream=$_POST['student_class_stream'];
$student_class_group=$_POST['student_class_group'];
$subject_name_monday2=$_POST['subject_name_monday'];
$teacher_name_monday2=$_POST['teacher_name_monday'];
$subject_name_tuesday2=$_POST['subject_name_tuesday'];
$teacher_name_tuesday2=$_POST['teacher_name_tuesday'];
$subject_name_wednesday2=$_POST['subject_name_wednesday'];
$teacher_name_wednesday2=$_POST['teacher_name_wednesday'];
$subject_name_thursday2=$_POST['subject_name_thursday'];
$teacher_name_thursday2=$_POST['teacher_name_thursday'];
$subject_name_friday2=$_POST['subject_name_friday'];
$teacher_name_friday2=$_POST['teacher_name_friday'];
$subject_name_saturday2=$_POST['subject_name_saturday'];
$teacher_name_saturday2=$_POST['teacher_name_saturday'];

$count=count($period_code1);
for($i=0; $i<$count; $i++){
$period_coloum_subject_monday3[$i]=$period_code1[$i]."_subject_monday";
$period_coloum_teacher_monday3[$i]=$period_code1[$i]."_teacher_monday";
$period_coloum_subject_tuesday3[$i]=$period_code1[$i]."_subject_tuesday";
$period_coloum_teacher_tuesday3[$i]=$period_code1[$i]."_teacher_tuesday";
$period_coloum_subject_wednesday3[$i]=$period_code1[$i]."_subject_wednesday";
$period_coloum_teacher_wednesday3[$i]=$period_code1[$i]."_teacher_wednesday";
$period_coloum_subject_thursday3[$i]=$period_code1[$i]."_subject_thursday";
$period_coloum_teacher_thursday3[$i]=$period_code1[$i]."_teacher_thursday";
$period_coloum_subject_friday3[$i]=$period_code1[$i]."_subject_friday";
$period_coloum_teacher_friday3[$i]=$period_code1[$i]."_teacher_friday";
$period_coloum_subject_saturday3[$i]=$period_code1[$i]."_subject_saturday";
$period_coloum_teacher_saturday3[$i]=$period_code1[$i]."_teacher_saturday";

$que1="update class_time_table_new set $period_coloum_subject_monday3[$i]='$subject_name_monday2[$i]',		$period_coloum_teacher_monday3[$i]='$teacher_name_monday2[$i]',$period_coloum_subject_tuesday3[$i]='$subject_name_tuesday2[$i]',$period_coloum_teacher_tuesday3[$i]='$teacher_name_tuesday2[$i]',$period_coloum_subject_wednesday3[$i]='$subject_name_wednesday2[$i]',$period_coloum_teacher_wednesday3[$i]='$teacher_name_wednesday2[$i]',$period_coloum_subject_thursday3[$i]='$subject_name_thursday2[$i]',$period_coloum_teacher_thursday3[$i]='$teacher_name_thursday2[$i]',$period_coloum_subject_friday3[$i]='$subject_name_friday2[$i]',$period_coloum_teacher_friday3[$i]='$teacher_name_friday2[$i]',$period_coloum_subject_saturday3[$i]='$subject_name_saturday2[$i]',$period_coloum_teacher_saturday3[$i]='$teacher_name_saturday2[$i]',$update_by_update_sql  where class_code='$class_code_hidden' and section='$student_section'and group_name='$student_class_group' and stream_code='$student_class_stream'";
mysqli_query($conn73,$que1);

$que11="update school_info_class_period_new set period_start_time='$period_start_time1[$i]',period_end_time='$period_end_time1[$i]',$update_by_update_sql  where period_code='$period_code1[$i]' and class_code=''";
 mysqli_query($conn73,$que11); 
 echo "|?|success|?|";

}


?>

