<?php
include("../attachment/session.php");
$sports_type=$_POST['sports_type'];
$que1="insert into sports_level(sports_type,$update_by_insert_sql_column)values('$sports_type',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$que1))
{
echo "|?|success|?|";
}
?>