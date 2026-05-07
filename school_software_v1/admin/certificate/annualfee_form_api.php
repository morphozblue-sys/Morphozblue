<?php include("../attachment/session.php");
 $annualfee_student_name=$_POST['annualfee_student_name'];
 $annualfee_student_father_name=$_POST['annualfee_student_father_name'];
 $annualfee_school_name=$_POST['annualfee_school_name'];
 $annualfee_current_year_from=$_POST['annualfee_current_year_from'];
 $annualfee_current_year_to=$_POST['annualfee_current_year_to'];
 $annualfee_type=$_POST['annualfee_type'];
 $annualfee_issue_date1=$_POST['annualfee_issue_date'];
 $annualfee_issue_date2=explode("-",$annualfee_issue_date1);
 $annualfee_issue_date=$annualfee_issue_date2[2]."-".$annualfee_issue_date2[1]."-".$annualfee_issue_date2[0];
 $annualfee_student_roll_no=$_POST['annualfee_student_roll_no'];
 
$query="insert into annualfee_certificate(annualfee_student_name,annualfee_student_father_name,annualfee_school_name,annualfee_current_year_from,annualfee_current_year_to,annualfee_type,annualfee_issue_date,annualfee_student_roll_no,session_value,$update_by_insert_sql_column) values('$annualfee_student_name','$annualfee_student_father_name','$annualfee_school_name','$annualfee_current_year_from','$annualfee_current_year_to','$annualfee_type','$annualfee_issue_date','$annualfee_student_roll_no','$session1',$update_by_insert_sql_value)";

     if(mysqli_query($conn73,$query)){
	echo "|?|success|?|";
	}
 
