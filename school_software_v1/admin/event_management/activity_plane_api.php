<?php include("../attachment/session.php"); 
$event_name = $_POST['event_name'];
$activity_type = $_POST['activity_type'];
$organiser = $_POST['organiser'];
$objective = $_POST['objective'];
$topic_theme = $_POST['topic_theme'];
$venue = $_POST['venue'];
$date_day = $_POST['date_day'];
$category = $_POST['category'];
$committee = $_POST['committee'];
$incharge = $_POST['incharge'];
$no_participants = $_POST['no_participants'];
$invitees = $_POST['invitees'];
$invitation_card = $_POST['invitation_card'];
$distribution_card = $_POST['distribution_card'];
$sound_system = $_POST['sound_system'];
$seating_guest = $_POST['seating_guest'];
$green_room = $_POST['green_room'];
$out_source = $_POST['out_source'];
$stage_arrangement = $_POST['stage_arrangement'];
$light_arrangement = $_POST['light_arrangement'];
$name_judges = $_POST['name_judges'];
$time_duration = $_POST['time_duration'];
$compering = $_POST['compering'];
$preparation = $_POST['preparation'];
$preparation_script = $_POST['preparation_script'];
$photography = $_POST['photography'];
$publicity_banner = $_POST['publicity_banner'];
$refreshment = $_POST['refreshment'];
$writting_report = $_POST['writting_report'];
$feedback_students = $_POST['feedback_students'];
$feedback_parents = $_POST['feedback_parents'];
$amt_spent = $_POST['amt_spent'];   
$review_event = $_POST['review_event'];

$name_participants = $_POST['name_participants'];
$count1=count($name_participants);
for($i=0;$i<$count1;$i++){
$name_participants1=explode('|?|',$name_participants[$i]);
$name_participants11=$name_participants1[1];
$id_participants=$name_participants1[0];
$quer="insert into event_activity_plan(name_participants,participant_id,event_name,activity_type,organiser,objective,topic_theme,venue,date_day,category,committee,incharge,no_participants,invitees,invitation_card,distribution_card,sound_system,seating_guest,green_room,out_source,stage_arrangement,light_arrangement,name_judges,time_duration,compering,preparation,preparation_script,photography,publicity_banner,refreshment,writting_report,feedback_students,feedback_parents,amt_spent,review_event,$update_by_insert_sql_column)

values('$name_participants11','$id_participants','$event_name','$activity_type','$organiser','$objective','$topic_theme','$venue','$date_day','$category','$committee','$incharge','$no_participants','$invitees','$invitation_card','$distribution_card','$sound_system','$seating_guest','$green_room','$out_source','$stage_arrangement','$light_arrangement','$name_judges','$time_duration','$compering','$preparation','$preparation_script','$photography','$publicity_banner','$refreshment','$writting_report','$feedback_students','$feedback_parents','$amt_spent','$review_event',$update_by_insert_sql_value)";

if(mysqli_query($conn73,$quer)){	
}
}
echo "|?|success|?|";

?>
   