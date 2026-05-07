<?php
$activity=$_GET['activity'];
$sport_name=$_GET['sport_name'];

include("../../con73/con37.php");
$que15="select * from event_table where event_name='$sport_name' and event_activity='$activity'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));

while($row15=mysqli_fetch_assoc($run15)){
         
		$s_no=$row15['s_no'];
		$event_name=$row15['event_name'];
		$event_type=$row15['event_type'];
		$event_activity=$row15['event_activity'];
		$event_date_1 = $row15['event_date'];
	    $event_date_2 = explode("-",$event_date_1);
	    $event_date=$event_date_2[2]."-".$event_date_2[1]."-".$event_date_2[0];
		$event_address=$row15['event_address'];
		
	}
	
	
	echo $event_type."|?|".$event_date."|?|".$event_address;
?>