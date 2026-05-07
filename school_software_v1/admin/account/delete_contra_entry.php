<?php include("../attachment/session.php"); 
$s_no=$_GET['s_no'];
$que3="UPDATE contra_entry set account_status='Deactive' where uniq_id='$s_no' "; 
$run=mysqli_query($conn73,$que3);

if(mysqli_affected_rows($conn73)>0)
echo '|?|success|?|';
?>