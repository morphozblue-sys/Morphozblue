<?php include("../attachment/session.php");
	$pass2=mysqli_real_escape_string($conn73,$_POST['new_password']);
	$old=mysqli_real_escape_string($conn73,$_POST['old_password']);	
	$user_name=mysqli_real_escape_string($conn73,$_POST['user_name']);	
	
	$query="select * from user_rights where user_email='$user_name'";
    $run=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
    while($row=mysqli_fetch_assoc($run)){
	$user_password=$row['user_password'];
	$user_email=$row['user_email'];
	}
	
	if($user_password==$old && $user_email==$user_name){	
	$login_query="update user_rights set user_password='$pass2',$update_by_update_sql  where user_email='$user_name'";	
	$run2=mysqli_query($conn73,$login_query) or die(mysqli_error($conn73));
	session_start();
    session_destroy();
      echo "|?|success|?|";
    }
    else{
    echo "|?|error|?|";
	}



?>
