<?php
include("../attachment/session.php");

$delete_record=$_GET['id'];
$table_name=$_GET['question_table'];

$query="delete from $table_name where s_no='$delete_record'";

if(mysqli_query($conn73,$query)){

	echo "|?|success|?|";
}
?>
