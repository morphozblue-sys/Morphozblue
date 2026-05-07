<?php include("../attachment/session.php");
$house=$_POST['house'];
$que1="insert into event_house(house)values('$house')";
if(mysqli_query($conn73,$que1)){
echo "|?|success|?|";
}
?>