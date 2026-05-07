<?php include("../attachment/session.php");
	
	$s_no=$_GET['s_no'];
	
	$query2="delete from school_info_syllabus_info where s_no='$s_no' and session_value='$session1'";
	
	if(mysqli_query($conn73,$query2)){
    echo "|?|success|?|";
    }
?>