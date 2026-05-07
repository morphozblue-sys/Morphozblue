<?php include("../attachment/session.php");
 $s_no=$_POST['s_no'];
 $tutionfee_school_name=$_POST['tutionfee_school_name'];
 $tutionfee_current_year_from=$_POST['tutionfee_current_year_from'];
 $tutionfee_current_year_to=$_POST['tutionfee_current_year_to'];
 $tutionfee_type=$_POST['tutionfee_type'];
 $tutionfee_issue_date1=$_POST['tutionfee_issue_date'];
 $tutionfee_issue_date2=explode("-",$tutionfee_issue_date1);
 $tutionfee_issue_date=$tutionfee_issue_date2[2]."-".$tutionfee_issue_date2[1]."-".$tutionfee_issue_date2[0];
 
 echo $query="update tutionfee_certificate set tutionfee_school_name='$tutionfee_school_name', tutionfee_current_year_from='$tutionfee_current_year_from', tutionfee_current_year_to='$tutionfee_current_year_to', tutionfee_type='$tutionfee_type', tutionfee_issue_date='$tutionfee_issue_date',$update_by_update_sql  where s_no='$s_no'";
  

    if(mysqli_query($conn73,$query)){
		
	echo "|?|success|?|";
	}
 

  
?>

	