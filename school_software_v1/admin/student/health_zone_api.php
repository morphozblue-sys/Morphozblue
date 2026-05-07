<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
  $student_name=$_POST['student_name'];
  $student_roll_no=$_POST['student_roll_no'];
  $student_class=$_POST['student_class'];
  $student_class_section=$_POST['student_class_section'];
  $student_father_name=$_POST['student_father_name'];
  $student_medical_history=$_POST['student_medical_history'];
  $student_major_illness=$_POST['student_major_illness'];
  $student_cwsn=$_POST['student_cwsn'];
  $student_cwsn_description=$_POST['student_cwsn_description'];
  $student_height=$_POST['student_height'];
  $student_weight=$_POST['student_weight'];
  
  $health_checkup=$_POST['health_checkup'];
  $checkup_date=$_POST['checkup_date'];
  $checkup_hospital_name=$_POST['checkup_hospital_name'];
  $checkup_doctor_name=$_POST['checkup_doctor_name'];
  $checkup_bp=$_POST['checkup_bp'];
  $checkup_hb=$_POST['checkup_hb'];
  $checkup_suger=$_POST['checkup_suger'];
  $checkup_hiv=$_POST['checkup_hiv'];
  $checkup_tb=$_POST['checkup_tb'];
  $eye_problem=$_POST['eye_problem'];
  $specs=$_POST['specs'];
  $left_specs_no=$_POST['left_specs_no'];
  $right_specs_no=$_POST['right_specs_no'];
  $checkup_remark=$_POST['checkup_remark'];
  $checkup_discription=$_POST['checkup_discription'];
  $checkup_marks=$_POST['checkup_marks'];
  $blood_group=$_POST['blood_group'];
  
  $checkup_report1=$_FILES['checkup_report1']['name'];
 
  $que151="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
$run151=mysqli_query($conn73,$que151) or die(mysqli_error($conn73));
if(mysqli_num_rows($run151)<1){
  	  $quer1232="insert into student_medical_info(student_roll_no,session_value,$update_by_insert_sql_column)values('$student_roll_no','$session1',$update_by_insert_sql_value)";
    mysqli_query($conn73,$quer1232);
  }
  if($health_checkup=='checkup1'){
  
$query="update student_medical_info set student_name='$student_name',student_class='$student_class',student_class_section='$student_class_section',student_father_name='$student_father_name',student_medical_history='$student_medical_history',student_major_illness='$student_major_illness',student_cwsn='$student_cwsn',student_cwsn_description='$student_cwsn_description',student_height='$student_height',student_weight='$student_weight',checkup1_date='$checkup_date',checkup1_hospital_name='$checkup_hospital_name',checkup1_doctor_name='$checkup_doctor_name',checkup1_bp='$checkup_bp',checkup1_hb='$checkup_hb',checkup1_suger='$checkup_suger',checkup1_hiv='$checkup_hiv',checkup1_tb='$checkup_tb',checkup1_eye_problem='$eye_problem',checkup1_specs='$specs',checkup1_left_specs_no='$left_specs_no',checkup1_right_specs_no='$right_specs_no',checkup1_remark='$checkup_remark',checkup1_discription='$checkup_discription',checkup1_marks='$checkup_marks',blood_group='$blood_group',$update_by_update_sql  where student_roll_no='$student_roll_no'";
  
  
  mysqli_query($conn73,$query);
  		if($checkup_report1!=''){
	$imagename = $_FILES['checkup_report1']['name'];
	$size = $_FILES['checkup_report1']['size'];
	$uploadedfile = $_FILES['checkup_report1']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"checkup1_report","student_health","student_roll_no");
	}
echo "|?|success|?|";
  
  
  }else{
  
$query1="update student_medical_info set student_name='$student_name',student_class='$student_class',student_class_section='$student_class_section',student_father_name='$student_father_name',student_medical_history='$student_medical_history',student_major_illness='$student_major_illness',student_cwsn='$student_cwsn',student_cwsn_description='$student_cwsn_description',student_height='$student_height',student_weight='$student_weight',checkup2_date='$checkup_date',checkup2_hospital_name='$checkup_hospital_name',checkup2_doctor_name='$checkup_doctor_name',checkup2_bp='$checkup_bp',checkup2_hb='$checkup_hb',checkup2_suger='$checkup_suger',checkup2_hiv='$checkup_hiv',checkup2_tb='$checkup_tb',checkup2_eye_problem='$eye_problem',checkup2_specs='$specs',checkup2_left_specs_no='$left_specs_no',checkup2_right_specs_no='$right_specs_no',checkup2_remark='$checkup_remark',checkup2_discription='$checkup_discription',checkup2_marks='$checkup_marks',blood_group='$blood_group',$update_by_update_sql  where student_roll_no='$student_roll_no'";
   
   
  mysqli_query($conn73,$query1);
  		if($checkup_report1!=''){
	$imagename = $_FILES['checkup_report1']['name'];
	$size = $_FILES['checkup_report1']['size'];
	$uploadedfile = $_FILES['checkup_report1']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$student_roll_no,"checkup2_report","student_health","student_roll_no");
	}
echo "|?|success|?|";
 
 }
 	
	?>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>