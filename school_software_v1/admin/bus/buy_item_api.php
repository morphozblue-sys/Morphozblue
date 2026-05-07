<?php include("../attachment/session.php");

	$item_product_name = $_POST['item_product_name'];
	$item_quantity = $_POST['item_quantity'];
	$item_purchase_rate = $_POST['item_purchase_rate'];
	$total_purchase_amount = $_POST['total_purchase_amount'];
	$shop_name = $_POST['shop_name'];
	$contact_person_name = $_POST['contact_person_name'];
	
	
	$quer="insert into bus_stock_purchase(item_product_name,item_quantity,item_purchase_rate,total_purchase_amount,shop_name,contact_person_name,session_value,$update_by_insert_sql_column)
	values('$item_product_name','$item_quantity','$item_purchase_rate','$total_purchase_amount','$shop_name','$contact_person_name','$session1',$update_by_insert_sql_value)";
 
 if(mysqli_query($conn73,$quer)){
	echo "|?|success|?|";
 }
 ?>