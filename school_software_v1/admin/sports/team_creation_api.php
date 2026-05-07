<?php include("../attachment/session.php");

    $student_index = $_POST['student_index'];
	$count1=count($student_index);
	$sports_name = $_POST['sports_name'];
    $student_name = $_POST['student_name'];
	$student_class = $_POST['student_class'];
	$student_admission_number = $_POST['student_admission_number'];
	$student_father_name = $_POST['student_father_name'];
	$student_mother_name = $_POST['student_mother_name'];
	$dateofbirth = $_POST['dateofbirth'];
	$board_no = $_POST['board_no'];
	$session_value = $_POST['session_value'];
	$sports_type = $_POST['sports_type'];
	$age_category = $_POST['age_category'];
 
	$staff_index = $_POST['staff_index'];
	$count2=count($staff_index);
	$emp_name = $_POST['emp_name'];
	$emp_designation = $_POST['emp_designation'];
	$emp_mobile = $_POST['emp_mobile'];
	$remark_staff = $_POST['remark_staff'];
	
    $event_date_2 = explode("-",$event_date_1);
	$event_date=$event_date_2[2]."-".$event_date_2[1]."-".$event_date_2[0];
    for($q=0;$q<$count2;$q++){
     $index2=$staff_index[$q];
     $quer11="insert into sports_team_creation_staff(sports_name,emp_name,emp_designation,emp_mobile,remark_staff,$update_by_insert_sql_column)values
	 ('$sports_name[$index2]','$emp_name[$index2]','$emp_designation[$index2]','$emp_mobile[$index2]','$remark_staff[$index2]',$update_by_insert_sql_value)"; 
     mysqli_query($conn73,$quer11);
    }
   for($i=0;$i<$count1;$i++){
   $index1=$student_index[$i];
    $quer="insert into sports_team_creation(sports_name,student_name,student_class,dateofbirth,session_value,student_admission_number,board_no,student_mother_name,student_father_name,sports_type,age_category,$update_by_insert_sql_column)values('$sports_name[$index1]','$student_name[$index1]','$student_class[$index1]','$dateofbirth[$index1]','$session_value[$index1]','$student_admission_number[$index1]','$board_no[$index1]','$student_mother_name[$index1]','$student_father_name[$index1]','$sports_type[$index1]','$age_category[$index1]',$update_by_insert_sql_value)";
   mysqli_query($conn73,$quer);
  }
echo "|?|success|?|";
 
?>
