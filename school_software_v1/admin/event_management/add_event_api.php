<?php include("../attachment/session.php");

$queryy="select event_date from event_table";
$run=mysqli_query($conn73,$queryy);
if(!$run){
$query1="ALTER TABLE `event_table` ADD `event_date` DATE NOT NULL";
mysqli_query($conn73,$query1);
}




$event_name=$_POST['event_name'];
$total_participats=$_POST['total_participats'];
$event_date =$_POST['event_date'];
$que1="insert into event_table(event_name,total_participats,event_date)values('$event_name','$total_participats','$event_date')";
if(mysqli_query($conn73,$que1)){
echo "|?|success|?|";
}
?>