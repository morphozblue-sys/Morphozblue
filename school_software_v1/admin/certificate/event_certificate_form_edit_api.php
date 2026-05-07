<?php include("../attachment/session.php");
  $s_no=$_POST['s_no'];
 $event_type=$_POST['event_type'];
 $event_organized_date1=$_POST['event_organized_date'];
 $event_organized_date2=explode("-",$event_organized_date1);
 $event_organized_date=$event_organized_date2[2]."-".$event_organized_date2[1]."-".$event_organized_date2[0];
 $event_rank=$_POST['event_rank'];
 
$query="update event_certificate set event_type='$event_type', event_organized_date='$event_organized_date', event_rank='$event_rank',$update_by_update_sql  where s_no='$s_no'";
  

    if(mysqli_query($conn73,$query)){
		
	echo "|?|success|?|";
	}
 
  
  
?>
