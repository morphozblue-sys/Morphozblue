<?php include("../attachment/session.php");
  $s_no=$_POST['s_no'];
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
  $any_fee_concession=$_POST['any_fee_concession'];
  $wheather_ncc_scount_guide=$_POST['wheather_ncc_scount_guide'];
  $Games_Played_Or_Extra_Activity=$_POST['Games_Played_Or_Extra_Activity'];
  $result_status=$_POST['result_status'];
  $total_num_working=$_POST['total_num_working'];
  $num_of_days_present=$_POST['num_of_days_present'];
  $any_other_remark=$_POST['any_other_remark'];
  $tc_remark=$_POST['tc_remark'];
  $date_of_application=$_POST['date_of_application'];
  $due_date=$_POST['due_date'];
    $nationality=$_POST['nationality'];
  $paid_month=$_POST['paid_month'];

  //$query="update student_tc set tc_student_roll_no='$tc_student_roll_no',tc_generate_no='$tc_generate_no',tc_student_sssm_id_no='$tc_student_sssm_id_no',tc_student_uid_no='$tc_student_uid_no',tc_student_name='$tc_student_name',tc_student_father_name='$tc_student_father_name',tc_mother_name='$tc_mother_name',date_of_birth='$date_of_birth',date_of_birth_in_word='$date_of_birth_in_word',tc_admission_no='$tc_admission_no',tc_admission_date='$tc_admission_date',tc_student_class='$tc_student_class',tc_student_class_leaving='$tc_student_class_leaving',tc_student_class_section='$tc_student_class_section',class_in_which_admitted='$class_in_which_admitted',date_of_school_leaving='$date_of_school_leaving',region_for_leaving='$region_for_leaving',due_if_any='$due_if_any',conduct_and_behaviour='$conduct_and_behaviour',blank_field_1='$meetings_up_to_date',blank_field_2='$Date_of_Stuck_off_role',blank_field_3='$result_status',tc_subject1='$tc_subject1',tc_subject2='$tc_subject2',tc_subject3='$tc_subject3',tc_subject4='$tc_subject4',tc_subject5='$tc_subject5',date_of_application='$date_of_application',total_num_working='$total_num_working',num_of_days_present='$num_of_days_present',fee_concession='$fee_concession',nationality='$nationality',tc_student_category='$tc_student_category',failed_once='$failed_once',ncc_scout='$ncc_scout',games_activity='$games_activity',other_remark='$other_remark' where s_no='$s_no'";
  if($_SESSION['software_link']=='holyangelkurawar')
  $query="update student_tc set tc_student_roll_no='$tc_student_roll_no',tc_generate_no='$tc_generate_no',tc_student_sssm_id_no='$tc_student_sssm_id_no',tc_student_uid_no='$tc_student_uid_no',tc_student_name='$tc_student_name',tc_student_father_name='$tc_student_father_name',tc_mother_name='$tc_mother_name',date_of_birth='$date_of_birth',date_of_birth_in_word='$date_of_birth_in_word',tc_admission_no='$tc_admission_no',tc_admission_date='$tc_admission_date',tc_student_class='$tc_student_class',tc_student_class_leaving='$tc_student_class_leaving',tc_student_class_section='$tc_student_class_section',class_in_which_admitted='$class_in_which_admitted',date_of_school_leaving='$date_of_school_leaving',region_for_leaving='$region_for_leaving',tc_subject='$tc_subject',due_if_any='$due_if_any',conduct_and_behaviour='$conduct_and_behaviour',blank_field_2='$any_fee_concession',blank_field_5='$wheather_ncc_scount_guide',blank_field_4='$Games_Played_Or_Extra_Activity',blank_field_3='$result_status',total_num_working='$total_num_working',num_of_days_present='$num_of_days_present',month_pupil_has_paid='$paid_month',blank_field_1='$due_date',date_of_application='$date_of_application',any_other_remark='$any_other_remark',tc_remark='$tc_remark',nationality='$nationality' where s_no='$s_no'";
  else
  $query="update student_tc set tc_student_roll_no='$tc_student_roll_no',tc_generate_no='$tc_generate_no',tc_student_sssm_id_no='$tc_student_sssm_id_no',tc_student_uid_no='$tc_student_uid_no',tc_student_name='$tc_student_name',tc_student_father_name='$tc_student_father_name',tc_mother_name='$tc_mother_name',date_of_birth='$date_of_birth',date_of_birth_in_word='$date_of_birth_in_word',tc_admission_no='$tc_admission_no',tc_admission_date='$tc_admission_date',tc_student_class='$tc_student_class',tc_student_class_leaving='$tc_student_class_leaving',tc_student_class_section='$tc_student_class_section',class_in_which_admitted='$class_in_which_admitted',date_of_school_leaving='$date_of_school_leaving',region_for_leaving='$region_for_leaving',tc_subject='$tc_subject',due_if_any='$due_if_any',conduct_and_behaviour='$conduct_and_behaviour',blank_field_2='$any_fee_concession',blank_field_5='$wheather_ncc_scount_guide',blank_field_4='$Games_Played_Or_Extra_Activity',blank_field_3='$result_status',total_num_working='$total_num_working',num_of_days_present='$num_of_days_present',month_pupil_has_paid='$paid_month',blank_field_1='$due_date',date_of_application='$date_of_application',any_other_remark='$any_other_remark' ,tc_remark='$tc_remark' where s_no='$s_no'";
  
  
  if(mysqli_query($conn73,$query)){
  $que1="update student_admission_info set student_status='Tc_issued',$update_by_update_sql  where student_roll_no='$tc_student_roll_no' and session_value='$session1'";
	mysqli_query($conn73,$que1);
	echo "|?|success|?|";
	}


?>
