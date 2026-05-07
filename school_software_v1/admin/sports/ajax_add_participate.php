<?php
$activity=$_GET['activity'];
$sport_name=$_GET['sport_name'];

include("../../con73/con37.php");
$que15="select * from sports_table where sports_name='$sport_name' and sports_activity='$activity'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));

while($row15=mysqli_fetch_assoc($run15)){
         
		$s_no=$row15['s_no'];
		$sports_name=$row15['sports_name'];
		$sports_type=$row15['sports_type'];
		$sports_activity=$row15['sports_activity'];
		$sports_date_1 = $row15['sports_date'];
	    $sports_date_2 = explode("-",$sports_date_1);
	    $sports_date=$sports_date_2[2]."-".$sports_date_2[1]."-".$sports_date_2[0];
		$sports_address=$row15['sports_address'];
		
	}
	
	
	echo $sports_type."|?|".$sports_date."|?|".$sports_address;
?>