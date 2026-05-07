<?php include("../attachment/session.php")?>
<?php
include("../../con73/con37.php");
$s_no=$_GET['s_no'];

$query3="delete from expense_monthly where s_no='$s_no' and session_value='$session1'";
if(mysqli_query($conn73,$query3)){
echo "<script>window.open('expense_monthly_list.php','_self')</script>";
}
?>