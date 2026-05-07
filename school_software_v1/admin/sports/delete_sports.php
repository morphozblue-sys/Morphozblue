<?php include("../attachment/session.php");

$delete_record=$_GET['id'];

$query="delete from sports_table where s_no='$delete_record'";

if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>
