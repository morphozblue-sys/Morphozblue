<?php include("../attachment/session.php");
	$fitness_test_date = $_POST['fitness_test_date'];
	$student_name = $_POST['student_name'];
	$student_father_name = $_POST['student_father_name'];
	$student_roll_no = $_POST['student_roll_no'];
	$student_class = $_POST['student_class'];
	$student_class_section = $_POST['student_class_section'];
    $term = $_POST['fitness_test'];	
	$body_weight_rawscore = $_POST['body_weight_rawscore'];
	$body_weight_zone = $_POST['body_weight_zone'];
	$body_weight_description = $_POST['body_weight_description'];
	$body_height_rawscore = $_POST['body_height_rawscore'];
	$body_height_zone = $_POST['body_height_zone'];
	$body_height_description = $_POST['body_height_description'];
	$pacer_raw_score = $_POST['pacer_raw_score'];
	$pacer_zone = $_POST['pacer_zone'];
	$pacer_description = $_POST['pacer_description'];
	$trunk_lift_raw_score = $_POST['trunk_lift_raw_score'];
	$trunk_lift_zone = $_POST['trunk_lift_zone'];
	$trunk_lift_description = $_POST['trunk_lift_description'];
	$sit_reach_l_raw_score = $_POST['sit_reach_l_raw_score'];
	$sit_reach_l_zone = $_POST['sit_reach_l_zone'];
	$sit_reach_l_description = $_POST['sit_reach_l_description'];
	$sit_reach_r_raw_score = $_POST['sit_reach_r_raw_score'];
	$sit_reach_r_zone = $_POST['sit_reach_r_zone'];	
	$sit_reach_r_description = $_POST['sit_reach_r_description'];
	$curl_raw_score = $_POST['curl_raw_score'];
	$curl_zone = $_POST['curl_zone'];
	$curl_description = $_POST['curl_description'];
	$standing_raw_score = $_POST['standing_raw_score'];
	$standing_zone = $_POST['standing_zone'];
	$standing_description = $_POST['standing_description'];
	
  /*------------------------------------make column variable------------------------------*/
  /*------------------------------------start------------------------------*/
	$term_body_weight_rawscore=$term.'_body_weight_rawscore';
	$term_body_weight_zone=$term.'_body_weight_zone';
	$term_body_weight_description=$term.'_body_weight_description';
	$term_body_height_rawscore=$term.'_body_height_rawscore';
	$term_body_height_zone=$term.'_body_height_zone';
	$term_body_height_description=$term.'_body_height_description';
	$term_pacer_raw_score=$term.'_pacer_raw_score';
	$term_pacer_zone=$term.'_pacer_zone';
	$term_pacer_description=$term.'_pacer_description';
	$term_trunk_lift_raw_score=$term.'_trunk_lift_raw_score';
	$term_trunk_lift_zone=$term.'_trunk_lift_zone';
	$term_trunk_lift_description=$term.'_trunk_lift_description';
	$term_sit_reach_l_raw_score=$term.'_sit_reach_l_raw_score';
	$term_sit_reach_l_zone=$term.'_sit_reach_l_zone';
	$term_sit_reach_l_description=$term.'_sit_reach_l_description';
	$term_sit_reach_r_raw_score=$term.'_sit_reach_r_raw_score';
	$term_sit_reach_r_zone=$term.'_sit_reach_r_zone';
	$term_sit_reach_r_description=$term.'_sit_reach_r_description';
	$term_curl_raw_score=$term.'_curl_raw_score';
	$term_curl_zone=$term.'_curl_zone';
	$term_curl_description=$term.'_curl_description';
	$term_standing_raw_score=$term.'_standing_raw_score';
	$term_standing_zone=$term.'_standing_zone';
	$term_standing_description=$term.'_standing_description';
  /*------------------------------------make column variable------------------------------*/
  /*------------------------------------End------------------------------*/

    $que151="select * from student_physical_fitness where student_roll_no='$student_roll_no' and session_value='$session1'";
$run151=mysqli_query($conn73,$que151) or die(mysqli_error($conn73));
if(mysqli_num_rows($run151)<1){
  	  $quer1232="insert into student_physical_fitness(student_roll_no,session_value,$update_by_insert_sql_column)values('$student_roll_no','$session1',$update_by_insert_sql_value)";
    mysqli_query($conn73,$quer1232);
  }
  
  
	$quer22="update student_physical_fitness set fitness_test_date='$fitness_test_date',student_name='$student_name',student_father_name='$student_father_name',student_class='$student_class',student_class_section='$student_class_section',fitness_test='$term',$term_body_weight_rawscore='$body_weight_rawscore',$term_body_weight_zone='$body_weight_zone',$term_body_weight_description='$body_weight_description',$term_body_height_rawscore='$body_height_rawscore',$term_body_height_zone='$body_height_zone',$term_body_height_description='$body_height_description',$term_pacer_raw_score='$pacer_raw_score',$term_pacer_zone='$pacer_zone',$term_pacer_description='$pacer_description',$term_trunk_lift_raw_score='$trunk_lift_raw_score',$term_trunk_lift_zone='$trunk_lift_zone',$term_trunk_lift_description='$trunk_lift_description',$term_sit_reach_l_raw_score='$sit_reach_l_raw_score',$term_sit_reach_l_zone='$sit_reach_l_zone',$term_sit_reach_l_description='$sit_reach_l_description',$term_sit_reach_r_raw_score='$sit_reach_r_raw_score',$term_sit_reach_r_zone='$sit_reach_r_zone',$term_sit_reach_r_description='$sit_reach_r_description',$term_curl_raw_score='$curl_raw_score',$term_curl_zone='$curl_zone',$term_standing_raw_score='$standing_raw_score',$term_standing_zone='$standing_zone',$term_standing_description='$standing_description',$term_standing_description='$standing_description',$term_curl_description='$curl_description',$update_by_update_sql  where student_roll_no='$student_roll_no'";

    if(mysqli_query($conn73,$quer22)){
echo "|?|success|?|";
	}
   
  
  ?>

	