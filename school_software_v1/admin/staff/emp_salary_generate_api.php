<?php include("../attachment/session.php");

	$emp_id=$_POST['emp_id'];
	$emp_name=$_POST['emp_name'];
	$emp_account_no=$_POST['emp_account_no'];
	$salary_from=$_POST['salary_from'];
	$salary_from1=$_POST['salary_from'];
	$salary_payment_mode=$_POST['salary_payment_mode'];
	$cheque_bank_name=$_POST['cheque_bank_name'];
	$cheque_no=$_POST['cheque_no'];
	$cheque_date=$_POST['cheque_date'];
	$neft_bank_name=$_POST['neft_bank_name'];
	$neft_bank_account_no=$_POST['neft_bank_account_no'];
	$salary_from2=explode("-",$salary_from1);
	$salary_from_m=$salary_from2[1];
	$salary_from_y=$salary_from2[2];
    $d=cal_days_in_month(CAL_GREGORIAN,$salary_from_m,$salary_from_y);
	$salary_current_date=date("Y-m-d");
	
	$salary_to=$_POST['salary_to'];
	$pf_number=$_POST['pf_number'];

	
	$total_present=$_POST['total_present'];
	$total_absent=$_POST['total_absent'];
	$total_leave=$_POST['total_leave'];
	$verify_total_leaves=$_POST['verify_total_leaves'];
	$leave_verification=$_POST['leave_verification'];
    



	
/***********************Salary Calculations Start********************************/

	
/***********************Salary Calculations End********************************/
	
$level_ptax_deduction11=$_POST['level_ptax_deduction11'];
$level_esic_deduction11=$_POST['level_esic_deduction11'];
$level_tds_deduction11=$_POST['level_tds_deduction11'];
$level_pf_deduction11=$_POST['level_pf_deduction11'];
$level_other_deduction11=$_POST['level_other_deduction11'];
$level_other_deduction_remark11=$_POST['level_other_deduction_remark11'];
$level_total_incentive11=$_POST['level_total_incentive11'];
$level_allowance11=$_POST['level_allowance11'];
$level_basic_salary11=$_POST['level_basic_salary11'];
$level_total_present11=$_POST['level_total_present11'];
$level_total_absent11=$_POST['level_total_absent11'];
$level_salary_days11=$_POST['level_salary_days11'];
$level_total_leave11=$_POST['level_total_leave11'];
$level_total_deduction11=$_POST['level_total_deduction11'];
$level_final_salary111=$_POST['level_final_salary11'];
if($_SESSION['database_name1']=='sanskarschoolnarsinghpur'){
  $level_final_salary11 = round($level_final_salary111);  
}else{
  $level_final_salary11=$level_final_salary111; 
}
$level_working_days11=$_POST['level_working_days11'];
$level_days_in_month11=$_POST['level_days_in_month11'];
$level_per_day_salary11=$_POST['level_per_day_salary11'];
$level_total_holiday11=$_POST['level_total_holiday11'];
$level_total_sunday11=$_POST['level_total_sunday11'];
$level_total_days11=$_POST['level_total_days11'];
$level_total_advance11=$_POST['level_total_advance11'];
$da_amount=$_POST['da_amount'];
$hra_amount=$_POST['hra_amount'];
$salery_generate_date=$_POST['salery_generate_date'];
	

	$dsjhks="ALTER TABLE `employee_salary_generate` ADD `emp_account_no` VARCHAR(50) NOT NULL AFTER `filter3`;";
	
 mysqli_query($conn73,$dsjhks);
	
 $quer="insert into employee_salary_generate(emp_id,employee_name,emp_account_no,employee_salary_date_from,employee_salary_date_to,employee_total_working_day,employee_total_incentive,employee_salary_generate_date,employee_total_pay,employee_pf_no,employee_pf_amount,total_present,total_absent,total_leave,verify_total_leaves,leave_verification,employee_salary_status,salary_payment_mode,cheque_bank_name,cheque_no,cheque_date,neft_bank_name,neft_bank_account_no,esic_amount,tds_amount,ptax_amount,advance_amount,total_sunday,total_holiday,other_deduction,other_deduction_remark,allowance,basic_salary,final_salary,salary_day,hra_amount,da_amount,session_value,$update_by_insert_sql_column) values('$emp_id','$emp_name','$emp_account_no','$salary_from','$salary_to','$level_working_days11','$level_total_incentive11','$salery_generate_date','$level_basic_salary11','$pf_number','$level_pf_deduction11','$level_total_present11','$level_total_absent11','$level_total_leave11','$verify_total_leaves','$leave_verification','Active','$salary_payment_mode','$cheque_bank_name','$cheque_no','$cheque_date','$neft_bank_name','$neft_bank_account_no','$level_esic_deduction11','$level_tds_deduction11','$level_ptax_deduction11','$level_total_advance11','$level_total_sunday11','$level_total_holiday11','$level_other_deduction11','$level_other_deduction_remark11','$level_allowance11','$level_basic_salary11','$level_final_salary11','$level_salary_days11','$hra_amount','$da_amount','$session1',$update_by_insert_sql_value)";

 
 
if(mysqli_query($conn73,$quer)){
    
 $query="insert into ledger_info (emp_id_or_student_roll_no,emp_or_student_name,date,amount_type,payment_mode,total_amount,credit_or_debit_from,session_value,$update_by_insert_sql_column) values('$emp_id','$emp_name','$salery_generate_date','Debit','$salary_payment_mode','$level_final_salary11','salary','$session1',$update_by_insert_sql_value)";
 mysqli_query($conn73,$query);
	echo "|?|success|?|";
	
}

?>


