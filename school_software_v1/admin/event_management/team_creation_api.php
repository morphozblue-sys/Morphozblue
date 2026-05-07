<?php include("../attachment/session.php");
    $student_index = $_POST['student_index'];
	$count1=count($student_index);
    $participate_type = $_POST['participate_type'];
	$event_name = $_POST['event_name'];
	$student_name = $_POST['student_name'];
	$dateofbirth = $_POST['dateofbirth'];
	$student_class = $_POST['student_class'];
	$gender = $_POST['gender'];
	$school_name = $_POST['school_name'];
	$category = $_POST['category'];
	$house_name = $_POST['house_name'];
	$student_adhar_number=$_POST['student_adhar_number'];
	$student_admission_number=$_POST['student_admission_number'];
	$student_scholar_number=$_POST['student_scholar_number'];
    $session_value = $_POST['session_value'];
	$student_mother_name = $_POST['student_mother_name'];
	$student_father_name = $_POST['student_father_name'];
	
	$staff_index = $_POST['staff_index'];
	$count2=count($staff_index);
	$emp_name = $_POST['emp_name'];
	$remark_staff = $_POST['remark_staff'];
	$emp_designation = $_POST['emp_designation'];
	$emp_mobile = $_POST['emp_mobile'];

  for($q=0;$q<$count2;$q++){
  $index2=$staff_index[$q];
  $quer11="insert into event_team_creation_staff(event_name,session_value,emp_name,emp_designation,emp_mobile,remark_staff,$update_by_insert_sql_column)values('$event_name[$index2]','$session_value[$index2]','$emp_name[$index2]','$emp_designation[$index2]','$emp_mobile[$index2]','$remark_staff[$index2]',$update_by_insert_sql_value)";
   mysqli_query($conn73,$quer11);
  }
  for($i=0;$i<$count1;$i++){
  $index1=$student_index[$i];
  $quer="insert into event_team_creation(participate_type,event_name,house_name,school_name,student_name,gender,student_class,dateofbirth,category,session_value,student_adhar_number,student_admission_number,student_scholar_number,student_mother_name,student_father_name,$update_by_insert_sql_column)values('$participate_type[$index1]','$event_name[$index1]','$house_name[$index1]','$school_name[$index1]','$student_name[$index1]','$gender[$index1]','$student_class[$index1]','$dateofbirth[$index1]','$category[$index1]','$session_value[$index1]','$student_adhar_number[$index1]','$student_admission_number[$index1]','$student_scholar_number[$index1]','$student_mother_name[$index1]','$student_father_name[$index1]',$update_by_insert_sql_value)";
 mysqli_query($conn73,$quer);
 }
echo "|?|success|?|";
?>
