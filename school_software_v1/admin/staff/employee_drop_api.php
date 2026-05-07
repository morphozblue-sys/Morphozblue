<?php include("../attachment/session.php");

	$s_no=$_POST['s_no'];
	$drop_date=$_POST['drop_date'];

 $query="update employee_info set emp_drop_date='$drop_date' where s_no='$s_no'";
if(mysqli_query($conn73,$query)){
	echo "|?|success|?|";
}

?>