<?php include("../attachment/session.php");

    $student_index = $_POST['student_index'];
	$count1=count($student_index);
    $student_name = $_POST['student_name'];
	$class_section = $_POST['class_section'];
	$student_gender = $_POST['student_gender'];
	$student_adm_sch = $_POST['student_adm_sch'];
	$student_father_name = $_POST['student_father_name'];
	$student_mother_name = $_POST['student_mother_name'];
	$student_date_of_birth = $_POST['student_date_of_birth'];
	$age_category = $_POST['age_category'];
	$in_words = $_POST['in_words'];
	$session_value = $_POST['session_value'];

  
  for($i=0;$i<$count1;$i++){
  $index1=$student_index[$i];
  $quer="insert into sports_age_category(student_name,class_section,student_gender,student_adm_sch,student_father_name,student_mother_name,student_date_of_birth,age_category,in_words,session_value,$update_by_insert_sql_column)values('$student_name[$index1]','$class_section[$index1]','$student_gender[$index1]','$student_adm_sch[$index1]','$student_father_name[$index1]','$student_mother_name[$index1]','$student_date_of_birth[$index1]','$age_category[$index1]','$in_words[$index1]','$session_value[$index1]',$update_by_insert_sql_value)";
 mysqli_query($conn73,$quer);
 }
echo "|?|success|?|;	
 
?>
