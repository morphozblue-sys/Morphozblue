<?php 
if(isset($_POST['finish'])){
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
	$student_photo_temp=$_FILES['student_photo']['tmp_name']; 
	$document_dob=$_FILES['document_dob']['name'];            
	$document_dob_temp=$_FILES['document_dob']['tmp_name'];
    $student_photo_hidden = $_POST['student_photo_hidden'];
	$dob_certificate_hidden = $_POST['dob_certificate_hidden'];
	
	if($document_dob!=null || $student_photo!=null){
	 $path="../../documents/student/".$student_roll_no;
	 move_uploaded_file($student_photo_temp,$path."/".$student_photo);
     move_uploaded_file($document_dob_temp,$path."/".$document_dob);
    }else{
	$document_dob=$dob_certificate_hidden;
	$student_photo=$student_photo_hidden;
	}

	
	   $quer="update sports_participate_table set sports_name='$sports_name',school_name='$school_name',student_roll_no='$student_roll_no',student_name='$student_name',student_father_name='$student_father_name',student_mother_name='$student_mother_name',student_adhar_number='$student_adhar_number',student_admission_number='$student_admission_number',student_scholar_number='$student_scholar_number',contact_no='$contact_no',board_no='$board_no',student_class='$student_class',student_section='$student_section',gender='$gender',dateofbirth='$dateofbirth',session_value='$session_value',age_category='$age_category',actual_age='$actual_age',$update_by_update_sql  where s_no='$s_no11'";
  

 if(mysqli_query($conn73,$quer)){

  $query11="update student_admission_info set sports_name='$sports_name',student_photo_blob='$student_photo',student_dob_certificate='$document_dob',$update_by_update_sql  where student_roll_no='$student_roll_no' and session_value='$session_value'";
 mysqli_query($conn73,$query11);
    echo "<script>window.open('participate_list.php','_self');</script>";
}
 }
 
 ?>