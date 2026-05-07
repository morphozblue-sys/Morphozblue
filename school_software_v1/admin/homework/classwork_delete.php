<?php include("../attachment/session.php"); ?>
<?php

$delete_record=$_GET['id'];

$query="delete from  classwork_student where s_no='$delete_record'";

if(mysqli_query($conn73,$query)){

	echo "|?|success|?|";
}
?>