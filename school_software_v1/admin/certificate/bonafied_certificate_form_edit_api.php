<?php include("../attachment/session.php");
 $s_no=$_POST['s_no'];
 $bonafied_school_name=$_POST['bonafied_school_name'];
 $bonafied_current_year_from=$_POST['bonafied_current_year_from'];
 $bonafied_current_year_to=$_POST['bonafied_current_year_to'];
 $bonafied_type=$_POST['bonafied_type'];
 $bonafied_issue_date1=$_POST['bonafied_issue_date'];
 $bonafied_issue_date2=explode("-",$bonafied_issue_date1);
 $bonafied_issue_date=$bonafied_issue_date2[2]."-".$bonafied_issue_date2[1]."-".$bonafied_issue_date2[0];
 
 echo $query="update bonafied_certificate set bonafied_school_name='$bonafied_school_name', bonafied_current_year_from='$bonafied_current_year_from', bonafied_current_year_to='$bonafied_current_year_to', bonafied_type='$bonafied_type', bonafied_issue_date='$bonafied_issue_date',$update_by_update_sql  where s_no='$s_no'";
  

    if(mysqli_query($conn73,$query)){
		
	echo "|?|success|?|";
	}
 

  
?>

	