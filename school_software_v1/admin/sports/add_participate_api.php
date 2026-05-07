<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");

    $sports_name = $_POST['sports_name'];
	$school_name = $_POST['school_name'];
	$session_value = $_POST['session_value'];
	$student_roll_no = $_POST['student_roll_no'];
	$student_name = $_POST['student_name'];
	$student_father_name = $_POST['student_father_name'];
	$student_mother_name = $_POST['student_mother_name'];
	$student_adhar_number = $_POST['student_adhar_number'];
	$student_admission_number = $_POST['student_admission_number'];
	$student_scholar_number = $_POST['student_scholar_number'];
	$contact_no = $_POST['contact_no'];
	$board_no = $_POST['board_no'];
	$student_class = $_POST['student_class'];
	$student_section = $_POST['student_section'];
	$gender = $_POST['gender'];
	$dateofbirth = $_POST['dateofbirth'];
	$age_category = $_POST['age_category'];
	$actual_age = $_POST['actual_age'];
	
    $student_photo=$_FILES['student_photo']['name'];
	$document_dob=$_FILES['document_dob']['name'];            
	
	if($student_photo!=''){
	$imagename = $_FILES['student_photo']['name'];
	$size = $_FILES['student_photo']['size'];
    $uploadedfile = $_FILES['student_photo']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_image","student_documents","student_roll_no");
	}
	if($document_dob!=''){
	$imagename = $_FILES['document_dob']['name'];
	$size = $_FILES['document_dob']['size'];
    $uploadedfile = $_FILES['document_dob']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"student_dob_image","student_documents","student_roll_no");
	}

  $quer="insert into sports_participate_table(sports_name,board_no,school_name,student_name,gender,student_class,dateofbirth,student_roll_no,session_value,student_adhar_number,student_admission_number,student_scholar_number,student_father_name,student_mother_name,contact_no,student_section,age_category,actual_age,$update_by_insert_sql_column)values('$sports_name','$board_no','$school_name','$student_name','$gender','$student_class','$dateofbirth','$student_roll_no','$session_value','$student_adhar_number','$student_admission_number','$student_scholar_number','$student_father_name','$student_mother_name','$contact_no','$student_section','$age_category','$actual_age',$update_by_insert_sql_value)";
 if(mysqli_query($conn73,$quer)){
 $query="update student_admission_info set sports_name='$sports_name',$update_by_update_sql  where student_roll_no='$student_roll_no' and session_value='$session_value'";
 mysqli_query($conn73,$query);
 echo "|?|success|?|";
}
?>