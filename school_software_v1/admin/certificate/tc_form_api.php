<?php include("../attachment/session.php");
  $tc_student_roll_no=$_POST['tc_student_roll_no'];
  $tc_student_sssm_id_no=$_POST['tc_student_sssm_id_no'];
  $tc_student_uid_no=$_POST['tc_student_uid_no'];
  $tc_student_name=$_POST['tc_student_name'];
  $tc_student_father_name=$_POST['tc_student_father_name'];
  $tc_mother_name=$_POST['tc_mother_name'];
  $date_of_birth=$_POST['date_of_birth'];
  $date_of_birth_in_word=$_POST['date_of_birth_in_word'];
  $tc_admission_no=$_POST['tc_admission_no'];
  $tc_admission_date=$_POST['tc_admission_date'];
  $tc_student_class=$_POST['tc_student_class'];
  $tc_student_class_section=$_POST['tc_student_class_section'];
  $tc_student_class_leaving=$_POST['tc_student_class_leaving'];
  $class_in_which_admitted=$_POST['class_in_which_admitted'];
  $date_of_school_leaving=$_POST['date_of_school_leaving'];
  $region_for_leaving=$_POST['region_for_leaving'];
  $tc_subject=$_POST['tc_subject'];
  $due_if_any=$_POST['due_if_any'];
  $conduct_and_behaviour=$_POST['conduct_and_behaviour'];
  $tc_generate_no=$_POST['tc_generate_no'];
  $due_date=$_POST['due_date'];
  $result_status=$_POST['result_status'];
  $any_fee_concession=$_POST['any_fee_concession'];
  $wheather_ncc_scount_guide=$_POST['wheather_ncc_scount_guide'];
  $Games_Played_Or_Extra_Activity=$_POST['Games_Played_Or_Extra_Activity'];
  $total_num_working=$_POST['total_num_working'];
  $num_of_days_present=$_POST['num_of_days_present'];
  $date_of_application=$_POST['date_of_application'];
  $any_other_remark=$_POST['any_other_remark'];
  $paid_month=$_POST['paid_month'];
  $Nationality=$_POST['Nationality'];
  $Place_Of_Birth=$_POST['Place_Of_Birth'];
  $Last_School_Attend=$_POST['Last_School_Attend'];
  $Other_Remark=$_POST['Other_Remark'];
  if($_SESSION['software_link']=='vidyaviharchanda'){
 $query="insert into student_tc(tc_student_roll_no,tc_generate_no,tc_student_sssm_id_no,tc_student_uid_no,tc_student_name,tc_student_father_name,tc_mother_name,date_of_birth,date_of_birth_in_word,tc_admission_no,tc_admission_date,tc_student_class,tc_student_class_leaving,tc_student_class_section,class_in_which_admitted,date_of_school_leaving,region_for_leaving,tc_subject,due_if_any,conduct_and_behaviour,session_value,blank_field_1,blank_field_2,blank_field_3,blank_field_4,blank_field_5,total_num_working,num_of_days_present,date_of_application,any_other_remark,month_pupil_has_paid,Nationality,Place_Of_Birth,Last_School_Attend,Other_Remark,$update_by_insert_sql_column) 
  values ('$tc_student_roll_no','$tc_generate_no','$tc_student_sssm_id_no','$tc_student_uid_no','$tc_student_name','$tc_student_father_name','$tc_mother_name','$date_of_birth','$date_of_birth_in_word','$tc_admission_no','$tc_admission_date','$tc_student_class','$tc_student_class_leaving','$tc_student_class_section','$class_in_which_admitted','$date_of_school_leaving','$region_for_leaving','$tc_subject','$due_if_any','$conduct_and_behaviour','$session1','$due_date','$any_fee_concession','$result_status','$Games_Played_Or_Extra_Activity','$wheather_ncc_scount_guide','$total_num_working','$num_of_days_present','$date_of_application','$any_other_remark','$paid_month','$Nationality','$Place_Of_Birth','$Last_School_Attend','$Other_Remark',$update_by_insert_sql_value)";    
  
  }
  else
  {
  $query="insert into student_tc(tc_student_roll_no,tc_generate_no,tc_student_sssm_id_no,tc_student_uid_no,tc_student_name,tc_student_father_name,tc_mother_name,date_of_birth,date_of_birth_in_word,tc_admission_no,tc_admission_date,tc_student_class,tc_student_class_leaving,tc_student_class_section,class_in_which_admitted,date_of_school_leaving,region_for_leaving,tc_subject,due_if_any,conduct_and_behaviour,session_value,blank_field_1,blank_field_2,blank_field_3,blank_field_4,blank_field_5,total_num_working,num_of_days_present,date_of_application,any_other_remark,month_pupil_has_paid,$update_by_insert_sql_column) values ('$tc_student_roll_no','$tc_generate_no','$tc_student_sssm_id_no','$tc_student_uid_no','$tc_student_name','$tc_student_father_name','$tc_mother_name','$date_of_birth','$date_of_birth_in_word','$tc_admission_no','$tc_admission_date','$tc_student_class','$tc_student_class_leaving','$tc_student_class_section','$class_in_which_admitted','$date_of_school_leaving','$region_for_leaving','$tc_subject','$due_if_any','$conduct_and_behaviour','$session1','$due_date','$any_fee_concession','$result_status','$Games_Played_Or_Extra_Activity','$wheather_ncc_scount_guide','$total_num_working','$num_of_days_present','$date_of_application','$any_other_remark','$paid_month',$update_by_insert_sql_value)";
  }
  if(mysqli_query($conn73,$query)){
     $que1="update student_admission_info set student_status='Tc_issued',$update_by_update_sql  where student_roll_no='$tc_student_roll_no' and session_value='$session1'";
	mysqli_query($conn73,$que1);
	
	$tc_generate_no=$tc_generate_no+1;
	$sql="update login set tc_generate_no='$tc_generate_no'";
	mysqli_query($conn73,$sql);
	echo "|?|success|?|";
	}

