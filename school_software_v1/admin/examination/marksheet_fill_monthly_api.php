<?php include("../attachment/session.php");
include("../sms/sms.php");

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
$exam_date=$_POST['exam_date'];

$total_attendance=$_POST['total_attendance'];
$total_present=$_POST['total_present'];
$attendance_remark=$_POST['attendance_remark'];

$total_attendance11=$exam_type.'_total_attendance';
$total_present11=$exam_type.'_total_present';
$attendance_remark11=$exam_type.'_attendance_remark';

$qry221="select * from school_info_general";
$rest221=mysqli_query($conn73,$qry221);
while($row221=mysqli_fetch_assoc($rest221)){
$school_info_school_name = $row221['school_info_school_name'];
}

$student_class=$_POST['student_class'];
$class_que1="select class_code from school_info_class_info where class_name='$student_class'";
$class_run1=mysqli_query($conn73,$class_que1) or die(mysqli_error($conn73));
while($class_row1=mysqli_fetch_assoc($class_run1)){
$class_code=$class_row1['class_code'];
}

$query0="select * from school_info_subject_info where stream_name='$student_class_stream' and group_name='$student_class_group' and class='$student_class' and session_value='$session1'$filter37";
$res0=mysqli_query($conn73,$query0) or die(mysqli_error($conn73));
while($row0=mysqli_fetch_assoc($res0)){
$subject_code=$row0['subject_code'];
$subject_name11[$subject_code]=$row0['subject_name'];
}

$query="select * from school_info_exam_types_monthly where class_code='$class_code' and session_value='$session1'$filter37";
$res=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
$exam_type11='';
while($row=mysqli_fetch_assoc($res)){
$exam_code=$row['exam_code'];
$exam_type11[$exam_code]=$row['exam_type'];
}


 $exam_marks1=$exam_type."_".$subject_name."_marks";
 $exam_marks_maximum1="monthly_".$exam_type."_maximum_mark";
 $exam_marks_minimum1="monthly_".$exam_type."_minimum_mark";
 $exam_marks_add1="monthly_".$exam_type."_mark_add";
 
 $count=count($student_name);
 for($i=0; $i<$count; $i++){
 $quer="update examination_monthly set $exam_marks1='$student_marks[$i]',$total_attendance11='$total_attendance[$i]',$total_present11='$total_present[$i]',$attendance_remark11='$attendance_remark[$i]',$update_by_update_sql  where student_roll_no='$student_roll_no[$i]' and session_value='$session1'";
 mysqli_query($conn73,$quer) or die(mysqli_error($conn73));
 if(isset($_POST['sms_'.$student_roll_no[$i]])){
     $contact=$_POST['sms_'.$student_roll_no[$i]];
    $content="Dear Parents, Your Child ".$student_name[$i]." Got ".$student_marks[$i]." Marks ".$subject_name11[$subject_name]." ".$exam_type11[$exam_type].", Regards ".$school_info_school_name.".[SCHOOL]";
      sendDNDSMS($contact, $content);
 }
}
$exam_date_update="monthly_".$exam_type."_time_date='$exam_date'";
 $quer6="update school_info_subject_info set $exam_marks_maximum1='$student_maximum_marks',$exam_marks_minimum1='$student_minimum_marks',$exam_marks_add1='$student_mark_add',$exam_date_update,$update_by_update_sql  where class='$exam_student_class' and subject_code='$subject_name'and group_name='$student_class_group' and stream_name='$student_class_stream' and session_value='$session1'$filter37";
 mysqli_query($conn73,$quer6) or die(mysqli_error($conn73));
echo "|?|success|?|";

?>
