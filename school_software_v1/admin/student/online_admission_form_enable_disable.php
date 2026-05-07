<?php include("../attachment/session.php");
$s_no=$_GET['s_no'];
$value=$_GET['value'];
$query="update student_admission_info_website set website_status='$value' where s_no='$s_no'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>