<?php include("../attachment/session.php");

$subject=$_POST['subject'];
$subject_hindi=$_POST['subject_hindi'];
$subject_code=$_POST['subject_code_hidden'];

$quer12="update school_info_subjects set subject='$subject',subject_hindi='$subject_hindi',$update_by_update_sql  where subject_code='$subject_code' and (session_value='$session1' || session_value='') $filter37";
 if(mysqli_query($conn73,$quer12)){
echo "|?|success|?|";
}
?>