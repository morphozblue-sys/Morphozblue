<?php include("../attachment/session.php");

$s_no=$_POST['s_no'];
$other_certificate_type=$_POST['other_certificate_type'];
$other_certificate_name=$_POST['caste_category'];
 
$query="update other_certificate set other_certificate_type='$other_certificate_type', other_certificate_name='$other_certificate_name',$update_by_update_sql  where s_no='$s_no'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>

	