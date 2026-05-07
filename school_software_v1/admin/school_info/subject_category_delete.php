<?php include("../attachment/session.php"); ?>
<?php
$s_no = $_GET['s_no'];
$subject_category_column = $_GET['subject_category_column'];
$quer1="update school_info_subject_info set $subject_category_column='' where s_no='$s_no'";
if(mysqli_query($conn73,$quer1)){
echo "|?|success|?|";
}
?>