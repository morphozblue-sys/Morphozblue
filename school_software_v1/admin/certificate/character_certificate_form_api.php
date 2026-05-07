<?php include("../attachment/session.php");
 $character_student_name=$_POST['character_student_name'];
 $character_student_father_name=$_POST['character_student_father_name'];
 $character_school_name=$_POST['character_school_name'];
 $character_current_year_from=$_POST['character_current_year_from'];
 $character_current_year_to=$_POST['character_current_year_to'];
 $character_type=$_POST['character_type'];
 $character_issue_date1=$_POST['character_issue_date'];
 $character_issue_date2=explode("-",$character_issue_date1);
 $character_issue_date=$character_issue_date2[2]."-".$character_issue_date2[1]."-".$character_issue_date2[0];
 $character_student_roll_no=$_POST['student_roll_no'];
 
 $query="insert into character_certificate(character_student_name,character_student_father_name,character_school_name,character_current_year_from,character_current_year_to,character_type,character_issue_date,character_student_roll_no,session_value,$update_by_insert_sql_column) values('$character_student_name','$character_student_father_name','$character_school_name','$character_current_year_from','$character_current_year_to','$character_type','$character_issue_date','$character_student_roll_no','$session1',$update_by_insert_sql_value)";
 
  

    if(mysqli_query($conn73,$query)){
		
	echo "|?|success|?|";
	}
 
