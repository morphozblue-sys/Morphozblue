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
  //$tc_subject=$_POST['tc_subject'];
  $tc_subject2=$_POST['tc_subject2'];
  $tc_subject3=$_POST['tc_subject3'];
  $tc_subject4=$_POST['tc_subject4'];
  $tc_subject5=$_POST['tc_subject5'];
  $tc_subject1=$_POST['tc_subject1'];
  $tc_subject6=$_POST['tc_subject6'];
  $due_if_any=$_POST['due_if_any'];
  $conduct_and_behaviour=$_POST['conduct_and_behaviour'];
  $date_of_application=$_POST['date_of_application'];
  $total_num_working=$_POST['total_num_working'];
  $num_of_days_present=$_POST['num_of_days_present'];
  $fee_concession=$_POST['fee_concession'];
  $nationality=$_POST['nationality'];
  $tc_student_category=$_POST['tc_student_category'];
  $failed_once=$_POST['failed_once'];
  $ncc_scout=$_POST['ncc_scout'];
  $games_activity=$_POST['games_activity'];
  $other_remark=$_POST['other_remark'];
  $serial_no=$_POST['serial_no'];
  $tc_generate_no=$_POST['tc_generate_no'];
  //$select_month=$_POST['select_month'];
  $select_month='|?|04|?|';
  $meetings_up_to_date=$_POST['meetings_up_to_date'];
  $Date_of_Stuck_off_role=$_POST['Date_of_Stuck_off_role'];
  $result_status=$_POST['result_status'];
  
  
  if($select_month!=''){
    $total_attendance=0;
    $total_present=0;
    $exp_select_month=explode('|?|',$select_month);
    $exp_count=count($exp_select_month);
    for($ab=1; $ab<$exp_count; $ab++){
    
    $query01="select * from student_attendance where attendance_roll_no='$student_roll_no' and session_value='$session1' and month='$exp_select_month[$ab]'";
    $res01=mysqli_query($conn73,$query01) or die(mysqli_error($conn73));
    while($row01=mysqli_fetch_assoc($res01)){
    $year=$row01['year'];
    $month=$row01['month'];
    if(($month=='04' && $year==$exp_session_year1) || ($month=='06' && $year==$exp_session_year1) || ($month=='07' && $year==$exp_session_year1) || ($month=='08' && $year==$exp_session_year1) || ($month=='09' && $year==$exp_session_year1) || ($month=='10' && $year==$exp_session_year1) || ($month=='11' && $year==$exp_session_year1) || ($month=='12' && $year==$exp_session_year1) || ($month=='01' && $year==$exp_session_year2) || ($month=='02' && $year==$exp_session_year2) || ($month=='03' && $year==$exp_session_year2)){
    $complete_date=$year.'-'.$exp_select_month[$ab].'-01';
    $number = date(' t ', strtotime($complete_date) );
    
    $day_name = date(' N ', strtotime($complete_date) );
    $day_diff=8-$day_name;
    
    
    
    
        for($i=1;$i<=$number;$i++){
        
        if($i<10){
        $x='0'.$i;
        $a=$row01['0'.$i];
        $b=$a;
        }else{
        $x=$i;
        $a=$row01[$i];
        $b=$a;
        }
        
        if($i==$day_diff || $i==$day_diff+7 || $i==$day_diff+14 || $i==$day_diff+21 || $i==$day_diff+28){
        $a="S";
        }
        $date3=$x.'-'.$exp_select_month[$ab].'-'.$year;
        $que6="select * from holiday_manage where holiday_date='$date3'";
        $result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
        while($row5=mysqli_fetch_assoc($result)){
        $a="H";
        }
        
        if($a!='S' && $a!='H'){
        $total_num_working=$total_attendance+1;
        }
        
        if($a=='P'){
        $num_of_days_present=$total_present+1;
        }elseif($a=='P/2'){
        $num_of_days_present=$total_present+0.5;
        }
        }
    
    
    
    
    }
    }
    //exit();
    }
}
  
  	$qry12="select tc_subject6 from student_tc_cbse";

  	if(mysqli_query($conn73,$qry12)){
	    
	}else{
	 $qry12="ALTER TABLE `student_tc_cbse` ADD `tc_subject6` VARCHAR(50) NOT NULL;";
	 mysqli_query($conn73,$qry12);
	}
  
  
echo $query="insert into student_tc_cbse(tc_student_roll_no,tc_student_sssm_id_no,tc_student_uid_no,tc_student_name,tc_student_father_name,tc_mother_name,date_of_birth,date_of_birth_in_word,tc_admission_no,tc_admission_date,tc_student_class,tc_student_class_leaving,tc_student_class_section,class_in_which_admitted,date_of_school_leaving,region_for_leaving,tc_subject1,tc_subject2,tc_subject3,tc_subject4,tc_subject5,tc_subject6,due_if_any,conduct_and_behaviour,date_of_application,total_num_working,num_of_days_present,fee_concession,nationality,tc_student_category,failed_once,ncc_scout,games_activity,other_remark,serial_no,session_value,tc_type,tc_generate_no,blank_field_1,blank_field_2,blank_field_3,$update_by_insert_sql_column) values ('$tc_student_roll_no','$tc_student_sssm_id_no','$tc_student_uid_no','$tc_student_name','$tc_student_father_name','$tc_mother_name','$date_of_birth','$date_of_birth_in_word','$tc_admission_no','$tc_admission_date','$tc_student_class','$tc_student_class_leaving','$tc_student_class_section','$class_in_which_admitted','$date_of_school_leaving','$region_for_leaving','$tc_subject1','$tc_subject2','$tc_subject3','$tc_subject4','$tc_subject5','$tc_subject6','$due_if_any','$conduct_and_behaviour','$date_of_application','$total_num_working','$num_of_days_present','$fee_concession','$nationality','$tc_student_category','$failed_once','$ncc_scout','$games_activity','$other_remark','$serial_no','$session1','original','$tc_generate_no','$meetings_up_to_date','$Date_of_Stuck_off_role','$result_status',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query)){
$que1="update student_admission_info set student_status='Tc_issued',$update_by_update_sql  where student_roll_no='$tc_student_roll_no' and session_value='$session1'";
mysqli_query($conn73,$que1);

$update_tc_generate_no=$tc_generate_no+1;
$qry2="update login set tc_generate_no='$update_tc_generate_no'";
$rest2=mysqli_query($conn73,$qry2);

echo "|?|success|?|";
}
 
