<?php
include("../attachment/session.php");
$sports_name=$_POST['sports_name'];
$que1="insert into sports_table(sports_name,$update_by_insert_sql_column)values('$sports_name',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$que1))
{
echo "|?|success|?|";
}
?>