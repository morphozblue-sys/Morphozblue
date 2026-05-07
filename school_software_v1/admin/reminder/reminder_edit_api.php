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
    $s_no1 = $_POST['s_no1'];

$quer="update reminder set reminder_allocated_date='$reminder_allocated_date',reminder_finish_date='$reminder_finish_date',reminder_task_1='$reminder_task_1',reminder_task_2='$reminder_task_2',reminder_task_3='$reminder_task_3',reminder_task_4='$reminder_task_4',reminder_task_5='$reminder_task_5',reminder_remark='$reminder_remark',$update_by_update_sql  where s_no='$s_no1' and session_value='$session1'";

if(mysqli_query($conn73,$quer)){

echo "|?|success|?|";
}
?>