<?php 
 include("../attachment/session.php");

$delete_record=$_GET['id'];

$query="DELETE FROM `student_penality` WHERE s_no='$delete_record'";
$b=mysqli_query($conn73,$query);
if($b){
echo "|?|success|?|";
}
?>