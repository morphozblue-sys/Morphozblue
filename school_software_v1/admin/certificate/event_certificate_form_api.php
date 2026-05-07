<?php include("../attachment/session.php");
 $event_student_name=$_POST['event_student_name'];
$event_type=$_POST['event_type'];
 $event_student_class=$_POST['event_student_class'];
$event_student_section=$_POST['event_student_section'];
$event_organized_date1=$_POST['event_organized_date'];
 $event_organized_date2=explode("-",$event_organized_date1);
 $event_organized_date=$event_organized_date2[2]."-".$event_organized_date2[1]."-".$event_organized_date2[0];
 $event_rank=$_POST['event_rank'];
 $event_student_roll_no=$_POST['event_student_roll_no'];
 
 $query="insert into event_certificate(event_student_name,event_student_class,event_student_section,event_type,event_organized_date,event_rank,event_student_roll_no,session_value,$update_by_insert_sql_column) values('$event_student_name','$event_student_class','$event_student_section','$event_type','$event_organized_date','$event_rank','$event_student_roll_no','$session1',$update_by_insert_sql_value)";
 
  

    if(mysqli_query($conn73,$query)){
		
	echo "|?|success|?|";
	}
 
