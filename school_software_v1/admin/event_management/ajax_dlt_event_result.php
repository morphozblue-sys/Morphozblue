<?php include("../attachment/session.php"); ?>
<?php

$sno=$_GET['sno'];
$delete = "delete from event_result where s_no='$sno'";
if(mysqli_query($conn73,$delete)){
echo "|?|success|?|";
}
?>