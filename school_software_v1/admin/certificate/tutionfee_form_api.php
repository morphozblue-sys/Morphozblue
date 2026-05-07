<?php include("../attachment/session.php");
 $tutionfee_student_name=$_POST['tutionfee_student_name'];
 $tutionfee_student_father_name=$_POST['tutionfee_student_father_name'];
 $tutionfee_school_name=$_POST['tutionfee_school_name'];
 $tutionfee_current_year_from=$_POST['tutionfee_current_year_from'];
 $tutionfee_current_year_to=$_POST['tutionfee_current_year_to'];
 $tutionfee_type=$_POST['tutionfee_type'];
 $tutionfee_fees_other=$_POST['tutionfee_fees_other'];
 $tutionfee_issue_date1=$_POST['tutionfee_issue_date'];
 $tutionfee_issue_date2=explode("-",$tutionfee_issue_date1);
 $tutionfee_issue_date=$tutionfee_issue_date2[2]."-".$tutionfee_issue_date2[1]."-".$tutionfee_issue_date2[0];
 $tutionfee_student_roll_no=$_POST['tutionfee_student_roll_no'];
 	$qry12="select tutionfee_fees_other from tutionfee_certificate";
	if(mysqli_query($conn73,$qry12)){
	    
	}else{
	 $qry12="ALTER TABLE `tutionfee_certificate` ADD `tutionfee_fees_other` VARCHAR(50) NOT NULL;";
	 mysqli_query($conn73,$qry12);
	}

  echo  $query="insert into tutionfee_certificate(tutionfee_student_name,tutionfee_student_father_name,tutionfee_school_name,tutionfee_current_year_from,tutionfee_current_year_to,tutionfee_type,tutionfee_fees_other,tutionfee_issue_date,tutionfee_student_roll_no,session_value,$update_by_insert_sql_column) values('$tutionfee_student_name','$tutionfee_student_father_name','$tutionfee_school_name','$tutionfee_current_year_from','$tutionfee_current_year_to','$tutionfee_type','$tutionfee_fees_other','$tutionfee_issue_date','$tutionfee_student_roll_no','$session1',$update_by_insert_sql_value)";
    if(mysqli_query($conn73,$query)){
	echo "|?|success|?|";
	}
