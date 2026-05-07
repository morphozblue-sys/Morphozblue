<?php include("../attachment/session.php");
 $s_no=$_POST['s_no'];
 $character_school_name=$_POST['character_school_name'];
 $character_current_year_from=$_POST['character_current_year_from'];
 $character_current_year_to=$_POST['character_current_year_to'];
 $character_type=$_POST['character_type'];
 $character_issue_date1=$_POST['character_issue_date'];
 $character_issue_date2=explode("-",$character_issue_date1);
 $character_issue_date=$character_issue_date2[2]."-".$character_issue_date2[1]."-".$character_issue_date2[0];
 
 echo $query="update character_certificate set character_school_name='$character_school_name', character_current_year_from='$character_current_year_from', character_current_year_to='$character_current_year_to', character_type='$character_type', character_issue_date='$character_issue_date',$update_by_update_sql  where s_no='$s_no'";
  

    if(mysqli_query($conn73,$query)){
		
	echo "|?|success|?|";
	}
 

  
?>

	