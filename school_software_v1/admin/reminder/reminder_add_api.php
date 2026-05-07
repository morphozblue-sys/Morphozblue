<?php include("../attachment/session.php");
	$reminder_allocated_date_1 = $_POST['reminder_allocated_date'];
	$reminder_allocated_date_2 = explode("-",$reminder_allocated_date_1);
	$reminder_allocated_date=$reminder_allocated_date_2[2]."-".$reminder_allocated_date_2[1]."-".$reminder_allocated_date_2[0];
	$reminder_finish_date_1 = $_POST['reminder_finish_date'];
	$reminder_finish_date_2 = explode("-",$reminder_finish_date_1);
	$reminder_finish_date=$reminder_finish_date_2[2]."-".$reminder_finish_date_2[1]."-".$reminder_finish_date_2[0];
	$reminder_task_1 = $_POST['reminder_task_1'];
	$reminder_task_2 = $_POST['reminder_task_2'];
	$reminder_task_3 = $_POST['reminder_task_3'];
	$reminder_task_4 = $_POST['reminder_task_4'];
	$reminder_task_5 = $_POST['reminder_task_5'];
	$reminder_remark = $_POST['reminder_remark'];
	
	$quer="insert into reminder(reminder_allocated_date,reminder_finish_date,reminder_task_1,reminder_task_2,reminder_task_3,reminder_task_4,reminder_task_5,reminder_remark,session_value,$update_by_insert_sql_column)
      values('$reminder_allocated_date','$reminder_finish_date','$reminder_task_1','$reminder_task_2','$reminder_task_3','$reminder_task_4','$reminder_task_5','$reminder_remark','$session1',$update_by_insert_sql_value)";
 
if(mysqli_query($conn73,$quer)){

	echo "|?|success|?|";
}
?>