<?php include("../attachment/session.php");

    $item_s_no = $_POST['item_s_no'];
	$item_product_name = $_POST['item_product_name'];
	$item_product_category = $_POST['item_product_category'];
	$item_quantity = $_POST['item_quantity'];
	$item_sales_rate = $_POST['item_sales_rate'];
	$total_amount = $_POST['total_amount'];
	
	$student_name = $_POST['student_name'];
	$student_father_name = $_POST['student_father_name'];
	$student_class = $_POST['student_class'];
	$student_roll_no = $_POST['student_roll_no'];

   $quer="insert into stock_sale_table(item_product_name,item_product_category,item_quantity,item_sales_rate,total_amount,student_name,student_father_name,student_class,student_roll_no,stock_id,session_value,$update_by_insert_sql_column)
	values('$item_product_name','$item_product_category','$item_quantity','$item_sales_rate','$total_amount','$student_name','$student_father_name','$student_class','$student_roll_no','$item_s_no','$session1',$update_by_insert_sql_value)";

	$query12="select * from stock_buy_table_1 where purchase_status='Active' and s_no='$item_s_no'";
    $run1=mysqli_query($conn73,$query12);
    while($row1=mysqli_fetch_assoc($run1)){
    $item_quantity1 = $row1['item_quantity'];
	
	$item_quantity2=$item_quantity1-$item_quantity;
	
	 $query="update stock_buy_table_1 set item_quantity='$item_quantity2',$update_by_update_sql  where s_no='$item_s_no'";
     mysqli_query($conn73,$query);
	 

 }
if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>