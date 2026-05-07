<?php include("../attachment/session.php");
$exam_type=$_POST['exam_type'];
$student_subject_name=$_POST['student_subject_name'];
$student_subject_code=$_POST['student_subject_code'];
$class_code=$_POST['student_class_code'];
$admit_card_date = $_POST['admit_card_date'];
$admit_card_exam_time_from=$_POST['admit_card_exam_time_from'];
$admit_card_exam_time_to=$_POST['admit_card_exam_time_to'];
$admit_card_show=$_POST['admit_card_show'];
$student_class_group=$_POST['student_class_group'];
$student_class_stream=$_POST['student_class_stream'];
$exam_term=$_POST['exam_term'];

$admit_card_sitting=$_POST['admit_card_sitting'];


$count=count($admit_card_exam_time_from);
for($i=0; $i<$count; $i++){
$admit_card_date_name1=$exam_term.'_'.$exam_type."_time_date";
$exam_time_from_name1=$exam_term.'_'.$exam_type."_time_from";
$exam_time_to_name1=$exam_term.'_'.$exam_type."_time_to";
$exam_admit_card_show1=$exam_term.'_'.$exam_type."_admit_card_show";
$exam_admit_sitting=$exam_term.'_'.$exam_type."_sitting";



$quer="update school_info_subject_info set $admit_card_date_name1='$admit_card_date[$i]',$exam_admit_sitting='$admit_card_sitting[$i]',$exam_time_from_name1='$admit_card_exam_time_from[$i]',$exam_time_to_name1='$admit_card_exam_time_to[$i]',$exam_admit_card_show1='$admit_card_show[$i]',$update_by_update_sql  where class_code='$class_code[$i]' and subject_code='$student_subject_code[$i]' and group_name='$student_class_group' and stream_name='$student_class_stream' and (session_value='$session1' || session_value='') $filter37";
 mysqli_query($conn73,$quer) or die(mysqli_error($conn73));

}
echo "|?|success|?|";
?>
