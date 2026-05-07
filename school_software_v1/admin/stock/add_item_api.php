<?php include("../attachment/session.php");

 	$item_product_name = $_POST['item_product_name'];
	$item_product_category = $_POST['item_product_category'];
	$item_brand_name = $_POST['item_brand_name'];
	$item_description = $_POST['item_description'];
	$item_quantity = $_POST['item_quantity'];
	$item_code = $_POST['item_code'];
	$item_rate = $_POST['item_rate'];
	
mysqli_query($conn73,"ALTER TABLE `stock_item_table` ADD `item_code` VARCHAR(50) NOT NULL,ADD `item_product_category` VARCHAR(50) NOT NULL,ADD `item_rate` VARCHAR(50) NOT NULL,ADD `item_quantity` VARCHAR(50) NOT NULL;");
 $quer="insert into stock_item_table(item_code,item_quantity,item_product_name,item_product_category,item_brand_name,item_description,item_status,item_rate,session_value,$update_by_insert_sql_column)values('$item_code','$item_quantity','$item_product_name','$item_product_category','$item_brand_name','$item_description','Active','$item_rate','$session1',$update_by_insert_sql_value)";

if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>