<?php include("../attachment/session.php");
	$student_roll_no1 = $_POST['student_roll_no1'];
	$student_name = $_POST['student_name'];
	$student_class = $_POST['student_class'];
	$student_section = $_POST['student_section'];
	$student_admission_number = $_POST['student_admission_number'];
	$gate_pass_date = $_POST['gate_pass_date'];
	$gate_pass_time = $_POST['gate_pass_time'];
	$reason_for_leaving = $_POST['reason_for_leaving'];
	$recommender = $_POST['recommender'];
	$approver = $_POST['approver'];
	
	$received_by = $_POST['received_by'];
	$contact_no = $_POST['contact_no'];
	$relation = $_POST['relation'];
	
	$gate_pass_time = $_POST['gate_pass_time'];
	$send_sms = $_POST['send_sms'];
	$sms = $_POST['sms'];
	$student_sms_contact_number = $_POST['student_sms_contact_number'];
	
 	$table_exists="SELECT * FROM INFORMATION_SCHEMA.student_gate_pass";
	if(!mysqli_query($conn73,$table_exists)){
	 $creat_table="CREATE TABLE `student_gate_pass` (`s_no` int(11) NOT NULL,`student_name` varchar(50) NOT NULL,`student_class` varchar(50) NOT NULL,`student_roll_no` varchar(50) NOT NULL,`student_admission_number` varchar(50) NOT NULL,`student_section` varchar(50) NOT NULL,`gate_pass_date` varchar(50) NOT NULL,`gate_pass_time` varchar(50) NOT NULL,`recommender` varchar(50) NOT NULL,`approver` varchar(50) NOT NULL,`session_value` varchar(50) NOT NULL,`gate_pass_status` varchar(50) NOT NULL DEFAULT 'Active',`reason_for_leaving` varchar(500) NOT NULL,`update_change` varchar(50) NOT NULL,`last_updated_date` varchar(20) NOT NULL
)";
mysqli_query($conn73,$creat_table);
 $update_table="ALTER TABLE `student_gate_pass` ADD PRIMARY KEY (`s_no`);";
mysqli_query($conn73,$update_table);
$update_table1="ALTER TABLE `student_gate_pass` MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT;";
mysqli_query($conn73,$update_table1);
$update_table1="ALTER TABLE `student_gate_pass` ADD `received_by` VARCHAR(100) NOT NULL AFTER `last_updated_date`, ADD `contact_no` VARCHAR(100) NOT NULL AFTER `received_by`, ADD `relation` VARCHAR(100) NOT NULL AFTER `contact_no`;";
mysqli_query($conn73,$update_table1);
	}
	
$update_table1="ALTER TABLE `student_gate_pass` ADD `received_by` VARCHAR(100) NOT NULL AFTER `last_updated_date`, ADD `contact_no` VARCHAR(100) NOT NULL AFTER `received_by`, ADD `relation` VARCHAR(100) NOT NULL AFTER `contact_no`;";
mysqli_query($conn73,$update_table1);
 	$quer="insert into student_gate_pass(student_roll_no,student_name,student_class,student_section,student_admission_number,gate_pass_date,gate_pass_time,reason_for_leaving,recommender,approver,received_by,contact_no,relation,session_value,$update_by_insert_sql_column) 
	values('$student_roll_no1','$student_name','$student_class','$student_section','$student_admission_number','$gate_pass_date','$gate_pass_time','$reason_for_leaving','$recommender','$approver','$received_by','$contact_no','$relation','$session1',$update_by_insert_sql_value)";


    if(mysqli_query($conn73,$quer)){
	echo "|?|success|?|";
    }
      //  include("../sms/sms.php");
		if($send_sms=="Yes"){
	//	sendDNDSMS($student_sms_contact_number,$sms);	
		}
 ?>
