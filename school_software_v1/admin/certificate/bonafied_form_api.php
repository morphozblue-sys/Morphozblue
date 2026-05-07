<?php include("../attachment/session.php");
 $bonafied_student_name=$_POST['bonafied_student_name'];
 $bonafied_student_father_name=$_POST['bonafied_student_father_name'];
 $bonafied_school_name=$_POST['bonafied_school_name'];
 $bonafied_current_year_from=$_POST['bonafied_current_year_from'];
 $bonafied_current_year_to=$_POST['bonafied_current_year_to'];
 $bonafied_type=$_POST['bonafied_type'];
 $bonafied_issue_date1=$_POST['bonafied_issue_date'];
 $bonafied_issue_date2=explode("-",$bonafied_issue_date1);
 $bonafied_issue_date=$bonafied_issue_date2[2]."-".$bonafied_issue_date2[1]."-".$bonafied_issue_date2[0];
 $bonafied_student_roll_no=$_POST['bonafied_student_roll_no'];
 
  $query="insert into bonafied_certificate(bonafied_student_name,bonafied_student_father_name,bonafied_school_name,bonafied_current_year_from,bonafied_current_year_to,bonafied_type,bonafied_issue_date,bonafied_student_roll_no,session_value,$update_by_insert_sql_column) values('$bonafied_student_name','$bonafied_student_father_name','$bonafied_school_name','$bonafied_current_year_from','$bonafied_current_year_to','$bonafied_type','$bonafied_issue_date','$bonafied_student_roll_no','$session1',$update_by_insert_sql_value)";
 
  

    if(mysqli_query($conn73,$query)){
		
	echo "|?|success|?|";
	}
 
