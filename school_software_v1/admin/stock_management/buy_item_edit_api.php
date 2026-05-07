<?php include("../attachment/session.php");

$invoice_no = $_POST['invoice_no'];

    /// For Delete Code Start
$query0="select * from purchase_detail where invoice_number='$invoice_no' and session_value='$session1' and purchase_status='Active'";
$res0=mysqli_query($conn73,$query0) or die(mysqli_error($conn73));
while($row0=mysqli_fetch_assoc($res0)){
    $item_s_no=$row0['item_s_no'];
    $quantity=$row0['quantity'];
    $add_in_stock=$row0['add_in_stock'];
    if($add_in_stock=='Yes'){
        $query1="select available_stock from new_stock where item_s_no='$item_s_no' and new_stock_status='Active'";
        $res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
        $available_stock=0;
        while($row1=mysqli_fetch_assoc($res1)){
            $available_stock=$row1['available_stock'];
        }
        $new_available_stock=$available_stock-$quantity;
        $query2="update new_stock set available_stock='$new_available_stock',$update_by_update_sql where item_s_no='$item_s_no' and new_stock_status='Active'";
        mysqli_query($conn73,$query2);
    }
}

$query="update purchase_detail set purchase_status='Edited',$update_by_update_sql where invoice_number='$invoice_no' and session_value='$session1' and purchase_status='Active'";
mysqli_query($conn73,$query);

    /// For Delete Code End
    
	$vendor_s_no = $_POST['vendor_id'];
	$invoice_date = $_POST['invoice_date'];
	
	
	$item_class = $_POST['item_class'];
	$item_category = $_POST['item_category'];
	$item_name = $_POST['item_name'];
	$item_quantity = $_POST['item_quantity'];
	$item_rate = $_POST['item_rate'];
	$item_total = $_POST['item_total'];
	
	
	$grand_total_quantity = $_POST['grand_total_quantity'];
	$item_grand_total = $_POST['item_grand_total'];
	$total_discount_remark = $_POST['total_discount_remark'];
	$total_discount_amount = $_POST['total_discount_amount'];
	$total_payable_amount = $_POST['total_payable_amount'];
	$payment_mode = $_POST['payment_mode'];
	$cheque_bank_name = $_POST['cheque_bank_name'];
	$cheque_no = $_POST['cheque_no'];
	$cheque_date = $_POST['cheque_date'];
	$neft_bank_name = $_POST['neft_bank_name'];
	$neft_bank_account_no = $_POST['neft_bank_account_no'];
	//$ = $_POST[''];
$result=0;
$ledger_item_s_no='';
$ledger_item_class='';
$ledger_item_category='';
$comma_var='';
$item_count=count($item_name);
for($i=0; $i<$item_count; $i++){

$ledger_item_s_no=$ledger_item_s_no.$comma_var.$item_name[$i];
$ledger_item_class=$ledger_item_class.$comma_var.$item_class[$i];
$ledger_item_category=$ledger_item_category.$comma_var.$item_category[$i];
$comma_var=',';

$quer="insert into purchase_detail(vendor_s_no,invoice_number,invoice_date,item_class,item_category,item_s_no,quantity,rate,total_amount,total_quantity,grand_total,discount_remark,discount_amount,payable_amount,payment_mode,cheque_bank_name,cheque_date,cheque_number,neft_bank_name,neft_bank_acount_number,purchase_status,session_value,add_in_stock,$update_by_insert_sql_column) values('$vendor_s_no','$invoice_no','$invoice_date','$item_class[$i]','$item_category[$i]','$item_name[$i]','$item_quantity[$i]','$item_rate[$i]','$item_total[$i]','$grand_total_quantity','$item_grand_total','$total_discount_remark','$total_discount_amount','$total_payable_amount','$payment_mode','$cheque_bank_name','$cheque_date','$cheque_no','$neft_bank_name','$neft_bank_account_no','Active','$session1','No',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$quer)){
    $result++;
}
}
if($result>0){

 $quer1="update new_stock_ledger set ledger_account_type='Debit',ledger_type='Vendor',ledger_student_customer_id='$vendor_s_no',ledger_invoice_date='$invoice_date',ledger_item_class='$ledger_item_class',ledger_item_category='$ledger_item_category',ledger_item_s_no='$ledger_item_s_no',ledger_payable_amount='$total_payable_amount',ledger_payment_mode='$payment_mode',ledger_cheque_bank_name='$cheque_bank_name',ledger_cheque_date='$cheque_date',ledger_cheque_number='$cheque_no',ledger_neft_bank_name='$neft_bank_name',ledger_neft_bank_acount_number='$neft_bank_account_no',$update_by_update_sql where ledger_invoice_no='$invoice_no' and ledger_status='Active' and session_value='$session1' and ledger_account_type='Debit' and ledger_type='Vendor'";
 mysqli_query($conn73,$quer1);

 echo "|?|success|?|";
}
?>