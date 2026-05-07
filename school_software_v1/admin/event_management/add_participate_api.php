<?php include("../attachment/session.php");
    $participate_type = $_POST['participate_type'];
	$event_name = $_POST['event_name'];
	$house_name = $_POST['house_name'];
	$school_name = $_POST['school_name'];
	$student_name = $_POST['student_name'];
	$gender = $_POST['gender'];
	$student_class = $_POST['student_class'];
	$dateofbirth = $_POST['dateofbirth'];
	$category = $_POST['category'];
	$student_roll_no = $_POST['student_roll_no'];
	$session_value = $_POST['session_value'];
	$student_adhar_number = $_POST['student_adhar_number'];
	$student_admission_number = $_POST['student_admission_number'];
	$student_scholar_number = $_POST['student_scholar_number'];
	$student_father_name = $_POST['student_father_name'];
	$student_mother_name = $_POST['student_mother_name'];
   	

  $quer="insert into event_participate_table(participate_type,event_name,house_name,school_name,student_name,gender,student_class,dateofbirth,student_roll_no,session_value,category,student_adhar_number,student_admission_number,student_scholar_number,student_father_name,student_mother_name,$update_by_insert_sql_column)values('$participate_type','$event_name','$house_name','$school_name','$student_name','$gender','$student_class','$dateofbirth','$student_roll_no','$session_value','$category','$student_adhar_number','$student_admission_number','$student_scholar_number','$student_father_name','$student_mother_name',$update_by_insert_sql_value)";
 
 if(mysqli_query($conn73,$quer)){

echo "|?|success|?|";
}
 ?>