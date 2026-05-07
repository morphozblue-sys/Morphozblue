<?php include("../attachment/session.php");

	$s_no1 = $_POST['s_no1'];
	$reminder_teacher_name = $_POST['reminder_teacher_name'];
	$reminder_allocated_date_1 = $_POST['reminder_allocated_date'];
	$reminder_allocated_date_2 = explode("-",$reminder_allocated_date_1);
	$reminder_allocated_date=$reminder_allocated_date_2[2]."-".$reminder_allocated_date_2[1]."-".$reminder_allocated_date_2[0];
	$reminder_finish_date_1 = $_POST['reminder_finish_date'];
	$reminder_finish_date_2 = explode("-",$reminder_finish_date_1);
	$reminder_finish_date=$reminder_finish_date_2[2]."-".$reminder_finish_date_2[1]."-".$reminder_finish_date_2[0];
	$reminder_teacher_task_1 = $_POST['reminder_teacher_task_1'];
	$reminder_teacher_task_2 = $_POST['reminder_teacher_task_2'];
	$reminder_teacher_task_3 = $_POST['reminder_teacher_task_3'];
	$reminder_teacher_task_4 = $_POST['reminder_teacher_task_4'];
	$reminder_teacher_task_5 = $_POST['reminder_teacher_task_5'];
	$reminder_teacher_remark = $_POST['reminder_teacher_remark'];
	
$quer="update teacher_reminder set reminder_teacher_name='$reminder_teacher_name',reminder_allocated_date='$reminder_allocated_date',reminder_finish_date='$reminder_finish_date',reminder_teacher_task_1='$reminder_teacher_task_1',reminder_teacher_task_2='$reminder_teacher_task_2',reminder_teacher_task_3='$reminder_teacher_task_3',reminder_teacher_task_4='$reminder_teacher_task_4',reminder_teacher_task_5='$reminder_teacher_task_5',reminder_teacher_remark='$reminder_teacher_remark',$update_by_update_sql  where s_no='$s_no1' and session_value='$session1'";

if(mysqli_query($conn73,$quer)){

	echo "|?|success|?|";
}
?>