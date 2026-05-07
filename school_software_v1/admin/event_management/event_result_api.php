<?php include("../attachment/session.php");
    $student_index = $_POST['student_index'];
	$count1=count($student_index);
    $participate_type = $_POST['participate_type'];
	$event_name = $_POST['event_name'];
	$house_name = $_POST['house_name'];
	$school_name = $_POST['school_name'];
	$student_name = $_POST['student_name'];
	$gender = $_POST['gender'];
	$student_class = $_POST['student_class'];
	$dateofbirth = $_POST['dateofbirth'];
	$remark = $_POST['remark'];
	$category = $_POST['category'];
	$session_value = $_POST['session_value'];
    //$event_date_2 = explode("-",$event_date_1);
	//$event_date=$event_date_2[2]."-".$event_date_2[1]."-".$event_date_2[0];
  
  for($i=0;$i<$count1;$i++){
  $index1=$student_index[$i];
  $quer="insert into event_result(participate_type,event_name,house_name,school_name,student_name,gender,student_class,dateofbirth,remark,category,session_value,$update_by_insert_sql_column)values('$participate_type[$index1]','$event_name[$index1]','$house_name[$index1]','$school_name[$index1]','$student_name[$index1]','$gender[$index1]','$student_class[$index1]','$dateofbirth[$index1]','$remark[$index1]','$category[$index1]','$session_value[$index1]',$update_by_insert_sql_value)";
 mysqli_query($conn73,$quer);
 }
echo "|?|success|?|";
?>
