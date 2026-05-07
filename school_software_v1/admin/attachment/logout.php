<?php include("../attachment/session.php"); 
$logout_time=date("Y-m-d h:i:sa");
$session_id=$_SESSION['session_id'];
 $query="update login_details set logout_time='$logout_time' where session_id='$session_id'";

mysqli_query($conn73,$query);
session_destroy();

 echo "<script>window.open('index.php','_self')</script>";
?>
