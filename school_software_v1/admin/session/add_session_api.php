<?php
include("../attachment/session.php"); 

$session=$_POST['add_session'];
$creation_date=$_POST['creation_date'];
$last_session1=$_POST['last_session'];

$que1="insert into add_session(session,creation_date,last_session)values('$session','$creation_date','$last_session1')";
if(mysqli_query($conn73,$que1)){
echo "|?|success|?|";
}
?>