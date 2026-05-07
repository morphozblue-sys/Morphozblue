<?php include("../attachment/session.php");

$s_no_hidden=$_POST['s_no_hidden'];
$subject_category_column_hidden=$_POST['subject_category_column_hidden'];
$subject_category=$_POST['subject_category'];

 $sql="update school_info_subject_info set $subject_category_column_hidden='$subject_category' where  s_no='$s_no_hidden'";
$res=mysqli_query($conn73,$sql) or die(mysqli_error($conn73));   
	if ($res)
	{
	 	echo "|?|success|?|";
	}

?>
