<?php include("../attachment/session.php");
	
	$s_no=$_GET['s_no'];
	$value=$_GET['value'];
	$completion_date=date('Y-m-d');

	$query2="update school_info_syllabus_info set syllabus_completion_status='$value', syllabus_actual_completion_date='$completion_date' where s_no='$s_no' and session_value='$session1'";
	
	if(mysqli_query($conn73,$query2)){
    echo "|?|success|?|";
    }
?>