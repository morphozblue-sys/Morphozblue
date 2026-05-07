<?php include("../attachment/session.php");

$exam_type=$_POST['exam_type'];
$student_subject_code=$_POST['student_subject_code'];
$class_code=$_POST['student_class_code'];
$syllabus_content=$_POST['syllabus_content'];

$admit_card_show=$_POST['admit_card_show'];
$student_class_group=$_POST['student_class_group'];
$student_class_stream=$_POST['student_class_stream'];


$syllabus_content_column=$exam_type.'_syllabus_content';
$syllabus_show_hide_column=$exam_type.'_syllabus_show_hide';

$count=count($syllabus_content);
for($i=0; $i<$count; $i++){

$quer="update school_info_subject_info set $syllabus_show_hide_column='$admit_card_show[$i]',$syllabus_content_column='$syllabus_content[$i]',$update_by_update_sql  where class_code='$class_code[$i]' and subject_code='$student_subject_code[$i]' and group_name='$student_class_group' and stream_name='$student_class_stream' and session_value='$session1'$filter37";
mysqli_query($conn73,$quer) or die(mysqli_error($conn73));

}
echo "|?|success|?|";
?>