<?php
$event_name=$_GET['id'];
include("../../con73/con37.php");
$que="select * from event_table where event_name='$event_name'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$num=0;	
while($row=mysqli_fetch_assoc($run)){
$s_no=$row['s_no'];
$event_name = $row['event_name'];	
$total_participats = $row['total_participats'];	
}
if(mysqli_num_rows($run)>0){
$num=1;	
echo $total_participats."|?|".$num;
}	
?>