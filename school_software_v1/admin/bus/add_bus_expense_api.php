<?php include("../attachment/session.php");

	$bus_name = $_POST['bus_name'];
	$bus_detail=explode('|?|',$bus_name);
	$bus_expance_remark = $_POST['bus_expance_remark'];
	$bus_expance_amount = $_POST['bus_expance_amount'];
	$garage_shop = $_POST['garage_shop'];
	$maintainance_date = $_POST['maintainance_date'];
	$bill_date = $_POST['bill_date'];
	$current_date = $_POST['payment_date'];
	$bus_reading = $_POST['bus_reading'];

if(!isset($_POST['bus_expanse_s_no'])){


	$qry12="select garage_shop from bus_expense";
	if(mysqli_query($conn73,$qry12)){
	    
	}else{
	 $qry12="ALTER TABLE `bus_expense` ADD `garage_shop` VARCHAR(50) NOT NULL, ADD `maintainance_date` VARCHAR(50) NOT NULL, ADD `bill_date` VARCHAR(50) NOT NULL;";
	 mysqli_query($conn73,$qry12);
	}


 $query="insert into bus_expense(bus_id,expense_remark,expense_amount,date,garage_shop,maintainance_date,bill_date,bus_reading,$update_by_insert_sql_column) values('$bus_detail[4]','$bus_expance_remark','$bus_expance_amount','$current_date','$garage_shop','$maintainance_date','$bill_date','$bus_reading',$update_by_insert_sql_value)";
	
if(mysqli_query($conn73,$query)){

 $last_id=mysqli_insert_id();
   $query1="insert into ledger_info(emp_or_student_name,date,amount_type,payment_mode,total_amount,credit_or_debit_from,session_value,blank_field_1,blank_field_2,$update_by_insert_sql_column) values('Bus Expense','$current_date','Debit','Cash','$bus_expance_amount','bus','$session1','$last_id','$bus_detail[4]',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query1)){
echo "|?|success|?|";
}

}

}

if(isset($_POST['bus_expanse_s_no'])){

$bus_expanse_s_no = $_POST['bus_expanse_s_no'];
$query="update bus_expense set bus_id='$bus_detail[4]',expense_remark='$bus_expance_remark',expense_amount='$bus_expance_amount',date='$current_date',garage_shop='$garage_shop',maintainance_date='$maintainance_date',bill_date='$bill_date',bus_reading='$bus_reading',$update_by_update_sql where s_no='$bus_expanse_s_no'";
	
if(mysqli_query($conn73,$query)){

$query1="update ledger_info set total_amount='$bus_expance_amount',blank_field_2='$bus_detail[4]',date='$current_date',$update_by_update_sql where blank_field_1='$bus_expanse_s_no' and session_value='$session1' and credit_or_debit_from='bus'";
if(mysqli_query($conn73,$query1)){
echo "|?|success|?|";
}

}


}
?>