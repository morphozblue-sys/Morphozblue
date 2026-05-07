<?php include("../attachment/session.php");

$s_no=$_POST['s_no'];
$caste_type=$_POST['caste_type'];
$caste_category=$_POST['caste_category'];
 
$query="update caste_certificate set caste_type='$caste_type', caste_category='$caste_category',$update_by_update_sql  where s_no='$s_no'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>

	